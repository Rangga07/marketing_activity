<?php
class KL {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function kegiatanlain_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");;
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='kegiatan lain' AND nama_ao='$nama_ao' AND tanggal='$tgl' ";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function kegiatanlain_tampil_admin($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");;
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='kegiatan lain'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function kegiatanlain_tampil_filter_admin($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['nama_ao'];
		$tanggal = $_POST['tanggal'];
		$ftanggal = strtotime($tanggal);
		$ftanggal = date("Y/m/d", $ftanggal);
		$sql = "SELECT * FROM kegiatan_lain WHERE ao = '$nama' AND tgl = '$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function kegiatanlain_detail_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");;
		$sql = "SELECT * FROM kegiatan_lain WHERE ao='$nama_ao' AND tgl='$tgl'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

    public function report_bulanan_kegiatanlain($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$sql = "SELECT * FROM kegiatan_lain INNER JOIN kegiatan_awal ON kegiatan_lain.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ORDER BY tgl ASC";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	public function tambah_kegiatanlain($kode, $nama_keg, $f_jam, $to_jam, $keterangan, $nama_ao, $tanggal, $id_keg) {
		$db = $this->mysqli->conn;

		$db->query("INSERT INTO kegiatan_lain VALUES ('$kode','$nama_keg','$f_jam','$to_jam','$keterangan','$nama_ao','$tanggal','$id_keg')") or die ($db->error);
	}

	public function detail_full_tampil($id_keg) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_lain INNER JOIN kegiatan_awal ON kegiatan_lain.id_keg=kegiatan_awal.kode WHERE id_keg='$id_keg'";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}

}

?>