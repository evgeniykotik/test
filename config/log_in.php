<?php
session_start();

require_once "UsersStorage.php";
require_once "errorMessage.php";

$login = trim($_POST["login"]);
$password = $_POST["password"];
$response = [];

$storage = CrudStorage::getUsersStorage();
$user = $storage->read("login", $login);

if ($user == null) {
    $response = [
        "messageLogin" => ErrorMessage::$errorMessage["errorLogin"]
    ];
    echo json_encode($response);
    die();
} else {
    $md5 = md5($password . $login);
    if ($md5 == $user->getFieldValue("password")) {
        $_SESSION["user"] = ["name" => $user->getFieldValue("name")];
        $response = [
            "status" => true
        ];
        echo json_encode($response);
    } else {
        $response = [
            "messagePassword" => ErrorMessage::$errorMessage["errorPassword"]
        ];
        echo json_encode($response);
        die();
    }
}
