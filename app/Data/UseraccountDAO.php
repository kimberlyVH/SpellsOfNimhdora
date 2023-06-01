<?php
//Data/accountDAO.php

declare(strict_types=1);

namespace Data;

use PDO;
use Exception;
use Data\DBConfig;

class UserAccountDAO

{
    public function addNewUserAccount(int $avatarId, int $playerAge, string $playerGender, string $playerBio, int $level, int $xp)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            $stmt = $dbh->prepare("INSERT INTO useraccounts (avatarId, playerAge, playerGender, playerBio, LVL, XP) VALUES 
            (:avatarId, :playerAge, :playerGender, :playerBio, :LVL, :XP)");

            $stmt->bindValue(":avatarId", $avatarId);
            $stmt->bindValue(":playerAge", $playerAge);
            $stmt->bindValue(":playerGender", $playerGender);
            $stmt->bindValue(":playerBio", $playerBio);
            $stmt->bindValue(":LVL", $level);
            $stmt->bindValue(":XP", $xp);

            $stmt->execute();
            $lastNew = $dbh->lastInsertId();
            
            $dbh->commit();
            $dbh = null;
            return $lastNew;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function getUserAccountByAccountNr(int $accountNr)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("SELECT * FROM useraccounts WHERE accountNr = :accountNr");

            $stmt->bindValue(":accountNr", $accountNr);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $dbh = null;
            return $row;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function updateUserAccount(int $accountNr, int $avatarId, int $playerAge, string $playerGender, string $playerBio)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $sql = "UPDATE useraccounts SET avatarId = :avatarId, playerAge = :playerAge, playerGender = :playerGender,
            playerBio = :playerBio WHERE accountNr = :accountNr";
            $stmt = $dbh->prepare($sql);

            $stmt->execute(array(":accountNr"=>$accountNr,
            ":avatarId"=>$avatarId,
            ":playerAge"=>$playerAge,
            ":playerGender"=>$playerGender,
            ":playerBio"=>$playerBio));

            $dbh->commit();
            $dbh = null;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function deleteUserAccount($accountNr) 
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM useraccounts WHERE accountNr = :accountNr";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":accountNr"=>$accountNr));
            $dbh = null;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }
}

