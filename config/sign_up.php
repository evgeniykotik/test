<?php
session_start();

require_once "UsersStorage.php";
require_once "errorMessage.php";
require_once "Constant.php";


$login = trim($_POST["login"]);
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];
$email = $_POST["email"];
$name = trim($_POST["name"]);

$storage = CrudStorage::getUsersStorage();
$userLogin = $storage->read("login", $login);
$isUniqueLogin = $userLogin == null;
$userEmail = $storage->read("email", $email);
$isUniqueEmail = $userEmail == null;

$response = [];
$newUser = [];

if (str_replace(" ", "", $login) != $login) {
    $response["messageLogin"] = ErrorMessage::$errorMessage["errorLoginWithoutSpace"];
}
if (strlen($login) < Constant::MIN_LOGIN_LENGTH) {
    $response["messageLogin"] = sprintf(ErrorMessage::$errorMessage["errorLoginLength"], Constant::MIN_LOGIN_LENGTH);
}
if (!$isUniqueLogin) {
    $response["messageLogin"] = ErrorMessage::$errorMessage["errorLoginUnique"];
}
if (strlen($password) < Constant::MIN_PASSWORD_LENGTH) {
    $response["messagePassword"] = sprintf(ErrorMessage::$errorMessage["errorPasswordLength"], Constant::MIN_PASSWORD_LENGTH);
}
if (!preg_match("/((?<=\d)[a-z])|((?<=[a-z])\d)/i", $password)) {
    $response["messagePassword"] = ErrorMessage::$errorMessage["errorPasswordContent"];
}
if ($password !== $passwordConfirm) {
    $response["messagePasswordConfirm"] = ErrorMessage::$errorMessage["errorPasswordConfirm"];
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response["messageEmail"] = ErrorMessage::$errorMessage["errorEmail"];
}
if (!$isUniqueEmail) {
    $response["messageEmail"] = ErrorMessage::$errorMessage["errorEmailUnique"];
}
if (!preg_match("/^[a-z]+$/i", $name)) {
    $response["messageName"] = ErrorMessage::$errorMessage["errorNameContent"];
}
if (strlen($name) < Constant::MIN_NAME_LENGTH) {
    $response["messageName"] = sprintf(ErrorMessage::$errorMessage["errorNameLength"], Constant::MIN_NAME_LENGTH);
}
if (empty($response)) {
    $response["status"] = true;
    $newUser = new User($login, md5($password . $login), $email, $name);
    $storage->create($newUser);
    echo json_encode($response);
} else {
    $response["status"] = false;
    echo json_encode($response);
    die;
}