<?php
//entities/PlayableCard.php

declare(strict_types=1);

namespace Entities;

class PlayableCard extends Card
{  
    private bool $_isDisabled;
    private string $_role;
    private bool $_isDead;

    public function __construct(int $id, string $card_naam, string $card_imgSrc, int $attackPoints, int $defencePoints, $role = "none", bool $isDead = false)
    {   
        parent::__construct($id, $card_naam, $card_imgSrc, $attackPoints, $defencePoints);
        $this->_role = $role;
        $this->_isDead = $isDead;
    }
    
    public function setRole(string $role)
    {
        $this->_role = $role;
    }
    public function getRole(): string
    {
        return $this->_role;
    }

    public function setIsDead(bool $isDead)
    {
        $this->_isDead = $isDead;
    }
    public function getIsDead(): bool
    {
        return $this->_isDead;
    }
}
