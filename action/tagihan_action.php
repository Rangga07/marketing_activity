<?php
include "../models/m_tagihan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new TAG($connection);

?>
<?php
  error_reporting(1);
  if(@$_POST['tambahtagihan']) {
    $kode = $connection->conn->real_escape_string($_POST['kode_tag']);
    $nama = $connection->conn->real_escape_string($_POST['nama']);
    $alamat = $connection->conn->real_escape_string($_POST['alamat']);
    $kolek = $connection->conn->real_escape_string($_POST['kolek']);
    $ket = $connection->conn->real_escape_string($_POST['ket']);
    $jml_pokok = $connection->conn->real_escape_string($_POST['jml_pokok']);
    $jml_bunga = $connection->conn->real_escape_string($_POST['jml_bunga']);
    $keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $id_keg = $connection->conn->real_escape_string($_POST['id_keg']);

    $extensi = explode(".", $_FILES['foto_knj']['name']);
    $foto_knj = "tagihan-".round(microtime(true)).".".end($extensi);
    $sumber = $_FILES['foto_knj']['tmp_name'];
    $upload = move_uploaded_file($sumber, "../assets/images/kunjungan/".$foto_knj);
    if($upload){
      $keg->tambah_tagihan($kode, $nama,  $alamat, $kolek, $ket, $jml_pokok, $jml_bunga, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg);
       echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=tagihan';</script>";
    }else{
      $keg->tambah_tagihan($kode, $nama, $alamat, $kolek, $ket, $jml_pokok, $jml_bunga, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg);
       echo "<script> language='javascript'>window.alert('Data Tersimpan Tanpa Foto!');
        window.location.href='../index.php?page=tagihan';</script>";
    }

  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
