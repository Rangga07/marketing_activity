<?php
class BUL {

	private $mysqli;


	function __construct($conn) { 
		$this->mysqli = $conn;
	}

	public function tambah_realisasi($kode, $nominal, $noa, $tanggal, $nama_ao,$wilayah) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal']);
		$db->query("INSERT INTO realisasi VALUES ('$kode','$nominal','$noa','$tanggal','$nama_ao','$wilayah')") or die ($db->error);
	}

	public function tambah_pelunasan($kode, $nominal, $noa, $tanggal, $nama_ao,$wilayah) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal']);
		$db->query("INSERT INTO pelunasan VALUES ('$kode','$nominal','$noa','$tanggal','$nama_ao','$wilayah')") or die ($db->error);
	}

	public function tambah_bakidebet($kode, $bk_lancar, $noa_lancar, $bk_dpk, $noa_dpk, $bk_kl, $noa_kl, 
	$bk_dir, $noa_dir, $bk_m, $noa_m ,$tanggal, $nama_ao ,$wilayah) {
		$db = $this->mysqli->conn;
		$bk_lancar = str_replace('.','',$_POST['bk_lancar']);
		$bk_dpk = str_replace('.','',$_POST['bk_dpk']);
		$bk_kl = str_replace('.','',$_POST['bk_kl']);
		$bk_dir = str_replace('.','',$_POST['bk_dir']);
		$bk_m = str_replace('.','',$_POST['bk_m']);
		$db->query("INSERT INTO bakidebet VALUES ('$kode','$bk_lancar','$noa_lancar','$bk_dpk','$noa_dpk','$bk_kl','$noa_kl', 
		'$bk_dir','$noa_dir','$bk_m','$noa_m','$tanggal','$nama_ao','$wilayah')") or die ($db->error);
	}

	public function users_tampil_session($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$sql = "SELECT * FROM user WHERE username='$nama_ao'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}



	function __destruct() {
		$db = $this->mysqli->conn;
	}

}

?>