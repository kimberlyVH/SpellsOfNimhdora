<?php
//Presentation/deleteAccountForm.php

declare(strict_types=1);

namespace Presentation;
?>

<aside class="deleteAccount">
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Are you sure you want to delete your account? </h1>
        <button name="btnYes">YES</button>
        <button name="btnNo">NO</button>
    </form>
</aside>