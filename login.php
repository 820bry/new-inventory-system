<html>
    <head>
        <title>Login | Inventory System</title>
        <link rel="icon" href="./styling/Images/logotransparent.png">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="./styling/universal.css">
        <link rel="stylesheet" href="./styling/login.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="./scripts/login.js"></script>
    </head>

    <body class="page-body">
        <div class="page-background"></div>
        <div class="page-content">
            <img src="./styling/Images/logoblack.png" alt="logo-bw" width="50px" height="50px">
            <h2>New Inventory System</h2>
            
            <div class="login-content show">
                <form class="login-form" action="login-action.php" method="post">
                    <label for="login-id">Student ID</label>
                    <input type="text" id="login-id" name="student_id" placeholder="ID">
                    
                    <label for="login-pw">Password</label>
                    <input type="password" id="login-pw" name="password" placeholder="Password">
                    <br>
                    <br>
                    <br>
                    <input type="submit" value="Login">
                </form>
                <center>
                    <a href="javascript:;" onclick="onRegisterLinkPressed();" style="font-size: 18px;">
                        Click Here To Register
                    </a>
                </center>
            </div>
            <div class="register-content">
                <form class="register-form" action="register-action.php" method="post">
                    <label for="register-name">Enter your Name</label>
                    <input type="text" id="register-name" name="student_name" placeholder="Your Name" maxlength="25">

                    <label for="register-id">Enter your Student ID</label>
                    <input type="text" id="register-id" name="student_id" placeholder="Student ID" maxlength="5">

                    <label for="register-pw">Enter a Password</label>
                    <input type="password" id="register-pw" name="password" placeholder="Password" maxlength="20">

                    <label for="register-pw-confirm">Confirm your Password</label>
                    <input type="password" id="register-pw-confirm" name="password_confirm" placeholder="Confirm password" maxlength="20">

                    <input type="submit" value="Register">
                </form>
                <center>
                    <a href="javascript:;" onclick="onLoginLinkPressed();" style="font-size: 18px">
                        Click Here To Login
                    </a>
                </center>
            </div>
            <footer class="page-footer">
                <center><b>Copyright(C) i-CreatorZ Club | Chung Ling High School Penang</b></center>
            </footer>
        </div>
    </body>
</html>