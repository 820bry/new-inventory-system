<html>
    <head>
        <title>Log Masuk | Sistem Pengurusan Peralatan Bilik i-CreatorZ</title>
        <link rel="icon" href="./styling/Images/logotransparent.png">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="./styling/universal.css">
        <link rel="stylesheet" href="./styling/index.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="./scripts/login.js"></script>
    </head>

    <body class="page-body">
        <center class="page-content">
            <img src="./styling/Images/logoblack.png" alt="logo-bw" width="50px" height="50px">
            <h3>Sistem Pengurusan Peralatan Bilik i-CreatorZ</h3>
            
            <div class="login-content show">
                <form class="login-form" action="login-action.php" method="post">
                    <label for="login-id">ID Sekolah</label>
                    <input type="text" id="login-id" name="student_id" placeholder="ID">
                    
                    <label for="login-pw">Kata Laluan</label>
                    <input type="password" id="login-pw" name="password" placeholder="Kata Laluan">
                    <br>
                    <br>
                    <br>
                    <input type="submit" value="Log Masuk">
                </form>
                <center>
                    <a href="javascript:;" onclick="onRegisterLinkPressed();" style="font-size: 18px;">
                        Tekan Sini Untuk Daftar Sebagai Pengguna Baru
                    </a>
                </center>
            </div>
            <div class="register-content">
                <form class="register-form" action="register-action.php" method="post">
                    <label for="register-name">Masukkan Nama Anda</label>
                    <input type="text" id="register-name" name="student_name" placeholder="Nama" maxlength="25">

                    <label for="register-id">Masukkan ID Sekolah Anda</label>
                    <input type="text" id="register-id" name="student_id" placeholder="ID Sekolah" maxlength="5">

                    <label for="register-pw">Masukkan Kata Laluan</label>
                    <input type="password" id="register-pw" name="password" placeholder="Kata Laluan" maxlength="20">

                    <label for="register-pw-confirm">Sahkan Kata Laluan Anda</label>
                    <input type="password" id="register-pw-confirm" name="password_confirm" placeholder="Sahkan Kata Laluan" maxlength="20">

                    <input type="submit" value="Daftar Pengguna Baru">
                </form>
                <center>
                    <a href="javascript:;" onclick="onLoginLinkPressed();" style="font-size: 18px">
                        Tekan Sini Untuk Log Masuk
                    </a>
                </center>
            </div>
            <footer class="page-footer">
                <center><b>Hak Cipta | Kelab i-CreatorZ, SMJK Chung Ling</b></center>
            </footer>
        </center>
    </body>
</html>