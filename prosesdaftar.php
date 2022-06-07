<?php 

    require_once('config/+koneksi.php');
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $cekuser = mysqli_query($dbconnect,"SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($cekuser) <> 0) {
    echo "<script> language='javascript'>window.alert('Username sudah terdaftar!');
    window.location.href='daftar.php';</script>";
    } else {
    if(!$nama || !$username || !$password || !$level) {
    echo "<script> language='javascript'>window.alert('Data Belum Lengkap!');
    window.location.href='daftar.php';</script>";
    } else {
    $simpan = mysqli_query($dbconnect,"INSERT INTO user(nama, username, password, level) VALUES('$nama','$username','$password','$level')");
    if($simpan) {
    echo "<script> language='javascript'>window.alert('Daftar Sukses!!');
    window.location.href='form-login.php';</script>";
    } else {
    echo "Proses Gagal!";
    }
    }
    }
?>