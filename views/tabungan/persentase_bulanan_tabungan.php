<head>
	<title>PERSENTASE TABUNGAN</title>
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
include "../../models/m_rbb_tabungan.php";
include "../../models/m_users.php";
require_once('../../config/+koneksi.php');
require_once('../../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$keg = new RBBTAB($connection);
$users = new USR($connection);

error_reporting(0);

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
				<div class="panel-heading" align="center"> <b>PERSENTASE BULANAN TABUNGAN</b></div>
				<div class="panel-body">
					<form action="" method="POST">
						<table>
							<tr>
								<td width="950px"><label for="">Periode</label>
									<select class="form-control" name="periode" required>
										<option selected='selected' disabled>-- Pilih Tahun</option>
										<option value='2020'>2020</option>
										<option value='2021'>2021</option>
										<option value='2022'>2022</option>
										<option value='2023'>2023</option>
										<option value='2024'>2024</option>
										<option value='2025'>2025</option>
										<option value='2026'>2026</option>
										<option value='2027'>2027</option>
										<option value='2028'>2028</option>
										<option value='2030'>2029</option>
									</select><br />
								</td>
							</tr>
							<tr>
								<td width="950px"><label for="">Bulan</label>
									<select name='bulan' class="form-control" required>
										<option selected='selected' disabled>-- Pilih Bulan</option>
										<option value='1'>JANUARI</option>
										<option value='2'>FEBRUARI</option>
										<option value='3'>MARET</option>
										<option value='4'>APRIL</option>
										<option value='5'>MEI</option>
										<option value='6'>JUNI</option>
										<option value='7'>JULI</option>
										<option value='8'>AGUSTUS</option>
										<option value='9'>SEPTEMBER</option>
										<option value='10'>OKTOBER</option>
										<option value='11'>NOVEMBER</option>
										<option value='12'>DESEMBER</option>
									</select><br />
								</td>
								<td width="100px" align="center"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></td>
							</tr>

						</table>
					</form>
					<?php
					if (!isset($_POST['submit'])) {
					?>
						<?php
					} else {
						$periode_a = $_POST['periode'];
						$periode_b = $_POST['periode'];
						$bulan = $_POST['bulan'];
						if ($bulan == 1) {
							$bulan_seb = $_POST['bulan'] + 11;
							$periode_b = $_POST['periode'] - 1;
						} else {
							$bulan_seb = $_POST['bulan'] - 1;
							$periode_b = $_POST['periode'];
						}
						$nama_bulan = array('', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');
						if ($periode != "" | $bulan != "") {
							$tampil = $keg->rbb_all_tampil_bulan();
							if (mysqli_num_rows($tampil) >= 0) {
								$result = mysqli_fetch_object($tampil);
								$sql2 = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(noa_simpedik) as tnoa_simpedik,SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as tnoa_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
								$sql3 = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
								$total = mysqli_fetch_array($sql2);
								$total2 = mysqli_fetch_array($sql3);

								$selisih_pkm = $total['t_pkm'] - $total2['t_pkm'];
								$selisih_noa_pkm = $total['tnoa_pkm'] - $total2['tnoa_pkm'];
								$per_pkm = round($selisih_pkm / $total['t_pkm'] * 100);

								$selisih_sibumbung = $total['t_sibumbung'] - $total2['t_sibumbung'];
								$selisih_noa_sibumbung = $total['tnoa_sibumbung'] - $total2['tnoa_sibumbung'];
								$per_sibumbung = round($selisih_sibumbung / $total['t_sibumbung'] * 100);

								$selisih_sibumbung = $total['t_sibumbung'] - $total2['t_sibumbung'];
								$selisih_noa_sibumbung = $total['tnoa_sibumbung'] - $total2['tnoa_sibumbung'];
								$per_sibumbung = round($selisih_sibumbung / $total['t_sibumbung'] * 100);

								$selisih_simaspro = $total['t_simaspro'] - $total2['t_simaspro'];
								$selisih_noa_simaspro = $total['tnoa_simaspro'] - $total2['tnoa_simaspro'];
								$per_simaspro = round($selisih_simaspro / $total['t_simaspro'] * 100);

								$selisih_simpedik = $total['t_simpedik'] - $total2['t_simpedik'];
								$selisih_noa_simpedik = $total['tnoa_simpedik'] - $total2['tnoa_simpedik'];
								$per_simpedik = round($selisih_simpedik / $total['t_simpedik'] * 100);

								$selisih_simastu = $total['t_simastu'] - $total2['t_simastu'];
								$selisih_noa_simastu = $total['tnoa_simastu'] - $total2['tnoa_simastu'];
								$per_simastu = round($selisih_simastu / $total['t_simastu'] * 100);

								$selisih_tahara = $total['t_tahara'] - $total2['t_tahara'];
								$selisih_noa_tahara = $total['tnoa_tahara'] - $total2['tnoa_tahara'];
								$per_tahara = round($selisih_tahara / $total['t_tahara'] * 100);

								$selisih_total = $total['total'] - $total2['total'];
								$selisih_noa_total = $total['total_noa'] - $total2['total_noa'];
								$per_total = round($selisih_total / $total['total'] * 100);
								
								$per_target = round($total['total'] / $result->nominal * 100);

								$per_tab = round($selisih_total / $total['total'] * 100);

								echo "<hr/><table align='center' class='table1' border='0' height=120> <h3 align='center'><b>PERSENTASE TABUNGAN</b></h3>
										<h4 align='center'><b>POSISI DATA = </b> " . $nama_bulan[$bulan] . " " . $periode_a . "</h4>
										<h4 align='center'><b>PEMBANDING = </b>" . $nama_bulan[$bulan_seb] . " " . $periode_b  . "</h4>
										<br>
										<hr/>
										<h3 align='center'><b>KESELURUHAN</b></h3>
										<h4 align='center'><b>TARGET = </b>Rp. " . number_format($result->nominal) . "</h4>
										<tr>
										    <td rowspan='' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Persentase thdp TARGET</b><span class='percent'><br> $per_target%</span> <br/><br/><br/><br/><br/><br/><br/> </div></td>
											<td rowspan='' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total TABUNGAN thdp bulan sebelum</b><span class='percent'><br> $per_tab%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_total) . " </div></td>
                                        </tr>
                                        </table>
										<br/>
										<br/>
                                        <table border='1' class='table table-bordered table-hover table-striped table1' id='datatables' align='center'>
                                        <thead align='center'>
                                            <tr>
                                                <td rowspan=2 style=width: 1cm;><b></b></td>
                                                <td rowspan=2 style=width: 1cm;><b>NOMINAL</b></td>
                                                <td rowspan=2 style=width: 1cm;><b>NOA</b></td>
                                                <td colspan=3><b>SELISIH DENGAN PEMBANDING</b></td>
                                            </tr> 
                                            <tr>
                                                <td style='width: 3cm;'><b>Nominal</b></td>
                                                <td colspan='1'><b>NOA</b></td>	
                                                <td colspan='1'><b>%</b></td>	
                                            </tr>
                                        </thead>
                                        <tr>	
                                            <th width=190> PKM</th>
                                            <td width=200>Rp. " . number_format($total['t_pkm']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_pkm'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_pkm) . "</td>
                                            <td width=200 align='center'>$selisih_noa_pkm</td>
                                            <td width=200 align='center'><b>$per_pkm %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIBUMBUNG</th>
                                            <td width=200>Rp. " . number_format($total['t_sibumbung']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_sibumbung'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_sibumbung) . "</td>
                                            <td width=200 align='center'>$selisih_noa_sibumbung</td>
                                            <td width=200 align='center'><b>$per_sibumbung %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIMASPRO</th>
                                            <td width=200>Rp. " . number_format($total['t_simaspro']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_simaspro'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_simaspro) . "</td>
                                            <td width=200 align='center'>$selisih_noa_simaspro</td>
                                            <td width=200 align='center'><b>$per_simaspro %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIMPEDIK</th>
                                            <td width=200>Rp. " . number_format($total['t_simpedik']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_simpedik'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_simpedik) . "</td>
                                            <td width=200 align='center'>$selisih_noa_simpedik</td>
                                            <td width=200 align='center'><b>$per_simpedik %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> SIMASTU</th>
                                            <td width=200>Rp. " . number_format($total['t_simastu']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_simastu'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_simastu) . "</td>
                                            <td width=200 align='center'>$selisih_noa_simastu</td>
                                            <td width=200 align='center'><b>$per_simastu %</b></td>
										</tr>
										<tr>	
                                            <th width=190> TAHARA</th>
                                            <td width=200>Rp. " . number_format($total['t_tahara']) . "</td>
                                            <td width=200 align='center'>" . $total['tnoa_tahara'] . "</td>
                                            <td width=200>Rp. " . number_format($selisih_tahara) . "</td>
                                            <td width=200 align='center'>$selisih_noa_tahara</td>
                                            <td width=200 align='center'><b>$per_tahara %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> GRAND TOTAL TABUNGAN</th>
                                            <td width=200 class='redtext'><b>Rp. " . number_format($total['total']) . "</b></td>
                                            <td width=200 class='redtext' align='center'><b>" . $total['total_noa'] . "</b></td>
                                            <td width=200 class='redtext'><b>Rp. " . number_format($selisih_total) . "</b></td>
                                            <td width=200 class='redtext' align='center'><b>$selisih_noa_total</b></td>
                                            <td width=200 class='redtext' align='center'><b>$per_total%</b></td>
										</tr>
										</table><br><br>";


						?>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>CIWIDEY I</b>
				</div>
				<div class="panel-body">
					<?php
								$periode_a = $_POST['periode'];
								$periode_b = $_POST['periode'];
								$bulan = $_POST['bulan'];
								if ($bulan == 1) {
									$bulan_seb = $_POST['bulan'] + 11;
									$periode_b = $_POST['periode'] - 1;
								} else {
									$bulan_seb = $_POST['bulan'] - 1;
									$periode_b = $_POST['periode'];
								}
								$tampil = $keg->rbb_wil_tampil_bulan_ciwideysatu();
								if (mysqli_num_rows($tampil) >= 0) {
									$result = mysqli_fetch_object($tampil);
									$sql = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql5 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total_semua FROM tabungan WHERE YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan' ");
									$total_noa = mysqli_fetch_array($sql);
									$total = mysqli_fetch_array($sql2);
									$total_noaseb = mysqli_fetch_array($sql3);
									$total3 = mysqli_fetch_array($sql4);
									$total4 = mysqli_fetch_array($sql5);

									$nilai1 = $total['total'];
									$nilai2 = $result->nominal_wil;
									$persen = round($nilai1 / $nilai2 * 100);

									$selisih_total = $total['total'] - $total3['total'];
									$selisih_noa_total = $total_noa['total_noa'] - $total_noaseb['total_noa'];
									$per_total = round($selisih_total / $total['total'] * 100);

									$per_selisih = round($selisih_total / $total4['total'] * 100);
									$per_kontribusi = round($total['total'] / $total4['total_semua'] * 100);
									echo "<h5 align='center'><b> TARGET = </b> Rp. " . number_format($result->nominal_wil) . "</h5><hr/>
										<table align='center' class='table1' height=90>
											<tr>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL TABUNGAN</b><br><h3> Rp." . number_format($total['total']) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa['total_noa'] . "</h3><br/><br/><br/> </div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total TABUNGAN thdp bulan sebelum</b><span class='percent'><br> $per_total%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_total) . " <br/>(NOA: $selisih_noa_total)</div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontribusi%</span> <br/><br/><br/><br/><br/></div></td>
												
											</tr>
														";

									echo "
											</table><br><hr/>";
								} else {
									echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="26">
										<h4><b>SELISIH DENGAN BULAN PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #D2B48C;"><b>PKM</b></td>
									<td colspan="4" style="background-color: #00BFFF;"><b>SIBUMBUNG</b></td>
									<td colspan="4" style="background-color: #FF8C00;"><b>SIMASPRO</b></td>
									<td colspan="4" style="background-color: #6B8E23;"><b>SIMPEDIK</b></td>
									<td colspan="4" style="background-color: #9ACD32"><b>SIMASTU</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>TAHARA</b></td>
									<td rowspan="3"><b>Kontribusi thdp wilayah</b></td>
								</tr>
								<tr>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideysatu();
								while ($data = $tampil->fetch_object()) {
									$ao = $data->nama;
									$periode_a = $_POST['periode'];
									$periode_b = $_POST['periode'];
									$bulan = $_POST['bulan'];
									if ($bulan == 1) {
										$bulan_seb = $_POST['bulan'] + 11;
										$periode_b = $_POST['periode'] - 1;
									} else {
										$bulan_seb = $_POST['bulan'] - 1;
										$periode_b = $_POST['periode'];
									}
									$sql = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(noa_simastu) as tnoa_simastu,SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode_a' AND wilayah='Ciwidey 1'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");



									$total = mysqli_fetch_array($sql);
									$total_seb = mysqli_fetch_array($sql4);
									$total_wil = mysqli_fetch_array($sql2);
									$pers1 = $total['total'];
									$pers2 = $target['nominal_ao'];
									$persen_ao = round($pers1 / $pers2 * 100);

									$selisih_nom_pkm = $total['t_pkm'] - $total_seb['t_pkm'];
									$selisih_noa_pkm = $total['tnoa_pkm'] - $total_seb['tnoa_pkm'];
									$per_pkm = round($selisih_nom_pkm / $total['total'] * 100);

									$selisih_nom_sibumbung = $total['t_sibumbung'] - $total_seb['t_sibumbung'];
									$selisih_noa_sibumbung = $total['tnoa_sibumbung'] - $total_seb['tnoa_sibumbung'];
									$per_sibumbung = round($selisih_nom_sibumbung / $total['total'] * 100);

									$selisih_nom_simaspro = $total['t_simaspro'] - $total_seb['t_simaspro'];
									$selisih_noa_simaspro = $total['tnoa_simaspro'] - $total_seb['tnoa_simaspro'];
									$per_simaspro = round($selisih_nom_simaspro / $total['total'] * 100);

									$selisih_nom_simpedik = $total['t_simpedik'] - $total_seb['t_simpedik'];
									$selisih_noa_simpedik = $total['tnoa_simpedik'] - $total_seb['tnoa_simpedik'];
									$per_simpedik = round($selisih_nom_simpedik / $total['total'] * 100);

									$selisih_nom_simastu = $total['t_simastu'] - $total_seb['t_simastu'];
									$selisih_noa_simastu = $total['tnoa_simastu'] - $total_seb['tnoa_simastu'];
									$per_simastu = round($selisih_nom_simastu / $total['total'] * 100);

									$selisih_nom_tahara = $total['t_tahara'] - $total_seb['t_tahara'];
									$selisih_noa_tahara = $total['tnoa_tahara'] - $total_seb['tnoa_tahara'];
									$per_tahara = round($selisih_nom_tahara / $total['total'] * 100);

									$per_kontrib = round($total['total'] / $total_wil['total'] * 100);
							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_pkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_pkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_pkm ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_sibumbung) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_sibumbung ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_sibumbung ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simaspro) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simaspro ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simaspro ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simpedik) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simpedik ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simpedik ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simastu) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simastu ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simastu ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_tahara) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_tahara ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_tahara ?>%</b></td>
									<td colspan="2" align="center" class="redtext"><b><?php echo $per_kontrib ?> %</b></td>
								</tr>
							<?php
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>CIWIDEY II</b>
				</div>
				<div class="panel-body">
					<?php
								$periode_a = $_POST['periode'];
								$periode_b = $_POST['periode'];
								$bulan = $_POST['bulan'];
								if ($bulan == 1) {
									$bulan_seb = $_POST['bulan'] + 11;
									$periode_b = $_POST['periode'] - 1;
								} else {
									$bulan_seb = $_POST['bulan'] - 1;
									$periode_b = $_POST['periode'];
								}
								$tampil = $keg->rbb_wil_tampil_bulan_ciwideydua();
								if (mysqli_num_rows($tampil) >= 0) {
									$result = mysqli_fetch_object($tampil);
									$sql = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='ciwidey 2' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 2' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='ciwidey 2' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 2' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql5 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total_semua FROM tabungan WHERE YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan' ");
									$total_noa = mysqli_fetch_array($sql);
									$total = mysqli_fetch_array($sql2);
									$total_noaseb = mysqli_fetch_array($sql3);
									$total3 = mysqli_fetch_array($sql4);
									$total4 = mysqli_fetch_array($sql5);

									$nilai1 = $total['total'];
									$nilai2 = $result->nominal_wil;
									$persen = round($nilai1 / $nilai2 * 100);

									$selisih_total = $total['total'] - $total3['total'];
									$selisih_noa_total = $total_noa['total_noa'] - $total_noaseb['total_noa'];
									$per_total = round($selisih_total / $total['total'] * 100);

									$per_selisih = round($selisih_total / $total4['total'] * 100);
									$per_kontribusi = round($total['total'] / $total4['total_semua'] * 100);
									echo "<h5 align='center'><b> TARGET = </b> Rp. " . number_format($result->nominal_wil) . "</h5><hr/>
										<table align='center' class='table1' height=90>
											<tr>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL TABUNGAN</b><br><h3> Rp." . number_format($total['total']) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa['total_noa'] . "</h3><br/><br/><br/> </div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total TABUNGAN thdp bulan sebelum</b><span class='percent'><br> $per_total%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_total) . " <br/>(NOA: $selisih_noa_total)</div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontribusi%</span> <br/><br/><br/><br/><br/></div></td>
												
											</tr>
														";

									echo "
											</table><br><hr/>";
								} else {
									echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="26">
										<h4><b>SELISIH DENGAN BULAN PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #D2B48C;"><b>PKM</b></td>
									<td colspan="4" style="background-color: #00BFFF;"><b>SIBUMBUNG</b></td>
									<td colspan="4" style="background-color: #FF8C00;"><b>SIMASPRO</b></td>
									<td colspan="4" style="background-color: #6B8E23;"><b>SIMPEDIK</b></td>
									<td colspan="4" style="background-color: #9ACD32"><b>SIMASTU</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>TAHARA</b></td>
									<td rowspan="3"><b>Kontribusi thdp wilayah</b></td>
								</tr>
								<tr>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideydua();
								while ($data = $tampil->fetch_object()) {
									$ao = $data->nama;
									$periode_a = $_POST['periode'];
									$periode_b = $_POST['periode'];
									$bulan = $_POST['bulan'];
									if ($bulan == 1) {
										$bulan_seb = $_POST['bulan'] + 11;
										$periode_b = $_POST['periode'] - 1;
									} else {
										$bulan_seb = $_POST['bulan'] - 1;
										$periode_b = $_POST['periode'];
									}
									$sql = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(noa_simastu) as tnoa_simastu,SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 2' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode_a' AND wilayah='ciwidey 2'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");



									$total = mysqli_fetch_array($sql);
									$total_seb = mysqli_fetch_array($sql4);
									$total_wil = mysqli_fetch_array($sql2);
									$pers1 = $total['total'];
									$pers2 = $target['nominal_ao'];
									$persen_ao = round($pers1 / $pers2 * 100);

									$selisih_nom_pkm = $total['t_pkm'] - $total_seb['t_pkm'];
									$selisih_noa_pkm = $total['tnoa_pkm'] - $total_seb['tnoa_pkm'];
									$per_pkm = round($selisih_nom_pkm / $total['total'] * 100);

									$selisih_nom_sibumbung = $total['t_sibumbung'] - $total_seb['t_sibumbung'];
									$selisih_noa_sibumbung = $total['tnoa_sibumbung'] - $total_seb['tnoa_sibumbung'];
									$per_sibumbung = round($selisih_nom_sibumbung / $total['total'] * 100);

									$selisih_nom_simaspro = $total['t_simaspro'] - $total_seb['t_simaspro'];
									$selisih_noa_simaspro = $total['tnoa_simaspro'] - $total_seb['tnoa_simaspro'];
									$per_simaspro = round($selisih_nom_simaspro / $total['total'] * 100);

									$selisih_nom_simpedik = $total['t_simpedik'] - $total_seb['t_simpedik'];
									$selisih_noa_simpedik = $total['tnoa_simpedik'] - $total_seb['tnoa_simpedik'];
									$per_simpedik = round($selisih_nom_simpedik / $total['total'] * 100);

									$selisih_nom_simastu = $total['t_simastu'] - $total_seb['t_simastu'];
									$selisih_noa_simastu = $total['tnoa_simastu'] - $total_seb['tnoa_simastu'];
									$per_simastu = round($selisih_nom_simastu / $total['total'] * 100);

									$selisih_nom_tahara = $total['t_tahara'] - $total_seb['t_tahara'];
									$selisih_noa_tahara = $total['tnoa_tahara'] - $total_seb['tnoa_tahara'];
									$per_tahara = round($selisih_nom_tahara / $total['total'] * 100);

									$per_kontrib = round($total['total'] / $total_wil['total'] * 100);
							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_pkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_pkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_pkm ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_sibumbung) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_sibumbung ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_sibumbung ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simaspro) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simaspro ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simaspro ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simpedik) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simpedik ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simpedik ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simastu) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simastu ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simastu ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_tahara) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_tahara ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_tahara ?>%</b></td>
									<td colspan="2" align="center" class="redtext"><b><?php echo $per_kontrib ?> %</b></td>
								</tr>
							<?php
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>CIWIDEY III</b>
				</div>
				<div class="panel-body">
					<?php
								$periode_a = $_POST['periode'];
								$periode_b = $_POST['periode'];
								$bulan = $_POST['bulan'];
								if ($bulan == 1) {
									$bulan_seb = $_POST['bulan'] + 11;
									$periode_b = $_POST['periode'] - 1;
								} else {
									$bulan_seb = $_POST['bulan'] - 1;
									$periode_b = $_POST['periode'];
								}
								$tampil = $keg->rbb_wil_tampil_bulan_ciwideytiga();
								if (mysqli_num_rows($tampil) >= 0) {
									$result = mysqli_fetch_object($tampil);
									$sql = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='ciwidey 3' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 3' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT SUM(jumlah_noa) AS total_noa FROM tabungan WHERE wilayah='ciwidey 3' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 3' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");
									$sql5 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total_semua FROM tabungan WHERE YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan' ");
									$total_noa = mysqli_fetch_array($sql);
									$total = mysqli_fetch_array($sql2);
									$total_noaseb = mysqli_fetch_array($sql3);
									$total3 = mysqli_fetch_array($sql4);
									$total4 = mysqli_fetch_array($sql5);

									$nilai1 = $total['total'];
									$nilai2 = $result->nominal_wil;
									$persen = round($nilai1 / $nilai2 * 100);

									$selisih_total = $total['total'] - $total3['total'];
									$selisih_noa_total = $total_noa['total_noa'] - $total_noaseb['total_noa'];
									$per_total = round($selisih_total / $total['total'] * 100);

									$per_selisih = round($selisih_total / $total4['total'] * 100);
									$per_kontribusi = round($total['total'] / $total4['total_semua'] * 100);
									echo "<h5 align='center'><b> TARGET = </b> Rp. " . number_format($result->nominal_wil) . "</h5><hr/>
										<table align='center' class='table1' height=90>
											<tr>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL TABUNGAN</b><br><h3> Rp." . number_format($total['total']) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa['total_noa'] . "</h3><br/><br/><br/> </div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total TABUNGAN thdp bulan sebelum</b><span class='percent'><br> $per_total%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_total) . " <br/>(NOA: $selisih_noa_total)</div></td>
												<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontribusi%</span> <br/><br/><br/><br/><br/></div></td>
												
											</tr>
														";

									echo "
											</table><br><hr/>";
								} else {
									echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="26">
										<h4><b>SELISIH DENGAN BULAN PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #D2B48C;"><b>PKM</b></td>
									<td colspan="4" style="background-color: #00BFFF;"><b>SIBUMBUNG</b></td>
									<td colspan="4" style="background-color: #FF8C00;"><b>SIMASPRO</b></td>
									<td colspan="4" style="background-color: #6B8E23;"><b>SIMPEDIK</b></td>
									<td colspan="4" style="background-color: #9ACD32"><b>SIMASTU</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>TAHARA</b></td>
									<td rowspan="3"><b>Kontribusi thdp wilayah</b></td>
								</tr>
								<tr>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b>%</b></td>
								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideytiga();
								while ($data = $tampil->fetch_object()) {
									$ao = $data->nama;
									$periode_a = $_POST['periode'];
									$periode_b = $_POST['periode'];
									$bulan = $_POST['bulan'];
									if ($bulan == 1) {
										$bulan_seb = $_POST['bulan'] + 11;
										$periode_b = $_POST['periode'] - 1;
									} else {
										$bulan_seb = $_POST['bulan'] - 1;
										$periode_b = $_POST['periode'];
									}
									$sql = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(noa_simastu) as tnoa_simastu,SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tabungan WHERE wilayah='ciwidey 3' AND YEAR(tgl)='$periode_a' AND MONTH(tgl)='$bulan'");
									$sql3 = mysqli_query($dbconnect, "SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode_a' AND wilayah='ciwidey 3'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(pkm) as t_pkm, SUM(noa_pkm) as tnoa_pkm, SUM(sibumbung) as t_sibumbung, 
																	SUM(noa_sibumbung) as tnoa_sibumbung, SUM(simaspro) as t_simaspro, SUM(noa_simaspro) as tnoa_simaspro,
																	SUM(simpedik) as t_simpedik, SUM(simastu) as t_simastu, SUM(noa_simastu) as tnoa_simastu,
																	SUM(tahara) as t_tahara, SUM(noa_tahara) as t_tahara, SUM(jumlah) as total, SUM(jumlah_noa) as total_noa 
																	FROM tabungan WHERE wilayah='ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode_b' AND MONTH(tgl)='$bulan_seb'");



									$total = mysqli_fetch_array($sql);
									$total_seb = mysqli_fetch_array($sql4);
									$total_wil = mysqli_fetch_array($sql2);
									$pers1 = $total['total'];
									$pers2 = $target['nominal_ao'];
									$persen_ao = round($pers1 / $pers2 * 100);

									$selisih_nom_pkm = $total['t_pkm'] - $total_seb['t_pkm'];
									$selisih_noa_pkm = $total['tnoa_pkm'] - $total_seb['tnoa_pkm'];
									$per_pkm = round($selisih_nom_pkm / $total['total'] * 100);

									$selisih_nom_sibumbung = $total['t_sibumbung'] - $total_seb['t_sibumbung'];
									$selisih_noa_sibumbung = $total['tnoa_sibumbung'] - $total_seb['tnoa_sibumbung'];
									$per_sibumbung = round($selisih_nom_sibumbung / $total['total'] * 100);

									$selisih_nom_simaspro = $total['t_simaspro'] - $total_seb['t_simaspro'];
									$selisih_noa_simaspro = $total['tnoa_simaspro'] - $total_seb['tnoa_simaspro'];
									$per_simaspro = round($selisih_nom_simaspro / $total['total'] * 100);

									$selisih_nom_simpedik = $total['t_simpedik'] - $total_seb['t_simpedik'];
									$selisih_noa_simpedik = $total['tnoa_simpedik'] - $total_seb['tnoa_simpedik'];
									$per_simpedik = round($selisih_nom_simpedik / $total['total'] * 100);

									$selisih_nom_simastu = $total['t_simastu'] - $total_seb['t_simastu'];
									$selisih_noa_simastu = $total['tnoa_simastu'] - $total_seb['tnoa_simastu'];
									$per_simastu = round($selisih_nom_simastu / $total['total'] * 100);

									$selisih_nom_tahara = $total['t_tahara'] - $total_seb['t_tahara'];
									$selisih_noa_tahara = $total['tnoa_tahara'] - $total_seb['tnoa_tahara'];
									$per_tahara = round($selisih_nom_tahara / $total['total'] * 100);

									$per_kontrib = round($total['total'] / $total_wil['total'] * 100);
							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_pkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_pkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_pkm ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_sibumbung) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_sibumbung ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_sibumbung ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simaspro) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simaspro ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simaspro ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simpedik) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simpedik ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simpedik ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_simastu) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_simastu ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_simastu ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_tahara) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_tahara ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_tahara ?>%</b></td>
									<td colspan="2" align="center" class="redtext"><b><?php echo $per_kontrib ?> %</b></td>
								</tr>
							<?php
								}
							?>
						</table>
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


<script src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/chart.min.js"></script>
<script src="../assets/js/chart-data.js"></script>
<script src="../assets/js/easypiechart.js"></script>
<script src="../assets/js/easypiechart-data.js"></script>
<script src="../assets/js/bootstrap-datepicker.js"></script>
<script src="../assets/js/custom.js"></script>
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