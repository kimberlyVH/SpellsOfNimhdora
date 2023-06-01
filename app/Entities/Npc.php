<?php
//Entities/Npc.php

declare(strict_types=1);
namespace Entities;

use Entities\Player;

class Npc extends Player
{
    protected string $_userNickname;

    public function __construct (string $userNickname = "Marvin_42", array $deck, array $hand, array $playerBoard, int $lifePoints = 20)
    {   
        $this->_userNickname = $userNickname;
        parent::__construct($deck, $hand, $playerBoard, $lifePoints);
    }

    public function getNpcNickname(): string
    {
        return $this->_userNickname;
    }
}