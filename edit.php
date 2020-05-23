<?php
    ob_start();
    session_start();
    $dbhost = "pondja.com";
    $dbuser = "pondjaco_srinagarindhospital";
    $dbpass = "8jp2eAuz";
    $dbdatabase = "pondjaco_srinagarindhospital";
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbdatabase);
    mysqli_set_charset($conn, 'utf8');

    if(! $conn ) {
        die('Could not connect: ' . mysqli_error($conn));
    }
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>

<head>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/popper.min.js"></script>
</head>

<body>
    <?php
    $_SESSION['type'] = "new";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $q = "SELECT * FROM `database` WHERE id = '$id'";
        $r = mysqli_query($conn, $q);
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        $_SESSION['type'] = "edit";
        $_SESSION['submit_id'] = $id;
    }

    ?>

    <div class="container">
        <h1 class="text-center display-1">Bin Location</h1>
        <?php if (isset($_GET['id'])) { ?><h1 class="text-center">Currently Edit <b>ID <?php echo $row['id'];?></b></h1><?php } ?>
        <hr>
        <form method="GET" action="save.php">
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend mb-3">
                    <span class="input-group-text" id="addon-wrapping">Barcode</span>
                </div>
                <input type="text" class="form-control" placeholder="Item Barcode" aria-label="Barcode"
                    aria-describedby="addon-wrapping" name="barcode" id="barcode" <?php if (isset($_GET['id'])) echo 'value="' . $row['barcode'] . '"' ?>>
            </div>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend mb-3">
                    <span class="input-group-text" id="addon-wrapping">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Item Name" aria-label="Name"
                    aria-describedby="addon-wrapping" name="name" id="name" <?php if (isset($_GET['id'])) echo 'value="' . $row['name'] . '"' ?>>
            </div>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping">Location</span>
                </div>
                <input type="text" class="form-control" placeholder="Item Location" aria-label="Location"
                    aria-describedby="addon-wrapping" name="location" id="location" <?php if (isset($_GET['id'])) echo 'value="' . $row['loc'] . '"' ?>>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="./#" class="btn btn-warning">Cancel</a>
            <?php if (isset($_GET['id'])) { ?><a href="save.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a><?php } ?>
        </form>
    </div>
</body>

</html>