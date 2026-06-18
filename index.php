<?php
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
                echo "<br><br>You guessed the number in $attempt attempt(s)!";
                echo "<br><button type='submit' name='reset'>Play Again</button>";
            }
        }
        ?>

    </form>

</body>
</html>