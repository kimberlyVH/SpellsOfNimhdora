<?php
//gamestart.php

include("bootstrap.php");

if(!isset($_SESSION["user"])) {
    header("location: index.php");
    exit();
}
use Business\GameService;

$gameService = new GameService();
$game = $gameService->createGame();

$_SESSION["game"] = serialize($game);
$_SESSION["turn"] = 1;
$_SESSION["fase"] = 0;
$_SESSION["attacker"] = array();
$_SESSION["defender"] = array();


if (isset($_SESSION["game"])) {
    header("location: game.php");
    exit();
}
