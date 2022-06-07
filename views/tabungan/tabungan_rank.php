<head>
    <title>PERSENTASE TABUNGAN PER WILAYAH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../../assets/css/styles.css" rel="stylesheet">
    <script src="../../assets/js/config.js"></script>
    <link rel="icon" href="../../images/logo.jpg">
    <script type="text/javascript" src="../../js/jquery-ui.js"></script>
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <script src="../../jquery.js"></script>
</head>
<?php
include "../../models/m_rbb_kredit.php";
include "../../models/m_users.php";
require_once('../../config/+koneksi.php');
require_once('../../models/database.php');
error_reporting(0);

$connection = new Database($host, $user, $pass, $database);

$keg = new RBBKRE($connection);
$users = new USR($connection);


if (@$_GET['act'] == '') {
?>

    <style>
        .redtext {
            color: red;
        }

        .table1 {
            font-size: 13px;
        }
    </style>
    <div class="col-lg-12 main">
        <div class="row">
        </div>
        <!--/.row-->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"> <b>KINERJA DESA (TABUNGAN)</b></div>
                <div class="panel-body">
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <td width="1000px"><label for="">Wilayah</label>
                                    <select class="form-control" name="wilayah">
                                        <option selected='selected' disabled>-- Pilih Wilayah</option>
                                        <?php

                                        $sql = "SELECT * FROM wilayah";

                                        $hasil = mysqli_query($dbconnect, $sql);
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($hasil)) {
                                            $no++;

                                            $ket = "";
                                            if (isset($_GET['id'])) {
                                                $id = trim($_GET['id']);

                                                if ($id == $data['id']) {
                                                    $ket = "selected";
                                                }
                                            }
                                        ?>
                                            <option <?php echo $ket; ?> value="<?php echo $data['wilayah']; ?>"><?php echo $data['wilayah'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select> <br />
                                </td>
                            </tr>
                            <tr>
                                <td width="1000px"><label for="">Posisi Data</label>
                                    <input class="form-control" type="date" placeholder="Nominal" name="periode" id="fd"> <br />
                                </td>
                            </tr>
                            <tr>
                                <td width="1000px"><label for="">Perbandingan Bulan</label>
                                    <input class="form-control" type="date" placeholder="Nominal" name="pembanding" id="fd"> <br />
                                </td>
                            </tr>
                            <tr>
                                <td width="1000px"><label for="">Perbandingan Tahun</label>
                                    <input class="form-control" type="date" placeholder="Nominal" name="pembanding_thn" id="fd"> <br />
                                </td>
                                <td width="100px" align="center"><a href="?page=tampilan" target="_blank"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></a></td>
                            </tr>
                        </table>
                    </form>
                    </form>
                    <?php
                    if (!isset($_POST['submit'])) {
                    ?>
                        <?php
                    } else {
                        $wilayah = $_POST['wilayah'];
                        $periode = $_POST['periode'];
                        $ftanggal = date("Y/m/d", strtotime($periode));
                        $bulan_pem = $_POST['pembanding'];
                        $fbulan_pem = date("Y/m/d", strtotime($bulan_pem));
                        $tahun_pem = $_POST['pembanding_thn'];
                        $ftahun_pem = date("Y/m/d", strtotime($tahun_pem));

                        $nama_bulan = array('', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');
                        if ($ftanggal != "") {
                            $sql = mysqli_query($dbconnect, "SELECT * FROM nom_tab");
                            if (mysqli_num_rows($sql) > 0) {
                                $sql2 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah'");
                                $sql3 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah'");
                                $sql4 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah'");
                                $sql5 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah'");
                                $sql6 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah'");
                                $sql7 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah'");
                                //query saldo perproduk
                                $sql8 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql9 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql10 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql11 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql12 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql13 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");
                                //query noa perproduk
                                $sql14 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql15 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql16 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql17 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql18 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql19 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftanggal' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");
                                //query saldo perproduk perbandingan bulan
                                $sql20 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql21 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql22 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql23 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql24 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql25 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");
                                //query noa perproduk perbandingan bulan
                                $sql26 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql27 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql28 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql29 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql30 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql31 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$fbulan_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");
                                //query saldo perproduk perbandingan tahun
                                $sql32 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql33 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql34 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql35 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql36 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql37 = mysqli_query($dbconnect, "SELECT SUM(SALDO) AS total FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");
                                //query noa perproduk perbandingan tahun
                                $sql38 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASPRO'");
                                $sql39 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMPEDIK'");
                                $sql40 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB PKM'");
                                $sql41 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIBUMBUNG'");
                                $sql42 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB TAHARA'");
                                $sql43 = mysqli_query($dbconnect, "SELECT * FROM nom_tab WHERE TGL_POSISI='$ftahun_pem' AND KELURAH_A='$wilayah' AND PRODUK='TAB SIMASTU'");

                                $result = mysqli_fetch_array($sql2);
                                $total_noa = mysqli_num_rows($sql3);
                                $result_bulan_seb = mysqli_fetch_array($sql4);
                                $total_noa_bulan_seb = mysqli_num_rows($sql5);
                                $result_tahun_seb = mysqli_fetch_array($sql6);
                                $total_noa_tahun_seb = mysqli_num_rows($sql7);
                                $selisih_bulan = $result['total'] - $result_bulan_seb['total'];
                                $per_bulan = round($selisih_bulan / $result['total'] * 100);
                                $selisih_noa_bulan = $total_noa - $total_noa_bulan_seb;
                                $selisih_tahun = $result['total'] - $result_tahun_seb['total'];
                                $per_tahun = round($selisih_tahun / $result['total'] * 100);
                                $selisih_noa_tahun = $total_noa - $total_noa_tahun_seb;

                                //result saldo
                                $result_simaspro = mysqli_fetch_array($sql8);
                                $result_simpedik = mysqli_fetch_array($sql9);
                                $result_pkm = mysqli_fetch_array($sql10);
                                $result_sibumbung = mysqli_fetch_array($sql11);
                                $result_tahara = mysqli_fetch_array($sql12);
                                $result_simastu = mysqli_fetch_array($sql13);
                                $result_total = $result_simaspro['total'] + $result_simpedik['total'] + $result_pkm['total'] + $result_sibumbung['total'] + $result_tahara['total'] + $result_simastu['total'];
                                //result noa
                                $noa_simaspro = mysqli_num_rows($sql14);
                                $noa_simpedik = mysqli_num_rows($sql15);
                                $noa_pkm = mysqli_num_rows($sql16);
                                $noa_sibumbung = mysqli_num_rows($sql17);
                                $noa_tahara = mysqli_num_rows($sql18);
                                $noa_simastu = mysqli_num_rows($sql19);
                                //result saldo bulan sebelum
                                $result_simaspro_bulanseb = mysqli_fetch_array($sql20);
                                $result_simpedik_bulanseb = mysqli_fetch_array($sql21);
                                $result_pkm_bulanseb = mysqli_fetch_array($sql22);
                                $result_sibumbung_bulanseb = mysqli_fetch_array($sql23);
                                $result_tahara_bulanseb = mysqli_fetch_array($sql24);
                                $result_simastu_bulanseb = mysqli_fetch_array($sql25);
                                //result noa bulan sebelum
                                $noa_simaspro_bulanseb = mysqli_num_rows($sql26);
                                $noa_simpedik_bulanseb = mysqli_num_rows($sql27);
                                $noa_pkm_bulanseb = mysqli_num_rows($sql28);
                                $noa_sibumbung_bulanseb = mysqli_num_rows($sql29);
                                $noa_tahara_bulanseb = mysqli_num_rows($sql30);
                                $noa_simastu_bulanseb = mysqli_num_rows($sql31);
                                //result saldo tahun sebelum
                                $result_simaspro_tahunseb = mysqli_fetch_array($sql32);
                                $result_simpedik_tahunseb = mysqli_fetch_array($sql33);
                                $result_pkm_tahunseb = mysqli_fetch_array($sql34);
                                $result_sibumbung_tahunseb = mysqli_fetch_array($sql35);
                                $result_tahara_tahunseb = mysqli_fetch_array($sql36);
                                $result_simastu_tahunseb = mysqli_fetch_array($sql37);
                                //result noa tahun sebelum
                                $noa_simaspro_tahunseb = mysqli_num_rows($sql38);
                                $noa_simpedik_tahunseb = mysqli_num_rows($sql39);
                                $noa_pkm_tahunseb = mysqli_num_rows($sql40);
                                $noa_sibumbung_tahunseb = mysqli_num_rows($sql41);
                                $noa_tahara_tahunseb = mysqli_num_rows($sql42);
                                $noa_simastu_tahunseb = mysqli_num_rows($sql43);
                                //persentase produk bulan sebelum
                                $selisih_simaspro_bulan = $result_simaspro['total'] - $result_simaspro_bulanseb['total'];
                                $per_simaspro_bulan = round($selisih_simaspro_bulan / $result_simaspro['total'] * 100);
                                $selisih_simpedik_bulan = $result_simpedik['total'] - $result_simpedik_bulanseb['total'];
                                $per_simpedik_bulan = round($selisih_simpedik_bulan / $result_simpedik['total'] * 100);
                                $selisih_pkm_bulan = $result_pkm['total'] - $result_pkm_bulanseb['total'];
                                $per_pkm_bulan = round($selisih_pkm_bulan / $result_pkm['total'] * 100);
                                $selisih_sibumbung_bulan = $result_sibumbung['total'] - $result_sibumbung_bulanseb['total'];
                                $per_sibumbung_bulan = round($selisih_sibumbung_bulan / $result_sibumbung['total'] * 100);
                                $selisih_tahara_bulan = $result_tahara['total'] - $result_tahara_bulanseb['total'];
                                $per_tahara_bulan = round($selisih_tahara_bulan / $result_tahara['total'] * 100);
                                $selisih_simastu_bulan = $result_simastu['total'] - $result_simastu_bulanseb['total'];
                                $per_simastu_bulan = round($selisih_simastu_bulan / $result_simastu['total'] * 100);
                                //persentase produk tahun sebelum
                                $selisih_simaspro_tahun = $result_simaspro['total'] - $result_simaspro_tahunseb['total'];
                                $per_simaspro_tahun = round($selisih_simaspro_tahun / $result_simaspro['total'] * 100);
                                $selisih_simpedik_tahun = $result_simpedik['total'] - $result_simpedik_tahunseb['total'];
                                $per_simpedik_tahun = round($selisih_simpedik_tahun / $result_simpedik['total'] * 100);
                                $selisih_pkm_tahun = $result_pkm['total'] - $result_pkm_tahunseb['total'];
                                $per_pkm_tahun = round($selisih_pkm_tahun / $result_pkm['total'] * 100);
                                $selisih_sibumbung_tahun = $result_sibumbung['total'] - $result_sibumbung_tahunseb['total'];
                                $per_sibumbung_tahun = round($selisih_sibumbung_tahun / $result_sibumbung['total'] * 100);
                                $selisih_tahara_tahun = $result_tahara['total'] - $result_tahara_tahunseb['total'];
                                $per_tahara_tahun = round($selisih_tahara_tahun / $result_tahara['total'] * 100);
                                $selisih_simastu_tahun = $result_simastu['total'] - $result_simastu_tahunseb['total'];
                                $per_simastu_tahun = round($selisih_simastu_tahun / $result_simastu['total'] * 100);
                                //selisih noa bulan sebelum
                                $selisih_noa_simaspro_bln = $noa_simaspro - $noa_simaspro_bulanseb;
                                $selisih_noa_simpedik_bln = $noa_simpedik - $noa_simpedik_bulanseb;
                                $selisih_noa_pkm_bln = $noa_pkm - $noa_pkm_bulanseb;
                                $selisih_noa_sibumbung_bln = $noa_sibumbung - $noa_sibumbung_bulanseb;
                                $selisih_noa_tahara_bln = $noa_tahara - $noa_tahara_bulanseb;
                                $selisih_noa_simastu_bln = $noa_simastu - $noa_simastu_bulanseb;
                                //selisih noa tahun sebelum
                                $selisih_noa_simaspro_thn = $noa_simaspro - $noa_simaspro_tahunseb;
                                $selisih_noa_simpedik_thn = $noa_simpedik - $noa_simpedik_tahunseb;
                                $selisih_noa_pkm_thn = $noa_pkm - $noa_pkm_tahunseb;
                                $selisih_noa_sibumbung_thn = $noa_sibumbung - $noa_sibumbung_tahunseb;
                                $selisih_noa_tahara_thn = $noa_tahara - $noa_tahara_tahunseb;
                                $selisih_noa_simastu_thn = $noa_simastu - $noa_simastu_tahunseb;





                                $ftanggal = date("d-m-Y", strtotime($_POST['periode']));
                                $fbulan_pem = date("d-m-Y", strtotime($_POST['pembanding']));
                                $ftahun_pem = date("d-m-Y", strtotime($_POST['pembanding_thn']));
                                
                                $fb = date("M", strtotime($_POST['pembanding']));
                                $ft = date("Y", strtotime($_POST['pembanding_thn']));

                                echo "<hr/><table border='0' align='center' class='table1' border='0' height=120> <h3 align='center'><b>PERSENTASE TABUNGAN WILAYAH " . $wilayah . "</b></h3>
										<h4 align='center'>POSISI DATA = " . $ftanggal . "</h4>
										<h4 align='center'>BULAN PEMBANDING = " . $fbulan_pem . "</h4>
                                        <h4 align='center'>TAHUN PEMBANDING = " . $ftahun_pem . "</h4>
										<br>
										<hr/>
										<h3 align='center'><b>KESELURUHAN</b></h3>
										<tr>
											<td rowspan='' colspan='0' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Total Saldo</b><span class='percent'><br></span> <br/><br/><h3>Rp." . number_format($result['total']) . " <h3><br/></div></td>
                                            <td rowspan='' colspan='0' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Total NOA</b><span class='percent'><br></span> <br/><br/><h3>" . $total_noa . " <h3><br/></div></td>
                                        </tr>
                                        <tr>
                                            <td rowspan='' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Persentase Tanggal Pembanding</b><span class='percent'><br></span> <h5 class='redtext'> Rp. " . number_format($selisih_bulan) . " </h5><br/><h4 class='redtext'>$per_bulan%</br>NOA : $selisih_noa_bulan</h4><br/></div></td>
                                            <td rowspan='' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Persentase Tahun Pembanding</b><span class='percent'><br></span> <h5 class='redtext'> Rp. " . number_format($selisih_tahun) . " </h5><br/><h4 class='redtext'>$per_tahun%</br>NOA : $selisih_noa_tahun</h4><br/></div></td>
                                        </tr>
                                        </table>
                                        <br/>
                                        <hr/>
                                        <br/><br><br>
                                        <table border='1' class='table table-bordered table-hover table-striped table1' id='datatables' align='center'>
                                        <thead align='center'>
                                            <tr>
                                                <td rowspan=2 style=width: 1cm;><b></b></td>
                                                <td rowspan=2 style=width: 1cm;><b>SALDO</b></td>
                                                <td rowspan=2 style=width: 1cm;><b>NOA</b></td>
                                                <td colspan=4><b>PERSENTASE BULAN " . $fb . "</b></td>
                                                <td colspan=4><b>PERSENTASE TAHUN " . $ft . " </b></td>
                                            </tr> 
                                            <tr>
                                                <td><b>Saldo</b></td>
                                                <td style='background-color:yellow'><b><b><i class='fa fa-line-chart'></i></b></td>
                                                <td colspan='1'><b>NOA</b></td>
                                                <td style='background-color:yellow'><b><b><i class='fa fa-line-chart'></i></b></td>
                                                <td colspan='1'><b>Saldo</b></td>	
                                                <td style='background-color:yellow'><b><b><i class='fa fa-line-chart'></i></b></td>
                                                <td colspan='1'><b>NOA</b></td>	
                                                <td style='background-color:yellow'><b><b><i class='fa fa-line-chart'></i></b></td>
                                            </tr>
                                        </thead>
                                        <tr>	
                                            <th width=190> SIMASPRO</th>
                                            <td width=200>Rp. " . number_format($result_simaspro['total']) . "</td>
                                            <td width=200 align='center'>$noa_simaspro</td>
                                            <td>Rp. " . number_format($result_simaspro_bulanseb['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b>$per_simaspro_bulan %</b></td>
                                            <td>$noa_simaspro_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_simaspro_bln</b></td>
                                            <td>Rp. " . number_format($result_simaspro_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $per_simaspro_tahun%</b></td>
                                            <td>$noa_simaspro_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>  $selisih_noa_simaspro_thn</b></td>
                                            
                                        </tr>
                                        <tr>	
                                            <th width=190> SIMPEDIK</th>
                                            <td width=200>Rp. " . number_format($result_simpedik['total']) . "</td>
                                            <td width=200 align='center'>$noa_simpedik</td>
                                            <td>Rp. " . number_format($result_simpedik_bulanseb['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b> $per_simpedik_bulan%</b></td>
                                            <td>$noa_simpedik_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_simpedik_bln</b></td>
                                            <td>Rp. " . number_format($result_simpedik_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $per_simpedik_tahun%</b></td>
                                            <td>$noa_simpedik_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $selisih_noa_simpedik_thn </b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> PKM</th>
                                            <td width=200>Rp. " . number_format($result_pkm['total']) . "</td>
                                            <td width=200 align='center'>$noa_pkm</td>
                                            <td>Rp. " . number_format($result_pkm_bulanseb ['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b> $per_pkm_bulan%</b></td>
                                            <td>$noa_pkm_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_pkm_bln</b></td>
                                            <td>Rp. " . number_format($result_pkm_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $per_pkm_tahun%</b></td>
                                            <td>$noa_pkm_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>  $selisih_noa_pkm_thn</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIBUMBUNG</th>
                                            <td width=200>Rp. " . number_format($result_sibumbung['total']) . "</td>
                                            <td width=200 align='center'>$noa_sibumbung</td>
                                            <td>Rp. " . number_format($result_sibumbung_bulanseb ['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b> $per_sibumbung_bulan%</b></td>
                                            <td>$noa_sibumbung_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_sibumbung_bln</b></td>
                                            <td>Rp. " . number_format($result_sibumbung_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $per_sibumbung_tahun%</b></td>
                                            <td>$noa_sibumbung_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>  $selisih_noa_sibumbung_thn</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> TAHARA</th>
                                            <td width=200>Rp. " . number_format($result_tahara['total']) . "</td>
                                            <td width=200 align='center'>$noa_tahara</td>
                                            <td>Rp. " . number_format($result_tahara_bulanseb ['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b> $per_tahara_tahun%</b></td>
                                            <td>$noa_tahara_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_tahara_bln</b></td>
                                            <td>Rp. " . number_format($result_tahara_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$per_tahara_tahun %</b></td>
                                            <td>$noa_tahara_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>  $selisih_noa_tahara_thn</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIMASTU</th>
                                            <td width=200>Rp. " . number_format($result_simastu['total']) . "</td>
                                            <td width=200 align='center'>$noa_simastu</td>
                                            <td>Rp. " . number_format($result_simastu_bulanseb ['total']) . "</td>
                                            <td width=200 align='center' class='redtext' style='background-color:yellow'><b> $per_simastu_bulan%</b></td>
                                            <td>$noa_simastu_bulanseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>$selisih_noa_simastu_bln</b></td>
                                            <td>Rp. " . number_format($result_simastu_tahunseb ['total']) . "</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b> $per_simastu_tahun%</b></td>
                                            <td>$noa_simastu_tahunseb</td>
                                            <td width=200 class='redtext' align='center' style='background-color:yellow'><b>  $selisih_noa_simastu_thn</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> TOTAL SALDO</th>
                                            <td width=200 class='redtext'><b>Rp. " . number_format($result_total) . "</b></td>
                                            <td width=200 class='redtext' align='center'><b>$total_noa</b></td>
                                            <td></td>
                                            <td width=200><b></b></td>
                                            <td></td>
                                            <td width=200><b></b></td>
                                            <td></td>
                                            <td width=200><b></b></td>
                                            <td></td>
                                            <td></td>
										</tr>
										</table><br><br>";

                        ?>
                </div>
            </div>
        </div>

    </div>
<?php
                            } else {
?>
    <td colspan="7" align="center">Data Tidak Ditemukan!</td>
<?php
                            }
                        }
                    }
?>

</div>



<?php
}

?>



<script src="../../assets/js/jquery-1.11.1.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/chart.min.js"></script>
<script src="../../assets/js/chart-data.js"></script>
<script src="../../assets/js/easypiechart.js"></script>
<script src="../../assets/js/easypiechart-data.js"></script>
<script src="../../assets/js/bootstrap-datepicker.js"></script>
<script src="../../assets/js/custom.js"></script>
<script>
    window.onload = function() {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>