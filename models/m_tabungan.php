<?php
class TAB
{

	private $mysqli;


	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function tabungan_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");;
		$sql = "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='tabungan' AND nama_ao='$nama_ao' AND tanggal='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function tabungan_detail_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$tgl = date("Y/m/d");
		$sql = "SELECT * FROM tabungan WHERE ao='$nama_ao' AND tgl='$tgl'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function tambah_tabungan(
		$kode,
		$pkm,
		$noa_pkm,
		$sibumbung,
		$noa_sibumbung,
		$simaspro,
		$noa_simaspro,
		$simpedik,
		$noa_simpedik,
		$simastu,
		$noa_simastu,
		$tahara,
		$noa_tahara,
		$tanggal,
		$nama_ao,
		$id_keg,
		$wilayah
	) {
		$db = $this->mysqli->conn;
		$pkm = str_replace('.', '', $_POST['pkm']);
		$sibumbung = str_replace('.', '', $_POST['sibumbung']);
		$simaspro = str_replace('.', '', $_POST['simaspro']);
		$simpedik = str_replace('.', '', $_POST['simpedik']);
		$simastu = str_replace('.', '', $_POST['simastu']);
		$tahara = str_replace('.', '', $_POST['tahara']);
		$jumlah = $pkm + $sibumbung + $simaspro + $simpedik + $simastu + $tahara;
		$jumlah_noa = $noa_pkm + $noa_sibumbung + $noa_simaspro + $noa_simpedik + $noa_simastu + $noa_tahara;
		$db->query("INSERT INTO tabungan VALUES ('$kode','$pkm','$noa_pkm','$sibumbung','$noa_sibumbung',
												'$simaspro','$noa_simaspro','$simpedik','$noa_simpedik',
												'$simastu','$noa_simastu','$tahara','$noa_tahara','$jumlah','$jumlah_noa','$tanggal',
												'$nama_ao','$id_keg','$wilayah')") or die($db->error);
	}

	public function detail_full_tampil($id_keg)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tabungan WHERE id_keg='$id_keg'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function full_tampil($kode = null)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tabungan";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function tabungan_tampil_filter_admin($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama = $_POST['nama'];
		$sql = "SELECT * FROM tabungan WHERE nama = '$nama'";
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
		$sql = "SELECT * FROM tabungan INNER JOIN kegiatan_awal ON tabungan.id_keg=kegiatan_awal.kode WHERE ao='$nama' AND tgl = '$ftanggal'";
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
		$sql = "SELECT ao,id_keg,SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
				SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
				SUM(simpedik) as t_simpedik, SUM(noa_simpedik) as tnoa_simpedik,SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
				SUM(tahara) as t_tahara, SUM(noa_tahara) as tnoa_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
				FROM tabungan WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'";
		if ($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function users_tampil_session($kode = null)
	{
		$db = $this->mysqli->conn;
		$nama_ao = $_SESSION['username'];
		$sql = "SELECT * FROM user WHERE username='$nama_ao'";
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
		$sql = "SELECT * FROM tabungan WHERE ao='$nama_ao' AND YEAR(tgl)='$tgl'";
		$query = $db->query($sql) or die($db->error);
		return $query;
	}

	public function hapus_tabungan($kode)
	{
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM tabungan WHERE kode='$kode'") or die($db->error);
	}


	function __destruct()
	{
		$db = $this->mysqli->conn;
		$db->close();
	}
}
