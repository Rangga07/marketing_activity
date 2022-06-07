<?php
// Load file koneksi.php
  ob_start();
  require_once('../config/+koneksi.php');
  require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);

// Ambil data ID Provinsi yang dikirim via ajax post
$kode_all = $_POST['rbb_kredit_all'];

// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_bul WHERE kode_all='".$kode_all."'");

// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>Pilih</option>";

while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
	$html .= "<option value='".$data['bulan']."'>".$data['bulan']."</option>"; // Tambahkan tag option ke variabel $html
}

$callback = array('data_rbb_kredit_bul'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
