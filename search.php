<?php
include 'header.php';
include 'includes/dbh.inc.php';
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

        /* Styles for product cards */
        .card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: 300px;
            display: inline-block;
            text-align: center;
        }

        .shopBtn {
    border: none;
    background-color: white;
    padding: 10px;
    background-color: rgb(229, 0, 0);
    color: white;
}

.shopBtn:hover {
    background-color: rgb(2, 61, 134);
}
    </style>
</head>

<div class="shop">
    <center>
    <form action="search.php" method="POST">
        <input type="text" name="search" placeholder="Search...">
        <button class="button" type="submit" name="submit-search">Search</button>
    </form>

    <div class="product-container">
        <?php
        if (isset($_POST["submit-search"])) {
            $search = mysqli_real_escape_string($conn, $_POST["search"]);
            $sql = "SELECT * FROM shop WHERE itemTitle LIKE '%$search%' OR itemPartNumber LIKE '%$search%'";

            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            if ($queryResult > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
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
                                <input type="hidden" name="part" value="<?= $row['itemPartNumber']; ?>">
                                <h4>Part #: <?= $row['itemPartNumber']; ?></h4>
                                <br>
                                <input type="hidden" name="quantity" value="<?= $row['itemQuanity']; ?>">
                                <h4 class="card-text">Quantity: <?= $row['itemQuanity']; $quantity = $row['itemQuanity']; ?></h4>
                                <br>
                                <strong>
                                    $
                                    <?php
                                    if (isset($_SESSION["useruid"])) {
                                        $row = number_format($row['itemPrice1'], 2);
                                    } elseif (isset($_SESSION["adminsid"])) {
                                        $row = number_format($row['itemPrice1'], 2);
                                    } else {
                                        $row = number_format($row['itemPrice2'], 2);
                                    }
                                    echo $row;
                                    ?>
                                    <input type="hidden" name="price" value="<?= $row ?>">
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
                                    </a>
                </div>
                    <?php
                }
            } else {
                echo '0 Results!';
            }
        }
        ?>
        </center>
    </div>
</div>
