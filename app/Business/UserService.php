<?php
//Business/UserService.php

declare(strict_types=1);

namespace Business;

use Entities\User;
use Data\UserDAO;

use Business\UserAccountService;
use Exceptions\InvalidEmailException;
use Exceptions\InvalidPasswordComfirmationException;
use Exceptions\InvalidPasswordException;
use Exceptions\NewCantBeCurrentEmailException;
use Exceptions\UserAlreadyExistsException;
use Exceptions\UserDoesNotExistException;
use Exceptions\UserNicknameAlreadyExistsException;
use Exceptions\InvalidEmailConfirmationException;

class UserService
{
    public function register($userNickname, $userEmail, $userPassword, $passwordcomfirmation)
    {
        $userDAO = new UserDAO();
        $user = new User();
        $userAccountService = new UserAccountService();

        $user->setUserNickname($userNickname);

        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $user->setUserEmail($userEmail);

        if ($userPassword !== $passwordcomfirmation) {
            throw new InvalidPasswordComfirmationException();
        }
        $user->setUserPassword($userPassword);

        $rowcountEmail = $userDAO->doesUserAlreadyExist($user->getUserEmail());
        if ($rowcountEmail > 0) {
            throw new UserAlreadyExistsException();
        }

        $rowcountNickname = $userDAO->doesNicknameAlreadyExist($user->getUserNickname());
        if ($rowcountNickname > 0) {
            throw new UserNicknameAlreadyExistsException();
        }

        $newAccount = $userAccountService->createUserAccount();
        $user->setUserAccount($newAccount);

        $lastAddedUser = $userDAO->addNewUser((string)$user->getUserNickname(), (string) $user->getUserEmail(), (string) $user->getUserPassword(), (int) $newAccount->getUserAccountNr());
        $user->setId((int) $lastAddedUser);
        return $user;
    }

    public function logIn($userEmail, $userPassword)
    {
        $userDAO = new UserDAO();

        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $user = new User(null, null, $userEmail, $userPassword);

        $rowcount = $userDAO->doesUserAlreadyExist($user->getUserEmail());
        if ($rowcount == 0) {
            throw new UserDoesNotExistException();
        }

        $isItValid = $userDAO->isPasswordValid($user->getUserEmail(), $user->getUserPassword());
        if (!$isItValid) {
            throw new InvalidPasswordException();
        }

        $dataLoggedInUser = $userDAO->getUserToLogIn($user->getUserEmail());
        $user->setId((int) $dataLoggedInUser["userId"]);
        $user->setUserNickname((string) $dataLoggedInUser["userNickname"]);

        $userAccountService = new UserAccountService();
        $accountOfloggedIn = $userAccountService->giveUserAccount((int) $dataLoggedInUser["userAccountNr"]);

        $user->setUserAccount($accountOfloggedIn);
        return $user;
    }

    public function saveNewPassword($user, $newPassword, $passwordComfirmation)
    {
        if ($newPassword !== $passwordComfirmation) {
            throw new InvalidPasswordComfirmationException();
        }
        $user->setUserPassword($newPassword);

        $userDAO = new UserDAO();
        $userDAO->updateUserPassword($user->getUserId(), $user->getUserPassword());

        return $user;
    }

    public function saveNewEmailadres($user, $newEmail, $emailComfirmation) {
        $userDAO = new UserDAO();
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        if ($newEmail !== $emailComfirmation) {
            throw new InvalidEmailConfirmationException();
        }
        $rowcount = $userDAO->doesUserAlreadyExist($newEmail);
        if($rowcount !== 0) {
            throw new NewCantBeCurrentEmailException();
        }
       
        $user->setUserEmail($newEmail);

        $userDAO->updateUserEmail($user->getUserId(), $user->getUserEmail());

        return $user;
    }

    public function deleteAccount($user) {
        $userAccountService = new UserAccountService();
        $userAccountService->delete(($user->getUserAccount())->getUserAccountNr());
        $userDAO = new UserDAO();
        $userDAO->deleteUser($user->getUserId());
    }
}
