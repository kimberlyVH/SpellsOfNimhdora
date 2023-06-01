<?php
//Presentation/editingForm.php

declare(strict_types=1);

namespace Presentation;

$pageTitel = "Spells Of Nimhdora: Edit Profile";
$styleSheet = "edit";
require_once("header.php");
?>
<div class="container">
    <form class="editingForm" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h2>Edit profile</h2>

        <div class="pictureOptions">
            <img class="avatar_img" src="<?php print($avatarToPrint->getAvatar_imgSrc()); ?>" />
            <h4>Select an avatar</h4>
            <button class="btnPrevious " name="btnPrevious" value="1">
                <img src="Presentation/stylesheets/page_Img/arrow_icon_previous.png" />
            </button>

            <button class="btnNext" name="btnNext" value="1">
                <img src="Presentation/stylesheets/page_Img/arrow_icon_next.png" />
            </button><br />

            <span class="avatar_img_naam">"<?php print($avatarToPrint->getAvatar_naam()); ?>"</span><br />
            <span class="avatar_count"><small><?php print("(" . ($_SESSION["toPrintId"] + 1) . "/" . count($avatarList) . ")"); ?></small></span>
        </div>

        <div class="options">
            <ul>
                <?php
                if ($error !== "") {
                    print("<span class='error'>" . $error . "</span><br />");
                }
                ?>
                <li><b>Gender:
                    </b><select name="selectGender">
                        <option value="none">-- Select your gender --</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                        <option value="non-binary">non-binary</option>
                        <option value="I'm a mystery wrapped in awesomeness">I'm a mystery wrapped in awesomeness</option>
                    </select><br />
                </li>

                <li><b>Age: </b><input type="text" name="txtPlayerAge" placeholder="age"><br /></li>
                <li id="bio"><b>Bio: </b><textarea style="width: 600px; height: 200px" name="txtPlayerBio" placeholder="Tell us something about yourself" maxlength="255"></textarea></li>
            </ul>
        </div>

        <div class="btnhyperlink">
            <button id="btnSaveChanges" name="btnSaveChanges" value="save">Save Changes</button><br />
            <a href="account.php?action=back"><img src="Presentation/stylesheets/page_Img/Back_icon.png" alt="Back"></a>
        </div>
    </form>
</div>

<?php
require_once("footer.php");
?>