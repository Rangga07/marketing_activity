<?php
class KA {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tambah_kegiatan($kode, $nama_kegiatan, $nominal, $noa, $nama_ao, $tanggal) {
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO kegiatan_awal VALUES ('$kode','$nama_kegiatan','$nominal','$noa','$nama_ao','$tanggal')") or die ($db->error);
	}

	public function tambah_kegiatan_ppob($kode, $nama_kegiatan, $nominal, $noa, $nama_ao, $tanggal) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal']);
		$db->query("INSERT INTO kegiatan_awal VALUES ('$kode','$nama_kegiatan','$nominal','$noa','$nama_ao','$tanggal')") or die ($db->error);
	}

    public function kegiatan_tampildet($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date('Y/m/d');
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_ao='$nama_ao' AND tanggal='$tgl'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function kegiatan_tampil_filter_admin($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['nama_ao'];
		$tanggal = $_POST['tanggal'];
		$ftanggal = strtotime($tanggal);
		$ftanggal = date("Y/m/d", $ftanggal);
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_ao = '$nama' AND tanggal = '$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function kegiatan_tampil_admin($kode = null) {
		error_reporting(0); 
		$db = $this->mysqli->conn;
		$nama = $_POST['nama_ao'];
		$tanggal = $_POST['tanggal'];
		$ftanggal = strtotime($tanggal);
		$ftanggal = date("Y/m/d", $ftanggal);
		$sql = "SELECT * FROM kegiatan_awal";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function hapus_kegiatan($kode) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM kegiatan_awal WHERE kode = '$kode'") or die ($db->error);
	}

	public function detail_full_tampil_ppob($kode){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_awal WHERE kode='$kode'";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	public function ppob_tampildet($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date('Y/m/d');
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_ao='$nama_ao' AND tanggal='$tgl' AND nama_kegiatan='PPOB'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
	}

}

?>