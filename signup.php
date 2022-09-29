<?php
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(E_ALL);
session_start();
if ($_SESSION["user"]) {
    header("Location: profile.php");
}

?>
<!Doctype html>
<meta charset="utf-8">
<head>
    <link rel="stylesheet" href="assets/style.css">
    <title>Тестовое задание</title>
</head>
<body>
<form>
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите логин">
    <p class="msg none" id="errorLogin"></p>
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <p class="msg none" id="errorPassword"></p>
    <label>Подтвердите пароль</label>
    <input type="password" name="passwordConfirm" placeholder="Введите пароль">
    <p class="msg none" id="errorPasswordConfirm"></p>
    <label>Email</label>
    <input type="email" name="email" placeholder="Введите адрес почты">
    <p class="msg none" id="errorEmail"></p>
    <label>Имя пользователя</label>
    <input type="text" name="name" placeholder="Введите имя">
    <p class="msg none" id="errorName"></p>
    <input type="button" value="Регистрация" class="sign-btn">
    <p> Есть аккаунт?<a href="login.php"> Пройди авторизацию</a>.</p>

</form>

<script src="assets/jquery-3.6.1.js"></script>
<script src="assets/main.js"></script>

</body>
</html>