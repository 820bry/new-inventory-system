<?php
require_once('../dbcon.php');

$name = $_POST['item_name'];
$quantity = $_POST['item_quantity'];
$curr_date = date('Y-m-d H:i:s');

if(empty($name) || empty($quantity)) {
    echo "<script>
    window.alert('Please complete the form');
    window.history.back();
    </script>";
    return;
} else if($quantity <= 0 || $quantity >= 1000) {
    echo "<script>
    window.alert('Invalid number supplied');
    window.history.back();
    </script>";
    return;
} else {
    $sql = "INSERT INTO peralatan(NamaAset, IDAset, BilAset, DidaftarOleh, DidaftarPada)
        VALUES('$name', '".getNextId($con)."', '$quantity', '".$_GET['session']."', '$curr_date')";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo "<script>
        window.location='inventory.php?session=".$_GET['session']."';
        </script>";
    } else {
        echo "<script>
        window.alert('Failed to add item.');
        window.history.back();
        </script>";
    }
}

function getNextId($con) {
    $sql = "SELECT IDAset FROM peralatan ORDER BY IDAset DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    
    while($row = $result->fetch_assoc()) {
        $curr_id = $row['IDAset'];
    }

    return "A".sprintf("%03d",(int)str_replace("A", "", $curr_id) + 1);
}

?>