<?php
//register.php

include("bootstrap.php");

use Business\userService;
use Exceptions\InvalidEmailException;
use Exceptions\InvalidPasswordComfirmationException;
use Exceptions\UserAlreadyExistsException;
use Exceptions\UserNicknameAlreadyExistsException;

if (isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
} else {
    $error = "";

    if (isset($_POST["btnRegister"])) {

        $email = "";
        $nickname = "";
        $password = "";
        $passwordConfirmation = "";

        if (!empty($_POST["txtEmail"])) {
            $email = $_POST["txtEmail"];
        } else {
            $error .= "E-mail needs to be entered.<br />";
        }

        if (!empty($_POST["txtNickname"])) {

            $nickname = htmlentities($_POST["txtNickname"]);
        } else {
            $error .= "Nickname needs to be chosen.<br />";
        }

        if (!empty($_POST["txtPassword"]) && !empty($_POST["txtPasswordConfirmation"])) {
            $password = $_POST["txtPassword"];
            $passwordConfirmation = $_POST["txtPasswordConfirmation"];
        } else {
            $error .= "Please make sure both passwordfields are filled.<br />";
        }

        if ($error == "") {
            try {
                $userService = new userService();
                $user = $userService->register($nickname, $email, $password, $passwordConfirmation);

                $_SESSION["user"] = serialize($user);
                header("location: registersucces.php");

                exit();
            } catch (InvalidEmailException $e) {
                $error .= "Given addres is incorrect, please try again.<br />";
            } catch (UserAlreadyExistsException $e) {
                $error .= "There is already a user using this adres.<br />";
            } catch (UserNicknameAlreadyExistsException $e) {
                $error .= "There is already an adventurer known by this name. 
            Please choose a diffrent nickname. <br />";
            } catch (InvalidPasswordComfirmationException $e) {
                $error .= "Please make sure both passwordfields are identical.<br />";
            }

        }
    }
    include("Presentation/registerPage.php");
}
