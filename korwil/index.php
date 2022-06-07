<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);
?>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location:../form-login.php?pesan=belum");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KEGIATAN MARKETING | ADMIN</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/datepicker3.css" rel="stylesheet">
  <link href="../assets/css/styles.css" rel="stylesheet">
  <script src="../assets/js/config.js"></script>
  <link rel="icon" href="../images/logo.jpg">
  <script type="text/javascript" src="../js/jquery-ui.js"></script>
  <!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
  <script src="../jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#form-ao").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
      $("#form-analis").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
      $(".form").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
        if ($("input[name='level']:checked").val() == "AO") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
          $("#form-ao").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
          $("#form-analis").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
        } else if ($("input[name='level']:checked").val() == "analis") {
          $("#form-analis").slideDown("fast"); //Efek Slide Up (Menghilangkan Form Input)
          $("#form-ao").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
        } else {
          $("#form-analis").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
          $("#form-ao").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
        }
      });
    });
  </script>
</head>

<body>

  <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span></button>
        <a class="navbar-brand" href="#"><span>KORWIL</span>PAGE</a>

      </div>
    </div><!-- /.container-fluid -->
  </nav>
  <!-- Brand and toggle get grouped for better mobile display -->
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
      <div class="profile-userpic">
        <img src="../images/logo.jpg" class="img-responsive" alt="">
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name"><?php echo $_SESSION['level']; ?> </div>
        <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="divider"></div> 
    <ul class="nav menu">
      <li><a href="?page=dashboard-korwil"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
      <hr>
      <li><a href="?page=kegiatan_awal-korwil"><em class="fa fa-calendar">&nbsp;</em> Kegiatan Harian AO</a></li>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
          <em class="fa fa-clipboard">&nbsp;</em> Tagihan Kredit<span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-2">
          <li><a class="" href="?page=persetujuan">
              <span class="fa fa-arrow-right">&nbsp;</span> Persetujuan
            </a></li>
          <li><a class="" href="?page=report_harian_tagihan">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Harian/AO
            </a></li>
          <li><a class="" href="?page=report_bulanan_tagihan">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Bulanan/AO
            </a></li>
        </ul>
      </li>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-6">
        <em class="fa fa-clipboard">&nbsp;</em> PPOB<span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-6">
          <li><a class="" href="?page=report_bulanan_ppob">
            <span class="fa fa-arrow-right">&nbsp;</span> Report Bulanan/AO
          </a></li>
        </ul>
      </li>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-3">
          <em class="fa fa-leanpub">&nbsp;</em> Tabungan <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-3">
          <li><a class="" href="?page=report_harian_tabungan">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Harian/AO
            </a></li>
          <li><a class="" href="?page=report_bulanan_tabungan">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Bulanan/AO
            </a></li>
        </ul>
      </li>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-4">
          <em class="fa fa-users">&nbsp;</em> Promosi <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-4">
          <li><a class="" href="?page=report_harian_promosi">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Harian/AO
            </a></li>
          <li><a class="" href="?page=report_bulanan_promosi">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Bulanan/AO
            </a></li>
        </ul>
      </li>
      
      <li class="parent "><a data-toggle="collapse" href="#sub-item-7">
          <em class="fa fa-spinner">&nbsp;</em> Kegiatan Lain <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
          </a>
          <ul class="children collapse" id="sub-item-7">
            <li><a class="" href="?page=report_bulanan_kegiatanlain">
              <span class="fa fa-arrow-right">&nbsp;</span> Report Bulanan/AO
            </a></li>
          </ul>
      </li>
        <hr />
      <li class="parent "><a data-toggle="collapse" href="#sub-item-5">
          <em class="fa fa-industry">&nbsp;</em> Persentase Kredit <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <?php if($_SESSION['level'] == 'korwilsatu') {?>
        <ul class="children collapse" id="sub-item-5">
          <li><a class="" href="../views/kredit/persentase_bulanan_kredit_wilsatu.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Plafond 
            </a></li>
          <li><a class="" href="../views/kredit/persentase_bulanan_bakidebet_wilsatu.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Bakidebet
            </a></li>
        </ul>
        <?php } else if($_SESSION['level'] == 'korwildua') {?>
        <ul class="children collapse" id="sub-item-5">
          <li><a class="" href="../views/kredit/persentase_bulanan_kredit_wildua.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Plafond
            </a></li>
          <li><a class="" href="../views/kredit/persentase_bulanan_bakidebet_wildua.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Bakidebet
            </a></li>
        </ul>
        <?php } else if($_SESSION['level'] == 'korwiltiga') {?>
        <ul class="children collapse" id="sub-item-5">
          <li><a class="" href="../views/kredit/persentase_bulanan_kredit_wiltiga.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Plafond
            </a></li>
          <li><a class="" href="../views/kredit/persentase_bulanan_bakidebet_wiltiga.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Bakidebet
            </a></li>
        </ul>
        <?php } ?>
      </li>
      
      <li class="parent "><a data-toggle="collapse" href="#sub-item-6">
          <em class="fa fa-area-chart">&nbsp;</em> Tabungan Wilayah <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-6">
          <li><a class="" href="../views/tabungan/tabungan_rank.php" target="_blank">
              <span class="fa fa-arrow-right">&nbsp;</span> Tabungan Rank
            </a></li>
        </ul>
      </li>
      <hr />
      <li><a href="#" data-toggle="modal" data-target="#logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
  </div>
  <div id="logout" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" align="center"><b>PESAN</b></h4>
        </div>
        <form action="../logout.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <h4 align="center">
              <class="modal-body"> APA ANDA YAKIN INGIN KELUAR ?
            </h4>
            <br />
            <div align='center' class="form-group">
              <input type="submit" class="btn btn-success" name="tambah" value="YA">
              <button type="reset" class="btn btn-default" data-dismiss="modal">TIDAK</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  </div>

  <div id="page-wrapper">

    <?php
    if (@$_GET['page'] == 'dashboard-korwil' || @$_GET['page'] == '') {
      include "../views/dashboard-korwil.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'kegiatan_awal-korwil') {
      include "../views/kegiatan/kegiatan_awal-korwil.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'persetujuan') {
      include "../views/tagihan/persetujuan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'promosi-admin') {
      include "../views/promosi/promosi-admin.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'kegiatanlain') {
      include "views/kegiatanlain/kegiatanlain.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_tagihan') {
      include "../views/tagihan/detail_tagihan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_promosi') {
      include "../views/promosi/detail_promosi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_tabungan') {
      include "../views/tabungan/detail_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_kegiatanlain') {
      include "../views/kegiatanlain/detail_kegiatanlain.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_ppob') {
      include "../views/ppob/detail_ppob.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'detail_survey') {
      include "../views/survey/detail_survey.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_harian_tagihan') {
      include "../views/tagihan/report_harian_tagihan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_bulanan_tagihan') {
      include "../views/tagihan/report_bulanan_tagihan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'persetujuan') {
      include "../views/tagihan/persetujuan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_harian_tabungan') {
      include "../views/tabungan/report_harian_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_bulanan_tabungan') {
      include "../views/tabungan/report_bulanan_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_bulanan_ppob'){
      include "../views/ppob/report_bulanan_ppob.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_bulanan_kegiatanlain'){
      include "../views/kegiatanlain/report_bulanan_kegiatanlain.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_harian_promosi') {
      include "../views/promosi/report_harian_promosi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_bulanan_promosi') {
      include "../views/promosi/report_bulanan_promosi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'report_kegiatanlain') {
      include "../views/kegiatanlain/report_kegiatanlain.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'rbb_tabungan') {
      include "../views/rbb/rbb_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'rbb_kredit') {
      include "../views/rbb/rbb_kredit.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'realisasi_tabungan') {
      include "../views/tabungan/realisasi_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'persentase_bulanan_tabungan') {
      include "../views/tabungan/persentase_bulanan_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'persentase_tahunan_kredit') {
      include "../views/kredit/persentase_tahunan_kredit.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'users') {
      include "../views/users/users.php";
    }

    ?>

  </div><!-- /#page-wrapper -->

  </div><!-- /#wrapper -->

  <!-- JavaScript -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/chart.min.js"></script>
  <script src="../assets/js/chart-data.js"></script>
  <script src="../assets/js/easypiechart.js"></script>
  <script src="../assets/js/easypiechart-data.js"></script>
  <script src="../assets/js/bootstrap-datepicker.js"></script>
  <script>
    window.onload = function() {
      var chart1 = document.getElementById("line-chart").getContext("2d");
      window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
      });
    };
  </script>

  <script type="text/javascript">
    // format currency
    function format_currency(input) {
      "use strict";
      var angka = input.val().replace(/[^0-9]+/g, "");
      var pjg = angka.length;
      if (pjg < 3) {
        input.val(angka.substring(0, pjg % 3) + angka.substring(pjg % 3));
      } else if (pjg == 3) {
        input.val(angka.substring(0, 3));
      } else if (pjg < 6) {
        input.val(angka.substring(0, pjg % 3) + "." + angka.substring(pjg % 3));
      } else if (pjg == 6) {
        input.val(angka.substring(0, 3) + "." + angka.substring(3, 6));
      } else if (pjg < 9) {
        input.val(angka.substring(0, pjg % 3) + "." + angka.substring(pjg % 3, 3 + (pjg % 3)) + "." + angka.substring(3 + (pjg % 3)));
      } else if (pjg == 9) {
        input.val(angka.substring(0, 3) + "." + angka.substring(3, 6) + "." + angka.substring(6, 9));
      } else if (pjg < 12) {
        input.val(angka.substring(0, pjg % 3) + "." + angka.substring(pjg % 3, 3 + (pjg % 3)) + "." + angka.substring(3 + (pjg % 3), 6 + (pjg % 3)) + "." + angka.substring(6 + (pjg % 3)));
      } else if (pjg == 12) {
        input.val(angka.substring(0, 3) + "." + angka.substring(3, 6) + "." + angka.substring(6, 9) + "." + angka.substring(9, 12));
      }

    }
    $(function() {
      "use strict";
      $("#fc").focus();
      $("#fc").bind("keyup", function(e) {
        if ((e.which > 47 && e.which < 58) || e.which === 8 || e.which === 116) {
          format_currency($(this));
        } else {
          e.preventDefault();
        }
      });
    });
    $(function() {
      "use strict";
      $("#fd").focus();
      $("#fd").bind("keyup", function(e) {
        if ((e.which > 47 && e.which < 58) || e.which === 8 || e.which === 116) {
          format_currency($(this));
        } else {
          e.preventDefault();
        }
      });
    });
    $(function() {
      "use strict";
      $("#fe").focus();
      $("#fe").bind("keyup", function(e) {
        if ((e.which > 47 && e.which < 58) || e.which === 8 || e.which === 116) {
          format_currency($(this));
        } else {
          e.preventDefault();
        }
      });
    });
    $(function() {
      "use strict";
      $("#ff").focus();
      $("#ff").bind("keyup", function(e) {
        if ((e.which > 47 && e.which < 58) || e.which === 8 || e.which === 116) {
          format_currency($(this));
        } else {
          e.preventDefault();
        }
      });
    });
    $(function() {
      "use strict";
      $("#fg").focus();
      $("#fg").bind("keyup", function(e) {
        if ((e.which > 47 && e.which < 58) || e.which === 8 || e.which === 116) {
          format_currency($(this));
        } else {
          e.preventDefault();
        }
      });
    });
  </script>

</body>

</html>