<?php


session_start();
include 'includes/dbh.inc.php';
//
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function generateUniqueRandomString($length = 10, $existingStrings = []) {
    do {
        // Generate a random string
        $randomString = generateRandomString($length);
    } while (in_array($randomString, $existingStrings));

    return $randomString;
}

// Example usage to generate a unique random string of 16 characters
$existingStrings = []; // Initialize an array to store existing strings
$randomString = generateUniqueRandomString(16, $existingStrings);

// Add the generated string to the list of existing strings
$existingStrings[] = $randomString;

//


//$sql = "SELECT title, price, img, quantity, quantity2, partNum FROM orders WHERE userId = " . $_SESSION['userid'];
//$result = $conn->query($sql);
//Charge ID: " . $charge->

$totalPrice1 = $_SESSION["total"];
$totalPrice = $_SESSION["final"];

$totalPrice2 = round($totalPrice, 2); // Round to 2 decimal places
$newTotal = $totalPrice2 * 100;

require_once('stripe-php-12.5.0/init.php'); // Use the correct path to your Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_51NtwoLAALAHoRMAoBU1RLaIEv2CIsZnMFtcnPn7wKOO4moxSg7E5HHMGlhEAOTCocvHRFWMlbpMqvrpy8Ip5Br8C00Ja29MomP');

// Get the token from the form
$token = $_POST['stripeToken'];

// Create a charge
try {
  $charge = \Stripe\Charge::create([
    'amount' => $newTotal, // Amount in cents
    'currency' => 'usd',
    'description' => 'Example Charge',
    'source' => $token,
  ]);

  $sql = "SELECT title, price, img, quantity, quantity2, partNum FROM cart WHERE userId = " . $_SESSION['userid'];
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Payment successful, you can handle success logic here
    // Insert each item in the cart into the "orders" table
    while ($row = $result->fetch_assoc()) {
      $id = $_SESSION["userid"];
      $title = $row["title"];
      $part = $row["partNum"];
      $street = $_SESSION["street"];
      $apt = $_SESSION["apt"];
      $city = $_SESSION["city"];
      $state = $_SESSION["state"];
      $zip = $_SESSION["zip"];
      $quantity = $row["quantity"];
      $total = $_SESSION["total"];
      $tax = $_SESSION['tax'];
      $totalPrice2 = $_SESSION["final"];

      orders($conn, $id, $title, $part, $street, $apt, $city, $state, $zip, $quantity, $randomString);
      orders2($conn, $randomString, $total, $tax, $totalPrice2);
      $orderedItemTitles[] = $title;
      quantity($conn);
  }
  
  // Clear the cart after all items are successfully added to the "orders" table
  clearCart($_SESSION["userid"], $conn);
  
  // Convert the array of ordered item titles to a comma-separated string
  $orderedItemTitlesString = implode('<br><br>', $orderedItemTitles);
  
  // Output success message
  echo '<style>html, body {margin: 20px;padding: 0;font-family: Arial, sans-serif;text-align: center;}hr {width: 40%;}button {height: 50px;width: 100px;border: none;border-radius: 5px;background-color: white;padding: 10px;background-color: rgb(229, 0, 0);color: white;font-size: x-large;}button:hover {background-color: rgb(2, 61, 134);}</style><img src="https://static.vecteezy.com/system/resources/thumbnails/017/350/123/small/green-check-mark-icon-in-round-shape-design-png.png" alt=""><h1>Payment successful!</h1><br><hr><br><h3>Order Id: ' . $randomString .'</h3><h3>Subtotal: $ ' . $_SESSION["total"] .'</h3><h3>Shipping and Handling: $ 10</h3><h3>Tax: $ ' . $_SESSION['tax'] .'</h3><h3>Total: $ ' . $totalPrice2 . '</h3><br><hr><br> <h3>' . $orderedItemTitlesString . '</h3>';
  
  // Display order details, if needed

}
echo '<a href="index.php"><button>Return</button></a>';
} catch (\Stripe\Exception\CardException $e) {
  echo '<style>html, body {margin: 20px;padding: 0;font-family: Arial, sans-serif;text-align: center;}button {height: 50px;width: 100px;border: none;border-radius: 5px;background-color: white;padding: 10px;background-color: rgb(229, 0, 0);color: white;font-size: x-large;}button:hover {background-color: rgb(2, 61, 134);}</style><img src="data:image/png;base64,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" alt=""><h1>Payment Failed!</h1> Error: ' . $e->getError()->message . '<a href="index.php"><button>Return</button></a>';
}

// clear cart
function clearCart($id, $conn) {
  $sql = "DELETE FROM cart WHERE userId = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../parts.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

// Add to orders table

function orders($conn, $id, $title, $part, $street, $apt, $city, $state, $zip, $quantity, $randomString) {
  $purchaseDate = date("Y-m-d H:i:s"); // Get the current date and time
  $sql = "INSERT INTO orders (userId, title, partNum, purchaseDate, street, apt, city, state, zip, quantity, orderId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../parts.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "issssssssis", $id, $title, $part, $purchaseDate, $street, $apt, $city, $state, $zip, $quantity, $randomString);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

}
function orders2($conn, $randomString, $total, $tax, $totalPrice2){
  $sql = "INSERT INTO orders2 (orderId, subtotal, tax, total) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../parts.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $randomString, $total, $tax, $totalPrice2);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function quantity($conn) {

  $PQ = $_SESSION["quantity"];
  $part = $_SESSION["part"];

  if (isset($_SESSION["useruid"])) {
      $updateSql = "UPDATE shop SET itemQuanity = itemQuanity - ? WHERE itemPartNumber = ?";
  }

  $updateStmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($updateStmt, $updateSql)) {
      header("location: ../parts.php?error=stmtfailed");
      exit();
  }

  mysqli_stmt_bind_param($updateStmt, "is", $PQ, $part);
  mysqli_stmt_execute($updateStmt);
  mysqli_stmt_close($updateStmt);
}


?>

<head>
  <title>Payed</title>
  <link rel="shortcut icon" href="jlogo.jpg">
</head>