<?php
include "db.php";
session_start();

if(isset($_POST["reset"])){
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

if(!isset($_SESSION["correct_guess"])){
    $_SESSION["correct_guess"] = rand(1, 10);
}

if(!isset($_SESSION["attempt"])){
    $_SESSION["attempt"] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
</head>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#ddd;
}

form{
    background:white;
    width:400px;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
}

h3{
    color:#333;
    margin-bottom:15px;
    font-size:28px;
}

p{
    color:#666;
    margin-bottom:15px;
}

input[type="number"]{
    width:100%;
    padding:12px;
    border:2px solid #ddd;
    border-radius:8px;
    margin-bottom:15px;
    font-size:16px;
    outline:none;
}

input[type="number"]:focus{
    border-color:#667eea;
}

button{
    padding:12px 20px;
    border:none;
    border-radius:8px;
    background:#667eea;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#5563d6;
    transform:translateY(-2px);
}

br + br{
    margin-top:10px;
}
</style>
<body>

    <form method="post">
        <h3>Welcome to Guessing Game</h3>
        <p>Please Input Your Guess:</p>
        <input type="number" name="guess" min="1" max="10" >
        <button type="submit">Submit Guess</button>

        <?php
        if($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["reset"])){
            $guess = $_POST["guess"];
            $_SESSION["attempt"]++;
            $attempt = $_SESSION["attempt"];
            $correct_guess = $_SESSION["correct_guess"];

            if($guess > $correct_guess){
                $output = "Lower!";
            }
            elseif($guess < $correct_guess){
                $output = "Higher!";
            }
            else{
                $output = "Correct Guess!";
            }

            echo "<br><br>Attempts: $attempt";
            echo "<br>$output";

            if($guess == $correct_guess){
                echo "<br><br>You guessed the number in $attempt attempts!";
                echo "<br><button type='submit' name='reset'>Play Again</button>";
            }
        }
        ?>
    </form>
</body>
</html>