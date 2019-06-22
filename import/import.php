<?php
include('../banner.php');
?>
<html>
    <head>
        <title>Import Data | Sistem Pengurusan Peralatan Bilik i-CreatorZ</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="import.css">
    </head>
    <body>
        <div class="page-content">
            <h2>Mengimport Data Dari Jadual Luar Ke Dalam Inventori</h2>
            <p>Anda boleh mengimport data dari jadual fail CSV ke dalam inventori.</p>

            <form class="import-data-form" action="import-process.php?session=<?php echo $_GET['session']; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="import_file"><br>
                <input type="submit" value="Import Data">
            </form>
        </div>
    </body>
</html>
<?php
include('../footer.php');
?>