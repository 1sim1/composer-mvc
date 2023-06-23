$(document).ready(function() {
    $('#login').off('click').on('click', onSubmitLogin);
});

onSubmitLogin = function() {
    let email = $('#email').val();
    alert('Login con email ' + email);
}