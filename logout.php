<?php
// error_reporting(0);
session_start();

if(@$_GET['session']==true)
{
    unset($_SESSION['email']);
    echo '<script>window.location.replace("login.php");</script>';
}


?>