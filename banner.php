<html>
    <head>
        <link rel="icon" href="../styling/Images/logotransparent.png">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/universal.css">
        <link rel="stylesheet" href="../styling/banner.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <div class="banner-content">
            <div class="title">
                <img src="../styling/Images/logoblack.png" alt="logo-bw" width="50px" height="50px">
                <span>Sistem Pengurusan Peralatan @ Bilik i-CreatorZ</span>
            </div>
            <div class="subtitle-text">
                <span>
                    Log Masuk Sebagai: 
                    <?php
                    require_once('dbcon.php');

                    $session = $_GET['session'];
                    $sql = "SELECT Nama FROM pengguna WHERE IDPengguna = '$session'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<b>".$row['Nama']."</b>";
                        }
                    } else {
                        // user accessed the site without logging in / session was invalid
                        echo "<script>
                        window.alert('Invalid Session');
                        window.location = '../index.php';
                        </script>";
                    }
                    ?>
                </span>
            </div>
            <br>
            <ul class="navbar">
                <li><a href="../main/main.php?session=<?php echo $_GET['session']; ?>">Halaman Utama</a></li>
                <li><a href="../inventory/inventory.php?session=<?php echo $_GET['session']; ?>">Inventori</a></li>
                <li><a href="../import/import.php?session=<?php echo $_GET['session']; ?>">Import Data</a></li>
                <li><a href="../report/report.php?session=<?php echo $_GET['session']; ?>">Lapor Masalah Aset</a></li>
                <li style="float: right"><a href="../index.php">Log Keluar</a></li>
            </ul>
        </div>
    </body>
</html>