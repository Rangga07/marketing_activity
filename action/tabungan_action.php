<?php
include "../models/m_tabungan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new TAB($connection);

?>
<?php
error_reporting(0);
if (@$_POST['tambahtabungan']) {
  $kode = $connection->conn->real_escape_string($_POST['kode']);
  $pkm = $connection->conn->real_escape_string($_POST['pkm']);
  $noa_pkm = $connection->conn->real_escape_string($_POST['noa_pkm']);
  $sibumbung = $connection->conn->real_escape_string($_POST['sibumbung']);
  $noa_sibumbung = $connection->conn->real_escape_string($_POST['noa_sibumbung']);
  $simaspro = $connection->conn->real_escape_string($_POST['simaspro']);
  $noa_simaspro = $connection->conn->real_escape_string($_POST['noa_simaspro']);
  $simpedik = $connection->conn->real_escape_string($_POST['simpedik']);
  $noa_simpedik = $connection->conn->real_escape_string($_POST['noa_simpedik']);
  $simastu = $connection->conn->real_escape_string($_POST['simastu']);
  $noa_simastu = $connection->conn->real_escape_string($_POST['noa_simastu']);
  $tahara = $connection->conn->real_escape_string($_POST['tahara']);
  $noa_tahara = $connection->conn->real_escape_string($_POST['noa_tahara']);
  $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
  $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
  $id_keg = $connection->conn->real_escape_string($_POST['id_keg']);
  $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);

  $keg->tambah_tabungan(
    $kode,
    $pkm,
    $noa_pkm,
    $sibumbung,
    $noa_sibumbung,
    $simaspro,
    $noa_simaspro,
    $simpedik,
    $noa_simpedik,
    $simastu,
    $noa_simastu,
    $tahara,
    $noa_tahara,
    $tanggal,
    $nama_ao,
    $id_keg,
    $wilayah
  );
  echo "<script> language='javascript'>window.alert('Data Tersimpan!');
          window.location.href='../index.php?page=tabungan';</script>";
} else {
  echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
    window.location.href='../index.php';</script>";

  echo mysqli_connect_errno($connection);
}

?>
