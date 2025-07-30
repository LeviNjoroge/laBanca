function submitReview(params) {
    var tel = document.getElementById('tel');
    var email = document.getElementById('email');
    var message = document.getElementById('message');
    var time = now();

    var data = {
        tel: tel.value,
        email: email.value,
        message: message.value,
        time: time
    };
}
