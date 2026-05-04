<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_login = "";
    $admin_password = ""; 

    if ($_POST["login"] == $admin_login && $_POST["password"] == $admin_password) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "Неверные данные";
    }
}
?>

<form action="login.php" method="POST">
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Entry</button>
</form>
