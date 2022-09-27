function handleErrorMessage(message, element) {
    if (message == null) {
        element.addClass('none');
    } else {
        element.removeClass('none').text(message);
    }
}

//Авторизация

$('.login-btn').click(function (e) {
    e.preventDefault();
    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'config/log_in.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success: function (data) {
            if (data.status === true) {
                document.location.href = 'profile.php';
            } else {
                handleErrorMessage(data["messageLogin"], $('#1'));
                handleErrorMessage(data["messagePassword"], $('#2'))
            }
        }
    });
});

//Регистрация
$('.sign-btn').click(function (e) {
    e.preventDefault();
    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val(),
        passwordConfirm = $('input[name="passwordConfirm"]').val(),
        email = $('input[name="email"]').val(),
        name = $('input[name="name"]').val();

    $.ajax({
        url: 'config/sign_up.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
            passwordConfirm: passwordConfirm,
            email: email,
            name: name
        },
        success: function (data) {
            if (data.status === true) {
                document.location.href = 'login.php';
            } else {
                handleErrorMessage(data["messageLogin"], $('#1'));
                handleErrorMessage(data["messagePassword"], $('#2'));
                handleErrorMessage(data["messagePasswordConfirm"], $('#3'));
                handleErrorMessage(data["messageEmail"], $('#4'));
                handleErrorMessage(data["messageName"], $('#5'));
            }
        }
    });
});