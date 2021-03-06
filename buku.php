<?php
error_reporting(0);
session_start();
include 'fungsi.php';
if ($_SESSION[tipe] == 'Dosen' or $_SESSION[tipe] == 'Mahasiswa' OR $_SESSION[tipe] == 'Admin') {
    $page = 'view_buku.vanray';
    $dataperpage = query("select a.idbuku, a.nama, a.pengarang, b.cover,b.tahun, b.sinapsis,b.kodebuku,b.status,b.penerbit from buku_detail b left join buku a on a.idbuku=b.idbuku where a.idkategori='1' order by a.idbuku DESC");
    $numpage = mysql_num_rows($dataperpage);
    $start = $_GET['start'];
    $eu = $start - 0;
    $limit = 16;
    $thisp = $eu + $limit;
    $back = $eu - $limit;
    $next = $eu + $limit;
    if (strlen($start) > 0 && !is_numeric($start)) {
        echo 'Data Error';
        exit();
    }

    connect();
    $bu = query("select a.idbuku, a.nama, a.pengarang, b.cover,b.tahun, b.sinapsis,b.kodebuku,b.status,b.penerbit from buku_detail b left join buku a on a.idbuku=b.idbuku where a.idkategori='1' order by a.idbuku DESC limit $eu,$limit");
    $lala = mysql_num_rows($bu);
    ?>
    <!DOCTYPE html>
    <html 
        <head>
            <title><?php echo $_SESSION[tipe] ?> || Lihat Buku</title>
            <?php include 'style.php'; ?>
            <link rel="stylesheet" type="text/css" href="asset/material/css/materialize.css" media="screen,projection">
            <style>
                .panco-nav {
                    font-size: 16px;
                    text-transform: uppercase;
                    font-family: "immi", sans-serif;
                }

                xm {
                    font-size: 13px;
                }

                .aka {
                    width: 45px;
                    padding-top: 5px;
                    margin-right: 5PX;
                }

                .se {
                    position: absolute;
                    display: initial;
                    width: 535px;
                }

                .ll {
                    padding-left: 5px;
                    padding-right: 5px;
                }
                .profil {
                    padding: 4px 4px 4px 4px;
                }
                @media only screen and (max-width: 992px){
                    .se {
                        display: none;

                    }
                }
                @media only screen and (max-width: 1158px){
                    .se {
                        font-size: 14px ;

                    }
                }

                .profile-img {
                    width: 37px;
                    height: 37px;
                    border-radius: 3px;
                    float: left;
                    margin-top: 11px;
                    margin-right: 5px;
                }
                body > div > div.col.s3 > div > div.card-content > div > img{
                    width: 150px;
                    float: left;
                    padding-top: 100px;
                    padding-left: 10px;
                    box-shadow: 0px 0px 2px 0px;
                }
            </style>
        </head>

        <body>
            <!-- Navigasi -->
            <?php
            include 'nav.php';
            ?>
            <div class="row">
                <div id="scroll-wrap" class="container">
                    <div class="main">

                        <div id="bookshelf" class="bookshelf">
                            <?php
                            if ($lala == 0) {
                                echo "<h2 class='text-center'>BUKU TIDAK ADA DALAM DATABASE</h2>";
                            } else {
                                while ($lp = mysql_fetch_array($bu)) {
                                    ?>         

                                    <style>
                                        .no-csstransforms3d .book[data-book="book-<?php echo $lp[idbuku] ?>"],
                                        .no-js .book[data-book="book-<?php echo $lp[idbuku] ?>"],
                                        .book[data-book="book-<?php echo $lp[idbuku] ?>"] .front {
                                            background: url(dokumen/bk/<?php echo $lp[cover] ?>);
                                            background-attachment: fixed;
                                            background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.1) 0%, rgba(211, 211, 211, 0.1) 5%, rgba(255, 255, 255, 0.15) 5%, rgba(255, 255, 255, 0.1) 9%, rgba(0, 0, 0, 0.01) 100%), url(dokumen/bk/<?php echo $lp[cover] ?>), #009bdb;
                                            background: linear-gradient(to right, rgba(0, 0, 0, 0.1) 0%, rgba(211, 211, 211, 0.1) 5%, rgba(255, 255, 255, 0.15) 5%, rgba(255, 255, 255, 0.1) 9%, rgba(0, 0, 0, 0.01) 100%), url(dokumen/bk/<?php echo $lp[cover] ?>), #009bdb;
                                        }

                                        .book[data-book="book-<?php echo $lp[idbuku] ?>"] .inner { border-color: #009bdb }
                                        .book[data-book="book-<?php echo $lp[idbuku] ?>"] .cover::before {
                                            background: url(dokumen/bk/<?php echo $lp[cover] ?>);
                                            background: -webkit-linear-gradient(left, transparent 0%, rgba(0, 0, 0, 0.01) 1%, rgba(0, 0, 0, 0.1) 50%, transparent 100%), url(dokumen/bk/<?php echo $lp[cover] ?>), #009bdb;
                                            background: linear-gradient(to right, transparent 0%, rgba(0, 0, 0, 0.01) 1%, rgba(0, 0, 0, 0.1) 50%, transparent 100%), url(dokumen/bk/<?php echo $lp[cover] ?>), #009bdb;
                                        }
                                    </style>

                                    <figure>
                                        <div class="book z-depth-5" data-book="book-<?php echo $lp[idbuku] ?>"></div>
                                        <div class="buttons"><a title="Status Buku di Perpustakaan" href="#"><?php echo $lp[status] ?></a><a href="#">Details</a></div>
                                        <figcaption><h2><?php echo $lp[nama] ?> <span><?php echo $lp[pengarang] ?></span></h2></figcaption>
                                        <div class="details">
                                            <ul>
                                                <li><?php echo $lp[sinapsis] ?></li>
                                                <li>Kode Buku : <?php echo $lp[kodebuku] ?></li>
                                                <li>Penerbit  : <?php echo $lp[penerbit] ?></li>
                                                <li>Tahun Terbit  : <?php echo $lp[tahun] ?></li>
                                            </ul>
                                        </div>
                                    </figure>
                                <?php }
                            } ?>

                        </div></div><!-- /main -->
                    <?php if ($numpage > $limit) { ?>
                        <div class="text-center">
                            <ul class="pagination">
                                <?php
                                if ($back >= 0) {
                                    echo "<li><a href=$page?start=$back>PREV</a></li>";
                                }
                                $l = 1;
                                for ($i = 0; $i < $numpage; $i = $i + $limit) {
                                    if ($i <> $eu) {
                                        echo "<li><a href=$page?start=$i>$l</a></li>";
                                    } else {
                                        echo "<li class='active'><a>$l</a></li>";
                                    }
                                    $l = $l + 1;
                                }
                                if ($thisp < $numpage) {
                                    echo "<li><a href=$page?start=$next>NEXT</a></li>";
                                }
                            }
                            ?></ul></div>
                </div><!-- /container -->
            </div>
            <script type="text/javascript" src="asset/jquery-2.1.1.min.js"></script>
            <script type="text/javascript" src="asset/material/js/materialize.js"></script>
            <script>  $(".button-collapse").sideNav();</script>
            <script>
                $(document).ready(function () {
                    $('.dropdown').dropdown();
                });

            </script>

    <?php include 'js.php'; ?>
        </body>

    </html> <?php
} else {
    header('location:index.php');
} 