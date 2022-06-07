<?php
include "../models/m_bulanan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new BUL($connection);

?>
<?php
  error_reporting(0);
  if(@$_POST['tambahbakidebet']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $bk_lancar = $connection->conn->real_escape_string($_POST['bk_lancar']);
    $noa_lancar = $connection->conn->real_escape_string($_POST['noa_lancar']);
    $bk_dpk = $connection->conn->real_escape_string($_POST['bk_dpk']);
    $noa_dpk = $connection->conn->real_escape_string($_POST['noa_dpk']);
    $bk_kl = $connection->conn->real_escape_string($_POST['bk_kl']);
    $noa_kl = $connection->conn->real_escape_string($_POST['noa_kl']);
    $bk_dir = $connection->conn->real_escape_string($_POST['bk_dir']);
    $noa_dir = $connection->conn->real_escape_string($_POST['noa_dir']);
    $bk_m = $connection->conn->real_escape_string($_POST['bk_m']);
    $noa_m = $connection->conn->real_escape_string($_POST['noa_m']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);

    $keg->tambah_bakidebet($kode, $bk_lancar, $noa_lancar, $bk_dpk, $noa_dpk, $bk_kl, $noa_kl, 
                            $bk_dir, $noa_dir, $bk_m, $noa_m ,$tanggal, $nama_ao,$wilayah);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=bakidebet';</script>";

        
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php?page=bakidebet';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
