<?php
//Data/CardDAO.php

declare(strict_types=1);

namespace Data;

use PDO;
use Exception;
use Data\DBConfig;

class CardDAO
{
    public function getAllCards()
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUsr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id, card_naam, card_imgSrc, defence, attack  FROM cards";
            $resultSet = $dbh->query($sql);
         
            $dbh = null;
            return $resultSet;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo ($error);
            return null;
        }
    }
    public function getCardById(int $id)
    {
        try {
            $dbh = new PDO(DBConfig::getCONn(), DBConfig::getUSr(), DBConfig::getPASs());
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT id, card_naam, card_imgSrc, defence, attack  FROM cards WHERE id = :id");

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
