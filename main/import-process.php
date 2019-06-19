<?php
require_once('../dbcon.php');

session_start();

$session = $_GET['session'];
if(isset($session) || empty($session)) {
    echo "<script> window.location = '../login.php'; </script>";
}

$file = $_FILES[csv]

?>