<?php
//Presentation/changePasswordForm.php

declare(strict_types=1);

namespace Presentation;
?>

<aside class="changePassword">
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Change Password</h1>
        <?php
        if ($error !== "") {
            print("<span class='error'>".$error."</span><br / >");
        }

        if ($updated !== "") {
            print("<span class='succes'>".$updated."</span><br / >");
        }
        ?>
        <input type="password" name="txtPassword" placeholder="new password"><br />
        <input type="password" name="txtPasswordConfirmation" placeholder="Comfirm new password"><br />
        <button name="btnSavePassword">Save</button><br />

    </form>
</aside>

