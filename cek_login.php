<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
require_once('config/+koneksi.php');

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($dbconnect, "select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if ($data['level'] == "admin") {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin/index.php");

		// cek jika user login sebagai pegawai
	} else if ($data['level'] == "direksi") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "direksi";
		// alihkan ke halaman dashboard pegawai
		header("location:direksi/index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "korwildua") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "korwildua";
		// alihkan ke halaman dashboard pegawai
		header("location:korwil/index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "korwilsatu") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "korwilsatu";
		// alihkan ke halaman dashboard pegawai
		header("location:korwil/index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "korwiltiga") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "korwiltiga";
		// alihkan ke halaman dashboard pegawai
		header("location:korwil/index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "AO") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "AO";
		// alihkan ke halaman dashboard pegawai
		header("location:index.php");

		// cek jika user login sebagai pengurus
	} else if ($data['level'] == "analis") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "analis";
		// alihkan ke halaman dashboard pegawai
		header("location:index.php");

		// cek jika user login sebagai pengurus
	} else {

		// alihkan ke halaman login kembali
		header("location:form-login.php?pesan=gagal");
	}
} else {
	header("location:form-login.php?pesan=gagal");
}
