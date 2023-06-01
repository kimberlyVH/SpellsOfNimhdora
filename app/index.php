<?php
//index.php

include("bootstrap.php");

if (isset($_POST["btnPlay"])) {
    header("location: gamestart.php");
    exit();
}

if (isset($_SESSION["toPrintId"]) ||isset($_SESSION["manage"])) {
    unset($_SESSION["toPrintId"]);
    unset($_SESSION["manage"]);
}

if(isset($_SESSION["game"])) {
    unset($_SESSION["game"]);
    unset($_SESSION["turn"]);
    unset($_SESSION["fase"]);
    unset($_SESSION["attacker"]);
    unset($_SESSION["defender"]);
}


include("Presentation\homepage.php");
