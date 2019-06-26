<?php
require_once('dbcon.php');

$id = $_POST['student_id'];
$password = $_POST['password'];

$sql = "SELECT IDSekolah, KataLaluan FROM pengguna WHERE IDSekolah = '$id' AND BINARY KataLaluan = '$password'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) != 0) {
    echo "<script>
    window.location = './main/main.php?session=".getSessionId($id, $con)."';
    </script>";
} else {
    echo "<script>
    window.alert('Login gagal');
    window.history.back();
    </script>";
}

function getSessionId($id, $con) {
    $sql = "SELECT IDPengguna FROM pengguna WHERE IDSekolah = '$id'";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) != 0) {
        while($row = $result->fetch_assoc()) {
            return $row['IDPengguna'];
        }
    } else {
        // tidak mendapati ID Pengguna
    }
}

?>