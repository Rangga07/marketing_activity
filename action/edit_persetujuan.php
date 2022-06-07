<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["nama_nas"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($dbconnect,"UPDATE kegiatan_awal_tagihan set nama_nas='" . $_POST["nama_nas"][$i] . "', status='" . $_POST["status"][$i] . "' WHERE kode='" . $_POST["kode"][$i] . "'");
}
echo "<script> language='javascript'>window.alert('Data Tersimpan!');
        window.location.href='../korwil/index.php?page=persetujuan';</script>";
}

?>

</div>
</form>
</body>
</html>