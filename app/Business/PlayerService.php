<?php
//Business/PlayerService.php

declare(strict_types=1);

namespace Business;

use Entities\Player;
use Business\PlayableCardService;

class PlayerService
{
    public function createPlayer(): Player
    {
        $playableCardService = new PlayableCardService();
        $deck = $playableCardService->generateDeck();
        $hand = array();
        $playerBoard = array();

        $player = new Player((array) $deck, (array) $hand, (array) $playerBoard);
        return $player;
    }

    public function drawCards(Player $player, $aantal): Player
    {
        $hand = $player->getHand();
        for ($x = 0; $x < $aantal; $x++) {
            $oldDeck = $player->getDeck();
            $random = rand(0, (count($oldDeck) - 1));
            $randomCard = $oldDeck[$random];
            array_splice($oldDeck, $random, 1);
            array_push($hand, $randomCard);

            $player->setDeck($oldDeck);
        }

        $refreshedDeckArray = array();
        foreach ($oldDeck as $card) {
            array_push($refreshedDeckArray, $card);
        }
        $player->setDeck($refreshedDeckArray);
        $player->setHand($hand);
        return $player;
    }

    //checking if the defendingbattlefield has creatures
    public function checkDefendingBattlefield($defendingPlayer): bool
    {
        $hasCreatures = false;
        $defendingBattlefield = $defendingPlayer->getPlayerBoard();
        if (count($defendingBattlefield) > 0) {
            $hasCreatures = true;
        }
        return $hasCreatures;
    }


    public function removeFromHand(Player $player, $chosenCard): Player
    {
        $hand = $player->getHand();
        $playerBoard = $player->getPlayerBoard();
        $cardThatGoesOnBattleField = $hand[$chosenCard];

        array_splice($hand, $chosenCard, 1);

        $player->setHand($hand);

        array_push($playerBoard, $cardThatGoesOnBattleField);
        $player->setPlayerBoard($playerBoard);
        return $player;
    }

    public function setAttackerOnPlayerBoard($player, $chosenCard): Player
    {
        $playerBoard = $player->getPlayerBoard();
        $playableCardService = new PlayableCardService();
        $playableCardService->cardBecomesAttacker($playerBoard[$chosenCard]);
        $player->setPlayerBoard($playerBoard);
        return $player;
    }
    public function setDefenderOnPlayerBoard($player, $chosenCard): Player
    {
        $playerBoard = $player->getPlayerBoard();
        $playableCardService = new PlayableCardService();
        $playableCardService->cardBecomesDefender($playerBoard[$chosenCard]);
        $player->setPlayerBoard($playerBoard);
        return $player;
    }


    //calculating damage using the $_SESSION variables as reference
    public function calculateDamage()
    {
        $damage = 0;
        $attackingCards = $_SESSION["attacker"];
        $defendingCards = $_SESSION["defender"];

        if (count($defendingCards) == 0) {
            foreach ($attackingCards as $attackingCard) {
                $damage += $attackingCard->getAttackPoints();
            }
        }

        if (count($defendingCards) > 0) {
            for ($x = 0; $x < (count($defendingCards)); $x++) {
                $attackingCard = $attackingCards[$x];
                $defendingCard = $defendingCards[$x];

                if (($attackingCard->getAttackPoints()) > ($defendingCard->getDefencePoints())) {
                    $damage += (($attackingCard->getAttackPoints()) - ($defendingCard->getDefencePoints()));
                }
            }

            if (count($attackingCards) > count($defendingCards)) {
                $diffrence = count($attackingCards) - count($defendingCards);
                $placeToCountAgain = count($attackingCards) - $diffrence;

                for ($x = ($placeToCountAgain); $x < (count($attackingCards)); $x++) {
                    $attackingCard = $attackingCards[$x];
                    $damage += $attackingCard->getAttackPoints();
                }
            }
        }
        return $damage;
    }

    public function defenderLosesLife($defender, $damage): player
    {
        $oldLifepoints = $defender->getLifePoints();
        $newLifepoints = $oldLifepoints - $damage;

        if ($newLifepoints < 0) {
            $newLifepoints = 0;
        }

        $defender->setLifePoints($newLifepoints);
        return $defender;
    }


    //resetting battlefield after attack
    public function resetBattleField($playerWhoEndsTurn): Player
    {
        $cardsOnBattlefield = $playerWhoEndsTurn->getPlayerBoard();
        foreach ($cardsOnBattlefield as $card) {
            $card->setRole("none");
        }
        $playerWhoEndsTurn->setPlayerBoard($cardsOnBattlefield);
        return $playerWhoEndsTurn;
    }

    //determining new playerboard for the attacking player after the fight
    public function afterMathAttacker(Player $attackingPlayer): Player
    {

        $attackingCards = $_SESSION["attacker"];
        $defendingCards = $_SESSION["defender"];

        $playerBoardBefore = $attackingPlayer->getPlayerBoard();
        $playerBoardAfter = array();

        if (count($defendingCards) > 0) {
            for ($x = 0; $x < (count($defendingCards)); $x++) {
                $attackingCard = $attackingCards[$x];
                $defendingCard = $defendingCards[$x];

                if (($attackingCard->getAttackPoints()) == ($defendingCard->getDefencePoints())) {
                    $attackingCard->setIsDead(true);
                } elseif (($attackingCard->getAttackPoints()) < ($defendingCard->getDefencePoints())) {
                    $attackingCard->setIsDead(true);
                }
            }
        }

        foreach ($attackingCards as $attackingCard) {
            if ($attackingCard->getIsDead() == true) {
                $attackingCard->setIsDead(false);
                $indexToDelete = array_search($attackingCard, $playerBoardBefore);
                array_splice($playerBoardBefore, $indexToDelete, 1);
            }
        }

        foreach ($playerBoardBefore as $card) {
            array_push($playerBoardAfter, $card);
        }

        $attackingPlayer->setPlayerBoard($playerBoardAfter);
        return $attackingPlayer;
    }

    //determining new playerboard for the defending player, using the $_SESSION variables as reference
    public function afterMathDefender(Player $defendingPlayer): Player
    {
        $attackingCards = $_SESSION["attacker"];
        $defendingCards = $_SESSION["defender"];

        $playerBoardBefore = $defendingPlayer->getPlayerBoard();
        $playerBoardAfter = array();

        if (count($defendingCards) > 0) {
            for ($x = 0; $x < (count($defendingCards)); $x++) {
                $attackingCard = $attackingCards[$x];
                $defendingCard = $defendingCards[$x];

                if (($attackingCard->getAttackPoints()) == ($defendingCard->getDefencePoints())) {
                    $defendingCard->setIsDead(true);
                } elseif (($attackingCard->getAttackPoints()) > ($defendingCard->getDefencePoints())) {
                    $defendingCard->setIsDead(true);
                }
            }
        }

        foreach ($defendingCards as $defendingCard) {
            if ($defendingCard->getIsDead() == true) {
                $defendingCard->setIsDead(false);
                $indexToDelete = array_search($defendingCard, $playerBoardBefore);
                array_splice($playerBoardBefore, $indexToDelete, 1);
            }
        }

        foreach ($playerBoardBefore as $card) {
            array_push($playerBoardAfter, $card);
        }
        $defendingPlayer->setPlayerBoard($playerBoardAfter);
        return $defendingPlayer;
    }
}
