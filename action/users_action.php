<?php
include "../models/m_users.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$keg = new USR($connection);

?>
<?php
  error_reporting(0);
  if(@$_POST['tambahusers']) {
    $id = $connection->conn->real_escape_string($_POST['id']);
    $nama = $connection->conn->real_escape_string($_POST['nama']);
    $username = $connection->conn->real_escape_string($_POST['username']);
    $password = $connection->conn->real_escape_string($_POST['password']);
    $level = $connection->conn->real_escape_string($_POST['level']);
    $wilayah = $connection->conn->real_escape_string($_POST['wilayah']);

    $keg->tambah_users($id ,$nama, $username, $password, $level, $wilayah);

    echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../admin/index.php?page=users';</script>";

  }else{
    echo "<script> language='javascript'>window.alert('Gagal Tersimpan!');
        window.location.href='../admin/index.php?page=users';</script>";

    echo mysqli_connect_errno($connection);
  }
?>
