<?php
    include_once 'header.php';
    include 'includes/dbh.inc.php';
?>

<?php
    if (!isset($_SESSION["adminsid"])) {
        header("location: index.php");
    }
?>
</head>
<body>
    <div class="body-wraper">
    <div class="adminPanel">
        <h1 align="center">Create Admin</h1>
        <form action="/admin_includes/signup.admin.inc.php" method="post">
            <label>Username:</label>
            <input type="text" name="adminUid" placeholder="Kiser.Ethan">
            <label>Password:</label>
            <input type="password" name="pwd" placeholder="Password">
            <label>Confirm Password:</label>
            <input type="password" name="pwdrepeat" placeholder="Confirm Password">
            <button type="submit" name="submit">submit</button>
        </form>
    </div>

    <div class="adminPanel">
        <h1 align="center">List Items</h1>
        <form action="/list_includes/list.inc.php" method="post" enctype="multipart/form-data">
        <label>Image:</label>
            <input type="file" name="file">
            <label>Title:</label>
            <input type="text" name="title" placeholder="Carbon Brush Set">
            <label>Quanity:</label>
            <input type="text" name="productquanity" placeholder="10">
            <label>Part #:</label>
            <input type="text" name="partNo" placeholder="22-22-2222">
            <label>Price 1:</label>
            <input type="text" name="price1" placeholder="12.99">
            <label>Price 2:</label>
            <input type="text" name="price2" placeholder="14.99">
            <label>Description:</label>
            <input type="text" name="descpription" placeholder="Describe...">
            <button type="submit" name="submit">List</button>
        </form>
    </div>

    <div class="adminPanel" style="overflow: scroll;">
        <h1 align="center">Manage Listings</h1>
        <form method="post" action="edit.php">
    <?php
    $stmt = $conn->prepare("SELECT itemPartNumber FROM shop");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
    ?>
        <div>
            <h4 name="part"><?php echo $row["itemPartNumber"]; ?></h4>
            <button type="submit" name="delete" value="<?php echo $row["itemPartNumber"]; ?>">X</button>
        </div>
        <br><hr><br>
    <?php endwhile; ?>
</form>

    </div>
  <!--  <div class="adminPanel">
        <h1 align="center">Announcements</h1>
        
    </div>

    <div class="adminPanel">
        <h1 align="center">Manage Announcements</h1>
        
    </div>  -->

    <div class="adminPanel">
        <h1 align="center">Manage Admin</h1>
    </div>

   <!-- <div class="adminPanel">
        <h1 align="center">Customer Account Manager</h1>
        
    </div> -->
    </div>
</body>
<?php
    include_once 'footer.php';