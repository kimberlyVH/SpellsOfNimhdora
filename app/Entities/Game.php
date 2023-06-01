<?php
//Entities/game.php

declare(strict_types=1);
namespace Entities;

class Game
{
    private ?Player $_player;
    private ?Npc $_npc;
    private int $_damageMade;
    private ?Player $_winner;
 
    public function __construct(?Player $player = null, ?Npc $npc = null, ?int $madeDamage = 0, ?Player $winner = null)
    {
        $this->_player = $player;
        $this->_npc = $npc;
        $this->_damageMade = $madeDamage;
        $this->_winner = $winner;
    }

    public function setPlayer(Player $player)
    {
        $this->_player = $player;
    }
    public function getPlayer(): Player
    {
        return $this->_player;
    }

    public function setNpc(Npc $npc)
    {
        $this->_npc = $npc;
    }
    public function getNpc(): Npc
    {
        return $this->_npc;
    }

    public function setDamageMade(int $madeDamage)
    {
        $this->_damageMade = $madeDamage;
    }
    public function getDamageMade(): int
    {
        return $this->_damageMade;
    }

    public function setWinner(Player $winner) 
    {
        $this->_winner = $winner;
    }
    public function getWinner(): Player 
    {
        return $this->_winner;
    }



}