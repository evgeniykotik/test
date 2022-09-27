<?php
session_start();
if (!$_SESSION["user"]) {
    header("Location: login.php");
}
?>
<!Doctype html>
<meta charset="utf-8">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Тестовое задание</title>
</head>
<body>
<p>
    <?php
    echo "Hello, {$_SESSION["user"]["name"]}";

    ?>
</p>
<p><a href="config/logOut.php" class="logout">Выход</a></p>
</body>
