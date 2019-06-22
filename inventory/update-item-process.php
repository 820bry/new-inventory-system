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
    window.alert('Sila isikan borang!');
    window.history.back();
    </script>";
    return;
} else if($quantity <= 0 || $quantity >= 1000) {
    echo "<script>
    window.alert('Bilangan aset hanya boleh di antara 1 dan 999!');
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
        window.alert('Gagal mengemaskini data aset.');
        window.history.back();
        </script>";
    }
}

?>