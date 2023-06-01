<?php
//Business/GameService.php

declare(strict_types=1);
namespace Business;

use Entities\Game;
use Business\PlayerService;
use Business\NpcService;


class GameService
{

    //game gets created at push of playbtn
    public function createGame(): Game
    {
        $playerService = new PlayerService();
        $npcService = new NpcService();
        $player = $playerService->createPlayer();
        $npc = $npcService->createNpc();

        $game = new Game($player, $npc);
        return $game;
    }

    //player starts game
    public function startGame(Game $game): Game
    {
        $playerService = new PlayerService();

        $npc = $game->getNpc();
        $player = $game->getPlayer();
    
        $playerUserHasHand = $playerService->drawCards($player, 3);
        $npcHasHand = $playerService->drawCards($npc, 3);
    
        $game->setPlayer($playerUserHasHand);
        $game->setNpc($npcHasHand);

        return $game;
    }

    //player draws a card
    public function enterDrawfase(Game $game, int $turn): Game
    {
        $playerService = new PlayerService();

        if($turn == 1) {
            $needToDraw = $game->getPlayer();
        } else {
            $needToDraw = $game->getNpc();
        }
        
        $hasDrawn = $playerService->drawCards($needToDraw, 1);
    
        if($turn == 1) {
            $game->setPlayer($hasDrawn);
        } else {
            $game->setNpc($hasDrawn);
        }
        return $game;
    }

   
    //player puts card on board
    public function enterSummonFase(Game $game , $chosenCard): Game
    {   
        $playerService = new PlayerService();

        $player = $game->getPlayer();
        $playerRemovedCardFromHand = $playerService->removeFromHand($player, $chosenCard);
        
        $game->setPlayer($playerRemovedCardFromHand);
        return $game;
    }
    //npc puts card on board
    public function npcEntersSummonFase(Game $game): game
    {
        //game where npc has drawn a card
        $npcService = new NpcService();
        $npc = $game->getNpc();
        $npcRemovedCardFromHand = $npcService->removeFromHandNpc($npc);

        $game->setNpc($npcRemovedCardFromHand);
        return $game;
    } 
    

    //player choses an attacking card
    public function EnterAttackFase(Game $game, $chosenCard): Game 
    {   
        $playerService = new PlayerService();
        $player = $game->getPlayer();

        $playerChoseAnAttacker = $playerService->setAttackerOnPlayerBoard($player, $chosenCard);

        $game->setPlayer($playerChoseAnAttacker);
        return $game;
    }
    //npc choses an attacking card
    public function npcEntersAttackingFase (Game $game): Game
    {
        $npcService = new NpcService();
        $npc = $game->getNpc();

        $npcChoseAnAttacker = $npcService->setAttackerOnNpcBoard($npc);

        $game->setNpc($npcChoseAnAttacker);
        return $game;
    }

    //player choses defendingCard
    public function EnterDefendFase($game, $chosenCard): Game
    {
        $playerService = new PlayerService();
        $player = $game->getPlayer();

        $playerChoseAnDefender = $playerService->setDefenderOnPlayerBoard($player, $chosenCard);

        $game->setPlayer($playerChoseAnDefender);
        return $game;
    }
    //npc choses defendingCards 
    public function npcEntersDefendFase($game): Game
    {
        $npcService = new NpcService();
        $npc = $game->getNpc();

        $npcChoseAnDefender = $npcService->setDefenderOnNpcBoard($npc);

        $game->setNpc($npcChoseAnDefender);
        return $game;
    }


    //fight
    public function fight(Game $game, $turn): Game
    {   
        $defendingCards = $_SESSION["defender"];

        $playerService = new PlayerService();
        if($turn == 1) {
            $attacker = $game->getPlayer();
            $defender = $game->getNpc();
        }
        if($turn == 2) {
            $attacker = $game->getNpc();
            $defender = $game->getPlayer();
        }
         
        $damage = $playerService->calculateDamage();
        $defender = $playerService->defenderLosesLife($defender, $damage);

        if(count($defendingCards) > 0) {
            $defender = $playerService-> afterMathDefender($defender);
            $attacker = $playerService-> afterMathAttacker($attacker);
        }


        $game->setDamageMade($damage);
        if($turn == 1) {
            $game->setPlayer($attacker);
            $game->setNpc($defender);
        }
        if($turn == 2) {
            $game->setNpc($attacker);
            $game->setPlayer($defender);
        }

        return $game;
    }

    //reset battelfield after attack
    public function resettingBattlefield($game, $turn): game
    {   
        $playerService = new PlayerService();
        if($turn == 1) {
            $playerWhoEndsTurn = $game->getPlayer();
        } else {
            $playerWhoEndsTurn = $game->getNpc();
        }

        $playerBattlefieldReset = $playerService->resetBattleField($playerWhoEndsTurn);

        if($turn == 1) {
            $game->setPlayer($playerBattlefieldReset);
        } else {
            $game->setNpc($playerBattlefieldReset);
        }

        return $game;
    }
}
