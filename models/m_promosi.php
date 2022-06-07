<?php
class PRO
{

	private $mysqli;


	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function promosi_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='promosi' AND nama_ao='$nama_ao' AND tanggal='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function promosi_detail_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function tambah_promosi($kode, $wilayah, $nama, $alamat, $no_hp, $kep, $produk, $nominal, $keterangan, $foto_knj, $nama_ao, $tanggal, $id_keg)
	{
		$db = $this->mysqli->conn;

		$db->query("INSERT INTO promosi VALUES ('$kode','$wilayah','$nama','$alamat','$no_hp','$kep','$produk','$nominal','$keterangan','$foto_knj','$nama_ao','$tanggal','$id_keg')") or die($db->error);
	}

	public function detail_full_tampil($id_keg)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT promosi.wilayah,promosi.nama,promosi.alamat,promosi.no_hp,
				promosi.kep,promosi.produk,promosi.nominal,promosi.keterangan,promosi.ao,promosi.id_keg
				FROM promosi INNER JOIN kegiatan_awal ON promosi.id_keg=kegiatan_awal.kode WHERE id_keg='$id_keg'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}
	
	public function detail_full_tampil_bulanan($bulan, $tahun, $ao)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT promosi.wilayah,promosi.nama,promosi.alamat,promosi.no_hp,
				promosi.kep,promosi.produk,promosi.nominal,promosi.keterangan,promosi.ao,promosi.id_keg,promosi.tgl
				FROM promosi INNER JOIN kegiatan_awal 
				ON promosi.id_keg=kegiatan_awal.kode WHERE MONTH(tgl)= '$bulan' AND YEAR(tgl)='$tahun' AND ao='$ao'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function detail_full_tampil_target_promosi($id_keg)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_awal_promosi WHERE kode_keg= '$id_keg'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}
	
	public function detail_full_tampil_target_promosi_bulanan($bulan, $tahun, $ao)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_awal_promosi WHERE MONTH(tgl)= '$bulan' AND YEAR(tgl)= '$tahun' AND ao='$ao'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function full_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM promosi";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function promosi_tampil_filter_admin($kode = null)
	{
		$db = $this->mysqli->conn;
		$wilayah = $_POST['wilayah'];
		$sql = "SELECT * FROM promosi WHERE wilayah = '$wilayah'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
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
		$sql = "SELECT promosi.wilayah,promosi.nama,promosi.alamat,promosi.no_hp,
				promosi.kep,promosi.produk,promosi.nominal,promosi.keterangan,promosi.ao,promosi.id_keg,
				kegiatan_awal.nama_ao,kegiatan_awal.kode
				 FROM promosi INNER JOIN kegiatan_awal ON promosi.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND tgl = '$ftanggal'";
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
		$sql = "SELECT promosi.wilayah,promosi.nama,promosi.alamat,promosi.no_hp,
				promosi.kep,promosi.produk,promosi.nominal,promosi.keterangan,promosi.ao,promosi.id_keg,promosi.tgl,
				kegiatan_awal.nama_ao,kegiatan_awal.kode FROM promosi INNER JOIN kegiatan_awal ON promosi.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ORDER BY tgl ASC ";
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
		$sql = "SELECT * FROM promosi WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function kegiatan_awal_promosi_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal_promosi WHERE ao='$nama_ao' AND tgl='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function hapus_promosi($kode)
	{
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM promosi WHERE kode='$kode'") or die($db->error);
	}

	function __destruct()
	{
		$db = $this->mysqli->conn;
		$db->close();
	}
}
