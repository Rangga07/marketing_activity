<?php
class TAG {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tambah_tagihan($kode, $nama, $alamat, $kolek, $ket, $jml_pokok, $jml_bunga, $keterangan, $foto_knj, $tanggal, $nama_ao, $id_keg) {
		$db = $this->mysqli->conn;
		$jml_pokok = str_replace('.','',$_POST['jml_pokok']);
		$jml_bunga = str_replace('.','',$_POST['jml_bunga']);
		$jumlah = $jml_pokok + $jml_bunga;
		$db->query("INSERT INTO tagihan VALUES ('$kode','$nama','$alamat','$kolek','$ket','$jml_pokok','$jml_bunga', '$jumlah','$keterangan','$foto_knj','$tanggal','$nama_ao', '$id_keg')") or die ($db->error);
	}

	public function tagihan_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='tagihan'AND nama_ao='$nama_ao' AND tanggal='$tgl' LIMIT 1";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tagihan_detail_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query; 
	}

 
	public function detail_full_tampil($id_keg) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tagihan INNER JOIN kegiatan_awal ON tagihan.id_keg=kegiatan_awal.kode WHERE id_keg='$id_keg'";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	} 

	public function detail_target_tampil($id_keg) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM kegiatan_awal_tagihan INNER JOIN kegiatan_awal ON kegiatan_awal_tagihan.kode_keg=kegiatan_awal.kode WHERE kode_keg='$id_keg';";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	} 

	public function report_harian($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$tanggal = $_POST['tgl'];
		$ftanggal = strtotime($tanggal);
		$ftanggal = date("Y/m/d", $ftanggal);
		$sql = "SELECT * FROM tagihan INNER JOIN kegiatan_awal ON tagihan.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND tgl = '$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	} 
	
	public function report_bulanan($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$sql = "SELECT * FROM tagihan INNER JOIN kegiatan_awal ON tagihan.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ORDER BY tgl ASC";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	public function report_bulanan_ppob($kode = null) {
		$db = $this->mysqli->conn;
		$nama = $_POST['ao'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_ao='$nama' AND nama_kegiatan='PPOB' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' ORDER BY tanggal ASC";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function full_tampil_ao($kode=null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y");
		$sql = "SELECT * FROM tagihan WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function hapus_tagihan($kode) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM tagihan WHERE kode='$kode'") or die ($db->error);
	}

	public function kegiatan_awal_tagihan_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl'";
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
