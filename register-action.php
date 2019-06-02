<?php
require_once('dbcon.php');

$query = "SELECT * FROM users";
$get_users = mysqli_query($con, $query);

$next_id = "ICRZ".sprintf("%03d", mysqli_num_rows($get_users) + 1);

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
    $sql = "INSERT INTO users(UserName, StudentID, UserID, Password)
        VALUES('$name', '$id', '$next_id', '$password')";
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "<script>
        window.location = 'login.php';
        </script>";
    } else {
        echo "<script>
        window.alert('Failed to register');
        window.history.back();
        </script>";
    }
}

?>