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
                <span>i-CreatorZ Inventory System</span>
            </div>
            <div class="subtitle-text">
                <span>
                    Logged in as: 
                    <?php
                    require_once('../dbcon.php');

                    $session = $_GET['session'];
                    $sql = "SELECT UserName FROM users WHERE UserID = '$session'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<b>".$row['UserName']."</b>";
                        }
                    } else {
                        // user accessed the site without logging in / session was invalid
                        echo "<script>
                        window.alert('Invalid Session');
                        window.location = '../login.php';
                        </script>";
                    }
                    ?>
                </span>
            </div>
            <br>
            <ul class="navbar">
                <li><a href="../main/main.php?session=<?php echo $_GET['session']; ?>">Main Page</a></li>
                <li><a href="../main/inventory.php?session=<?php echo $_GET['session']; ?>">Inventory</a></li>
                <li><a href="../main/import.php?session=<?php echo $_GET['session']; ?>">Import Data</a></li>
                <li><a href="../main/report.php?session=<?php echo $_GET['session']; ?>">Report Item</a></li>
                <li style="float: right"><a href="../login.php">Logout</a></li>
            </ul>
        </div>
    </body>
</html>