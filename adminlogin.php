<?php
    include_once ('header.php');
?>
<body>
    
<center>
    <div class="signin-box">
        <h1>Login as Admin</h1>
                                   

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



        <form action="admin_includes/login.admin.inc.php" method="post">
            <label>Username:</label>
            <input type="text" name="adminUid" placeholder="Username">
            <label>Password:</label>
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">submit</button>
        </form>
    </div>
    </center>
<?php
    include_once 'footer.php';