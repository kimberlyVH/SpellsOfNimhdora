<?php
//Presentation\header.php

declare(strict_types=1);

namespace Presentation;
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title><?php print($pageTitel); ?></title>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <link rel="icon" href="Presentation/stylesheets/page_Img/faviconSON.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="Presentation/stylesheets/<?php print($styleSheet); ?>.css">
   
   <style>

       html, body { height: 100vh; height: calc(var(--vh, 1vh) * 100); }
       body {display: grid; grid-template-columns: repeat(1, 1fr); 
            gap: 0px; grid-auto-rows: minmax (25px, auto);}
       .navbar {grid-column: 1; grid-row: 1;}
       footer {grid-column: 1; grid-row: 3;}

    </style>
</head>

<body class="standard">

    <?php
    if (isset($_SESSION["game"])) {
    ?>
          <nav class="navbar">
            <ul>
                <li><a href="index.php">Quit</a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav class="navbar">
            <ul>    
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">About</a></li>
                <?php
                if (isset($_SESSION["user"])) {
                ?>
                    <li><a href="Account.php">My account</a></li>
                    <li><a href="logout.php">Log out</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    <?php
    }
    ?>