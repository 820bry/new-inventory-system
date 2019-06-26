<?php
include('../banner.php');
?>
<html>
    <head>
        <title>Inventori | Sistem Pengurusan Peralatan Bilik i-CreatorZ</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="inventory.css">
    </head>
    <body>
        <div id="popup-window" class="add-item-window">
            <div class="add-item-content">
                <span class="btn-close">&times;</span>
                <h2>Daftar Aset Baru</h2>
                <form class="add-item-form" action="add-item-process.php?session=<?php echo $_GET['session']; ?>" method="post">
                    <label for="add-name">Masukkan Nama Aset</label>
                    <input type="text" id="add-name" name="item_name" placeholder="Nama Aset" maxlength="25">

                    <label for="add-quantity">Masukkan Bilangan Aset</label>
                    <input type="number" id="add-quantity" name="item_quantity" step="1" value="1" min="1" max="999">

                    <input type="submit" value="Daftar Aset">
                </form>
            </div>
        </div>
    
        <div class="page-content">
            <h2>Inventori</h2>
            <input type="text" id="search-bar" name="search_bar" class="search" placeholder="Cari Aset">
            <button id ="btn-search" class="btn-search" onclick="search()">&#128270</button>
            <button id="btn-add" class="btn-add">Daftar Aset</button>
            <table class="inventory-listing">
                <?php
                require_once('../dbcon.php');

                echo "
                    <tr>
                        <th width=\"8%\">ID Aset</th>
                        <th width=\"25%\">Nama</th>
                        <th width=\"8%\">Bilangan</th>
                        <th width=\"25%\">Laporan & Masalah Aset</th>
                        <th width=\"15%\">Didaftar Oleh</th>
                        <th width=\"10%\">Didaftar Pada</th>
                        <th width=\"10%\">Urusan</th>
                    </tr>";

                $sql = "SELECT * FROM peralatan";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) >= 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>".$row['IDAset']."</td>
                            <td>".$row['NamaAset']."</td>
                            <td>".$row['BilAset']."</td>
                            <td><ul class=\"report-data\">";
                            getReports($con, $row['IDAset']);
                            echo "</ul></td>
                            <td>".getUsername($row['DidaftarOleh'], $con)."</td>
                            <td>".$row['DidaftarPada']."</td>
                            <td>
                                <button onclick=\"window.location = 'update.php?session=".$_GET['session']."&ItemID=".$row['IDAset']."'\"'>Kemaskini</button>
                                <button onclick=\"confirmDelete('".$row['IDAset']."');\">Hapus Aset</button>
                            </td>
                        <tr>";
                    }
                } else {
                    echo "Terdapat Masalah Semasa Mengambil Data Inventori";
                }

                function getUsername($id, $con) {
                    $sql = "SELECT Nama FROM pengguna WHERE IDPengguna = '$id'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            return $row['Nama'];
                        }
                    } else {
                        return "Pengguna Tidak Wujud";
                    }
                }

                function getReports($con, $id) {
                    $sql = "SELECT * FROM kerosakan WHERE AsetRosak = '$id'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li><a href=\"../view-report/view-report.php?session=".$_GET['session']."&ReportID=".$row['IDLaporan']."\">".$row['TajukLaporan']."</li>";
                        }
                    } else {
                        // Tiada laporan
                        echo "Tiada Laporan atau Masalah.";
                    }
                }
                ?>
            </table>
            
        </div>
    </body>
    <script src="inventory.js"></script>
    <script>
        function confirmDelete(id) {
            if(confirm("Adakah anda pasti hendak menghapuskan semua rekod aset ini?")) {
                window.location = 'del-item-process.php?session=<?php echo $_GET['session'] ?>&ItemID=' + id;
            } else {
                // Tidak perlu buat apa-apa
            }
        }

        function search() {
            var query = document.getElementById("search-bar").value;

            if(query === "" || query.trim().length == 0) {
                window.alert('Sila masukkan kata pencarian!');
            } else {
                window.location = 'search.php?session=<?php echo $_GET['session']; ?>&query='+query;
            }
        }
    </script>
</html>

<?php
include('../footer.php');
?>