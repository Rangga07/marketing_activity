<html>
<head>
<link href="assets/css/login.css" rel="stylesheet">
<link rel="icon" href="images/logo.jpg">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> LOGIN KEGIATAN MARKETING</title>
</head>

</html>


<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<script> language='javascript'>window.alert('Username atau Password salah!');
        window.location.href='form-login.php';</script>";
		}else if($_GET['pesan']=="belum"){
      echo "<script> language='javascript'>window.alert('Login Terlebih Dahulu!');
        window.location.href='form-login.php';</script>";
    }
	}
    ?>
    
<div class="login-page">
  <div class="form">
  <img src="logo.jpg" width="80" height="80" style="display: block; margin: auto;"  />
  <p>APLIKASI KEGIATAN HARIAN</p>
  <p>PT. BPR HAYURA ARTALOLA</p>
  <hr/>
  <br/>
    <form class="login-form" action="cek_login.php" method="post">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button>login</button>
    </form>
    <br>
    <p style="font-size: 10px; display: block; margin: auto; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#DCDCDC;">Copyright © 2021 PT. BPR HAYURA ARTALOLA | IT Support</p>
  </div>
</div>

<script src="assets/js/login.js"></script>