<?php
class USR {

	private $mysqli;


	function __construct($conn) {
		$this->mysqli = $conn;
	} 


	public function tambah_users($id ,$nama, $username, $password, $level, $wilayah) {
		$db = $this->mysqli->conn;
		$pass = md5($password);
		$db->query("INSERT INTO user VALUES ('$id','$nama','$username','$pass','$level','$wilayah')") or die ($db->error);
	}

	public function users_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM user";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	

	public function users_tampil_ciwideysatu($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 1'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	public function users_tampil_ciwideydua($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 2'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	 
	public function users_tampil_ciwideytiga($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 3'";
		if($kode != null) {
			$sql .= "WHERE kode = $kode";
		}
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}
	
	public function hapus_user($id) {
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM user WHERE id = '$id'") or die ($db->error);
	}
	
	public function waktu_tampil($kode = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM akses";
		$query = $db->query($sql) or die ($db->error); 
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}

}

?>