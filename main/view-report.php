<?php
require_once('banner.php');
?>

<?php
require_once('../dbcon.php');

$rid = $_GET['ReportID'];

$sql = "SELECT * FROM damage WHERE ReportID = '$rid'";
$result = mysqli_query($con, $sql);

if($result) {
    while($row = $result->fetch_assoc()) {
        $title = $row['ReportTitle'];
        $desc = $row['ReportDesc'];
        $quantity = $row['DamageQuantity'];
        $uid = $row['ReportedBy'];
    }
} else {
    echo "<script>
    window.alert('Report not found.');
    window.history.back();
    </script>";
}

function getUser($con, $uid) {
    $sql = "SELECT UserName FROM users WHERE UserID = '$uid'";
    $result = mysqli_query($con, $sql);

    if($result) {
        while($row = $result->fetch_assoc()) {
            return $row['UserName'];
        }
    } else {
        // failed to find username
        return "User reported not found.";
    }
}

?>

<html>
    <head>
        <title>View Report | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="../styling/view-report.css">
    </head>
    <body>
        <div class="page-content">
            <h2>Inventory > View Report</h2>
            <table class="report-table">
                <tr>
                    <th>Report Title</th>
                    <td><?php echo $title; ?></td>
                </tr>
                <tr>
                    <th>Reported By</th>
                    <td><?php getUser($con, $uid); ?></td>
                </tr>
                <tr>
                    <th>Report Description</th>
                    <td><?php echo $desc; ?></td>
                </tr>
                <tr>
                    <th>Affected Item</th>
                    <td>lalala</td>
                </tr>
                <tr>
                    <th>Affected Amount</th>
                    <td><?php echo $quantity; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>

<?php
require_once('footer.html');
?>