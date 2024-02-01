<?php

session_start();
include 'includes/dbh.inc.php';

?>

<html>
    <head>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 50px;
        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007BFF;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
        </style>
    </head>
    <body>
        <form action="update.php" method="post">
        <?php
            $sql = "SELECT usersEmail, usersUid FROM users WHERE usersId = " . $_SESSION['userid'];
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $name = $row["usersUid"];
                $email = $row["usersEmail"];
            }  
        ?>
        <h1>Edit Profile</h1>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= $name ?>">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?= $email ?>">
        <button type="submit" name="submit">Update</button><br><br>
        <button type="submit" name="delete" style="background-color: red;">Delete Acount</button>
        </form>
    </body>
</html>