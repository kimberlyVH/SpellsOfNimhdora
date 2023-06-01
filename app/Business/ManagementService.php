<?php
//Business/AvatarService.php

declare(strict_types=1);

namespace Business;

use Business\UserService;
use Exceptions\InvalidEmailException;
use Exceptions\SomethingWentWrongPasswordException;
use Exceptions\InvalidPasswordComfirmationException;
use Exceptions\InvalidEmailConfirmationException;
use Exceptions\NewCantBeCurrentEmailException;


class ManagementService
{

    public function managementOptionChgP()
    {
        // changing password
        if (isset($_SESSION["manage"]) && $_SESSION["manage"] == "chgP") {
            $error = "";
            $updated = "";
            $newPassword = "";
            $passwordConfirmation = "";

            if (isset($_POST["btnSavePassword"])) {
                if (!empty($_POST["txtPassword"]) && !empty($_POST["txtPasswordConfirmation"])) {
                    $newPassword = $_POST["txtPassword"];
                    $passwordConfirmation = $_POST["txtPasswordConfirmation"];
                } else {
                    $error .= "Please make sure both passwordfields are filled.<br />";
                }
            }

            if (isset($_POST["btnSavePassword"]) && $error == "") {
                try {
                    $user = unserialize($_SESSION["user"]);

                    $userService = new UserService();
                    $updatedUser = $userService->saveNewPassword($user, $newPassword, $passwordConfirmation);
                    if ($updatedUser) {
                        $updated = "Your password has been successfully updated!";
                        $_SESSION["user"] = serialize($updatedUser);
                    } else {
                        throw new SomethingWentWrongPasswordException();
                    }
                } catch (InvalidPasswordComfirmationException $e) {
                    $error .= "Please make sure both passwordfields are identical.<br />";
                } catch (SomethingWentWrongPasswordException $e) {
                    $error .= "Seems like the mignions have failed in forfilling your request,
            please try again later.<br />";
                }
            }
            include("Presentation/changePasswordForm.php");
        }
    }

    public function managementOptionChgM()
    {
        //change E-mail address

        if (isset($_SESSION["manage"]) && $_SESSION["manage"] == "chgM") {
            $error = "";
            $updated = "";
            $newEmail = "";
            $emailConfirmation = "";

            if (isset($_POST["btnSaveEmail"])) {
                if (!empty($_POST["txtEmail"]) && !empty($_POST["txtEmailConfirmation"])) {
                    $newEmail = $_POST["txtEmail"];
                    $emailConfirmation = $_POST["txtEmailConfirmation"];
                } else {
                    $error .= "Please make sure both fields are filled.<br />";
                }
            }

            if (isset($_POST["btnSaveEmail"]) && $error == "") {
                try {
                    $user = unserialize($_SESSION["user"]);

                    $userService = new UserService();
                    $updatedUser = $userService->saveNewEmailadres($user, $newEmail, $emailConfirmation);
                    if ($updatedUser) {
                        $updated = "Your E-mailadres has been successfully updated!";
                        $_SESSION["user"] = serialize($updatedUser);
                    } else {
                        throw new SomethingWentWrongPasswordException();
                    }
                } catch (InvalidEmailException $e) {
                    $error .= "Given addres is incorrect, please try again.<br />";
                } catch (InvalidEmailConfirmationException $e) {
                    $error .= "Please make sure both adresses are identical.<br />";
                } catch (SomethingWentWrongPasswordException $e) {
                    $error .= "Seems like the mignions have failed in forfilling your request,
                    please try again later.<br />";
                } catch(NewCantBeCurrentEmailException $e) {
                    $error .= "Seems like the adres you want to set as current adres is already in use, please pick a diffrent one.<br />";
                }
            }
            include("Presentation/changeEmailForm.php");
        }
    }

    public function managementOptionDelA() {
        if(isset($_SESSION["manage"]) && $_SESSION["manage"] == "delA") {
            if(isset($_POST["btnNo"])) {
                unset($_SESSION["manage"]);
                header("location: manageaccount.php");
                exit();
            }
            if(isset($_POST["btnYes"])) {
                $user = unserialize($_SESSION["user"]);
                $userService = new UserService();
                $userService-> deleteAccount($user);
    
                unset($_SESSION["user"]);
                header("location: index.php");
                exit();
            }
    
            include("Presentation/deleteAccountForm.php");
        }
    }
}
