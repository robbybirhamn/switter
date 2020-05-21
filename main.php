<?php 
session_start(); 

//cek apakah sudah login
if(empty($_SESSION['user_login']))
{
    echo "<script>document.location.href='index.php'</script>";
}

//include koneksi
include "koneksi.php";

$userId = $_SESSION['user_login'];

//cek user login
$q_userData = mysqli_query($koneksi,"SELECT*from member WHERE id='$userId'");
$userData = mysqli_fetch_array($q_userData);
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
    <script src="js/jquery-1.11.3.js"></script>
</head>
<body>
    <!------------ Navigation Bar ------------>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">
                    <span style="color:#1DA1F2;font-weight:bold;" class="glyphicon glyphicon-chevron-right"></span>
                    <span style="color:#1DA1F2;font-weight:bold;">SWITTER</span>
                </a>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <button id="tweet" class="btn btn-default pull-right visible-xs-block">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        Tweet
                </button>
            </div>

            <div id="nav-menu" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                Beranda
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php
                            $qtot_pesan_user = mysqli_query($koneksi,"SELECT * from tweet WHERE user_id='$userId'");
                            $jml_pesan_user = mysqli_num_rows($qtot_pesan_user);
                            ?>
                            <span class="badge"><?= $jml_pesan_user ?></span>
                            <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
                                Notifikasi
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php
                            $qtot_pesan = mysqli_query($koneksi,"SELECT * from tweet");
                            $jml_pesan = mysqli_num_rows($qtot_pesan);
                            ?>
                            <span class="badge"><?= $jml_pesan ?></span>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                Pesan
                        </a>
                    </li>
                    <li class="visible-xs-inline">
                        <a href="#">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Profile
                        </a>
                    </li>
                    <li class="visible-xs-inline">
                        <a href="logout.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true" ></span>
                             Keluar
                        </a>
                    </li>
                </ul>

                <button id="tweet" class="btn btn-default pull-right hidden-xs">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        Tweet
                </button>

                <!------------- Options Button Dropdown  ------------->
                <div id="nav-options" class="btn-group pull-right hidden-xs">
                    <button type="button" class="btn btn-default dropdown-toggle thumbnail" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="imgs/<?= $userData['img'] ?>" alt="bos 01">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Pengaturan</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Keluar</a></li>
                    </ul>
                </div>

                <form id="search" role="search" action="search.php" method="GET" class="hidden-sm">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="search here..">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div id="profile-resume" class="card" style="border-color:#15181C;">
                    <a href="#"><img class="card-img-top img-responsive" src="imgs/landscape.jpg"></a>
                    <div class="card-block" style="background:#15181C;color:white;">
                    <img src="imgs/<?= $userData['img'] ?>" class="card-img">
                    <h4 class="card-title"><?= $userData['name'] ?> <small><?= $userData['email'] ?></small></h4>
                    <p class="card-text"><?= $userData['biodata'] ?></p>
                    <ul class="list-inline list-unstyled">
                        <li id="card-tweets">
                        <a href="#">
                        <span class="profile-stats">Tweet</span>
                        <span class="profile-value"><?= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from tweet WHERE user_id='$userId'")) ?></span>
                        </a>
                        </li>
                        <li id="card=following">
                        <a href="#">
                        <span class="profile-stats">Following</span>
                        <span class="profile-value"><?= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from member WHERE id!='$userId'")) ?></span>
                        </a>
                        </li>
                        <li id="card=followers">
                        <a href="#">
                        <span class="profile-stats">Followers</span>
                        <span class="profile-value"><?= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from member WHERE id!='$userId'")) ?></span>
                        </a>
                        </li>
                    </ul>
                    </div>
                    </div>

                    <div id="profile-photo" class="card" style="border-color:#15181C;">
                    <div class="card-header" style="border-color:#15181C;background:#15181C;color:white;">Dokumen Foto</div>
                    <div class="card-block" style="background:#15181C;color:white;">
                    <ul class="list-inline list-unstyled">
                        <?php
                        //galeri user login
                        $q_galeri = mysqli_query($koneksi,"SELECT*from galeri WHERE user_id='$userId'");
                        while($galeriData = mysqli_fetch_array($q_galeri))
                        {
                        ?>
                        <li>
                            <a href="imgs/<?= $galeriData['img'] ?>" class="thumbnail"><img class="img-responsive" src="imgs/<?= $galeriData['img'] ?>"></a>
                        </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb card" style="background:#15181C;color:white;border-color:#15181C;">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Profil</a></li>
                    <li class="active">Feed</li>
                </ol>

                <div id="main-card" class="card" style="border-color:#15181C;">
                    <?php
                    if(isset($_POST['tweet']))
                    {
                        $tweet = $_POST['tweet'];
                        //insert tweet to database
                        mysqli_query($koneksi,"INSERT into tweet (user_id,tweet)values('$userId','$tweet')");
                    }
                    ?>
                    <form id="new-message" method="POST" action="" style="background:#15181C;color:white;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="tweet" placeholder="Tweet your ideas . . .">
                            <span class="input-group-addon" type="button" data-toggle="modal" data-target="#exampleModal">
                                <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                            </span>
                        </div>
                    </form>
                    
                    <ul id="feed" class="list-unstyled" style="background:#15181C;color:white;border-color:#15181C;">
                        <?php
                        //menampilkan seluruh tweet terbaru
                        $q_tweet = mysqli_query($koneksi,"SELECT*,tweet.id as twid from tweet JOIN member ON member.id=tweet.user_id WHERE upid=0 ORDER BY time DESC");
                        while($tweetData = mysqli_fetch_array($q_tweet)){
                            $q_reptweet = mysqli_query($koneksi,"SELECT*,tweet.id as tw from tweet JOIN member ON member.id=tweet.user_id WHERE upid=$tweetData[twid] ORDER BY time DESC");
                            $jum = mysqli_num_rows($q_reptweet);
                        ?>
                        <li style="border-color:#000;">
                            <img src="imgs/<?= $tweetData['img'] ?>" class="feed-avatar img-circle">
                            <div class="feed-post">
                                <h5><?= $tweetData['name'] ?> <small>@<?= $tweetData['username'] ?></small></h5>
                                <p><?= $tweetData['tweet'] ?></p>
                            </div>
                            <div class="action-list">
                                <a href="#" type="button" class="replyTweet" data-id="<?= $tweetData['twid']; ?>">
                                    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                                    <span class="retweet-count"><?= $jum ?></span>
                                </a>
                                <a href="#">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                </a>
                                <a href="#">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                            </div>
                        </li>
                        <?php 
                            while($repData = mysqli_fetch_array($q_reptweet)){
                                ?>
                                <li style="border-color:#000;margin-left:50px;">
                                    <img src="imgs/<?= $repData['img'] ?>" class="feed-avatar img-circle">
                                    <div class="feed-post">
                                        <h5><?= $repData['name'] ?> <small>@<?= $repData['username'] ?></small></h5>
                                        <p><?= $repData['tweet'] ?></p>
                                    </div>
                                    <div class="action-list">
                                        <a href="#" type="button" class="replyTweet" data-id="<?= $repData['tw']; ?>">
                                            <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                                        </a>
                                        <a href="#">
                                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                            <span class="retweet-count">6</span>
                                        </a>
                                        <a href="#">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            }
                        } ?>

                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div id="who-follow" class="card" style="border:none">
                    <div class="card-header" style="background:#15181C;color:white;">
                        On Radar
                    </div>
                    <div class="card-block" style="background:#15181C;color:white;">
                        <ul class="list-unstyled">
                            <?php
                            //menampilkan user selain kita
                            $q_memberu = mysqli_query($koneksi,"SELECT*from member WHERE id != '$userId'");
                            while($memberuData = mysqli_fetch_array($q_memberu))
                            {
                            ?>
                            <li>
                                <img src="imgs/<?= $memberuData['img'] ?>" class="img-rounded">
                                <div class="info">
                                    <strong><?= $memberuData['name'] ?></strong>
                                    <button class="btn btn default" style="background:#1DA1F2;">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:white;"></span> Follow
                                    </button>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div id="app-info" class="card" style="background:#15181C;color:white;border:none;">
                    <div class="card-block">
                        @2020 Switter - Stikubank Twitter
                        <ul class="list-unstyled list-inline">
                            <li><a href="tentang_kami.html">Tentang Kami</a></li>
                            <li><a href="kebijakan.html">Kebijakan dan Privasi</a></li>
                            <li><a href="bantuan.html">Bantuan</a></li>
                            <li><a href="#">Status</a></li>
                            <li><a href="#">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="card-footer" style="background:#15181C;color:white;">
                        <a href="#">Switter &copy; 2019</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload your image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    <input type="file" name="image" class="form-control">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply this tweet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="reply_tweet.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" class="form-control" name="upid" id="idTweet">
                <input type="text" name="tweet" class="form-control" id="user_id" placeholder="reply this tweet">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".replyTweet", function () {
            var idTweet = $(this).data('id');
            $("#idTweet").val( idTweet );
            $('#replyModal').modal('show');
        });
    </script>

    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
</html>