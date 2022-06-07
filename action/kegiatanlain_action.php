<?php
include "../models/m_kegiatanlain.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$keg = new KL($connection);

?>
<?php
  if(@$_POST['tambahkegiatanlain']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $nama_keg = $connection->conn->real_escape_string($_POST['nama_keg']);
    $f_jam = $connection->conn->real_escape_string($_POST['f_jam']);
    $to_jam = $connection->conn->real_escape_string($_POST['to_jam']);
    $keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $id_keg = $connection->conn->real_escape_string($_POST['id_keg']);

    $keg->tambah_kegiatanlain($kode, $nama_keg, $f_jam, $to_jam, $keterangan, $nama_ao, $tanggal, $id_keg);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=kegiatanlain';</script>";

  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
