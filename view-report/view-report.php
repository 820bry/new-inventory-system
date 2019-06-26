<?php
include('../banner.php');
?>

<?php
require_once('../dbcon.php');

$rid = $_GET['ReportID'];

$sql = "SELECT * FROM kerosakan WHERE IDLaporan = '$rid'";
$result = mysqli_query($con, $sql);

if($result) {
    while($row = $result->fetch_assoc()) {
        $title = $row['TajukLaporan'];
        $desc = $row['Keterangan'];
        $quantity = $row['BilRosak'];
        $itemid = $row['AsetRosak'];
        $uid = $row['DilaporOleh'];
    }
} else {
    echo "<script>
    window.alert('Report not found.');
    window.history.back();
    </script>";
}

function getUser($con, $uid) {
    $sql = "SELECT Nama FROM pengguna WHERE IDPengguna = '$uid'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) != 0) {
        while($row = $result->fetch_assoc()) {
            return $row['Nama'];
        }
    } else {
        // Pengguna tidak wujud
        return "User reported not found.";
    }
}

function getItemName($con, $itemid) {
    $sql = "SELECT NamaAset FROM peralatan WHERE IDAset = '$itemid'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) != 0) {
        while($row = $result->fetch_assoc()) {
            return $row['NamaAset'];
        }
    } else {
        return "Item not found.";
    }
}

?>

<html>
    <head>
        <title>Laporan Aset | Sistem Pengurusan Peralatan Bilik i-CreatorZ</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/main.css">
        <link rel="stylesheet" href="view-report.css">
    </head>
    <body>
        <div class="page-content">
            <a href="../inventory/inventory.php?session=<?php echo $_GET['session']; ?>">Kembali ke Halaman Inventori</a>
            <div id="report-data">
                <h2>Inventori > Laporan Aset</h2>
                <table class="report-table">
                    <tr>
                        <th>Tajuk Laporan</th>
                        <td><?php echo $title; ?></td>
                    </tr>
                    <tr>
                        <th>Dilaporkan Oleh</th>
                        <td><?php echo getUser($con, $uid)." [ ".$uid." ]"; ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan Laporan</th>
                        <td><?php echo $desc; ?> </td>
                    </tr>
                    <tr>
                        <th>Aset Terjejas</th>
                        <td><?php echo getItemName($con, $itemid)." [ ".$itemid." ] "; ?></td>
                    </tr>
                    <tr>
                        <th>Bilangan Terjejas</th>
                        <td><?php echo $quantity; ?></td>
                    </tr>
                </table>
            </div>
            <br>
            <button class="btn-print" id="btn-print">Mencetak Laporan</button>
        </div>
    </body>
    <script>
        var button = document.getElementById("btn-print");

        button.onclick = function() {
            var restorepage = $('body').html();
            var printcontent = $('#report-data').clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
</html>

<?php
include('../footer.php');
?>