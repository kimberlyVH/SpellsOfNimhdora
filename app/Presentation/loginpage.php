<?php
//Presentation/loginpage.php

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Login";
$styleSheet = "login";

require_once("header.php");
?>
<section class="container">
    <section class="left">
        <div class="backframe">
            <img src="Presentation/stylesheets/page_Img/reg_log_head.png">
            <form class="login" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
                <header>
                    <h1>Hi there traveler!</h1>
                    <h2>Login</h2>
                </header>

                <?php
                if ($error !== "") {
                    print("<span class='error'>" . $error . "</span><br />");
                }
                ?>

                <input type="text" name="txtEmail" placeholder="E-mailadres"><br />
                <input type="password" name="txtPassword" placeholder="password"><br />

                <button id="btnLogin" name="btnLogin">Login</button>

                <p><small>Not known to us yet?<a href="register.php"> Register here!</small></a></p>
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