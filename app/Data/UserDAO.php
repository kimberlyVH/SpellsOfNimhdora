<?php
//Data/UserDAO.php

declare(strict_types=1);

namespace Data;

use PDO;
use Exception;
use Data\DBConfig;

class UserDAO
{
    public function doesUserAlreadyExist($userEmail)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM users WHERE userEmail = :userEmail");

            $stmt->bindValue(":userEmail", $userEmail);
            $stmt->execute();
            $rowcount = $stmt->rowCount();
            $dbh = null;
            return $rowcount;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function doesNickNameAlreadyExist($userNickname)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT * FROM users WHERE userNickname = :userNickname");

            $stmt->bindValue(":userNickname", $userNickname);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            $dbh = null;
            return $rowcount;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function addNewUser($userNickname, $userEmail, $userPassword, $userAccountNr)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $stmt = $dbh->prepare("INSERT INTO users (userNickname, userEmail, userPassword, userAccountNr) VALUES (:userNickname, :userEmail, :userPassword, :userAccountNr)");

            $stmt->bindValue(":userNickname", $userNickname);
            $stmt->bindValue(":userEmail", $userEmail);
            $stmt->bindValue(":userPassword", $userPassword);
            $stmt->bindValue(":userAccountNr", $userAccountNr);

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

    public function ispasswordvalid($userEmail, $userPassword)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT userPassword FROM users WHERE userEmail = :userEmail");

            $stmt->bindValue(":userEmail", $userEmail);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $isItValid = password_verify($userPassword, $row["userPassword"]);
            $dbh = null;
            return $isItValid;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function getUserToLogIn($userEmail)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT userId, userNickname, userAccountNr FROM users WHERE userEmail = :userEmail");

            $stmt->bindValue(":userEmail", $userEmail);

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

    public function updateUserPassword($userId, $userPassword)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $sql = "UPDATE users SET userPassword = :userPassword WHERE userId = :userId";
            $stmt = $dbh->prepare($sql);

            $stmt->execute(array(
                ":userId" => $userId,
                ":userPassword" => $userPassword,
            ));

            $lastUpdated = $dbh->lastInsertId();
            $dbh->commit();
            $dbh = null;

            return $lastUpdated;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function updateUserEmail($userId, $userEmail)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $sql = "UPDATE users SET userEmail = :userEmail WHERE userId = :userId";
            $stmt = $dbh->prepare($sql);

            $stmt->execute(array(
                ":userId" => $userId,
                ":userEmail" => $userEmail,
            ));

            $lastUpdated = $dbh->lastInsertId();
            $dbh->commit();
            $dbh = null;

            return $lastUpdated;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }

    public function deleteUser($userId)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM users WHERE userId = :userId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":userId"=>$userId));
            $dbh = null;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error); 
            return null;
        }
    }
}
