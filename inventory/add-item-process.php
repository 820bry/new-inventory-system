<?php
require_once('../dbcon.php');

$name = $_POST['item_name'];
$quantity = $_POST['item_quantity'];
$curr_date = date('Y-m-d H:i:s');

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
    $sql = "INSERT INTO peralatan(NamaAset, IDAset, BilAset, DidaftarOleh, DidaftarPada)
        VALUES('$name', '".getNextId($con)."', '$quantity', '".$_GET['session']."', '$curr_date')";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo "<script>
        window.location='inventory.php?session=".$_GET['session']."';
        </script>";
    } else {
        echo "<script>
        window.alert('Gagal mendaftar aset.');
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