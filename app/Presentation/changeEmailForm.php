<?php
//Presentation/changeEmailForm.php

declare(strict_types=1);

namespace Presentation;
?>

<aside class="changeEmail">
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Change E-mailadres</h1>
        <?php
        if ($error !== "") {
            print("<span class='error'>".$error."</span><br / >");
        }

        if ($updated !== "") {
            print("<span class='succes'>".$updated."</span><br / >");
        }
        ?>
        <input type="text" name="txtEmail" placeholder="new E-mailadres"><br />
        <input type="text" name="txtEmailConfirmation" placeholder="Confirm new E-mailadres"><br />
        <button name="btnSaveEmail">Save</button><br />
    </form>
</aside>
</section>
