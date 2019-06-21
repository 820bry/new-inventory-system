<?php
require_once('../dbcon.php');

$id = $_GET['ItemID'];

// delete all reports with its ID as well
mysqli_query($con, "DELETE FROM damage WHERE DamageItem = '$id'");

$sql = "DELETE FROM inventory WHERE ItemID = '$id'";
$result = mysqli_query($con, $sql);

if($result) {
    echo "<script>
    window.location = 'inventory.php?session=".$_GET['session']."';
    </script>";
} else {  
    // item doesn't exist
    echo "<script>
    window.alert('Failed to delete item');
    window.history.back();
    </script>";
}

?>