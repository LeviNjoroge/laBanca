<?php
session_start();
include("database.php");

// Google OAuth handler
header('Content-Type: application/json');

// Get the JSON input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!isset($data['credential']) || !isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

// Verify the Google JWT token
function verifyGoogleToken($token) {
    // You need to verify the JWT token with Google's API
    // For production, use Google's PHP client library or verify manually
    
    // Decode the JWT (this is a simplified version - use proper JWT library in production)
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return false;
    }
    
    $payload = json_decode(base64_decode($parts[1]), true);
    
    // Basic validation - in production, verify signature with Google's public keys
    if (!$payload || !isset($payload['email']) || !isset($payload['name'])) {
        return false;
    }
    
    return $payload;
}

$googleUser = verifyGoogleToken($data['credential']);

if (!$googleUser) {
    echo json_encode(['success' => false, 'message' => 'Invalid Google token']);
    exit;
}

$email = $googleUser['email'];
$name = $googleUser['name'];
$googleId = $googleUser['sub'] ?? '';
$picture = $googleUser['picture'] ?? '';

// Split name into first and last name
$nameParts = explode(' ', $name, 2);
$firstName = $nameParts[0];
$lastName = isset($nameParts[1]) ? $nameParts[1] : '';

if ($data['action'] === 'signin') {
    // Handle Google Sign-In
    $checkUser = "SELECT * FROM users WHERE email_address = ? OR google_id = ?";
    $stmt = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($stmt, "ss", $email, $googleId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // User exists, log them in
        $user = mysqli_fetch_assoc($result);
        
        // Set session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['id_no'] = $user['national_id_no'];
        $_SESSION['date_of_birth'] = $user['date_of_birth'];
        $_SESSION['surname'] = $user['surname'];
        $_SESSION['email'] = $user['email_address'];
        $_SESSION['phone'] = $user['phone_number'];
        $_SESSION['balance'] = $user['balance'];
        $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'default.jpeg';
        
        // Update Google ID if not set
        if (empty($user['google_id'])) {
            $updateGoogleId = "UPDATE users SET google_id = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $updateGoogleId);
            mysqli_stmt_bind_param($stmt, "si", $googleId, $user['id']);
            mysqli_stmt_execute($stmt);
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Signed in successfully',
            'redirect' => $user['username'] === 'admin' ? '/admin/admin.php' : 'index.php'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No account found. Please sign up first.']);
    }
    
} elseif ($data['action'] === 'signup') {
    // Handle Google Sign-Up
    $checkUser = "SELECT * FROM users WHERE email_address = ? OR google_id = ?";
    $stmt = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($stmt, "ss", $email, $googleId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Account already exists. Please sign in instead.']);
    } else {
        // Create new user account
        $username = strtolower(str_replace(' ', '', $firstName . $lastName)) . rand(100, 999);
        
        // Generate a random password (user can change it later)
        $randomPassword = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);
        
        $insertUser = "INSERT INTO users (first_name, last_name, surname, username, email_address, password, google_id, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertUser);
        $defaultPicture = 'default.jpeg';
        mysqli_stmt_bind_param($stmt, "ssssssss", $firstName, $lastName, $lastName, $username, $email, $randomPassword, $googleId, $defaultPicture);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'success' => true, 
                'message' => 'Account created successfully! Please complete your profile.',
                'redirect' => 'signin.php'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create account. Please try again.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

mysqli_close($conn);
?>
