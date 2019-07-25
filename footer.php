<html>
    <head>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="../styling/universal.css">
        <link rel="stylesheet" href="../styling/footer.css">
    </head>
    <body>
    <br>
    <hr>
        <div class="footer">
            <div class="resize">
                <button onclick="resizeText('-1');">-</button>
                <span>Resize Content</span>
                <button onclick="resizeText('1');">+</button>
            </div>
            <img src="../styling/Images/logoblack.png" alt="logo-bw" width="30px" height="30px">
            <p><b>Hak Cipta | Kelab i-CreatorZ, SMJK Chung Ling</b></p>
        </div>

        <script type="text/javascript">
            function resizeText(factor) {
                if(document.body.style.fontSize == "") {

                    document.body.style.fontSize = "1.0em";
                }
                document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (factor * 0.2) + "em";
            }
        </script>
    </body>
</html>