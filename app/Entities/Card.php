<?php
//entities/card.php

declare(strict_types=1);

namespace Entities;

class Card
{
    protected static $idMap = array();
    protected int $id;
    protected string $_card_naam;
    protected string $_card_imgSrc;
    protected int $_attackPoints;
    protected int $_defencePoints;

    protected function __construct(int $id, string $card_naam, string $card_imgSrc, int $attackPoints, int $defencePoints) {
        $this->id = $id;
        $this->_card_naam = $card_naam;
        $this->_card_imgSrc = $card_imgSrc;
        $this->_attackPoints = $attackPoints;
        $this->_defencePoints = $defencePoints;
    }

    public static function create(
        int $id,
        string $card_naam,
        string $card_imgSrc,
        int $attackPoints,
        int $defencePoints,

    ) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Card(
                (int) $id,
                (string) $card_naam,
                (string) $card_imgSrc,
                (int) $attackPoints,
                (int) $defencePoints,
            );
        }
        return self::$idMap[$id];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCard_Naam(string $card_naam)
    {
        $this->_card_naam = $card_naam;
    }
    public function getCard_naam(): string
    {
        return $this->_card_naam;
    }

    public function setCard_imgSrc(string $avatar_imgSrc)
    {
        $this->_card_imgSrc = $avatar_imgSrc;
    }
    public function getCard_imgSrc(): string
    {
        return $this->_card_imgSrc;
    }

    public function setAttackPoints(int $attackPoints)
    {
        $this->_attackPoints = $attackPoints;
    }
    public function getAttackPoints(): int
    {
        return $this->_attackPoints;
    }

    public function setDefencePoints(int $defencePoints)
    {
        $this->_defencePoints = $defencePoints;
    }
    public function getDefencePoints(): int
    {
        return $this->_defencePoints;
    }
}
