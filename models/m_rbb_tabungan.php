<?php
class RBBTAB {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	} 


	public function tambah_rbb_all($kode, $periode, $nominal, $nominal2) {
		$db = $this->mysqli->conn;
		$nominal2 = $nominal;
		$periode = $_POST['periode'];
		$periode = date('Y');
		$nominal = str_replace('.','',$_POST['nominal']);
		$db->query("INSERT INTO rbb_tabungan_all VALUES ('$kode','$periode','$nominal','$nominal2')") or die ($db->error);
	}

	public function tambah_rbb_bul($kode, $bulan, $nominal, $kode_all) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal_bul']);
		$db->query("INSERT INTO rbb_tabungan_bul VALUES ('$kode','$bulan','$nominal','$kode_all')") or die ($db->error);
	}

	public function tambah_rbb_wil($kode, $wilayah, $nominal, $kode_all, $kode_bul) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal_wil']);
		$db->query("INSERT INTO rbb_tabungan_wil VALUES ('$kode','$wilayah','$nominal','$kode_all', '$kode_bul')") or die ($db->error);
	}

	public function tambah_rbb_ao($kode, $ao, $nominal, $kode_all , $kode_bul) {
		$db = $this->mysqli->conn;
		$nominal = str_replace('.','',$_POST['nominal_ao']);
		$db->query("INSERT INTO rbb_tabungan_ao VALUES ('$kode','$ao','$nominal','$kode_all','$kode_bul')") or die ($db->error);
	}

	public function rbb_all_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM rbb_tabungan_all";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_all_tampil_periode($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$sql = "SELECT * FROM rbb_tabungan_all WHERE periode='$periode'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_all_tampil_bulan($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$bulan = $_POST['bulan'];
		$sql = "SELECT * FROM rbb_tabungan_bul INNER JOIN rbb_tabungan_all ON rbb_tabungan_bul.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND bulan='$bulan'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_bul_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM rbb_tabungan_bul INNER JOIN rbb_tabungan_all ON rbb_tabungan_bul.kode_all=rbb_tabungan_all.kode";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM rbb_tabungan_wil INNER JOIN rbb_tabungan_bul ON rbb_tabungan_wil.kode_bul=rbb_tabungan_bul.kode";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query; 
	}

	public function rbb_wil_tampil_periode_ciwideysatu($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$sql = "SELECT * FROM rbb_tabungan_wil INNER JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND wilayah='Ciwidey 1'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_tampil_bulan_ciwideysatu($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$bulan = $_POST['bulan'];
		$sql = "SELECT * FROM rbb_tabungan_wil JOIN rbb_tabungan_bul ON rbb_tabungan_wil.kode_bul=rbb_tabungan_bul.kode JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND bulan='$bulan' AND wilayah='Ciwidey 1' ";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}   
	
	public function rbb_wil_tampil_periode_ciwideydua($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$sql = "SELECT * FROM rbb_tabungan_wil INNER JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND wilayah='Ciwidey 2'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_tampil_bulan_ciwideydua($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$bulan = $_POST['bulan'];
		$sql = "SELECT * FROM rbb_tabungan_wil JOIN rbb_tabungan_bul ON rbb_tabungan_wil.kode_bul=rbb_tabungan_bul.kode JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND bulan='$bulan' AND wilayah='Ciwidey 2' ";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_tampil_periode_ciwideytiga($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$sql = "SELECT * FROM rbb_tabungan_wil INNER JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND wilayah='Ciwidey 3'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_tampil_bulan_ciwideytiga($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$bulan = $_POST['bulan'];
		$sql = "SELECT * FROM rbb_tabungan_wil JOIN rbb_tabungan_bul ON rbb_tabungan_wil.kode_bul=rbb_tabungan_bul.kode JOIN rbb_tabungan_all ON rbb_tabungan_wil.kode_all=rbb_tabungan_all.kode WHERE periode='$periode' AND bulan='$bulan' AND wilayah='Ciwidey 3' ";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_wil_sum_periode_ciwideysatu($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$fperiode = strtotime($periode);
		$nperiode = date("Y", $fperiode);
		$sql = "SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND tgl='$nperiode'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function rbb_ao_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM user 
				JOIN rbb_tabungan_ao
				ON user.id=rbb_tabungan_ao.id_user
				JOIN rbb_tabungan_bul
				ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function hapus_rbb_ao($kode) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM rbb_tabungan_ao WHERE kode='$kode'") or die ($db->error);
	}
	
	function __destruct() {
		$db = $this->mysqli->conn;
	}

}

?>