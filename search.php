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
        width: 650px;
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
            <h2>Search user for : <?= $_GET['q'] ?></h2>
            <div class="card-block" style="background:#15181C;color:white;">
            <ul class="list-unstyled">
                <?php
                //menampilkan user selain kita
                $q_memberu = mysqli_query($koneksi,"SELECT*from member WHERE name LIKE '%$_GET[q]%'");
                while($memberuData = mysqli_fetch_array($q_memberu))
                {
                ?>
                <li>
                    <img src="imgs/<?= $memberuData['img'] ?>" class="img-rounded">
                    <div class="info">
                        <strong><?= $memberuData['name'] ?></strong>
                        <br>
                        <button class="btn btn default" style="background:#1DA1F2;">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:white;"></span> Follow
                        </button>
                    </div>
                </li>
                <hr>
                <?php } ?>
            </ul>
                </div>
        </div>
    </div>

    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
</html>