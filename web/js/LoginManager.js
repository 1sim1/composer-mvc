$(document).ready(function() {
    $('#login').off('submit').on('submit', onSubmitLogin);
    $('#register').off('submit').on('submit', onSubmitRegister);
    
});

onSubmitLogin = function(e) {
    e.preventDefault();
    let email = $('#email').val();
    alert('Invio la seguente mail per la validazione: ' + email);
    $.ajax({
        url: '/login',
        type: "POST",
        success: onPostShowCredentials,
        async: true,
        context: this,
        crossBrowser: "true",
        data: { 'email' : email }
    });
}
onPostShowCredentials = function(response) {
    response = $.parseJSON(response);
    alert(response.msg);
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