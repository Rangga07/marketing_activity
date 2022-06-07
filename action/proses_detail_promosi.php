<?php
    //membuat koneksi
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');

    $connection = new Database($host, $user, $pass, $database);

    
    //memasukkan data ke array
        
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $no_hp     = $_POST['no_hp'];
        $kep     = $_POST['kep'];
        $produk     = $_POST['produk'];
        $nominal = str_replace('.', '', $_POST['nominal']);
        $keterangan     = $_POST['keterangan'];
        $ao     = $_POST['ao'];
        $tgl     = $_POST['tgl'];
        $id_keg     = $_POST['id_keg'];

        $total = count($nama);


    //melakukan perulangan input
    for($i=0; $i<$total; $i++){
        $w    = $_POST['wilayah'];
        mysqli_query($dbconnect, "INSERT INTO promosi SET
            wilayah  = '$w',
            nama  = '$nama[$i]',
            alamat  = '$alamat[$i]',
            no_hp  = '$no_hp[$i]',
            kep  = '$kep[$i]',
            produk  = '$produk[$i]',
            nominal  = '$nominal[$i]',
            keterangan  = '$keterangan[$i]',
            ao  = '$ao[$i]',
            tgl  = '$tgl[$i]',
            id_keg  = '$id_keg[$i]'
        ");
    }

    echo "<script> language='javascript'>window.alert('Target Promosi Tersimpan!');
        window.location.href='../index.php?page=promosi';</script>";
