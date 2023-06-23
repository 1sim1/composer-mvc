$(document).ready(function() {
    $('#login').off('click').on('click', onSubmitLogin);
    $('#register').off('click').on('click', onSubmitRegister);
    
});

onSubmitLogin = function() {
    let email = $('#email').val();
    alert('Login con email ' + email);
}

onSubmitRegister = function() {
    let firstName = $('#firstname').val();
    let lastName = $('#lastname').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let confirmPassword = $('#confirmPassword').val();

    if(password !== confirmPassword) {
        alert('Le password inserite non coincidono');
    } else {
        alert('Campi inseriti: ' + firstName + ', ' + lastName + ', ' + email);
    }
}