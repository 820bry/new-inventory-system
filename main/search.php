<?php
require_once('banner.php');

$query = $_GET['query'];

if(!isset($_GET['query']) || empty($query)) {
    echo "<script>window.location = 'inventory.php?session=".$_GET['session']."';</script>";
}
?>

<html>
    <head>
        <title>Results for '<?php echo $query; ?>' | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="../styling/inventory.css">
    </head>
    <body>
        <div class="page-content">
            <a href="inventory.php?session=<?php echo $_GET['session']; ?>">Go back to inventory</a>
            <h2>Search results for '<?php echo $query; ?>' </h2>
            <input type="text" id="search-bar" name="search_bar" class="search" placeholder="Enter Search Term" value="<?php echo $query; ?>">
            <button id ="btn-search" class="btn-search" onclick="search()">&#128270</button><br><br><br>
            <table class="inventory-listing">
            <?php
                require_once('../dbcon.php');

                $sql =  "SELECT * FROM inventory WHERE ItemName LIKE '%$query%'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) != 0) {
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
                    echo "No results.";
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
    <script>
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