<?php
session_start();
require_once 'includes/dbh.inc.php';

if (isset($_POST["delete"])) {
    $partNo = $_POST["delete"]; // Use the button value as the part number

    delete($conn, $partNo);
}

function delete($conn, $partNo) {
    $sql = "DELETE FROM shop WHERE itemPartNumber = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: adminedit.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $partNo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: adminedit.php");
}

//

?>

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

<?php
if (isset($_POST["edit"])) {
    require_once 'includes/dbh.inc.php';


    // Get the itemPartNumber from the form submission
    $itemPartNumber = $_POST["edit"];

    $sql = "SELECT * FROM shop WHERE itemPartNumber = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $itemPartNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $image = $row["itemImage"];
            $title = $row["itemTitle"];
            $quantity = $row["itemQuanity"];
            $part = $row["itemPartNumber"];
            $price1 = $row["itemPrice1"];
            $price2 = $row["itemPrice2"];

            // Form within the loop
            ?>
            <form action="update.php" method="post">
                <h1>Edit Listing</h1>
                <label for="image">Image:</label>
                <input type="file" name="file"><br>
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?= $title ?>">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" value="<?= $quantity ?>">
                <label for="part">Part Number:</label>
                <input type="text" name="part" value="<?= $part ?>">
                <label for="1">Price 1:</label>
                <input type="text" name="1" value="<?= $price1 ?>">
                <label for="2">Price 2:</label>
                <input type="text" name="2" value="<?= $price2 ?>">
                <button type="submit" name="updateList">Update</button><br><br>
            </form>
            <?php
        }

        $stmt->close();
    } else {
        echo "Error in preparing SQL statement: " . $conn->error;
    }
} else {
    echo "No itemPartNumber specified";
}
?>