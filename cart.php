<?php
    include 'header.php';
    include 'includes/dbh.inc.php';

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "removed") {
            echo "<script>alert('Item removed from cart!');</script>";
        }
    }
?>

<head>
    <style>
       .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        input[type="number"] {
    padding: 5px;
    margin-right: 10px;
    font-size: 14px;
    font-family: Arial, sans-serif;
    color: #333;
    width: 150px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

input[type="number"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px #007bff;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    appearance: none;
    -webkit-appearance: none;
    margin: 0;
}

.x {
    background-color: RGB(220, 20, 60);
    border: none;
    color: white;
    padding: 10px;
    font-size: 15px;
}

.x:hover {
    background-color: rgb(229, 0, 0);
}

.quan {
    background-color: rgb(2, 61, 134);
    border: none;
    color: white;
    padding: 10px;
    font-size: 15px;
}

.quan:hover {
    background-color: rgb(229, 0, 0);
}

form {
    border: none;
    display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
}

.pay-now-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pay-now-button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <center>
        <div class="container table-responsive">
            <h1 style="text-align: center; font-size: 50px;">Cart</h1>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Part Num.</th>
                    <th>Quantity</th>
                    <th>Remove Item</th>
                </tr>
                <?php
$sql = "SELECT title, price, img, quantity, quantity2, partNum FROM cart WHERE userId = " . $_SESSION['userid'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$totalPrice = 0;
$Ship = 5;
$rate = 0.0445;
$tax1 = 0;
$tax2 = $Ship * $rate;

while ($row = $result->fetch_assoc()) {
    $price = $row["price"];
    $quantity = $row["quantity"];
    $Price = $price * $quantity;
    $_SESSION["quantity"] = $quantity;
    $_SESSION["title"] = $row["title"];
    $_SESSION["partNum"] = $row["partNum"];

    $totalPrice += $Price;

    // Add the current item's price to the total
    // Display table rows
    echo '<tr><td><img src="' . $row["img"] . '" style="width: 150px; height: 150px;" alt="Image"></td>';
    echo "<td><p id='name'>". $row["title"] ."</p></td>";
    echo "<td><p id='price'>". number_format($Price, 2) ."</p></td>";
    echo "<td>". $row["partNum"] ."</td>";
    echo '<td>
    <form style="border: none;" action="cartFunctions.php" method="post">
        <input type="number" name="quantity" value="' . $row["quantity"] . '" min="1" max="' . $row['quantity2'] . '" oninput="validity.valid||(value=\'1\');" required>
        <input type="hidden" name="partNum" value="' . $row["partNum"] . '">
        <button name="update_quantity" class="quan">Update</button>
    </form>
    </td>';
    echo '<td>
    <form style="border: none;" action="cartFunctions.php" method="post">
        <input type="hidden" name="partNum" value="' . $row["partNum"] . '">
        <button class="x" name="remove_item">Remove</button>
    </form>
    </td>';
    $_SESSION["total"] = $totalPrice;
    $_SESSION["part"] = $row["partNum"];
}
echo "</table>";

echo '<form action="shipping.php"><div style="float: left; margin: 30px;"><h2>Subtotal: $' . number_format($totalPrice, 2) . '</h2><br>';
echo '<button class="pay-now-button" type="submit" method="post" name="pay">Pay Now</button></form>';
} else {
    echo "<tr><td colspan='6'>Cart Empty</td></tr>";
    echo "</table>";
}

$conn->close();
?>
        </div>
    </center>
    <script src="server/server.js"></script>
</body>
<?php
    include_once 'footer.php';