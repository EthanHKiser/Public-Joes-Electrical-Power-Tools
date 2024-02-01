 <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 100px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            width: 100%;
        }

        .order-list {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .order-list li {
            border-bottom: 1px solid #eee;
        }

        .order-list li:last-child {
            border-bottom: none;
        }

        .order-list li a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .order-list li a:hover {
            background-color: #f0f0f0;
        }

        .edit-profile-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin: 20px;
            transition: background-color 0.3s ease;
        }

        .edit-profile-button:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container"><br><br><br><br>
    <a href="profile.php"><button class="edit-profile-button">Back</button></a>
    <ul class="order-list">
    <center><h2>All orders are in date format</h2>
<p>results closest to the top are the most resent purchases.</p></center>
<?php

session_start();
include 'includes/dbh.inc.php';

// Initialize an empty array to store the distinct orders
$distinctOrders = [];

check1($conn);

function check1($conn) {
    $userId = $_SESSION['userid']; // Store the user ID in a variable

    $sql = "SELECT DISTINCT orderId FROM orders WHERE userId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $userId); // Bind the user ID as an integer
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $distinctOrders[] = $row["orderId"]; // Add each distinct orderId to the array
    }

    mysqli_stmt_close($stmt);

    check2($conn, $distinctOrders); // Pass the array of distinct orders to check2
}

function check2($conn, $distinctOrders) {
    // Reverse the array of distinct order IDs
    $distinctOrders = array_reverse($distinctOrders);

    // Now you can work with the reversed array of distinct order IDs
    foreach ($distinctOrders as $orderId) {

        $sql = "SELECT MAX(orderId) as orderId FROM orders2 WHERE orderId = ?";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../parts.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $orderId); // Bind the order ID as a string
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);

        echo '<ul class="order-list">'; // Start an unordered list with a CSS class
        while ($row = mysqli_fetch_assoc($result)) {
            $distinctOrders2[] = $row["orderId"]; // Add each distinct orderId to the array
            // Display each order ID as a clickable link
            echo '<li><a href="order_details.php?orderId=' . $row["orderId"] . '">' . $row["orderId"] . '</a></li>';
        }
        echo '</ul>'; // Close the unordered list
    
        mysqli_stmt_close($stmt);
    }
}


?>

</ul>
</div>