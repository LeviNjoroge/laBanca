function submitReview() {
    var tel = document.getElementById('tel');
    var email = document.getElementById('email');
    var message = document.getElementById('message');
    var time = now();

    var Feedback = {
        tel: tel.value,
        email: email.value,
        message: message.value,
        time: time
    };

    // feed this to customer_feedback.json
    var feedback = JSON.stringify(Feedback);
    localStorage.setItem('customer_feedback', feedback);
    
    alert('Thank you for your feedback!');
}
