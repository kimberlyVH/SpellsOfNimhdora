<?php
//entities/Avatar.php

declare(strict_types=1);

namespace Entities;

class Avatar
{
    private static $idMap = array();
    private int $id;
    private string $_avatar_naam;
    private string $_avatar_imgSrc;

    private function __construct(int $id, string $avatar_naam, string $avatar_imgSrc)
    {
        $this->id = $id;
        $this->_avatar_naam = $avatar_naam;
        $this->_avatar_imgSrc = $avatar_imgSrc;
    }

    public static function create(int $id, string $avatar_naam, string $avatar_imgSrc)
    {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Avatar($id, $avatar_naam, $avatar_imgSrc);
        }
        return self::$idMap[$id];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setAvatar_Naam(string $avatar_naam)
    {
        $this->_avatar_naam = $avatar_naam;
    }
    public function getAvatar_naam(): string
    {
        return $this->_avatar_naam;
    }

    public function setAvatar_imgSrc(string $avatar_imgSrc)
    {
        $this->_avatar_imgSrc = $avatar_imgSrc;
    }
    public function getAvatar_imgSrc(): string
    {
        return $this->_avatar_imgSrc;
    }
}
