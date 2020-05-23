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
    $item_per_page = 25;
    $current_page = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $current_page = $_GET['page'];
    }

    $start_id = ($current_page - 1) * $item_per_page;

    $q = "SELECT * FROM `database` limit {$start_id}, {$item_per_page}";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (is_numeric($id)) {
            $q = "SELECT * FROM `database` WHERE barcode = '$id' limit {$start_id}, {$item_per_page}";
        } else {
            $q = "SELECT * FROM `database` WHERE name LIKE '%$id%' limit {$start_id}, {$item_per_page}";
        }
    } else {
    }

    $r = mysqli_query($conn, $q);
    ?>

    <div class="container">
        <h1 class="text-center display-1">Bin Location</h1>
        <form method="GET">
            <input type="search" class="form-control form-control-lg" placeholder="Insert Barcode ID or Item Name..."
                name="id" value="<?php if (isset($_GET['id'])) echo $_GET['id'];?>">
        </form>
        <table class="table table-lg table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Location</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { ?>
                <tr>
                    <th scope="row"><?php echo '<a href="edit.php?id=' . $row['id'] . '">' . $row['id'] . '</a>'; ?></th>
                    <td><?php echo $row['name'] . ' (' . $row['barcode'] . ') '; ?></td>
                    <td><?php echo $row['loc']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="edit.php" class="btn btn-success">Add New Item</a>
    </div>
</body>

</html>