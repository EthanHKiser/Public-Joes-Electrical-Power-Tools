<?php
$image = $_GET['image'];
$title = $_GET['title'];
$description = $_GET['description']; // Include the description parameter
$part = $_GET['part'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Item Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .item-info {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }

    img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
    }

    h4 {
      color: #666;
      margin-bottom: 8px;
    }

    strong {
      color: #e44d26;
      font-size: 18px;
      display: block;
      margin-top: 20px;
    }
  </style>

</head>
<body>
<a href="parts.php">
    <button style=" background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            margin: 20px;
            transition: background-color 0.3s ease;">Return</button>
</a>
  <div class="item-info">
    <img src="<?= $image; ?>" alt="Image" class="card-img-top">
    <h2><?= $title; ?></h2>
    <h4>Description: <?= $description; ?></h4> <!-- Display the description -->
    <h4>Part #: <?= $part; ?></h4>
    <h4 class="card-text">Quantity: <?= $quantity; ?></h4>
    <strong>$<?= number_format($price, 2); ?></strong>
  </div>

</body>
</html>
