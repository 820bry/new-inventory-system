<?php
require_once('banner.php');
?>
<html>
    <head>
        <title>Import Data | New Inventory System</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="../styling/import.css">
    </head>
    <body>
        <div class="page-content">
            <h2>Import External Table Data Into Inventory</h2>
            <p>You can import an external CSV table data into the inventory system.</p>

            <form class="import-data-form" action="import-process.php?session=<?php echo $_GET['session']; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="import_file"><br>
                <input type="submit" value="Import Data">
            </form>
        </div>
    </body>
</html>
<?php
require_once('footer.html');
?>