<?php
//Business/CardService.php

declare(strict_types=1);

namespace Business;

use Entities\Card;
use Data\CardDAO;

class CardService
{
    public function giveCardList(): array
    {
        $cardDAO = new CardDAO();
        $cardListData = $cardDAO->getAllCards();

        $cardList = array();
        foreach ($cardListData as $cardData) {
            $card = Card::create((int) $cardData["id"], (string) $cardData["card_naam"], (string) $cardData["card_imgSrc"],
            (int) $cardData["attack"], (int) $cardData["defence"]);
            array_push($cardList, $card);
        }
        return $cardList;
    }

    public function giveCard(int $cardId): Card
    {
        $cardDAO = new cardDAO();
        $cardData = $cardDAO->getCardById((int) $cardId);
        $card = Card::create((int) $cardData["id"], (string) $cardData["card_naam"], (string) $cardData["card_imgSrc"], (int) $cardData["attack"],
        (int) $cardData["defence"]);
        return $card;
    }
}
