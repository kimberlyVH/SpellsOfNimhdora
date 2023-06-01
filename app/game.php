<?php
//game.php

include("bootstrap.php");

use Business\GameService;
use Business\AvatarService;
use Business\ButtonAndFaseServicePlayer;
use Business\ButtonAndFaseServiceNpc;

if (!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}

if (!isset($_SESSION["game"])) {
    header("location: index.php");
    exit();
}



$game = unserialize($_SESSION["game"]);
$gameService = new GameService();


//preparing NpcSide for layout
$avatarService = new AvatarService();
$npcAvatar = $avatarService->giveAvatar_image(0);

$npc = $game->getNpc();
$cardsInhandNpc = $npc->getHand();
$cardsOnBoardNpc = $npc->getPlayerBoard();


//getting info for playerSide layout
$user = unserialize($_SESSION["user"]);
$userAccount = $user->getUserAccount();
$userAvatar = $userAccount->getAvatar();

$player = $game->getPlayer();
$cardsInhandUser = $player->getHand();
$cardsOnBoardUser = $player->getPlayerBoard();

$damageMade = $game->getDamageMade();


//who wins?
if (isset($_SESSION["fase"]) && $_SESSION["fase"] !== 0) {

    $deckNpc = $npc->getDeck();
    $cardsLeftNpc = count($deckNpc);

    $deckPlayer = $player->getDeck();
    $cardsLeftPlayer = count($deckPlayer);

    if ($cardsLeftNpc ==  0 || $npc->getLifePoints() == 0) {
        $player->setUserNickname($user->getUserNickname());
        $game->setWinner($player);
        $_SESSION["fase"] = "GAME END";
    }

    if ($player->getLifePoints() == 0 || $cardsLeftPlayer == 0) {
        $game->setWinner($npc);
        $_SESSION["fase"] = "GAME END";
    }
}


//starting Game when player pushes the deck button for the first time
if (isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "0") {
    $game = unserialize($_SESSION["game"]);
    $gameService = new GameService();

    $startedGame = $gameService->startGame($game);

    $_SESSION["game"] = serialize($startedGame);
    $_SESSION["fase"] = 1;
    header("location: game.php");
    exit();
}

/*
TURNS
__________________________________
turn 1 -> player;
turn 2 -> npc; 

FASES
______________________________________________________________________________
fase 1: player -> drawfase / marvin -> draw, summon, picking attacker
fase 2: player -> summonfase / marvin -> none
fase 3: player -> picking attacker, declaring attack / marvin ->starting fight
fase 4: player -> picking defender, declaring block / marvin ->choses blockers
______________________________________________________________________________
*/
$buttonAndFaseServicePlayer = new ButtonAndFaseServicePlayer();
$buttonAndFaseServiceNpc = new ButtonAndFaseServiceNpc();

$buttonAndFaseServicePlayer->getFaseAndButtonFunctionPlayer();
$buttonAndFaseServiceNpc->getFaseAndButtonFunctionNpc();

include("Presentation/gamepage.php");
