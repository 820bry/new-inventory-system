<?php
require_once('../dbcon.php');

$id = $_GET['ItemID'];
$session = $_GET['session'];

$name = $_POST['item_name'];
$quantity = $_POST['item_quantity'];

$sql = "UPDATE peralatan
        SET NamaAset = '$name', BilAset = '$quantity'
        WHERE IDAset = '".$_GET['ItemID']."'";

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
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "<script>
        window.location = 'inventory.php?session=".$_GET['session']."';
        </script>";
    } else {
        echo "<script>
        window.alert('Failed to update item info');
        window.history.back();
        </script>";
    }
}

?>