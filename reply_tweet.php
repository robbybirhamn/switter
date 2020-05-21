<?php
session_start();
include "koneksi.php";
$userId = $_SESSION['user_login'];
$upid = $_POST['upid'];
$tweet = $_POST['tweet'];
mysqli_query($koneksi,"INSERT into tweet (upid,user_id,tweet) values ('$upid','$userId','$tweet')");
echo "<script>document.location.href='main.php';</script>";
?>