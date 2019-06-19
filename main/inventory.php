<?php
require_once('banner.php');
?>
<html>
    <head>
        <title>Inventory | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="../styling/inventory.css">
    </head>
    <body>
        <div id="popup-window" class="add-item-window">
            <div class="add-item-content">
                <span class="btn-close">&times;</span>
                <h2>Add New Item into Inventory</h2>
                <form class="add-item-form" action="add-item-process.php?session=<?php echo $_GET['session']; ?>" method="post">
                    <label for="add-name">Enter a name</label>
                    <input type="text" id="add-name" name="item_name" placeholder="Item Name" maxlength="25">

                    <label for="add-quantity">Enter the quantity</label>
                    <input type="number" id="add-quantity" name="item_quantity" step="1" value="1" min="1" max="999">

                    <input type="submit" value="Add Item">
                </form>
            </div>
        </div>
    
        <div class="page-content">
            <h2>Inventory</h2>
            <input type="text" id="search-bar" name="search_bar" class="search" placeholder="Enter Search Term">
            <button id ="btn-search" class="btn-search" onclick="search()">&#128270</button>
            <button id="btn-add" class="btn-add">Add Item</button>
            <table class="inventory-listing">
                <?php
                require_once('../dbcon.php');

                echo "
                    <tr>
                        <th width=\"8%\">Item ID</th>
                        <th width=\"25%\">Name</th>
                        <th width=\"5%\">Quantity</th>
                        <th width=\"25%\">Reports</th>
                        <th width=\"15%\">Registered By</th>
                        <th width=\"10%\">Added On</th>
                        <th width=\"10%\">Manage</th>
                    </tr>";

                $sql = "SELECT * FROM inventory";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) >= 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>".$row['ItemID']."</td>
                            <td>".$row['ItemName']."</td>
                            <td>".$row['ItemQuantity']."</td>
                            <td><ul class=\"report-data\">";
                            getReports($con, $row['ItemID']);
                            echo "</ul></td>
                            <td>".getUsername($row['UserRegistered'], $con)."</td>
                            <td>".$row['DateRegistered']."</td>
                            <td>
                                <button onclick=\"window.location = 'update.php?session=".$_GET['session']."&ItemID=".$row['ItemID']."'\"'>Update Item</button>
                                <button onclick=\"confirmDelete('".$row['ItemID']."');\">Delete Item</button>
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

                function getReports($con, $id) {
                    $sql = "SELECT * FROM damage WHERE DamageItem = '$id'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li><a href=\"view-report.php?session=".$_GET['session']."&ReportID=".$row['ReportID']."\">".$row['ReportTitle']."</li>";
                        }
                    } else {
                        // no reports
                        echo "No reports.";
                    }
                }
                ?>
            </table>
            
        </div>
    </body>
    <script src="../scripts/inventory.js"></script>
    <script>
        function confirmDelete(id) {
            if(confirm("Are you sure you want to delete this item?")) {
                window.location = 'del-item-process.php?session=<?php echo $_GET['session'] ?>&ItemID=' + id;
            } else {
                // do nothing
            }
        }

        function search() {
            var query = document.getElementById("search-bar").value;

            if(query === "") {
                window.alert('Please type a search query!');
            } else {
                window.location = 'search.php?session=<?php echo $_GET['session']; ?>&query='+query;
            }
        }
    </script>
</html>

<?php
require_once('footer.html');
?>