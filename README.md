# LaBanca - Personal Banking System

**A comprehensive web-based banking application built with PHP and MySQL**

> This project represents my first major undertaking after learning PHP, serving as a practical exploration of how I envisioned a banking system would work.

## 🏦 Project Overview

LaBanca is a full-featured banking simulation system that implements core banking functionalities including user management, account operations, transaction processing, and administrative controls. The system demonstrates fundamental banking concepts through a clean, modern web interface.

## ✨ Key Features

### 🔐 User Authentication & Management
- **User Registration**: Secure account creation with input validation
- **User Login**: Session-based authentication system
- **Profile Management**: Update personal information, profile pictures, and passwords
- **Account Security**: Password hashing and secure session handling

### 💰 Core Banking Operations
- **Balance Checking**: Real-time account balance display
- **Deposit Funds**: Add money to user accounts with transaction logging
- **Withdraw Funds**: Secure money withdrawal with balance verification
- **Money Transfers**: Peer-to-peer transfers between user accounts
- **Transaction History**: Complete audit trail of all financial operations

### 🎨 Modern User Interface
- **Responsive Design**: Mobile-first approach with clean, minimalist styling
- **Interactive Dialogs**: Modern modal dialogs for transaction operations
- **Real-time Feedback**: Instant notifications and form validation
- **Professional Styling**: Monochrome design with subtle animations

### 👥 Administrative Panel
- **User Management**: View all registered users and their account details
- **Transaction Monitoring**: Complete transaction history across all accounts
- **Review Management**: Customer feedback and support system
- **Password Reset**: Administrative password reset functionality
- **System Statistics**: User count and total system balance tracking

### 📱 Additional Features
- **Contact System**: Customer support and feedback collection
- **Profile Pictures**: User avatar upload and management
- **Session Management**: Secure logout and session timeout handling
- **Input Validation**: Comprehensive form validation and sanitization

## 🛠 Technical Architecture

### Backend Technologies
- **PHP**: Server-side logic and business operations
- **MySQL**: Database management with MySQLi extension
- **Session Management**: PHP sessions for user state management
- **File Upload**: Secure profile picture upload system

### Frontend Technologies
- **HTML5**: Semantic markup structure
- **CSS3**: Modern styling with flexbox and grid layouts
- **JavaScript**: Interactive dialogs and form enhancements
- **Responsive Design**: Mobile-friendly interface

### Security Features
- **Password Hashing**: Secure password storage using PHP's password_hash()
- **Input Sanitization**: Protection against XSS and injection attacks
- **Session Security**: Proper session management and user verification
- **File Upload Security**: Restricted file types and size validation

## 📊 Database Structure

The system utilizes three main database tables:

### Users Table
- User credentials and personal information
- Account balance tracking
- Profile picture references
- Registration timestamps

### Transactions Table
- Complete transaction history
- User ID associations
- Transaction types and amounts
- Timestamp logging

### Reviews Table
- Customer feedback system
- Contact information
- Support message tracking

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- ModRewrite enabled

### Database Configuration
1. Create a MySQL database for the application
2. Copy `database.example.php` to `database.php`
3. Update database credentials in `database.php`:
   ```php
   $db_host = "your_host";
   $db_user = "your_username";
   $db_pass = "your_password";
   $db_name = "your_database_name";
   ```

### File Permissions
- Ensure `profile_picture_images/` directory is writable
- Set appropriate permissions for file uploads

### Initial Setup
1. Create the required database tables
2. Set up an admin user account
3. Configure file upload directories
4. Test database connectivity

## 📁 Project Structure

```
laBanca/
├── components/           # Reusable header and footer components
├── admin/               # Administrative panel and management tools
├── profile_picture_images/ # User profile picture storage
├── index.php           # Main dashboard
├── signin.php          # User authentication
├── signup.php          # User registration
├── profile.php         # User profile management
├── transactions.php    # Banking operations interface
├── contact.php         # Customer support system
├── api.php            # Core banking functions
├── database.php       # Database configuration
└── styles.css         # Application styling
```

## 🎯 Core Banking Functions

### Balance Management
- `check_balance($user_id)` - Retrieve current account balance
- Real-time balance updates across all operations

### Transaction Processing
- `deposit_cash($user_id, $amount)` - Process deposit transactions
- `withdraw_cash($user_id, $amount)` - Handle withdrawal operations
- `transfer_cash($from, $to, $amount)` - Execute money transfers

### Audit Trail
- Complete transaction logging for all operations
- Detailed transaction history with timestamps
- User-specific transaction filtering

## 🔧 Development Notes

This project was developed as a learning exercise to understand:
- PHP fundamentals and best practices
- Database design and MySQL operations
- Web security considerations
- User interface design principles
- Session management and authentication
- File handling and uploads

## 🚨 Security Considerations

- All user inputs are sanitized and validated
- Passwords are properly hashed before storage
- Session management prevents unauthorized access
- File upload restrictions prevent malicious uploads
- SQL queries use proper parameterization where applicable

## 📝 Future Enhancements

Potential improvements for the system could include:
- API development for mobile applications
- Advanced transaction filtering and search
- Email notifications for transactions
- Two-factor authentication
- Account statements and reporting
- Interest calculation system
- Loan management functionality

## 🌐 Live Demo

The website is currently **live and functional** at: **[labanca.free.nf](http://labanca.free.nf)**

> **Status**: Development complete until further notice. The project is fully functional and available for viewing and testing.

**Feedback Welcome**: Any recommendations, suggestions, or bug reports are greatly appreciated! Feel free to reach out via LinkedIn or open an issue.

## 👨‍💻 Developer

**Levi Njoroge Junior**
- LinkedIn: [levinjorogejr](https://www.linkedin.com/in/levinjorogejr/)

---

*This project serves as a demonstration of PHP web development skills and banking system conceptualization. It was created as a first major project after learning PHP fundamentals.*
