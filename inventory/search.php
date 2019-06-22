<?php
include('../banner.php');

$query = $_GET['query'];

if(!isset($_GET['query']) || empty($query)) {
    echo "<script>window.location = 'inventory.php?session=".$_GET['session']."';</script>";
}
?>

<html>
    <head>
        <title>Hasil carian untuk '<?php echo $query; ?>' | Sistem Pengurusan Peralatan Bilik i-CreatorZ</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="inventory.css">
    </head>
    <body>
        <div class="page-content">
            <a href="inventory.php?session=<?php echo $_GET['session']; ?>">Kembali ke Halaman Inventori</a>
            <h2>Hasil carian untuk '<?php echo $query; ?>' </h2>
            <input type="text" id="search-bar" name="search_bar" class="search" placeholder="Cari Aset" value="<?php echo $query; ?>">
            <button id ="btn-search" class="btn-search" onclick="search()">&#128270</button><br><br><br>
            <table class="inventory-listing">
            <?php
                require_once('../dbcon.php');

                $sql =  "SELECT * FROM peralatan WHERE NamaAset LIKE '%$query%'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) != 0) {
                    echo "
                    <tr>
                        <th width=\"8%\">ID Aset</th>
                        <th width=\"25%\">Nama</th>
                        <th width=\"5%\">Bilangan</th>
                        <th width=\"25%\">Laporan & Masalah Aset</th>
                        <th width=\"15%\">Didaftar Oleh</th>
                        <th width=\"10%\">Didaftar Pada</th>
                        <th width=\"10%\">Urusan</th>
                    </tr>";
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
                    echo "<b>Tiada keputusan sepada.</b>";
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
                            echo "<li><a href=\"view-report.php?session=".$_GET['session']."&ReportID=".$row['IDLaporan']."\">".$row['TajukLaporan']."</li>";
                        }
                    } else {
                        // no reports
                        echo "Tiada Laporan atau Masalah.";
                    }
                }
                ?>
            </table>
        </div>
    </body>
    <script>
        function confirmDelete(id) {
            if(confirm("Adakah anda pasti hendak menghapuskan semua rekod aset ini?")) {
                window.location = 'del-item-process.php?session=<?php echo $_GET['session'] ?>&ItemID=' + id;
            } else {
                // do nothing
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