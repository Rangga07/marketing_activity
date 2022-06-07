<?php
include "../models/m_rbb_tabungan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new RBBTAB($connection);

?>
<?php
  if(@$_POST['tambahall']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $periode = $connection->conn->real_escape_string($_POST['periode']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal']);

    $keg->tambah_rbb_all($kode, $periode, $nominal, $nominal2);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../admin/index.php?page=rbb_tabungan';</script>";

  }else if(@$_POST['tambahbul']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $bulan = $connection->conn->real_escape_string($_POST['bulan']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal_bul']);
    $kode_all = $connection->conn->real_escape_string($_POST['kode_all']);

    $keg->tambah_rbb_bul($kode, $bulan, $nominal, $kode_all);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../admin/index.php?page=rbb_tabungan';</script>";

  
  }else if(@$_POST['tambahwil']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal_wil']);
    $kode_all = $connection->conn->real_escape_string($_POST['kode_all']);
    $kode_bul = $connection->conn->real_escape_string($_POST['kode_bul']);

    $keg->tambah_rbb_wil($kode, $wilayah, $nominal, $kode_all, $kode_bul);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../admin/index.php?page=rbb_tabungan';</script>";

  
  }else if(@$_POST['tambahao']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $ao = $connection->conn->real_escape_string($_POST['id_user']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal_ao']);
    $kode_all = $connection->conn->real_escape_string($_POST['kode_all']);
    $kode_bul = $connection->conn->real_escape_string($_POST['kode_bul']);

    $keg->tambah_rbb_ao($kode, $ao, $nominal, $kode_all, $kode_bul);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../admin/index.php?page=rbb_tabungan';</script>";

  
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../admin/index.php?page=rbb_tabungan';</script>";

    echo mysqli_connect_errno($connection);
  }

?>

