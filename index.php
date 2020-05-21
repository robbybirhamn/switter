<?php 
session_start(); 
//include koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switter - Stikubank Twitter</title>

    <link rel="shortcut icon" href="twitter.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <style>
        .bgcontent-box {
        background:#15181C;
        border-radius:5px;
        color:white;
            
        }

        .content-box {
        width: 350px;
        margin: 0% auto;
        padding:15px 10px;
        }
        @media only screen and (max-width: 650px) {
        .content-box {
            width: 500px;
        }
        }

        @media only screen and (max-width: 500px) {
        .content-box {
            width: 400px;
        }
        }

        @media only screen and (max-width: 400px) {
        .content-box {
            width: 300px;
        }
        }
        </style>
</head>
<body>
    
    <div class="container">
        <div class="content-box bgcontent-box">
            <?php

            //cek apakah sudah login
            if(isset($_SESSION['user_login']))
            {
                echo "<script>document.location.href='main.php'</script>";
            }

            //proses login

            //cek jika mendapat inputan
            if(isset($_POST['login']))
            {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                
                //query check username dan password
                $q_cek = mysqli_query($koneksi,"SELECT*from member WHERE username='$username' AND password='$password'");
                $cekData = mysqli_fetch_array($q_cek);
                
                //cek data jika tidak kosong
                if($cekData != NULL)
                {
                    //masukkan session
                    $_SESSION['user_login'] = $cekData['id'];
                    echo "<script>document.location.href='main.php'</script>";
                }else{
                    echo "<script>alert('USER TIDAK DITEMUKAN');</script>";
                }
            }
            ?>  
            <form action="" method="POST" id="firstForm" novalidate="novalidate">
            <center>
                <img src="twitter.ico" alt="">
                <h4 style="font-weight:bold;">SELAMAT DATANG</h4>
            </center>
            <div class="row">
                <div class="col-md-12"> 
                    <label for="nohp">username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="username" required="">
                    <br>
                    <label for="nohp">password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="password" required="">
                    <br>
                    <button name="login" value="ya" class="btn btn-success form-control" style="background:#1DA1F2;">MASUK</button>
                    <br>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
</html>