<?php
include "../models/m_survey.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


$keg = new SUR($connection);

?>
<?php
error_reporting(0);
if (@$_POST['tambahsurvey']) {
    $kode = $connection->conn->real_escape_string($_POST['kode_sur']);
    $nama = $connection->conn->real_escape_string($_POST['nama']);
    $alamat = $connection->conn->real_escape_string($_POST['alamat']);
    $nominal = $connection->conn->real_escape_string($_POST['nominal_peng']);
    $ket = $connection->conn->real_escape_string($_POST['ket']);
    $keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
    $tanggal = $connection->conn->real_escape_string($_POST['tgl']);
    $nama_ao = $connection->conn->real_escape_string($_POST['ao']);
    $id_keg = $connection->conn->real_escape_string($_POST['id_keg']);
    
    $extensi = explode(".", $_FILES['foto_knj']['name']);
    $foto_knj = "survey-".round(microtime(true)).".".end($extensi);
    $sumber = $_FILES['foto_knj']['tmp_name'];
    $upload = move_uploaded_file($sumber, "../assets/images/kunjungan/".$foto_knj);
    
    if($upload){
    $keg->tambah_survey($kode, $nama, $alamat, $nominal, $ket, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg);
    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../index.php?page=survey';</script>";
    }else{
        $keg->tambah_survey($kode, $nama, $alamat, $nominal, $ket, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg);
    echo "<script> language='javascript'>window.alert('Data Tersimpan Tanpa Foto!');
        window.location.href='../index.php?page=survey';</script>";
    }
    
    
} else {
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../index.php';</script>";

    echo mysqli_connect_errno($connection);
}
?>
