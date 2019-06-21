<?php
include('../banner.php');
?>

<html>
    <head>
        <title>Update Item | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="update.css">
    </head>
    <body>
        <div class="page-content">
            <h2>Inventory > Update Item Data</h2>
            <?php
            require_once('../dbcon.php');

            $session = $_GET['session'];
            $id = $_GET['ItemID'];

            $sql = "SELECT * FROM peralatan WHERE IDAset = '$id'";
            $result = mysqli_query($con, $sql);

            if($result) {
                while($row = $result->fetch_assoc()) {
                    $name = $row['NamaAset'];
                    $quantity = $row['BilAset'];
                }
            } else {
                // ID is empty or something went wrong
                echo "<script>
                window.location = 'inventory.php?session=$id';
                </script>";
            }
            ?>
            <form class="update-item-form" action="update-item-process.php?session=<?php echo $_GET['session'] ?>&ItemID=<?php echo $_GET['ItemID'] ?>" method="post">
                <label for="update-name">Item Name</label>
                <input type="text" id="update-name" name="item_name" placeholder="Enter a Name" value="<?php echo $name; ?>" maxlength="25">

                <label for="update-quantity">Quantity</label>
                <input type="number" id="update-quantity" name="item_quantity" step="1" value="<?php echo $quantity; ?>" min="1" max="999">

                <input type="submit" value="Update">
            </form>
        </div>
    </body>
</html>

<?php
include('../footer.php');
?>