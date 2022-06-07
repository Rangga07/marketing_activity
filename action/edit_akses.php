<?php
include('../config/+koneksi.php');
$id = $_GET['id'];
$time = $_GET['time'];

//query update
$query = "UPDATE akses SET time='$time' WHERE id='$id'";
if (mysqli_query($dbconnect, $query)) {
    # credirect ke page index

    echo "<script> language='javascript'>window.alert('Data Berhasil di Edit!');
        window.location.href='../admin/index.php?page=akses';</script>";
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($dbconnect);
}
