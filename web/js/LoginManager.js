$(document).ready(function () {
    $('#login').off('submit').on('submit', onSubmitLogin);
    $('#register').off('submit').on('submit', onSubmitRegister);
    $('#contact').off('submit').on('submit', onSubmitContact);
});

onSubmitLogin = function (e) {
    e.preventDefault();
    let email = $('#email').val();
    let password = $('#password').val();
    alert('Invio la seguente mail per la validazione: ' + email);
    $.ajax({
        url: '/login',
        type: "POST",
        success: onPostForms,
        async: true,
        context: this,
        crossBrowser: "true",
        data: {
            'email': email,
            'password': password
        }
    });
}

onSubmitRegister = function (e) {
    e.preventDefault();
    let firstName = $('#firstname').val();
    let lastName = $('#lastname').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let confirmPassword = $('#confirmPassword').val();

    if (password !== confirmPassword) {
        alert('Le password inserite non coincidono');
    } else {
        alert('Campi da validare: ' + firstName + ', ' + lastName + ', ' + email);
        $.ajax({
            url: '/register',
            type: "POST",
            success: onPostForms,
            async: true,
            context: this,
            crossBrowser: "true",
            data: {
                'firstname': firstName,
                'lastname': lastName,
                'email': email,
                'password': password,
                'confirmPassword': confirmPassword
            }
        });
    }
}

onSubmitContact = function (e) {
    e.preventDefault();
    let subject = $('#subject').val();
    let email = $('#email').val();
    let body = $('#body').val();

    alert('Invio il seguente testo per la validazione: ' + subject + ': ' + body);
    $.ajax({
        url: '/contact',
        type: "POST",
        success: onPostForms,
        async: true,
        context: this,
        crossBrowser: "true",
        data: {
            'subject': subject,
            'email': email,
            'body': body
        }
    });
}

onPostForms = function (response) {
    response = $.parseJSON(response);
    alert(response.msg);
}