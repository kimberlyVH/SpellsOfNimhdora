<?php
//Business/PLayableCardService.php

declare(strict_types=1);

namespace Business;

use Entities\PlayableCard;
use Business\CardService;

class PlayableCardService
{
public function generateDeck(): array
    {
        $deck = array();
        $cardService = new CardService();
        $cardList = $cardService->giveCardList();

        for ($x = 1; $x <= 20; $x++) {
            $randomCardId = rand(1, count($cardList));
            $randomCard = $cardService->giveCard($randomCardId);
            $playingCard = new PlayableCard((int) $randomCard->getId(), (string) $randomCard->getCard_naam(), (string) $randomCard->getCard_imgSrc(),
            (int) $randomCard->getAttackPoints(), (int) $randomCard->getDefencePoints());
            array_push($deck, $playingCard);
        }

        return $deck;
    }

    public function cardBecomesAttacker($chosenCard)
    {
        $chosenCard->setRole("attacker");
    }
    public function cardBecomesDefender($chosenCard)
    {
        $chosenCard->setRole("defender");
    }
}