<?php
//Entities/UserAccount.php

declare(strict_types=1);

namespace Entities;

class UserAccount
{
    private $_accountNr;
    private ?Avatar $_avatar;
    private $_playerAge;
    private $_playerGender;
    private $_playerBio;
    private $_level;
    private $_xp;

    public function __construct($accountNr = null, ?Avatar $avatar = null, int $playerAge = 0, string $playerGender = "none", string $playerBio = "none", int $level = 1, int $xp = 0)
    {
        $this->_accountNr = $accountNr;
        $this->_avatar = $avatar;
        $this->_playerAge = $playerAge;
        $this->_playerGender = $playerGender;
        $this->_playerBio = $playerBio;
        $this->_level = $level;
        $this->_xp = $xp;
    }

    public function setUserAccountNr(int $accountNr)
    {
        $this->_accountNr = $accountNr;
    }
    public function getUserAccountNr(): int
    {
        return $this->_accountNr;
    }


    public function setPlayerAge(int $playerAge)
    {
        $this->_playerAge = $playerAge;
    }
    public function getPlayerAge(): int
    {
        return $this->_playerAge;
    }

    public function setPlayerGender(string $playerGender)
    {
        $this->_playerGender = $playerGender;
    }
    public function getPlayerGender(): string
    {
        return $this->_playerGender;
    }

    public function setPlayerBio(string $playerBio)
    {
        $this->_playerBio = $playerBio;
    }
    public function getPlayerBio(): string
    {
        return $this->_playerBio;
    }

    public function setAvatar(Avatar $avatar)
    {
        $this->_avatar = $avatar;
    }
    public function getAvatar(): Avatar
    {
        return $this->_avatar;
    }

    public function setLevel(int $level)
    {
        $this->_level = $level;
    }
    public function getLevel(): int
    {
        return $this->_level;
    }

    public function setXp(int $xp)
    {
        $this->_xp = $xp;
    }
    public function getXp(): int
    {
        return $this->_xp;
    }
}
