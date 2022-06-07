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

  <?php
  $bulan = date('n');
  $tampil = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_wil JOIN rbb_kredit_bul ON rbb_kredit_wil.kode_bul=rbb_kredit_bul.kode JOIN rbb_kredit_all ON rbb_kredit_wil.kode_all=rbb_kredit_all.kode WHERE bulan='$bulan' AND wilayah='Ciwidey 1'");
  if (mysqli_num_rows($tampil) > 0) {
    $result = mysqli_fetch_object($tampil);
    $sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 1' AND MONTH(tgl)='$bulan'");
    $sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 1' AND MONTH(tgl)='$bulan'");
    $total = mysqli_fetch_array($sql2);
    $total2 = mysqli_fetch_array($sql3);
    $selisih = $total['total'] - $total2['total'];
    $per_realisasi = round($total['total'] / $result->nominal_wil * 100);
    $per_kredit = round($selisih / $result->nominal_wil * 100);
  ?>
    <div class="row">
      <div class="col-xs-6 col-md-4">
        <div class="panel panel-default">
          <div class="panel-body easypiechart-panel">
            <h4><b>CIWIDEY I (<?php echo date("F") ?>)</b></h4>
            <hr>
            <div class='easypiechart' id='easypiechart-blue' data-percent='<?php $per_kredit ?>'><b>Pertumbuhan Kredit</b><span class='percent'><br><?php echo $per_kredit ?> %</span></div><br>
            <td rowspan='4' width=360>
              <div class='easypiechart' id='easypiechart' data-percent='<?php $per_realisasi ?>'><b>Persentase Target Realisasi</b><span class='percent'><br><?php echo $per_realisasi ?> %</span></div>
            </td><br>
            <br>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php
    $bulan = date('n');
    $tampil = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_wil JOIN rbb_kredit_bul ON rbb_kredit_wil.kode_bul=rbb_kredit_bul.kode JOIN rbb_kredit_all ON rbb_kredit_wil.kode_all=rbb_kredit_all.kode WHERE bulan='$bulan' AND wilayah='Ciwidey 2'");
    if (mysqli_num_rows($tampil) > 0) {
      $result = mysqli_fetch_object($tampil);
      $sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND MONTH(tgl)='$bulan'");
      $sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND MONTH(tgl)='$bulan'");
      $total = mysqli_fetch_array($sql2);
      $total2 = mysqli_fetch_array($sql3);
      $selisih = $total['total'] - $total2['total'];
      $per_realisasi = round($total['total'] / $result->nominal_wil * 100);
      $per_kredit = round($selisih / $result->nominal_wil * 100);
    ?>
      <div class="row">
        <div class="col-xs-6 col-md-4">
          <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
              <h4><b>CIWIDEY II (<?php echo date("F") ?>)</b></h4>
              <hr>
              <div class='easypiechart' id='easypiechart-orange' data-percent='<?php $per_kredit ?>'><b>Pertumbuhan Kredit</b><span class='percent'><br><?php echo $per_kredit ?> %</span></div><br>
              <td rowspan='4' width=360>
                <div class='easypiechart' id='easypiechart' data-percent='<?php $per_realisasi ?>'><b>Persentase Target Realisasi</b><span class='percent'><br><?php echo $per_realisasi ?> %</span></div>
              </td><br>
              <br>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php
      $bulan = date('n');
      $tampil = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_wil JOIN rbb_kredit_bul ON rbb_kredit_wil.kode_bul=rbb_kredit_bul.kode JOIN rbb_kredit_all ON rbb_kredit_wil.kode_all=rbb_kredit_all.kode WHERE bulan='$bulan' AND wilayah='Ciwidey 3'");
      if (mysqli_num_rows($tampil) > 0) {
        $result = mysqli_fetch_object($tampil);
        $sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 3' AND MONTH(tgl)='$bulan'");
        $sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 3' AND MONTH(tgl)='$bulan'");
        $total = mysqli_fetch_array($sql2);
        $total2 = mysqli_fetch_array($sql3);
        $selisih = $total['total'] - $total2['total'];
        $per_realisasi = round($total['total'] / $result->nominal_wil * 100);
        $per_kredit = round($selisih / $result->nominal_wil * 100);
      ?>
        <div class="row">
          <div class="col-xs-6 col-md-4">
            <div class="panel panel-default">
              <div class="panel-body easypiechart-panel">
                <h4><b>CIWIDEY III (<?php echo date("F") ?>)</b></h4>
                <hr>
                <div class='easypiechart' id='easypiechart-red' data-percent='<?php $per_kredit ?>'><b>Pertumbuhan Kredit</b><span class='percent'><br><?php echo $per_kredit ?> %</span></div><br>
                <td rowspan='4' width=360>
                  <div class='easypiechart' id='easypiechart' data-percent='<?php $per_realisasi ?>'><b>Persentase Target Realisasi</b><span class='percent'><br><?php echo $per_realisasi ?> %</span></div>
                </td><br>
                <br>
              </div>
            </div>
          </div>
        <?php } ?>

        </div>





      </div><!-- /.row -->