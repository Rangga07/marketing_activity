<?php
include "../models/m_kegiatan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new KA($connection);

?>
<?php
  if(@$_POST['tambahppob']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $nama_kegiatan = $connection->conn->real_escape_string($_POST['nama_kegiatan']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal']);
    $noa = $connection->conn->real_escape_string($_POST['noa']);
    $nama_ao = $connection->conn->real_escape_string($_POST['nama_ao']);
    $tanggal = $connection->conn->real_escape_string($_POST['tanggal']);

    $keg->tambah_kegiatan_ppob($kode, $nama_kegiatan, $nominal ,$noa, $nama_ao, $tanggal);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=ppob';</script>";

        
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php?page=ppob';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
