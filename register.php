<?php
include "db.php";
session_start();

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    echo "Account already exists!";

} else {

    $insert = "INSERT INTO users (email, password)
               VALUES ('$email', '$password')";

    if (mysqli_query($conn, $insert)) {
        echo "Account created successfully!";
    } else {
        echo "Error creating account.";
    }

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="post">
        <h3>Register an Account</h3>
        <p>Email: </p>
        <input type="text" placeholder="Input Your Email" name="email" required>
        <p>Password</p>
        <input type="text" placeholder="Input Your Password" name="password" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>