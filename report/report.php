<?php
include('../banner.php');
?>

<html>
    <head>
        <title>Report Damage | Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="report.css">
    </head>
    <body>
        <div class="page-content">
            <h2>Inventory > Report Item</h2>
            <form class="report-item-form" action="report-item-process.php?session=<?php echo $_GET['session'];?>" method="post">
                <label for="dropdown">Select affected item</label><br>
                <select name="dropdown" id="dropdown" onchange="update()">
                    <option value="null" style="color: lightgray;" disabled selected>-- Select an item --</option>
                    <?php
                    require_once('../dbcon.php');

                    $sql = "SELECT DISTINCT NamaAset, IDAset, BilAset FROM peralatan";
                    $result = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_row($result)) {
                        echo "<option data-name='$row[0]' data-quantity='$row[2]' value='$row[1]'> $row[0] </option>";
                    }
                    ?>
                </select>
                <br>
                <br>
                <hr>
                <br>
                <div class="form-section disabled">
                    <label for="report-name">Report Title</label>
                    <input type="text" id="report-name" name="report_title" placeholder="Enter a title for this report" maxlength="20">
                    <span class="mini-text" id="char-count-1">20/20</span><br><br>

                    <label for="report-desc">Description</label>
                    <textarea id="report-desc" name="report_desc" placeholder="Enter a description" maxlength="200" rows="3" cols="45"></textarea>
                    <span class="mini-text" id="char-count-2">200/200</span><br><br>

                    <label for="report-quantity">Amount affected</label><br>
                    <input type="number" id="report-quantity" name="report_quantity" step="1" value="1" min="1"><br>

                    <input type="submit" value="Submit Report"><br>
                </div>
            </form>
        </div>
    </body>
    <script src="../scripts/report.js"></script>
</html>

<?php
include('../footer.php');
?>