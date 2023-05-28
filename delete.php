<?php
include 'index.php';

$id = $_GET['deleteid'];

$sq = "select * from  user where id='$id'";
$result = mysqli_query($connt, $sq);
if ($result && mysqli_num_rows($result) == 1) {
    $sql = "delete from user where id='$id'";
    $res = mysqli_query($connt, $sql);
    header('location:shows.php');
} else {
    header('location:shows.php');
}
