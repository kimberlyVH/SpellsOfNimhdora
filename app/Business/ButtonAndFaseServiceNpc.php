<?php
//Business/ButtonAndFaseServiceNpc.php
declare(strict_types=1);

namespace Business;

use Business\GameService;

class ButtonAndFaseServiceNpc
{
    public function getFaseAndButtonFunctionNpc()
    {
        //marvins turn
        if (isset($_SESSION["turn"]) && $_SESSION["turn"] == 2) {

            //Marvin draws a card -- summons a attacking creature -- and declares attack
            if (isset($_SESSION["fase"]) && $_SESSION["fase"] == 1) {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $playerService = new PlayerService();

                //marvin draws a card
                $drawFaseEntered = $gameService->enterDrawfase($game, $_SESSION["turn"]);

                //marvin puts a creature on the battlefield
                $summonFaseEntered = $gameService->npcEntersSummonFase($drawFaseEntered);

                //Marvin choses a Attacker on the battelfield
                $attackingFaseEntered = $gameService->npcEntersAttackingFase($summonFaseEntered);

                //checking if defender has creatures
                $defendingPlayer = $game->getPlayer();
                $hasCreatures = $playerService->checkDefendingBattlefield($defendingPlayer);
                if (!$hasCreatures) {
                    $_SESSION["fase"] = 3;
                } else {
                    $_SESSION["turn"] = 1;
                    $_SESSION["fase"] = 4;
                }
                $_SESSION["game"] = serialize($attackingFaseEntered);
                header("location: game.php");
                exit();
            }

            //Marvin attackes , no defendingCards from player
            if (isset($_SESSION["fase"]) && $_SESSION["fase"] == 3) {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();
                $playerService = new PlayerService();

                $battleHasBeenFaught = $gameService->fight($game, $_SESSION["turn"]);
                $_SESSION["game"] = serialize($battleHasBeenFaught);


                $_SESSION["fase"] = "endTurnNpc";

                header("location: game.php");
                exit();
            }


            //Mavin choses a defender on de battlefield
            if (isset($_SESSION["fase"]) && $_SESSION["fase"] == "4") {

                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();

                $defendingFaseEntered = $gameService->npcEntersDefendFase($game);

                $_SESSION["game"] = serialize($defendingFaseEntered);

                //throwing turn back to player, so he can finish his attack
                $_SESSION["turn"] = 1;
                $_SESSION["fase"] = "continue";

                header("location: game.php");
                exit();
            }

            //Marvin end his turn after his attack -- board gets reset -- back to drawfase player
            if (isset($_SESSION["fase"]) && $_SESSION["fase"] == "endTurnNpc") {
                $game = unserialize($_SESSION["game"]);
                $gameService = new GameService();

                $_SESSION["attacker"] = array();
                $_SESSION["defender"] = array();

                //turn still 2, reset battlefield Marvin
                $npcBattlefieldHasBeenReset = $gameService->resettingBattlefield($game, $_SESSION["turn"]);


                //switch turn to pass turn and resetting battlefield player
                $_SESSION["turn"] = 1;
                $bothAreReset = $gameService->resettingBattlefield($npcBattlefieldHasBeenReset, $_SESSION["turn"]);
                $_SESSION["game"] = serialize($bothAreReset);

                //fase to drawfase player
                $_SESSION["fase"] = 1;
                header("location: game.php");
                exit();
            }
        }
    }
}
