<?php
require_once('../dbcon.php');

$id = $_POST['dropdown'];
$title = $_POST['report_title'];
$desc = $_POST['report_desc'];
$quantity = $_POST['report_quantity'];

$sql = "INSERT INTO kerosakan(IDLaporan, TajukLaporan, Keterangan, BilRosak, AsetRosak, DilaporOleh)
        VALUES('".getNextId($con)."', '$title', '$desc', '$quantity', '$id', '".$_GET['session']."')";

if(empty($_GET['session'])) {
    echo "<script>
    window.history.back();
    </script>";
} else if(empty($id) || empty($title) || empty($desc) || empty($quantity)) {
    echo "<script>
    window.alert('Sila isikan borang!');
    window.location = 'report.php?session=".$_GET['session']."';
    </script>";
} else {
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "<script>
        window.location = '../inventory/inventory.php?session=".$_GET['session']."';
        </script>";
    } else {
        echo "<script>
        window.alert('Gagal membuat laporan.');
        window.history.back();
        </script>";
    }
}

function getNextId($con) {
    $sql = "SELECT IDLaporan FROM kerosakan ORDER BY IDLaporan DESC LIMIT 1";
    $result = mysqli_query($con, $sql);

    while($row = $result->fetch_assoc()) {
        $curr_id = $row['IDLaporan'];
    }

    return "R".sprintf("%03d", (int)str_replace("R", "", $curr_id) + 1);
}
?>