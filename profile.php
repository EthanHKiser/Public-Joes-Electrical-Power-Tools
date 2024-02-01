<?php
session_start();
include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007BFF;
            margin: 0 auto 20px;
        }

        .profile-info {
            margin-top: 20px;
        }

        .profile-info h1 {
            font-size: 28px;
            margin: 0;
        }

        .profile-info p {
            font-size: 16px;
            margin: 5px 0;
            color: #333;
        }

        .edit-profile-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .edit-profile-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body><br><br>
    <div class="profile-container">
        <div class="profile-info">
            <?php
                $sql = "SELECT usersEmail, usersUid FROM users WHERE usersId = " . $_SESSION['userid'];
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $name = $row["usersUid"];
                    $email = $row["usersEmail"];
                }   
            ?>
            <h1><?php echo $name; ?></h1><br>
            <p><?php echo $email; ?></p><br>
            <a href="profileEdit.php"><button class="edit-profile-button">Edit Profile</button></a><br>
            <a href="purchaseHistory.php"><button class="edit-profile-button">Purchase History</button></a><br>
            <a href="index.php"><button class="edit-profile-button">Home</button></a>
        </div>
    </div>
</body>
</html>

