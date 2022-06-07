<?php
class CTK
{

    private $mysqli;


    function __construct($conn)
    {
        $this->mysqli = $conn;
    }


    public function kegiatan_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM kegiatan_awal WHERE nama_ao='$nama_ao' AND tanggal='$tgl'";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function target_tagihan_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1' ORDER BY nama_nas ASC";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function target_promosi_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM kegiatan_awal_promosi WHERE ao='$nama_ao' AND tgl='$tgl' ";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function target_survey_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM kegiatan_awal_survey WHERE ao='$nama_ao' AND tgl='$tgl' ORDER BY nama_nas ASC";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function hasil_tagihan_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1' ORDER BY nama ASC";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function hasil_promosi_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl'  ORDER BY wilayah ASC";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function hasil_survey_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM survey WHERE ao='$nama_ao' AND tgl='$tgl' ORDER BY nama ASC";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function hasil_kegiatanlain_tampil($kode = null)
    {
        $db = $this->mysqli->conn;
        $nama_ao = $_SESSION['username'];
        $tgl = date("Y/m/d");
        $sql = "SELECT * FROM kegiatan_lain WHERE ao='$nama_ao' AND tgl='$tgl'";
        if ($kode != null) {
            $sql .= "WHERE kode = $kode";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function hasil_tabungan_tampil($kode = null)
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

    function __destruct()
    {
        $db = $this->mysqli->conn;
        $db->close();
    }
}
