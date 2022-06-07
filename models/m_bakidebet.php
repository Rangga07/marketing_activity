<?php
class BD {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	} 

	public function tampil_bakidebet($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT * FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetlancar($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_lancar) as total, SUM(noa_lancar) as total_noa, bk_lancar FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetdpk($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_dpk) as total, SUM(noa_dpk) as total_noa FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetkl($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_kl) as total, SUM(noa_kl) as total_noa FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetdir($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_dir) as total, SUM(noa_dir) as total_noa FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	public function tampil_bakidebetm($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_m) as total, SUM(noa_m) as total_noa FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebet_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT * FROM bakidebet WHERE tgl='$ftanggal_pem'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetlancar_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_lancar) as total, SUM(noa_lancar) as total_noa FROM bakidebet WHERE tgl='$ftanggal_pem'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetdpk_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_dpk) as total, SUM(noa_dpk) as total_noa FROM bakidebet WHERE tgl='$ftanggal_pem'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetkl_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_kl) as total, SUM(noa_kl) as total_noa FROM bakidebet WHERE tgl='$ftanggal_pem'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetdir_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_dir) as total, SUM(noa_dir) as total_noa FROM bakidebet WHERE tgl='$ftanggal_pem'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function tampil_bakidebetm_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_m) as total, SUM(noa_m) as total_noa FROM bakidebet WHERE tgl='$ftanggal_pem'";
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