<?php
//account.php

include("bootstrap.php");

if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}

if (isset($_GET["action"]) && $_GET["action"] == "back") {
    unset($_SESSION["toPrintId"]);
    unset($_SESSION["manage"]);
}

$user = unserialize($_SESSION["user"]);

$userAccount = $user->getUserAccount();
$avatar = $userAccount->getAvatar();


include("Presentation/accountpage.php");
