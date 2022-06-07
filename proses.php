<?php

  ob_start();
  require_once('config/+koneksi.php');
  require_once('models/database.php');

  $connection = new Database($host, $user, $pass, $database);

// membaca tabel-tabel yang dipilih dari form

// membentuk string command menjalankan mysqldump
// diasumsikan file mysqldump terletak di dalam folder C:\AppServ\MySQL\bin
 
$command = "C:\AppServ\MySQL\bin\mysqldump -u".$user." -p".$pass." ".$database." ".$listTabel." > ".$database.".sql";
 
// perintah untuk menjalankan perintah mysqldump dalam shell melalui PHP
exec($command);
 
// bagian perintah untuk proses download file hasil backup.
   
header("Content-Disposition: attachment; filename=".$database.".sql");
header("Content-type: application/download");
$fp  = fopen($database.".sql", 'r');
$content = fread($fp, filesize($database.".sql"));
fclose($fp);
  
echo $content;
  
exit;
?>