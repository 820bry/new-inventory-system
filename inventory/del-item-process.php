<?php
require_once('../dbcon.php');

$id = $_GET['ItemID'];

// Hapuskan semua laporan yang mempunyai ID aset yang sama
mysqli_query($con, "DELETE FROM kerosakan WHERE AsetRosak = '$id'");

$sql = "DELETE FROM peralatan WHERE IDAset = '$id'";
$result = mysqli_query($con, $sql);

if($result) {
    echo "<script>
    window.location = 'inventory.php?session=".$_GET['session']."';
    </script>";
} else {  
    // Aset tidak wujud
    echo "<script>
    window.alert('Gagal menghapuskan aset.');
    window.history.back();
    </script>";
}

?>