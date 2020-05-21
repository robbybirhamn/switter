<?php
session_start();
include "koneksi.php";
$userId = $_SESSION['user_login'];

$target_dir = "imgs/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

    $name = 'images';
    $img = basename($_FILES["image"]["name"]);
    mysqli_query($koneksi,"INSERT into galeri (user_id,name,img) values ('$userId','$name','$img')");
}
echo "<script>document.location.href='main.php';alert='images has been uploaded'</script>";
?>