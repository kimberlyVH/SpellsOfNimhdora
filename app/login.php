<?php
//login.php

include("bootstrap.php");

use Business\UserService;
use Exceptions\InvalidEmailException;
use exceptions\InvalidPasswordException;
use Exceptions\UserDoesNotExistException;

if (isset($_SESSION["user"])) {
    header("location:index.php");
    exit;
} else {
    $error = "";

    if (isset($_POST["btnLogin"])) {
        $email = "";
        $password = "";

        if (!empty($_POST["txtEmail"])) {
            $email = $_POST["txtEmail"];
        } else {
            $error .= "E-mail needs to be entered.<br />";
        }

        if (!empty($_POST["txtPassword"])) {
            $password = $_POST["txtPassword"];
        } else {
            $error .= "Password is required.<br />";
        }

        if ($error == "") {
            try {
                $userService = new UserService();
                $inlogUser = $userService->logIn($email, $password);
                $_SESSION["user"] = serialize($inlogUser);
            } catch (InvalidEmailException $e) {
                $error .= "Given addres is incorrect, please try again.<br />";
            } catch (InvalidPasswordException $e) {
                $error .= "Invalid password, please try again<br />";
            } catch (UserDoesNotExistException $e) {
                $error .= "Our book of heroes holds many names, but seems like yours still has to touch it's pages.
            please register.";
            }
        }

        if($error == "" && isset($_SESSION["user"])) {
            header("location: index.php");
            exit();
        }
    }

    include("Presentation\loginpage.php");
}
