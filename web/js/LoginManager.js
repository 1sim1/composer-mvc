$(document).ready(function() {
    $('#login').off('submit').on('submit', onSubmitLogin);
    $('#register').off('submit').on('submit', onSubmitRegister);
    
});

onSubmitLogin = function(e) {
    e.preventDefault();
    let email = $('#email').val();
    alert('Login con email ' + email);
}

onSubmitRegister = function(e) {
    e.preventDefault();
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