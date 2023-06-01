<?php
//registersucces.php

include("bootstrap.php");

if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}
if(isset($_POST["btnPlay"])) {
    header("location: gamestart.php");
    exit();
}

include("Presentation/registersuccespage.php");