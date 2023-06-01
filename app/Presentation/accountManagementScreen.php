<?php
//Presentation/ccountManagementSreen.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Manage Account";
$styleSheet = "manageAccount";
require_once("header.php");
?>

<section class="container">
  <div class='left'>

    <img class="avatar_img" src="<?php print($userAvatar->getAvatar_imgSrc()); ?>" />
    <h4>What would you like to change?</h4>

    <div class="hyperlink">
      <a class='chgP' href="manageAccount.php?action=chgP"><img src="Presentation\stylesheets\page_Img\tandwiel_icon.png"> Change Password</a>
      <a class='chgE' href="manageAccount.php?action=chgM"><img src="Presentation\stylesheets\page_Img\tandwiel_icon.png"> Change Email-Addres</a>
      <a class='delA' href="manageAccount.php?action=delA"><img src="Presentation\stylesheets\page_Img\tandwiel_icon.png"> Delete Account</a>
    </div>

    <a id="back" href="account.php?action=back"><img src="Presentation/stylesheets/page_Img/Back_icon.png" alt="Back"></a>
  </div>
  <div class="fakeside">
  </div>
  <?php
  require_once("footer.php");
  ?>