<?php
    include_once 'header.php';
?>

<style>
</style>
</head>
<body>
<center>
    <div class="signin-box">
        <h1>Login</h1>
                                   

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<h3>Fill in all fields!</h3>";
                }
                else if ($_GET["error"] == "wronglogin") {
                    echo "<h3>Incorrect Login!</h3>";
                }
            }
        ?>



        <form action="includes/login.inc.php" method="post">
            <label>Email:</label>
            <input type="text" name="email" placeholder="example@example.com">
            <label>Password:</label>
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">submit</button>
        </form>
        <p>Don't already have an account? <a href="signup.php">Sign up here</a></p>
        <a href="adminlogin.php">
        <button class="adminbtn">
        <span class="material-symbols-outlined">
shield_person
</span>
        </button>
        </a>
    </div>
    </center>

    <div class="filler"></div>
<?php
    include_once 'footer.php';