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
    window.alert('Please fill in the form');
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
        window.alert('Failed to add report');
        window.history.back();
        </script>";
    }
}

function getNextId($con) {
    $sql = "SELECT * FROM kerosakan";
    $result = mysqli_query($con, $sql);

    return "R".sprintf("%03d", mysqli_num_rows($result) + 1);
}
?>