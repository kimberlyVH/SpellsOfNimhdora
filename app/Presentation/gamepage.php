<?php
//Presentation/gamePage.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Game";
$styleSheet = "game";
require_once("header.php");
?>
<section class="container">

    <!-- npc Side-->


    <!-- npc avatar, lifepunts, level -->
    <img class="avatarImgNpc" src="<?php print($npcAvatar->getAvatar_imgSrc()) ?>" />
    <img class="gameFrameNpc" src="Presentation/stylesheets/game_img/game_frame_Npc.png" />
    <h1 class="npcName"><?php print($npc->getNpcNickname()); ?></h1><br />
    <span class=lifepointsNpc><?php print($npc->getLifePoints()); ?></span><br />
    <span class=levelNpc><?php print(1); ?></span><br />

    <!-- npc deck aantal -->
    <img class="deckImg" src="Presentation/stylesheets/game_img/card_img/card_back.png" alt="deck"><br />
    <span class="amount"><?php print(count($npc->getDeck())); ?></span><br />

    <!-- npc hand -->
    <?php if (count($cardsInhandNpc) > 0) { ?>
        <table class="cardHand">
            <tr>
                <?php foreach ($cardsInhandNpc as $card) { ?>
                    <td><img src="Presentation/stylesheets/game_img/card_img/card_back.png" alt="back of card"></td>
                <?php } ?>
            </tr>
        </table>
    <?php } ?>

    <!-- npc board -->
    <?php if (count($cardsOnBoardNpc) > 0) { ?>
        <table class="cardsOnBoardNpc">
            <tr>
                <?php foreach ($cardsOnBoardNpc as $card) { ?>
                    <td>
                        <div class="imgCardBoardNpc">
                            <span class="cardnameNpc"><?php print($card->getCard_naam()); ?></span>
                            <span class="cardPowerNpc"><?php print($card->getAttackPoints() . "/" . $card->getDefencePoints()); ?></span>
                            <?php if ($card->getRole() !== "none") { ?>
                                <div class="cardRoleNpc">
                                    <img class="roleImg" src="Presentation/stylesheets/game_img/<?php print($card->getRole()); ?>.png" alt="<?php print($card->getRole()); ?>" />
                                </div>
                            <?php } ?>
                            <img class="cardImg" src="<?php print($card->getCard_imgSrc()); ?>" alt="<?php print($card->getCard_naam()); ?>" />
                        </div>
                    </td>
                <?php } ?>
            </tr>
        </table>
    <?php } ?>



    <!-- playerSide -->
    <form class="player" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">



        <!-- board -->
        <?php if (count($cardsOnBoardUser) > 0) { ?>
            <table class="cardsOnplayerBoard">
                <tr>
                    <?php foreach ($cardsOnBoardUser as $card) { ?>
                        <td>
                            <div class="imgBtnCardBoard">
                                <span class="cardnameBoard"><?php print($card->getCard_naam()); ?></span>
                                <span class="cardPowerBoard"><?php print($card->getAttackPoints() . "/" . $card->getDefencePoints()); ?></span>
                                <?php if ($card->getRole() !== "none") { ?>
                                    <div class="role">
                                        <img class="roleImgBoard" src="Presentation/stylesheets/game_img/<?php print($card->getRole()); ?>.png" alt="<?php print($card->getRole()); ?>" />
                                    </div>
                                <?php } ?>
                                <img class="cardImgBoard" src="<?php print($card->getCard_imgSrc()); ?>" alt="<?php print($card->getCard_naam()); ?>" />
                            </div>


                            <button class="btnCardBoard" name="cardOnBoard" value="<?php print(array_search($card, $cardsOnBoardUser)); ?>"></button>
                        <?php } ?>
                    <?php } ?>
                </tr>
            </table>

            <!-- kaarten in hand -->
            <?php if (count($cardsInhandUser) > 0) { ?>
                <table class="cardsInHandPlayer">
                    <tr>
                        <?php foreach ($cardsInhandUser as $card) { ?>
                            <td>
                                <div class="imageBtnCard">
                                    <span class="cardname"><?php print($card->getCard_naam()); ?></span>
                                    <span class="cardPower"><?php print($card->getAttackPoints() . "/" . $card->getDefencePoints()); ?></span>
                                    <img class="cardImg" src="<?php print($card->getCard_imgSrc()); ?>" alt="<?php print($card->getCard_naam()); ?>" />
                                </div>
                                <button class="btnCard" name="cardInhand" value="<?php print(array_search($card, $cardsInhandUser)); ?>"></button>
                            <?php } ?>
                            </td>
                        <?php } ?>
                </table>
                </tr>
                </div>

                <!-- avatar, lifepoints, level -->
                <div class="info">
                    <?php if ($_SESSION['fase'] == 2 && $_SESSION['turn'] == 1) { ?>

                        <p class="fase">Fase: Summon a creature</p><br />
                    <?php } ?>

                    <?php if ($_SESSION['fase'] == 3  && $_SESSION['turn'] == 1) { ?>
                        <p class="fase">Fase: Pick attacker(s)</p><br />
                    <?php } ?>

                    <?php if ($_SESSION['fase'] == 4  && $_SESSION['turn'] == 1) { ?>

                        <p class="fase">Fase: Pick blocker(s)</p><br /><br />

                    <?php } ?>

                    <?php print("<p class='damage'>Damage: " . $game->getDamageMade() . "</p>") ?>

                </div>
                <img class="avatarImg" src="<?php print($userAvatar->getAvatar_imgSrc()); ?>" />
                <img class="gameFrame" src="Presentation/stylesheets/game_img/game_frame.png" />
                <h1 class="playerName"><?php print($user->getUserNickname()); ?></h1><br />
                <span class=lifepoints><?php print($player->getLifePoints()); ?></span><br />
                <span class=levelPlayer><?php print($userAccount->getLevel()); ?></span><br />

                <!-- deckcount en button -->
                <div class="image"><img src="Presentation/stylesheets/game_img/card_img/card_back.png" alt="deck"><br /></div>
                <button class="btnDeck" name="btnDeck" value="<?php print($_SESSION["fase"]); ?>">


                    <?php if (isset($_SESSION["turn"]) && $_SESSION["turn"] == 1) { ?>
                        <?php if (isset($_SESSION["fase"]) && $_SESSION["fase"] == 0) { ?>

                            <span class="btnDeckMessage">
                                <bold>START</bold>
                            </span><br />


                        <?php } ?>

                        <?php if (isset($_SESSION["fase"]) && $_SESSION["fase"] == 1) { ?>

                            <span class="btnDeckMessage">
                                <bold>DRAW</bold>
                            </span><br />

                        <?php } ?>

                        <?php if ((isset($_SESSION["fase"]) && $_SESSION["fase"] == 3)
                            && (isset($_SESSION["attacker"]) && count($_SESSION["attacker"]) == 0)
                        ) { ?>

                            <span class="btnDeckMessage">
                                <bold>PASS TURN</bold>
                            </span><br />

                        <?php } ?>

                        <?php if ((isset($_SESSION["fase"]) && $_SESSION["fase"] == 3)
                            && (isset($_SESSION["attacker"]) && count($_SESSION["attacker"]) > 0)
                        ) { ?>

                            <span class="btnDeckMessage">
                                <bold>DECLARE ATTACK</bold>
                            </span><br />

                        <?php } ?>

                        <?php if (isset($_SESSION["fase"]) && $_SESSION["fase"] == "continue") { ?>

                            <span class="btnDeckMessage">
                                <bold>FINISH BATTLE</bold>
                            </span><br />

                        <?php } ?>

                        <?php if (isset($_SESSION["fase"]) && $_SESSION["fase"] == "endTurn") { ?>

                            <span class="btnDeckMessage">
                                <bold>END TURN</bold>
                            </span><br />

                        <?php } ?>

                        <?php if ((isset($_SESSION["fase"]) && $_SESSION["fase"] == "4")
                            && (isset($_SESSION["defender"]) && count($_SESSION['defender']) > 0)
                        ) { ?>

                            <span class="btnDeckMessage">
                                <bold>BLOCK</bold>
                            </span><br />

                        <?php } ?>

                        <?php if ((isset($_SESSION["fase"]) && $_SESSION["fase"] == "4")
                            && (isset($_SESSION["defender"]) && count($_SESSION['defender']) == 0)
                        ) { ?>

                            <span class="btnDeckMessage">
                                <bold>DON'T BLOCK</bold>
                            </span><br />

                        <?php } ?>

                    <?php } ?>
                    <span class="amountPlayer"><?php print(count($player->getDeck())); ?></span><br />
                </button>
    </form>


    <!-- GAME ENDING SCREEN -->
    <?php if ($npc->getLifePoints() == 0 || $player->getLifePoints() == 0) { ?>
        <?php $winner = $game->getWinner(); ?>

        <div class="endingScreen">
            <div class='endingMessage'>
                <?php if ($winner->getUserNickname() == $user->getUserNickname()) { ?>
                    <h1> CONGRATULATIONS, YOU WON!</h1>
                    <a href="index.php"><img class="back" src="Presentation\stylesheets\page_Img\Back_icon.png" alt="back" title="Back to Homepage"></a>
                    <a href="gamestart.php?action=againW"><img class="play" src="Presentation\stylesheets\page_Img\arrow_icon_next.png" alt="Play again" title="Play again"></a>
                <?php } else { ?>
                    <h1> <?php print($npc->getUserNickname()); ?> WINS</h1>
                    <a href="index.php"><img class='back' src="Presentation\stylesheets\page_Img\Back_icon.png" alt="back" title="Back to Homepage"></a>
                    <a href="gamestart.php?action=againL"><img class="play" src="Presentation\stylesheets\page_Img\arrow_icon_next.png" alt="rematch" title="rematch!"></a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</section>
<?php
require_once("footer.php");
?>