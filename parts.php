<?php
include_once 'header.php';
include 'includes/dbh.inc.php';

if (isset($_GET["error"])) {
    if ($_GET["error"] == "productincart") {
        echo "<script>alert('Product already added to cart!');</script>";
    }
}
?>
<head>
    <style>
        input {
            padding: 0px 20px;
            width: 400px;
            height: 40px;
            font-size: 22px;
            margin: 20px;
        }

        .button {
            width: 100px;
            height: 44px;
            font-size: 22px;
            margin: 20px;
            border: none;
    background-color: white;
    background-color: rgb(229, 0, 0);
    color: white;
        }

        .button:hover {
            background-color: rgb(2, 61, 134);
        }
    </style>
</head>
<body>
    <center>
    <div class="shop">
    <form action="search.php" method="POST">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit" name="submit-search" class="button">Search</button>
    </form>
        <?php
        if (isset($_SESSION["useruid"])) {
        } else {
            echo '<h3 style="color: red;">*You are currently shopping as a guest! For the best user experience and pricing, sign in.</h3>';
        }
        ?>
        <div class="row">
            <?php
            $stmt = $conn->prepare("SELECT * FROM shop");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()):
                if ($row['itemQuanity'] > 0):
            ?>
            <div class="col-sm-6 col-md-4">
            <a style="text-decoration: none;" href="item_info.php?image=<?= $row['itemImage']; ?>&title=<?= $row['itemTitle']; ?>&description=<?= $row['description']; ?>&part=<?= $row['itemPartNumber']; ?>&quantity=<?= $row['itemQuanity']; ?>&price=<?= isset($_SESSION["useruid"]) ? $row['itemPrice1'] : $row['itemPrice2']; ?>" class="card-link">
    <div class="card">
        <div class="thumbnail">
            <?php
            if (isset($_SESSION["useruid"])) {
                echo '<form action="cart_includes/cart.inc.php" method="POST" class="form-submit">';
            } else {
                echo '<form action="shipping.php" method="POST" class="form-submit">';
            }
            ?>
            <input type="hidden" name="image" value="<?= $row['itemImage']; ?>">
            <img src="<?= $row['itemImage']; ?>" alt="Image" class="card-img-top">
            <br>
            <div class="caption">
                <input type="hidden" name="title" value="<?= $row['itemTitle']; ?>">
                <h2><?= $row['itemTitle']; ?></h2>
                <br>
                <input type="hidden" name="descpition" value="<?= $row['description']; ?>">
                <h2 style="display: none;"><?= $row['description']; ?></h2>
                <br>
                <input type="hidden" name="part" value="<?= $row['itemPartNumber']; ?>">
                <h4>Part #: <?= $row['itemPartNumber']; ?></h4>
                <br>
                <input type="hidden" name="quantity" value="<?= $row['itemQuanity']; ?>">
                <h4 class="card-text">Quantity: <?= $row['itemQuanity']; $quantity = $row['itemQuanity']; ?></h4>
                <br>
                <strong>
                    $
                    <?php
                    $price = isset($_SESSION["useruid"]) ? $row['itemPrice1'] : $row['itemPrice2'];
                    echo number_format($price, 2);
                    ?>
                    <input type="hidden" name="price" value="<?= $price ?>">
                </strong>
                <p>
                    <br>
                    <div class="col-sm-6 col-md-6">
                        <?php
                        if (isset($_SESSION["userid"])) {
                            echo '<button class="shopBtn" type="submit" name="submit">Add to Cart</button>';
                        } else {
                            echo '<button class="shopBtn" type="submit" name="submit">Purchase</button>';
                        }
                        ?>
                    </div>
                </p>
            </div>
            </form>
        </div>
    </div>
</a>
            </div>
            <?php
            endif;
         endwhile; 
         ?>
        </div>
    </div>
    </center>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</body>

<?php
include_once 'footer.php';
