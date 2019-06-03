<?php
require_once('banner.php');
?>

<html>
    <head>
        <title>Inventory | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="../styling/inventory.css">
        <!-- Scripts -->

    </head>
    <body>
        <div class="page-content">
            <h2>Inventory</h2>
            <button class="btn-add" onclick="window.location.href = 'add-asset.php?session=<?php echo $_GET['session']; ?>';">Add Item</button>
            <table class="inventory-listing">
                <?php
                require_once('../dbcon.php');

                $sql = "SELECT * FROM inventory";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) > 0) {
                    echo "
                    <tr>
                        <th width=\"8%\">Item ID</th>
                        <th width=\"40%\">Name</th>
                        <th width=\"5%\">Quantity</th>
                        <th>Registered By</th>
                        <th width=\"10%\">Added On</th>
                        <th width=\"10%\">Manage</th>
                    </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>".$row['ItemID']."</td>
                            <td>".$row['ItemName']."</td>
                            <td>".$row['ItemQuantity']."</td>
                            <td>".getUsername($row['UserRegistered'], $con)."</td>
                            <td>".$row['DateRegistered']."</td>
                            <td>
                                <a href=\"https://google.com\">Update Data</a><br>
                                <a href=\"https://bing.com\">Delete Item</a>
                            </td>
                        <tr>";
                    }
                } else {
                    echo "Error in fetching inventory data";
                }

                function getUsername($id, $con) {
                    $sql = "SELECT UserName FROM users WHERE UserID = '$id'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            return $row['UserName'];
                        }
                    } else {
                        return "Invalid Username";
                    }
                }
                ?>
            </table>
        </div>
    </body>
</html>

<?php
require_once('footer.html');
?>