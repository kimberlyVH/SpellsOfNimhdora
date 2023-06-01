<?php
//Presentation/registerPage.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Join Us!";
$styleSheet = "register";
require_once("header.php");
?>
<section class="container">
    <section class="left">
        <div class="backframe_register">
            <img src="Presentation/stylesheets/page_Img/reg_log_head.png">
            <form class="register" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
                <header>
                    <h1>Come Join us!<br />
                        <small>Adventure awaits!</small>
                    </h1>
                    <h2>Register</h2>
                </header>

                <?php
                if ($error !== "") {
                    print("<span class='error'>" . $error . "</span><br />");
                }
                ?>
                <input type="text" name="txtEmail" placeholder="E-mailadres"><br />
                <input type="text" name="txtNickname" placeholder="Nickname"><br />
                <input type="password" name="txtPassword" placeholder="password"><br />
                <input type="password" name="txtPasswordConfirmation" placeholder="Comfirm password"><br />
                <button name="btnRegister">Register</button>

                <p><small>Already an account?<a href="login.php"> Log in!</small></a></p>
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