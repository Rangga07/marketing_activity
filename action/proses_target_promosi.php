<?php
    //membuat koneksi
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');

    $connection = new Database($host, $user, $pass, $database);

    
    //memasukkan data ke array
        $wilayah       = $_POST['wilayah'];
        $noa       = $_POST['noa'];
        $kode_keg     = $_POST['kode_keg'];
        $ao     = $_POST['ao'];
        $tgl     = $_POST['tgl'];

        $total = count($wilayah);


    //melakukan perulangan input
    for($i=0; $i<$total; $i++){

        mysqli_query($dbconnect, "INSERT INTO kegiatan_awal_promosi SET
            wilayah  = '$wilayah[$i]',
            noa  = '$noa[$i]',
            kode_keg  = '$kode_keg[$i]',
            ao  = '$ao[$i]',
            tgl  = '$tgl[$i]'
        ");
    }

    echo "<script> language='javascript'>window.alert('Target Promosi Tersimpan!');
        window.location.href='../index.php?page=kegiatan_awal';</script>";
