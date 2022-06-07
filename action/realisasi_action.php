<?php
include "../models/m_bulanan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new BUL($connection);

?>
<?php
  error_reporting(0);
  if(@$_POST['tambahrealisasi']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal']);
    $noa = $connection->conn->real_escape_string($_POST['noa']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);

    $keg->tambah_realisasi($kode, $nominal, $noa, $tanggal, $nama_ao,$wilayah);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=realisasi';</script>";

        
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php?page=realisasi';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
