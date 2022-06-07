<?php
//membuat koneksi
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);


//memasukkan data ke array
$nama       = $_POST['nama_nas'];
$alamat    = $_POST['alamat'];
$nominal = str_replace('.', '', $_POST['nominal']);
$kode_keg     = $_POST['kode_keg'];
$ao     = $_POST['ao'];
$tgl     = $_POST['tgl'];

$total = count($nama);


//melakukan perulangan input
for ($i = 0; $i < $total; $i++) {

    mysqli_query($dbconnect, "INSERT INTO kegiatan_awal_survey SET
            nama_nas    = '$nama[$i]',
            alamat = '$alamat[$i]',
            nominal = '$nominal[$i]',
            kode_keg  = '$kode_keg[$i]',
            ao  = '$ao[$i]',
            tgl  = '$tgl[$i]'
        ");
}

echo "<script> language='javascript'>window.alert('Target Survey Tersimpan!');
        window.location.href='../index.php?page=kegiatan_awal';</script>";
