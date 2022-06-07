<?php
include "../models/m_kegiatan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new KA($connection);

?>
<?php
  if(@$_POST['tambahkegiatan']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $nama_kegiatan = $connection->conn->real_escape_string($_POST['nama_kegiatan']);
    $nama_ao = $connection->conn->real_escape_string($_POST['nama_ao']);
    $tanggal = $connection->conn->real_escape_string($_POST['tanggal']);

    $keg->tambah_kegiatan($kode, $nama_kegiatan, $nominal, $noa, $nama_ao, $tanggal);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=kegiatan_awal';</script>";

        
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
