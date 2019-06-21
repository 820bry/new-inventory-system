<?php

date_default_timezone_set("Asia/Kuala_Lumpur");

$host = "127.0.0.1";
$port = "3306";

$socket = "";

$user = "root";
$password = "";

$dbname = "pengurusanperalatan-5sk2";

$con = mysqli_connect($host, $user, $password, $dbname, $port, $socket)
or die('Could not connect to the database server'.mysqli_connect_error());

?>