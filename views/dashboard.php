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
  <p id="timestamp"></p>

  <?php
  require_once('config/+koneksi.php');
  require_once('models/database.php');
  $nama_ao = $_SESSION['username'];
  $tgl = date("Y/m/d");
  $data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal WHERE nama_ao='$nama_ao' AND tanggal='$tgl'");
  $data2 = mysqli_query($dbconnect, "SELECT * FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl'");
  $data3 = mysqli_query($dbconnect, "SELECT * FROM tabungan WHERE ao='$nama_ao' AND tgl='$tgl'");
  $data4 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl'");
  $data5 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_lain WHERE ao='$nama_ao' AND tgl='$tgl'");

  $jumlah_ao = mysqli_num_rows($data);
  $jumlah_tag = mysqli_num_rows($data2);
  $jumlah_tab = mysqli_num_rows($data3);
  $jumlah_pro = mysqli_num_rows($data4);
  $jumlah_kl = mysqli_num_rows($data5);

  error_reporting(0);
  ?>
  <div class="panel panel-container">
    <div class="row">
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-teal panel-widget border-right">
          <div class="row no-padding"><em class="fa fa-xl fa-calendar color-blue"></em>
            <div class="large"><?php echo $jumlah_ao; ?></div>
            <div class="text-muted">Kegiatan</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-blue panel-widget border-right">
          <div class="row no-padding"><em class="fa fa-xl fa-clipboard color-orange"></em>
            <div class="large"><?php echo $jumlah_tag; ?></div>
            <div class="text-muted">Tagihan Kredit</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-orange panel-widget border-right">
          <div class="row no-padding"><em class="fa fa-xl fa-leanpub color-teal"></em>
            <div class="large"><?php echo $jumlah_tab; ?></div>
            <div class="text-muted">Tabungan</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-red panel-widget ">
          <div class="row no-padding"><em class="fa fa-xl fa-users color-red"></em>
            <div class="large"><?php echo $jumlah_pro; ?></div>
            <div class="text-muted">Promosi</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-red panel-widget ">
          <div class="row no-padding"><em class="fa fa-xl fa-paypal color-blue"></em>
            <div class="large"><?php echo $jumlah_pro; ?></div>
            <div class="text-muted">PPOB</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
        <div class="panel panel-red panel-widget ">
          <div class="row no-padding"><em class="fa fa-xl fa-spinner color-black"></em>
            <div class="large"><?php echo $jumlah_kl; ?></div>
            <div class="text-muted">Kegiatan Lain</div>
          </div>
        </div>
      </div>
    </div>
    <!--/.row-->
  </div>

  <?php
  $nama_ao = $_SESSION['username'];
  $tgl = date("Y/m/d");
  $data = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM tabungan WHERE ao='$nama_ao' AND tgl='$tgl'");
  $data2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM tabungan WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'");
  $data3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'");
  $data3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'");
  $data4 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'");

  $total_tagihan = mysqli_fetch_array($data);
  $total_tabungan = mysqli_fetch_array($data2);
  $total_promosi = mysqli_fetch_array($data3);
  $jumlah_noa_promosi = mysqli_num_rows($data4);
  ?>

  <?php
  $bulan = date('n');
  $tahun = date('Y');
  $nama_ao = $_SESSION['username'];
  $tampil = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");
  if (mysqli_num_rows($tampil) > 0) {
    $result = mysqli_fetch_object($tampil);
    $sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND ao='$nama_ao'");
    $total = mysqli_fetch_array($sql2);
    $per_tabungan = round($total['total'] / $result->total * 100);
  ?>
    <div class="row">
      <div class="col-xs-6 col-md-4">
        <div class="panel panel-default">
          <div class="panel-body easypiechart-panel">
            <h4><b>TABUNGAN (<?php echo date("F") ?>)</b></h4>
            <hr>
            <div class='easypiechart' id='easypiechart-red' data-percent='<?php $per_tabungan ?>'><b>Kontribusi</b><span class='percent'><br><?php echo $per_tabungan ?> %</span></div><br>
            <br>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php
    $bulan = date('n');
    $tahun = date('Y');
    $nama_ao = $_SESSION['username'];
    $tampil = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");
    if (mysqli_num_rows($tampil) > 0) {
      $result = mysqli_fetch_object($tampil);
      $sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND ao='$nama_ao'");
      $total = mysqli_fetch_array($sql2);
      $per_tabungan = round($total['total'] / $result->total * 100);
    ?>
      <div class="row">
        <div class="col-xs-6 col-md-4">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4><b>PENCAIRAN (<?php echo date("F") ?>)</b></h4>
              <hr>
              <div class='easypiechart' id='easypiechart-red' data-percent='<?php $per_tabungan ?>'><b>Kontribusi</b><span class='percent'><br><?php echo $per_tabungan ?> %</span></div><br>
              <br>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>


    </div><!-- /.row -->