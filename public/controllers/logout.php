<?php
// startuj sesiju ili uradi resume
if(!isset($_SESSION)){
    session_start();
}

session_destroy();


header('Location: /controllers/login.php');
