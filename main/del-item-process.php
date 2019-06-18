<?php
require_once('../dbcon.php');

$id = $_GET['ItemID'];

$sql = "DELETE FROM inventory WHERE ItemID = '$id'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) != 0) {
    echo "<script>
    window.location = 'inventory.php?session=".$_GET['session']."';
    </script>";
} else {  
    echo "<script>
    window.alert('Failed to delete item');
    window.history.back();
    </script>";
}

?>