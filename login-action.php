<?php
require_once('dbcon.php');

$id = $_POST['student_id'];
$password = $_POST['password'];

$sql = "SELECT StudentID, Password FROM users WHERE StudentID = '$id' AND BINARY Password = '$password'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) != 0) {
    echo "<script>
    window.location = './main/main.php?session=".getSessionId($id, $con)."';
    </script>";
} else {
    echo "<script>
    window.alert('Login failed');
    window.location = 'login.php';
    </script>";
}

function getSessionId($id, $con) {
    $sql = "SELECT UserID FROM users WHERE StudentID = '$id'";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) != 0) {
        while($row = $result->fetch_assoc()) {
            return $row['UserID'];
        }
    } else {
        // something went wrong here...
    }
}

?>