<?php
//Presentation/homepage>php.php

/*Homepage -- Public*/

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Homepage";
$styleSheet ="index";
require_once("header.php");
?>
<section class="container">
    <section class="left">

        
        <p>Welcome to, </p>
        <h1 class="gametitle">Spells Of Nimphdora</h1>
        

        <section class="links">
        <?php
            if (isset($_SESSION["user"])) {
            ?>
                <a id="play" href="gamestart.php">PLAY</a>
            <?php
            } else {
            ?>
                <a id="login" href="login.php">login</a>
                <a id="register" href="register.php">Join Us!</a>
            <?php
            }
            ?>
        </section>
  
    </section>

    <aside class="right">
        <img class="adventurerImg aniElement" src="Presentation/stylesheets/page_Img/resting_adventurer.png" alt="nimphdorain mage resting on clouds accompanied by fire sprites" />
    </aside>

</section>

<?php
require_once("footer.php");
?>