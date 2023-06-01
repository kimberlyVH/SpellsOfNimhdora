<?php
//Entities/Player.php

declare(strict_types=1);
namespace Entities;
class Player
{
    protected string $_userNickname;
    protected array $_deck;
    protected array $_hand;
    protected array $_playerBoard;
    protected int $_lifePoints;

    public function __construct (array $deck, array $hand, array $playerBoard, int $lifePoints = 20) 
    {   
        $this->_deck = $deck;
        $this->_hand = $hand;
        $this->_playerBoard = $playerBoard;
        $this->_lifePoints = $lifePoints;
    }

    public function setUserNickname(string $userNickname)
    {
        $this->_userNickname = $userNickname;
    }    
    public function getUserNickname(): string
    {
        return $this->_userNickname;
    }

    public function setDeck(array $deck)
    {
        $this->_deck = $deck;
    }
    public function getDeck(): array
    {
        return $this->_deck;
    }

    public function setHand(array $hand)
    {
        $this->_hand = $hand;
    }
    public function getHand(): array
    {
        return $this->_hand;
    }

    public function setPlayerBoard(array $playerBoard)
    {
        $this->_playerBoard = $playerBoard;
    }
    public function getPlayerBoard(): array
    {
        return $this->_playerBoard;
    }

    public function setLifePoints(int $lifePoints)
    {
        $this->_lifePoints = $lifePoints;
    }
    public function getLifePoints(): int
    {
        return $this->_lifePoints;
    }
}