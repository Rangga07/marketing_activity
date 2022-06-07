<?php
class SUR
{

	private $mysqli;


	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function tambah_survey($kode, $nama, $alamat, $nominal, $ket, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg)
	{
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO survey VALUES ('$kode', '$nama', '$alamat', '$nominal', '$ket', '$keterangan', '$foto_knj', '$tanggal', '$nama_ao', '$id_keg')") or die($db->error);
	}

	public function survey_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='Survey'AND nama_ao='$nama_ao' AND tanggal='$tgl' LIMIT 1";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function survey_detail_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM survey WHERE ao='$nama_ao' AND tgl='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}


	public function detail_full_tampil($id_keg)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM survey INNER JOIN kegiatan_awal ON survey.id_keg=kegiatan_awal.kode WHERE id_keg='$id_keg'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function report_harian($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$tanggal = $_POST['tgl'];
		$ftanggal = strtotime($tanggal);
		$ftanggal = date("Y/m/d", $ftanggal);
		$sql = "SELECT * FROM survey INNER JOIN kegiatan_awal ON survey.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND tgl = '$ftanggal'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function report_bulanan($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$sql = "SELECT * FROM survey INNER JOIN kegiatan_awal ON survey.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function full_tampil_ao($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y");
		$sql = "SELECT * FROM survey WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function hapus_survey($kode)
	{
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM survey WHERE kode='$kode'") or die($db->error);
	}

	public function detail_full_tampil_target_survey($id_keg)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_awal_survey WHERE kode_keg= '$id_keg'";
		$query = $db->query($sql) or die($db->error); 
		return $query;
	}

	public function kegiatan_awal_survey_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal_survey WHERE ao='$nama_ao' AND tgl='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	function __destruct()
	{
		$db = $this->mysqli->conn;
	}
}
