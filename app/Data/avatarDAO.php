<?php
//Data/AvatarDAO.php

declare(strict_types=1);
namespace Data;

use PDO;
use Exception;
use Data\DBConfig;

class AvatarDAO
{
    public function getAllAvatarImages()
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUsr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id, avatar_naam, avatar_imgSrc FROM avatar_images";
            $resultSet = $dbh->query($sql);
         
            $dbh = null;
            return $resultSet;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }
    public function getAvatarById(int $id)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT id, avatar_naam, avatar_imgSrc FROM avatar_images WHERE id = :id");

            $stmt->bindValue(":id", $id);

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
}