<?php
//manageAccount.php


include("bootstrap.php");

use Business\ManagementService;


if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}

$user = unserialize($_SESSION["user"]);
$userAccount = $user->getUserAccount();
$userAvatar = $userAccount->getAvatar();



//layout forms
include("Presentation/accountManagementScreen.php");
if (isset($_GET["action"]) && $_GET["action"] == "chgP") {
    $_SESSION["manage"] = $_GET["action"];
}
if (isset($_GET["action"]) && $_GET["action"] == "chgM") {
    $_SESSION["manage"] = $_GET["action"];
}
if (isset($_GET["action"]) && $_GET["action"] == "delA") {
    $_SESSION["manage"] = $_GET["action"];
}

if(isset($_SESSION["manage"])) {
    $managementService = new ManagementService();
    $managementService->managementOptionChgP();
    $managementService->managementOptionChgM();
    $managementService->managementOptionDelA();
}


    



