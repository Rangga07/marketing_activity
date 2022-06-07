<?php


class BDD {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	} 

    public function tampil_bakidebet_total($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_lancar) as total_lancar, SUM(bk_dpk) as total_dpk, SUM(bk_kl) as total_kl, SUM(bk_dir) as total_dir, SUM(bk_m) as total_m,
                        SUM(noa_lancar) as noa_lancar, SUM(noa_dpk) as noa_dpk, SUM(noa_kl) as noa_kl, SUM(noa_dir) as noa_dir, SUM(noa_m) as noa_m
                FROM bakidebet WHERE tgl='$ftanggal'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }

	public function tampil_bakidebet_ciwideydua($kode = null) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_lancar) as total_lancar, SUM(bk_dpk) as total_dpk, SUM(bk_kl) as total_kl, SUM(bk_dir) as total_dir, SUM(bk_m) as total_m,
                        SUM(noa_lancar) as noa_lancar, SUM(noa_dpk) as noa_dpk, SUM(noa_kl) as noa_kl, SUM(noa_dir) as noa_dir, SUM(noa_m) as noa_m
                FROM bakidebet WHERE tgl='$ftanggal' AND wilayah='Ciwidey 2'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebet_ciwideydua_seb($kode = null) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_lancar) as total_lancar, SUM(bk_dpk) as total_dpk, SUM(bk_kl) as total_kl, SUM(bk_dir) as total_dir, SUM(bk_m) as total_m,
                        SUM(noa_lancar) as noa_lancar, SUM(noa_dpk) as noa_dpk, SUM(noa_kl) as noa_kl, SUM(noa_dir) as noa_dir, SUM(noa_m) as noa_m
                FROM bakidebet WHERE tgl='$ftanggal_pem' AND wilayah='Ciwidey 2'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

    //bk lancar Ciwidey 2
	public function tampil_bakidebetlancar_ciwideydua($ao) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_lancar) as total, SUM(noa_lancar) as total_noa, bk_lancar FROM bakidebet WHERE tgl='$ftanggal' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebetlancar_ciwideydua_seb($ao) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_lancar) as total, SUM(noa_lancar) as total_noa, bk_lancar FROM bakidebet WHERE tgl='$ftanggal_pem' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

    //bk dpk ciwidey dua
	public function tampil_bakidebetdpk_ciwideydua($ao) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_dpk) as total, SUM(noa_dpk) as total_noa, bk_dpk FROM bakidebet WHERE tgl='$ftanggal' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebetdpk_ciwideydua_seb($ao) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_dpk) as total, SUM(noa_dpk) as total_noa, bk_dpk FROM bakidebet WHERE tgl='$ftanggal_pem' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	//bk kl ciwidey dua
	public function tampil_bakidebetkl_ciwideydua($ao) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_kl) as total, SUM(noa_kl) as total_noa, bk_kl FROM bakidebet WHERE tgl='$ftanggal' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebetkl_ciwideydua_seb($ao) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_kl) as total, SUM(noa_kl) as total_noa, bk_kl FROM bakidebet WHERE tgl='$ftanggal_pem' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }

    //bk kl ciwidey dua
	public function tampil_bakidebetdir_ciwideydua($ao) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_dir) as total, SUM(noa_dir) as total_noa, bk_dir FROM bakidebet WHERE tgl='$ftanggal' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebetdir_ciwideydua_seb($ao) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_dir) as total, SUM(noa_dir) as total_noa, bk_dir FROM bakidebet WHERE tgl='$ftanggal_pem' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    //bk kl ciwidey dua
	public function tampil_bakidebetm_ciwideydua($ao) {
		$db = $this->mysqli->conn;
		$periode = $_POST['periode'];
		$ftanggal = date("Y/m/d", strtotime($periode));
		$sql = "SELECT SUM(bk_m) as total, SUM(noa_m) as total_noa, bk_m FROM bakidebet WHERE tgl='$ftanggal' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }
    
    public function tampil_bakidebetm_ciwideydua_seb($ao) {
		$db = $this->mysqli->conn;
		$pembanding = $_POST['pembanding'];
		$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
		$sql = "SELECT SUM(bk_m) as total, SUM(noa_m) as total_noa, bk_m FROM bakidebet WHERE tgl='$ftanggal_pem' AND ao='$ao'";
		
		$query = $db->query($sql) or die ($db->error); 
		return $query;
    }

	function __destruct() {
		$db = $this->mysqli->conn;
	}

}

?>