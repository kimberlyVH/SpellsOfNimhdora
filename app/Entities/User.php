<?php
//Entities/user.php

declare(strict_types=1);

namespace Entities;

class User
{
    private $_userId;
    private $_userNickname;
    private $_userEmail;
    private $_userPassword;
    private ?UserAccount $_userAccount;

    public function __construct($cId = null, $cUserNickname = null, $cUserEmail = null, $cUserPassword = null, ?UserAccount $cUserAccount = null)
    {
        $this->_userId = $cId;
        $this->_userNickname = $cUserNickname;
        $this->_userEmail =  $cUserEmail;
        $this->_userPassword = $cUserPassword;
        $this->_userAccount = $cUserAccount;
    }

    public function setId(int $id)
    {
        $this->_userId = $id;
    }
    public function getUserId(): int
    {
        return $this->_userId;
    }

    public function setUserNickname(string $userNickname)
    {
        $this->_userNickname = $userNickname;
    }
    public function getUserNickname(): string
    {
        return $this->_userNickname;
    }

    public function setUserEmail(string $userEmail)
    {
        $this->_userEmail = $userEmail;
    }
    public function getUserEmail(): string
    {
        return $this->_userEmail;
    }

    public function setUserPassword(string $userPassword)
    {
        $this->_userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }
    public function getUserPassword(): string
    {
        return $this->_userPassword;
    }

    public function setUserAccount(UserAccount $userAccount)
    {
        $this->_userAccount = $userAccount;
    }
    public function getUserAccount(): UserAccount
    {
        return $this->_userAccount;
    }
}
