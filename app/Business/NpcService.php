<?php
//Entities/NpcService.php

declare(strict_types=1);
namespace Business;

use Entities\Npc;
use Business\PlayerService;
use Business\PlayableCardService;

class NpcService extends PlayerService {
    //creating an npc at gamestart
    public function createNpc(): Npc 
    {
        $playableCardService = new PlayableCardService();        
        $deck = $playableCardService->generateDeck();
        $hand = array();
        $playerBoard = array();

        $npc = new Npc("marvin_42", (array) $deck, (array) $hand, (array) $playerBoard);
        return $npc;
    }

    //removing card that goes on the battelfield from hand 
    public function removeFromHandNpc(Npc $npc): Npc
    {
        $hand = $npc->getHand();
        $npcBoard = $npc->getPlayerBoard();

        $chosenCard = rand(0, count($hand)-1);
        $cardOnTheBattlefield = $hand[$chosenCard];

        array_splice($hand, $chosenCard, 1);
        $npc->setHand($hand);
        array_push($npcBoard, $cardOnTheBattlefield);
        $npc->setPlayerBoard($npcBoard);
        return $npc;
    }

    //chosen a card on the battlefield that becomes an attacker 
    public function setAttackerOnNpcBoard($npc): Npc
    {
        $cardsOnNpcBattlefield = $npc->getPlayerBoard();
        $playableCardService = new PlayableCardService();

        if(count($cardsOnNpcBattlefield) == 1) {
            $attackingCard = $cardsOnNpcBattlefield[0];
            array_push($_SESSION['attacker'], $attackingCard);
            $playableCardService->cardBecomesAttacker($attackingCard);
        }

        /*later on maybe modifying that the cards are chosen random as well */
        if(count($cardsOnNpcBattlefield) > 1) {
            $chosenAmountOfCards = rand(1, count($cardsOnNpcBattlefield));
            for($x = 0; $x < $chosenAmountOfCards; $x++) {
                $chosenCard = $cardsOnNpcBattlefield[$x];
                array_push($_SESSION['attacker'], $chosenCard);
                $playableCardService->cardBecomesAttacker($chosenCard);
            }
        }
        
        $npc->setPlayerBoard($cardsOnNpcBattlefield);
        return $npc;
    }

    //chosing a card that becomes a defender
    public function setDefenderOnNpcBoard($npc): Npc
    {
        $cardsOnNpcBattlefield = $npc->getPlayerBoard();
        $playableCardService = new PlayableCardService();

        if(count($cardsOnNpcBattlefield) <= count($_SESSION["attacker"])) {
            for($x = 0 ; $x < count($cardsOnNpcBattlefield); $x++) {
                array_push($_SESSION["defender"], $cardsOnNpcBattlefield[$x]);
                $playableCardService->cardBecomesDefender($cardsOnNpcBattlefield[$x]);
            }
        }

        if(count($cardsOnNpcBattlefield) > count($_SESSION["attacker"])) {
            for($x = 0 ; $x < count($_SESSION["attacker"]); $x++) {
                array_push($_SESSION["defender"], $cardsOnNpcBattlefield[$x]);
                $playableCardService->cardBecomesDefender($cardsOnNpcBattlefield[$x]);
            }
        }

        $npc->setPlayerBoard($cardsOnNpcBattlefield);
        return $npc;
    }
}