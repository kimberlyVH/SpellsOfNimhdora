<?php
//editprofile.php

include("bootstrap.php");

use Business\AvatarService;
use Business\UserAccountService;

if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}

$user = unserialize($_SESSION["user"]);
$userAccount = $user->getUserAccount();
$userAvatar = $userAccount->getAvatar();

if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $_SESSION["toPrintId"] = $userAvatar->getId();
}

$avatarService = new AvatarService();
$avatarList = $avatarService->giveAvatarList();
$avatarToPrint = $avatarService->giveAvatar_image((int) $_SESSION["toPrintId"]);
$error = "";

if (isset($_POST["btnNext"])) {
    if ($_SESSION["toPrintId"] >= 3) {
        $_SESSION["toPrintId"] = 0;
    } else {
        $_SESSION["toPrintId"] += $_POST["btnNext"];
    }
    $avatarToPrint = $avatarService->giveAvatar_image($_SESSION["toPrintId"]);
}

if (isset($_POST["btnPrevious"])) {
    if ($_SESSION["toPrintId"] <= 0) {
        $_SESSION["toPrintId"] = 3;
    } else {
        $_SESSION["toPrintId"] -= $_POST["btnPrevious"];
    }
    $avatarToPrint = $avatarService->giveAvatar_image($_SESSION["toPrintId"]);
}

if (isset($_POST["btnSaveChanges"])) {

    if (isset($_POST["selectGender"])) {
        $userAccount->setPlayerGender((string) $_POST["selectGender"]);
    }

    if (!empty($_POST["txtPlayerAge"])) {

        if (
            $_POST["txtPlayerAge"] > 0 && $_POST["txtPlayerAge"] < 110
            && is_numeric($_POST["txtPlayerAge"])
        ) {
            $userAccount->setPlayerAge((int) $_POST["txtPlayerAge"]);
        } else {
            $error .= "We are honored to know that our community is so diverse, although the given age does seems rather unlikely.<br />
            Please enter an new age. <br />";
        }
    }

    if (!empty($_POST["txtPlayerBio"])) {
        $userAccount->setPlayerBio(htmlentities($_POST["txtPlayerBio"]));
    }

    if (isset($_SESSION["toPrintId"])) {

        $userAccount->setAvatar($avatarService->giveAvatar_image($_SESSION["toPrintId"]));
    }
}

if (isset($_POST["btnSaveChanges"]) && $error == "") {

    $userAccountService = new UserAccountService();
    $userAccountService->saveProfileChanges($userAccount);
    $user->setUserAccount($userAccount);

    $_SESSION["user"] = serialize($user);

    unset($_SESSION["toPrintId"]);
    header("location: account.php");
    exit();
}


include("Presentation/editingForm.php");
