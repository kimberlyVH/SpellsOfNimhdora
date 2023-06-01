<?php
//logout.php

include("bootstrap.php");

if (isset($_SESSION["user"])) {
    session_destroy();
    header("location: index.php");
    exit();
}
