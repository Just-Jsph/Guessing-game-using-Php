<?php
include "db.php";
session_start();

if(isset($_SESSION["user_id"])){
    header("Location: game.php");
    exit();
}

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $email = $_POST["email"] ?? "";
    $password =$_POST["password"] ?? "";

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE email = ? AND password = ?"
    );

    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["email"] = $user["email"];

        header("Location: game.php");
        exit();

    }else{

        echo "Invalid Email or Password";

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
</head>
<body>
    <form  method="post">
        <H1>Welcome to the guessing game</H1>
        <p>Email</p>
        <input type="text" name="email" required>
        <p>Password</p>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        <p>Don't have an account?</p>
        <button type="button" onclick="window.location.href='register.php'">
    Register here
</button>
    </form>
</body>
</html>