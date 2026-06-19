<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "guessing_game"
);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>