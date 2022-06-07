<?php
ob_start();
require_once('config/+koneksi.php');
require_once('models/database.php');

$connection = new Database($host, $user, $pass, $database);
?>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location:form-login.php?pesan=belum");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KEGIATAN MARKETING</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/datepicker3.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <link rel="icon" href="images/logo.jpg">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#form-input").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
      $("#form-input-promosi").css("display", "none");
      $(".detail").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
        if ($("input[name='nama_kegiatan']:checked").val() == "Tagihan") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
          $("#form-input").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
          $("#form-input-promosi").slideUp("fast");
        } else if ($("input[name='nama_kegiatan']:checked").val() == "Promosi") {
          $("#form-input-promosi").slideDown("fast"); //Efek Slide Up (Menghilangkan Form Input)
          $("#form-input").slideUp("fast");
        } else {
          $("#form-input").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
          $("#form-input-promosi").slideUp("fast");
        }
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#form-deal").css("display", "none"); //Menghilangkan form-input ketika pertama kali dijalankan
      $(".form").click(function() { //Memberikan even ketika class detail di klik (class detail ialah class radio button)
        if ($("input[name='kep']:checked").val() == "Deal") { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
          $("#form-deal").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
        } else {
          $("#form-deal").slideUp("fast"); //Efek Slide Up (Menghilangkan Form Input)
        }
      });
    });
  </script>
  <script src="assets/js/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

  <!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

  <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span></button>
        <a class="navbar-brand" href="#"><span>ACCOUNT</span>OFFICER </a>

      </div>
    </div><!-- /.container-fluid -->
  </nav>
  <!-- Brand and toggle get grouped for better mobile display -->
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
      <div class="profile-userpic">
        <img src="images/logo.jpg" class="img-responsive" alt="">
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name"><?php echo $_SESSION['username']; ?> | <?php echo $_SESSION['level']; ?> </div>
        <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
      <li><a href="?page=dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
      <hr />
      <li><a href="?page=kegiatan_awal"><em class="fa fa-calendar">&nbsp;</em> Kegiatan Awal</a></li>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-4">
          <em class="fa fa fa-calendar-check-o">&nbsp;</em> Akhir Hari <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-4">
          <li><a href="?page=tagihan"><em class="fa fa-clipboard">&nbsp;</em> Tagihan Kredit</a></li>
          <li><a href="?page=tabungan"><em class="fa fa-leanpub">&nbsp;</em> Tabungan</a></li>
          <li><a href="?page=promosi"><em class="fa fa-users">&nbsp;</em> Promosi</a></li>
          <li><a href="?page=survey"><em class="fa fa-motorcycle">&nbsp;</em> Survey</a></li>
          <li><a href="?page=ppob"><em class="fa fa-paypal">&nbsp;</em> PPOB</a></li>
          <li><a href="?page=kegiatanlain"><em class="fa fa-spinner">&nbsp;</em> Kegiatan Lain</a></li>
          <hr />
        </ul>
      </li>
      <li><a href="?page=cetak_laporan"><em class="fa fa-print">&nbsp;</em> Cetak Laporan</a></li>
      <hr>
      <li class="parent "><a data-toggle="collapse" href="#sub-item-5">
          <em class="fa fa-calendar-plus-o">&nbsp;</em> Bulanan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-5">
          <li><a href="?page=realisasi"><em class="	fa fa-dollar">&nbsp;</em> Pencairan</a></li>
          <li><a href="?page=pelunasan"><em class="fa fa-check-square">&nbsp;</em> Pelunasan</a></li>
          <li><a href="?page=bakidebet"><em class="fa fa-cube">&nbsp;</em> Baki Debet</a></li>
        </ul>
      </li>
      <hr />
      <li><a href="?page=profile"><em class="fa fa-user">&nbsp;</em> Profile </a></li>
      <hr>
      <li><a href="#" data-toggle="modal" data-target="#logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
  </div>
  <div id="logout" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" align="center"><b>PESAN</b></h4>
        </div>
        <form action="logout.php" method="post" enctype="multipart/form-data">
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
    if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
      include "views/dashboard.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'kegiatan_awal') {
      include "views/kegiatan/kegiatan_awal.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'tagihan') {
      include "views/tagihan/tagihan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'tabungan') {
      include "views/tabungan/tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'promosi') {
      include "views/promosi/promosi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'kegiatanlain') {
      include "views/kegiatanlain/kegiatanlain.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'ppob') {
      include "views/ppob/ppob.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'survey') {
      include "views/survey/survey.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'master_tagihan') {
      include "views/tagihan/master_tagihan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'master_tabungan') {
      include "views/tabungan/master_tabungan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'master_promosi') {
      include "views/promosi/master_promosi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'realisasi') {
      include "views/kredit/realisasi.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'pelunasan') {
      include "views/kredit/pelunasan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'tabungan_bulanan') {
      include "views/kredit/tabungan_bulanan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'bakidebet') {
      include "views/kredit/bakidebet.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'cetak_laporan') {
      include "views/cetak/cetak_laporan.php";
    } else if (@$_GET['page'] && @$_GET['page'] == 'profile') {
      include "views/users/profile.php";
    }

    ?>

  </div><!-- /#page-wrapper -->

  </div><!-- /#wrapper -->

  <!-- JavaScript -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <script src="assets/js/jquery-1.11.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/chart.min.js"></script>
  <script src="assets/js/chart-data.js"></script>
  <script src="assets/js/easypiechart.js"></script>
  <script src="assets/js/easypiechart-data.js"></script>
  <script src="assets/js/bootstrap-datepicker.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/jquery.mask.min.js"></script>
  <script>
    // Function ini dijalankan ketika Halaman ini dibuka pada browser
    $(function() {
      setInterval(timestamp, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
    });

    //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
    function timestamp() {
      $.ajax({
        url: 'ajax/ajax_timestamp.php',
        success: function(data) {
          $('#timestamp').html(data);
        },
      });
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatables').DataTable({
        "scrollY": 500,
        "scrollX": true

      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function() {
        var html = $(".copy").html();
        $(".after-add-more").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click", ".remove", function() {
        $(this).parents(".control-group").remove();
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more-promosi").click(function() {
        var html = $(".copy-promosi").html();
        $(".after-add-more-promosi").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click", ".remove-promosi", function() {
        $(this).parents(".control-group-promosi").remove();
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more-survey").click(function() {
        var html = $(".copy-survey").html();
        $(".after-add-more-survey").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click", ".remove-survey", function() {
        $(this).parents(".control-group-survey").remove();
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more-detpro").click(function() {
        var html = $(".copy-detpro").html();
        $(".after-add-more-detpro").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click", ".remove-detpro", function() {
        $(this).parents(".control-group-detpro").remove();
      });
    });
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