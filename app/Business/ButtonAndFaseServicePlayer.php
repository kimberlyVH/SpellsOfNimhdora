<?php
//Business/ButtonAndfasePlayerService.php

declare(strict_types=1);

namespace Business;

use Business\GameService;

class ButtonAndFaseServicePlayer
{

    public function getFaseAndButtonFunctionPlayer()
    {
        // player turn
        if (isset($_SESSION["turn"]) && $_SESSION["turn"] == 1) {
            //drawfase player
            if (isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "1") {

                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();

                $drawFaseEntered = $gameService->enterDrawfase($game, $_SESSION["turn"]);

                $_SESSION["game"] = serialize($drawFaseEntered);
                $_SESSION["fase"] = 2;
                header("location: game.php");
                exit();
            }

            //player puts card on board
            if (isset($_POST["cardInhand"]) && $_SESSION["fase"] == 2) {

                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();

                $chosenCard = (int) $_POST["cardInhand"];
                $summonFaseEntered = $gameService->enterSummonFase($game, $chosenCard);

                $_SESSION["game"] = serialize($summonFaseEntered);
                $_SESSION["fase"] = 3;

                header("location: game.php");
                exit();
            }

            //player picks attacker
            if (isset($_POST["cardOnBoard"]) && $_SESSION["fase"] == 3) {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $player = $game->getPlayer();
                $playerBoard = $player->getPlayerBoard();
                $chosenCard = $_POST["cardOnBoard"];


                array_push($_SESSION["attacker"], $playerBoard[$chosenCard]);
                $attackingfaseEntered = $gameService->EnterAttackFase($game, $chosenCard);

                $_SESSION["game"] = serialize($attackingfaseEntered);
                header("location: game.php");
                exit();
            }

            //player declare attack 
            if ((isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "3")
                && (isset($_SESSION["attacker"]) &&  count($_SESSION["attacker"]) > 0)
            ) {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $playerService = new PlayerService();

                //checking if npc has creatures on battlefield 
                $defendingPlayer = $game->getNpc();
                $hasCreatures = $playerService->checkDefendingBattlefield($defendingPlayer);
                if (!$hasCreatures) {
                    $battleHasBeenFaught = $gameService->fight($game, $_SESSION["turn"]);
                    $_SESSION["game"] = serialize($battleHasBeenFaught);
                    $_SESSION["fase"] = "endTurn";
                } else {
                    $_SESSION["turn"] = "2";
                    $_SESSION["fase"] = "4";
                }

                header("location: game.php");
                exit();
            }

            //when player decides not to attack but pass turn
            if ((isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "3")
                && (isset($_SESSION["attacker"]) &&  count($_SESSION["attacker"]) == 0)
            ) {

                $_SESSION["turn"] = 2;
                $_SESSION["fase"] = 1;
                header("location: game.php");
                exit();
            }

            //player declared attack -- marvin picked defenders -- fight continues
            if (isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "continue") {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $playerService = new PlayerService();

                $battleHasBeenFaught = $gameService->fight($game, $_SESSION["turn"]);

                $_SESSION["game"] = serialize($battleHasBeenFaught);
                $_SESSION["fase"] = "endTurn";

                header("location: game.php");
                exit();
            }


            //player ends turn after attack-> unset attackers on board and pass turn to marvin
            if (isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "endTurn") {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();

                $_SESSION["attacker"] = array();
                $_SESSION["defender"] = array();

                $battlefieldHasBeenReset = $gameService->resettingBattlefield($game, $_SESSION["turn"]);
                $_SESSION["game"] = serialize($battlefieldHasBeenReset);

                $_SESSION["turn"] = 2;
                $_SESSION["fase"] = 1;
                header("location: game.php");
                exit();
            }

            //turn is passed to back to player, player picks defenders
            if(isset($_SESSION["defender"]) && $_SESSION["defender"] <= $_SESSION["attacker"]) {
                if (isset($_POST["cardOnBoard"]) && $_SESSION["fase"] == "4") {
                    $game = unserialize($_SESSION["game"]);
                    $gameService = new GameService();
                    $player = $game->getPlayer();
                    $playerBoard = $player->getPlayerBoard();
                    $chosenCard = $_POST["cardOnBoard"];
    
                    array_push($_SESSION["defender"], $playerBoard[$chosenCard]);
                    $defendingfaseEntered = $gameService->EnterDefendFase($game, $chosenCard);
                    $_SESSION["game"] = serialize($defendingfaseEntered);
    
                    header("location: game.php");
                    exit();
                }
            }
          
            //player blocks
            if (isset($_POST["btnDeck"]) && $_POST["btnDeck"] == "4") {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $playerService = new PlayerService();

                //changing $_SESSION["turn"] as a symbolical switch player declare block(turn 1), marvin attacks(turn 2)
                $_SESSION["turn"] = 2;

                $battleHasBeenFaught = $gameService->fight($game, $_SESSION["turn"]);
                $_SESSION["game"] = serialize($battleHasBeenFaught);
                $_SESSION["attacker"] = array();
                $_SESSION["defender"] = array();

                $_SESSION["fase"] = "endTurnNpc";

                header("location: game.php");
                exit();
            }
        }
    }
}
