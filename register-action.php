<?php
require_once('dbcon.php');

$name = $_POST['student_name'];
$id = $_POST['student_id'];
$password = $_POST['password'];
$password2 = $_POST['password_confirm'];

if(empty($name) || empty($id) || empty($password) || empty($password2)) {
    echo "<script>
    window.alert('Fill in the form');
    window.history.back();
    </script>";
    return;
} else if($password != $password2) {
    echo "<script>
    window.alert('Passwords do not match');
    window.history.back();
    </script>";
    return;
} else {
    $sql = "INSERT INTO pengguna(Nama, IDSekolah, IDPengguna, KataLaluan)
        VALUES('$name', '$id', '".getNextId($con)."', '$password')";
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "<script>
        window.location = 'index.php';
        </script>";
    } else {
        echo "<script>
        window.alert('Failed to register');
        window.history.back();
        </script>";
    }
}

function getNextId($con) {
    $sql = "SELECT IDPengguna FROM pengguna ORDER BY IDPengguna DESC LIMIT 1";
    $result = mysqli_query($con, $sql);

    while($row = $result->fetch_assoc()) {
        $curr_id = $row['IDPengguna'];

        return "ICRZ".sprintf("%03d", (int)str_replace("ICRZ", "", $curr_id) + 1);
    }
}

?>