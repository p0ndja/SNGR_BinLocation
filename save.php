<?php
ob_start();
session_start();
$dbhost="pondja.com";
$dbuser="pondjaco_srinagarindhospital";
$dbpass="8jp2eAuz";
$dbdatabase="pondjaco_srinagarindhospital";
$conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
mysqli_set_charset($conn, 'utf8');

if( ! $conn) {
    die('Could not connect: '. mysqli_error($conn));
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q = "DELETE FROM `database` WHERE id = $id";
    $result_final=mysqli_query($conn, $q);
    if ( !$result_final) die('Could not post '.mysqli_error($conn));
} else {
    date_default_timezone_set('Asia/Bangkok');
    $date=date('Y-m-d H:i:s', time());
    $name=$_GET['name'];
    $barcode=$_GET['barcode'];
    $loc=$_GET['location'];

    if ($_SESSION["type"]=="new") {
        $q="INSERT INTO `database` (name, barcode, loc, time) VALUES ('$name', '$barcode', '$loc', '$date')";
        $result_final=mysqli_query($conn, $q);
        if ( !$result_final) die('Could not post '.mysqli_error($conn));
    }

    else {
        $sub=$_SESSION['submit_id'];
        $q="UPDATE `database` SET name = '$name', barcode = '$barcode', loc = '$loc', time = '$date' WHERE id = $sub";
        $result_final=mysqli_query($conn, $q);
        if ( !$result_final) die('Could not post '.mysqli_error($conn));
    }
}

header("Location: ./#");
?>