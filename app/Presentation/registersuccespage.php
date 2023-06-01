<?php
//Presentation/registerSuccesPage.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Succes!";
$styleSheet = "registerSucces";
require_once("header.php");
?>
<section class="container">


    <section class="left">
        <div class="backframe_register">
            <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
                <header>
                    <h1>Greetings new companion,</h1>
                    <p>
                        You've been succesfully added to our book of heroes!<br />
                        Let the Journey begin!
                    </p>
                </header>
                <button name="btnPlay">PLAY</button>
            </form>
        </div>
    </section>


    <aside class="right">
        <img class="adventurerImg aniElement" src="Presentation/stylesheets/page_Img/resting_adventurer.png" alt="nimphdorain mage resting on clouds accompanied by fire sprites" />
    </aside>

</section>


<?php
require_once("footer.php");
?>