<?php
include "../models/m_promosi.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$keg = new PRO($connection);

?>
<?php
  if(@$_POST['tambahpromosi']) {
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);
    $nama = $connection->conn->real_escape_string($_POST['nama']);
    $alamat = $connection->conn->real_escape_string($_POST['alamat']);
    $no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
    $kep = $connection->conn->real_escape_string($_POST['kep']);
    $produk = $connection->conn->real_escape_string($_POST['produk']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal']);
    $keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $id_keg = $connection->conn->real_escape_string($_POST['id_keg']);
    
    $extensi = explode(".", $_FILES['foto_knj']['name']);
    $foto_knj = "promosi-".round(microtime(true)).".".end($extensi);
    $sumber = $_FILES['foto_knj']['tmp_name'];
    $upload = move_uploaded_file($sumber, "../assets/images/kunjungan/".$foto_knj);
    if($upload){
    $keg->tambah_promosi($kode, $wilayah, $nama, $alamat, $no_hp, $kep, $produk, $nominal, $keterangan, $foto_knj, $nama_ao, $tanggal, $id_keg);
    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=tagihan';</script>";
    }else{
    $keg->tambah_promosi($kode, $wilayah, $nama, $alamat, $no_hp, $kep, $produk, $nominal, $keterangan, $foto_knj, $nama_ao, $tanggal, $id_keg);
    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=promosi';</script>";
    }
  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
