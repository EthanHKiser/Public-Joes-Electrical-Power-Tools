<?php

session_start();
include 'includes/dbh.inc.php';

$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;
data($conn, $orderId);

function data($conn, $orderId) {

    $sql = "SELECT * FROM orders2 WHERE orderId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $orderId); // Bind the user ID as an integer
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $sub = $row["subtotal"]; 
        $tax = $row["tax"]; 
        $total = $row["total"]; 
    }

    mysqli_stmt_close($stmt);

    // break

    $sql = "SELECT * FROM orders WHERE orderId = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../parts.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $orderId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$titlesArray = []; // Initialize an array to store titles

while ($row = mysqli_fetch_assoc($result)) {
    $date = $row["purchaseDate"];
    $titlesArray[] = $row["title"]; // Assuming the column name is "title"
}

mysqli_stmt_close($stmt);


display($total, $tax, $sub, $orderId, $date, $titlesArray);
}

function display($total, $tax, $sub, $orderId, $date, $titlesArray) {
    echo '<style>html, body {margin: 20px;padding: 0;font-family: Arial, sans-serif;text-align: center;}hr {width: 40%;}button {height: 50px;width: 100px;border: none;border-radius: 5px;background-color: white;padding: 10px;background-color: rgb(229, 0, 0);color: white;font-size: x-large;}button:hover {background-color: rgb(2, 61, 134);}</style><img src="https://static.vecteezy.com/system/resources/thumbnails/017/350/123/small/green-check-mark-icon-in-round-shape-design-png.png" alt=""><h1> Success!</h1><br><hr><br><h3>Order Id: ' . $orderId.'</h3><h3>Subtotal: $ ' . $sub .'</h3><h3>Shipping and Handling: $ 10</h3><h3>Tax: $ ' . $tax .'</h3><h3>Total: $ ' . $total . '</h3><br><hr><br>';
        echo '<ul>';
    foreach ($titlesArray as $title) {
        echo '<br><li>' . $title . '</li>';
    }
    echo '<br  ><a href="purchaseHistory.php"><button>Return</button></a>';
    echo '</ul>';
}