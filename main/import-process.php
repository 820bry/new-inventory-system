<?php
require_once('../dbcon.php');

session_start();

$session = $_GET['session'];

$curr_date = date('Y-m-d H:i:s');
$filename = $_FILES['import_file']['tmp_name'];

if($_FILES['import_file']['size'] > 0) {
    $file = fopen($filename, 'r');

    while(!feof($file)) {
        $data = fgetcsv($file, '0');

        $sql = "SELECT * FROM inventory WHERE ItemID = '$data[1]'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) === 0) {
            // to prevent it from importing empty datasets
            if(!empty($data[1])) {
                $insert = "INSERT INTO inventory(ItemName, ItemID, ItemQuantity, UserRegistered, DateRegistered)
                        VALUES('$data[0]', '$data[1]', '$data[2]', '$session', '$curr_date')";

                mysqli_query($con, $insert);

                echo "<script>
                window.alert('Successfully imported data');
                window.location = 'inventory.php?session=".$session."';
                </script>";
            }
        }
    }
    fclose($file);
} else {
    echo "<script>
    window.alert('Failed to import data.');
    window.history.back();
    </script>";
}

?>