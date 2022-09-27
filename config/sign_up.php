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
$user = $storage->read($login);
$isUnique = $user == null;

$response = [];
$newUser = [];

if (strlen($login) < Constant::MIN_LOGIN_LENGTH) {
    $response["messageLogin"] = sprintf(ErrorMessage::$errorMessage["errorLoginLength"], Constant::MIN_LOGIN_LENGTH);
}
if (!$isUnique) {
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
if (!preg_match("/^[a-z]+$/i", $name)) {
    $response["messageName"] = ErrorMessage::$errorMessage["errorNameContent"];
}
if (strlen($name) < Constant::MIN_NAME_LENGTH) {
    $response["messageName"] = sprintf(ErrorMessage::$errorMessage["errorNameLength"], Constant::MIN_NAME_LENGTH);
}
if (empty($response)) {
    $response["status"] = true;
    $newUser = ["login" => $login, "password" => md5($password . $login), "email" => $email, "name" => $name];
    $storage->create($newUser);
    echo json_encode($response);
} else {
    $response["status"] = false;
    echo json_encode($response);
    die();
}