<?php
    include_once 'header.php';
?>
    <style>
        .signup-box{
            width: 380px;
            height: 640px;
            margin: 25px;
            background-color: white;
            border-radius: 3px;
            padding: 15px;
        }

        .signup-box h1{
            text-align: center;
            padding-top: 15px;
        }

        .signup-box h4{
            text-align: center;
            padding-top: 10px;
        }

        .signup-box form{
            width: 300px;
            margin-left: 20px;
        }

        .signup-box form label{
            display: flex;
            margin-top: 20px;
            font-size: 18px;
        }

        .signup-box form input{
            width: 100%;
            padding: 7px;
            border: none;
            border: 1px solid gray;
            border-radius: 6px;
            outline: none;
        }

        .signup-box form button{
            width: 100%;
            height: 35px;
            margin-top: 20px;
            border: none;
            background-color: rgb(229, 0, 0);
            color: white;
            font-size: 15px;
            font-weight: 600;
            
        }

        .signup-box form button:hover{
            transition: ease .3s;
            background-color: rgb(2, 61, 134);
            color: white;
        }

        .signup-box p{
            text-align: center;
            padding: 15px;
            font-size: 15px;
        }

        .signup-box h3{
            text-align: center;
            color: red;
        }

        .signup-box h2{
            text-align: center;
            color: green;
        }
    </style>
</head>
    <center>
    <div class="signup-box">
        <h1>Sign Up</h1>
        <h4>It's free and only takes a minute of your time to unlock the best deals and user experience on this website!</h4>
        <form action="includes/signup.inc.php" method="post">
            <label>Email:</label>
            <input type="text" name="email" placeholder="example@example.com">
            <label>First Name:</label>
            <input type="text" name="uid" placeholder="Joe">
            <label>Password:</label>
            <input type="password" name="pwd" placeholder="Password">
            <label>Confirm Password:</label>
            <input type="password" name="pwdrepeat" placeholder="Confirm Password">
            <button type="submit" name="submit">submit</button>
        </form>
        <p>By clicking the submit button, you agree to obey the terms of use of this website.</p>
        <p>Already have an account? <a href="signin.php">Login here</a></p>
                        

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<h3>Fill in all fields!</h3>";
                }
                else if ($_GET["error"] == "invaliduid") {
                    echo "<h3>Choose a proper name!</h3>";
                }
                else if ($_GET["error"] == "invalidemail") {
                    echo "<h3>Choose a proper email!</h3>";
                }
                else if ($_GET["error"] == "stmtfailed") {
                    echo "<h3>Somthing went wrong, please try again.</h3>";
                }
                else if ($_GET["error"] == "emailtaken") {
                    echo "<h3>Email already exists!</h3>";
                }
                else if ($_GET["error"] == "passwordsdontmatch") {
                    echo "<h3>Passwords don't match!</h3>";
                }
                else if ($_GET["error"] == "none") {
                    echo "<h2>Success!</h2>";
                }
            }
        ?>




    </div>
    </center>

<?php
    include_once 'footer.php';