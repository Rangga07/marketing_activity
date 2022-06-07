<?php
include('../config/+koneksi.php');
$kode = $_GET['kode'];
$pkm = $_GET['pkm'];
$noa_pkm = $_GET['noa_pkm'];
$sibumbung = $_GET['sibumbung'];
$noa_sibumbung = $_GET['noa_sibumbung'];
$simaspro = $_GET['simaspro'];
$noa_simaspro = $_GET['noa_simaspro'];
$simpedik = $_GET['simpedik'];
$noa_simpedik = $_GET['noa_simpedik'];
$simastu = $_GET['simastu'];
$noa_simastu = $_GET['noa_simastu'];
$tahara = $_GET['tahara'];
$noa_tahara = $_GET['noa_tahara'];
$jumlah = $pkm + $sibumbung + $simaspro + $simpedik + $simastu + $tahara;
$jumlah_noa = $noa_pkm + $noa_sibumbung + $noa_simaspro + $noa_simpedik + $noa_simastu + $noa_tahara;

//query update
$query = "UPDATE tabungan SET pkm='$pkm' , noa_pkm='$noa_pkm' , sibumbung='$sibumbung', noa_sibumbung='$noa_sibumbung',
            simaspro='$simaspro', noa_simaspro='$noa_simaspro', simpedik='$simpedik', noa_simpedik='$noa_simpedik',
            simastu='$simastu', noa_simastu='$noa_simastu', tahara='$tahara', noa_tahara='$noa_tahara', 
            jumlah='$jumlah', jumlah_noa='$jumlah_noa' WHERE kode='$kode'";
if (mysqli_query($dbconnect, $query)) {
    # credirect ke page index

    echo "<script> language='javascript'>window.alert('Data Berhasil di Edit!');
        window.location.href='../index.php?page=tabungan';</script>";
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($dbconnect);
}
