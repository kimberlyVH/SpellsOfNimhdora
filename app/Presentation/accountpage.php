<?php
//Presentation/accountpage.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Your Account";
$styleSheet = "accountPage";
require_once("header.php");
?>

<div class="container">
    <div class="grid-container-left">
        <img class="avatar_img" src="<?php print($avatar->getAvatar_imgSrc()); ?>" />
        <h2>Hi, <?php print($user->getUserNickname()); ?></h2>

        <div class="hyperlinks">
            <a id="manage" href="manageaccount.php"><img src="Presentation\stylesheets\page_Img\tandwiel_icon.png"> Manage Account</a><br />
            <a id="edit" href="editprofile.php?action=edit"><img src="Presentation\stylesheets\page_Img\tandwiel_icon.png"> Edit Profile</a><br />
        </div>
        <a id="back" href="index.php"><img src="Presentation/stylesheets/page_Img/Back_icon.png" alt="Back"></a>
    </div>

    <div class="grid-container-right">
        <h1> Profile</h1>
        <ul>
            <li><b>Gender: </b><?php print($userAccount->getPlayerGender()); ?></li>
            <li><b>Age: </b><?php print($userAccount->getPlayerAge()); ?></li>
            <li><b>Bio: </b><?php print(htmlentities($userAccount->getPlayerBio())); ?></li>
        </ul>
    </div>
</div>

<?php
require_once("footer.php");
?>