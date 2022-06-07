<?php
include "../models/m_rbb_kredit.php";
include "../models/m_users.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new RBBKRE($connection);
$users = new USR($connection);


?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <style>
        .redtext {
            color: red;
        }
    </style>

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <!--/.row-->


    <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    $tgl = date("Y/m/d");
    $data2 = mysqli_query($dbconnect, "SELECT * FROM tagihan ");
    $data3 = mysqli_query($dbconnect, "SELECT * FROM tabungan ");
    $data4 = mysqli_query($dbconnect, "SELECT * FROM promosi ");
    $data5 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_lain ");

    $jumlah_tag = mysqli_num_rows($data2);
    $jumlah_tab = mysqli_num_rows($data3);
    $jumlah_pro = mysqli_num_rows($data4);
    $jumlah_kl = mysqli_num_rows($data5);
    ?>
    <div class="panel panel-container">
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-clipboard color-orange"></em>
                        <div class="large"><?php echo $jumlah_tag; ?></div>
                        <div class="text-muted">Tagihan</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-leanpub color-teal"></em>
                        <div class="large"><?php echo $jumlah_tab ?></div>
                        <div class="text-muted">Tabungan</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-red"></em>
                        <div class="large"><?php echo $jumlah_pro ?></div>
                        <div class="text-muted">Promosi</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-spinner color-black"></em>
                        <div class="large"><?php echo $jumlah_kl ?></div>
                        <div class="text-muted">Keigatan Lain</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row--><br />
    </div>

</div>





</div><!-- /.row -->