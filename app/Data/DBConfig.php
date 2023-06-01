<?php
//Data\DBConfig.php

declare(strict_types=1);
namespace Data;

class DBConfig {
    private static $DB_CONn = "mysql:host=localhost;dbname=spellsOfNimhdora;charset=utf8";
    private static $DB_PASs = "";
    private static $DB_USr = "root";

    static function getCONN() {
        return self::$DB_CONn;
    }

    static function getUSR() {
        return self::$DB_USr;
    }

    static function getPASS() {
        return self::$DB_PASs;
    }
}