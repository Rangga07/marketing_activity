<head>
	<title>PERSENTASE BAKIDEBET</title>
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
include "../../models/m_bakidebet_tiga.php";
include "../../models/m_bakidebet_dua.php";
include "../../models/m_bakidebet_satu.php";
include "../../models/m_bakidebet.php";
include "../../models/m_users.php";
require_once('../../config/+koneksi.php');
require_once('../../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$keg = new BD($connection);
$keg2 = new BDS($connection);
$keg3 = new BDD($connection);
$keg4 = new BDT($connection);
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
				<div class="panel-heading" align="center"> <b>PERSENTASE BULANAN BAKIDEBET</b></div>
				<div class="panel-body">
					<form action="" method="POST">
						<table>
							<tr>
								<td width="1000px"><label for="">Posisi Data</label>
									<input class="form-control" type="date" placeholder="Nominal" name="periode" id="fd"> <br />
								</td>
							</tr>
							<tr>
								<td width="1000px"><label for="">Perbandingan dengan</label>
									<input class="form-control" type="date" placeholder="Nominal" name="pembanding" id="fd"> <br />
								</td>
								<td width="100px" align="center"><a href="?page=tampilan" target="_blank"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></a></td>
							</tr>
							<!--<tr>
								<td width="1000px"><label for="">Periode</label>
								<select class="form-control" name="periode" required>
                                    <option selected='selected' disabled>-- Pilih Tahun</option>
									<option value='2019'>2019</option>
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
                                </select><br/></td>
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
                                </select><br/></td>
								<td width="100px" align="center"><a href="?page=tampilan" target="_blank"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></a></td>
							</tr> -->
						</table>
					</form>
					<?php
					if (!isset($_POST['submit'])) {
					?>
						<?php
					} else {
						$periode = $_POST['periode'];
						$ftanggal = date("Y/m/d", strtotime($periode));
						$pembanding = $_POST['pembanding'];
						$ftanggal_pem = date("Y/m/d", strtotime($pembanding));

						$nama_bulan = array('', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER');
						if ($ftanggal != "") {
							$tampil = $keg->tampil_bakidebet();
							$tampil2 = $keg->tampil_bakidebetlancar();
							$tampil3 = $keg->tampil_bakidebetdpk();
							$tampil4 = $keg->tampil_bakidebetkl();
							$tampil5 = $keg->tampil_bakidebetdir();
							$tampil6 = $keg->tampil_bakidebetm();
							$tampil_seb = $keg->tampil_bakidebetlancar_seb();
							$tampil_seb2 = $keg->tampil_bakidebetdpk_seb();
							$tampil_seb3 = $keg->tampil_bakidebetkl_seb();
							$tampil_seb4 = $keg->tampil_bakidebetdir_seb();
							$tampil_seb5 = $keg->tampil_bakidebetm_seb();
							$tampil_seb6 = $keg->tampil_bakidebet_seb();
							if (mysqli_num_rows($tampil) > 0) {
								$result = mysqli_fetch_object($tampil);
								$result2 = mysqli_fetch_object($tampil2);
								$result3 = mysqli_fetch_object($tampil3);
								$result4 = mysqli_fetch_object($tampil4);
								$result5 = mysqli_fetch_object($tampil5);
								$result6 = mysqli_fetch_object($tampil6);
								$result_seb = mysqli_fetch_object($tampil_seb);
								$result_seb2 = mysqli_fetch_object($tampil_seb2);
								$result_seb3 = mysqli_fetch_object($tampil_seb3);
								$result_seb4 = mysqli_fetch_object($tampil_seb4);
								$result_seb5 = mysqli_fetch_object($tampil_seb5);
								$result_seb6 = mysqli_fetch_object($tampil_seb6);
								$total = $result2->total + $result3->total + $result4->total + $result5->total + $result6->total;
								$total_noa = $result2->total_noa + $result3->total_noa + $result4->total_noa + $result5->total_noa + $result6->total_noa;
								$total_seb = $result_seb->total + $result_seb2->total + $result_seb3->total + $result_seb4->total + $result_seb5->total;
								$total_noa_seb = $result_seb->total_noa + $result_seb2->total_noa + $result_seb3->total_noa + $result_seb4->total_noa + $result_seb5->total_noa;

								$selisih_nom_bk = $total - $total_seb;
								$selisih_noa_bk = $total_noa - $total_noa_seb;
								$per_bk = round($selisih_nom_bk / $total * 100);

								$selisih_nom_bklancar = $result2->total - $result_seb->total;
								$selisih_noa_bklancar = $result2->total_noa - $result_seb->total_noa;
								$per_lancar = round($selisih_nom_bklancar / $result2->total * 100);

								$selisih_nom_bkdpk = $result3->total - $result_seb2->total;
								$selisih_noa_bkdpk = $result3->total_noa - $result_seb2->total_noa;
								$per_dpk = round($selisih_nom_bkdpk / $result3->total * 100);

								$selisih_nom_bkkl = $result4->total - $result_seb3->total;
								$selisih_noa_bkkl = $result4->total_noa - $result_seb3->total_noa;
								$per_kl = round($selisih_nom_bkkl / $result4->total * 100);

								$selisih_nom_bkdir = $result5->total - $result_seb4->total;
								$selisih_noa_bkdir = $result5->total_noa - $result_seb4->total_noa;
								$per_dir = round($selisih_nom_bkdir / $result5->total * 100);

								$selisih_nom_bkm = $result6->total - $result_seb5->total;
								$selisih_noa_bkm = $result6->total_noa - $result_seb5->total_noa;
								$per_m = round($selisih_nom_bkm / $result6->total * 100);

								//$selisih = $total['total'] - $total2['total'];
								//$per_realisasi = round($total['total']/$result->nominal_bul*100);
								//$per_kredit = round($selisih/$result->nominal_bul*100);
								//$selisih_realisasi = $total['total'] - $total3['total'];
								//$per_selisih_rea = round($selisih_realisasi/$total['total']*100);
								//$selisih_pelunasan = $total2['total'] - $total4['total'];
								//$per_selisih_pel = round($selisih_pelunasan/$total2['total']*100);

								$ftanggal = date("m/d/Y", strtotime($result->tgl));
								$ftanggal_seb = date("m/d/Y", strtotime($result_seb6->tgl));

								echo "<hr/><table align='center' class='table1' border='0' height=120> <h3 align='center'><b>PERSENTASE BAKIDEBET</b></h3>
										<h4 align='center'>POSISI DATA = " . $ftanggal . "</h4>
										<h4 align='center'>PEMBANDING = " . $ftanggal_seb . "</h4>
										<br>
										<hr/>
										<h3 align='center'><b>KESELURUHAN</b></h3>
										<tr>
											<td rowspan='' width=210><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total BK thdp bulan sebelum</b><span class='percent'><br> $per_bk%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_nom_bk) . " </div></td>
                                        </tr>
                                        </table>
                                        <br/>
                                        <table border='1' class='table table-bordered table-hover table-striped table1' id='datatables' align='center'>
                                        <thead align='center'>
                                            <tr>
                                                <td rowspan=2 style=width: 1cm;><b></b></td>
                                                <td rowspan=2 style=width: 1cm;><b>NOMINAL</b></td>
                                                <td rowspan=2 style=width: 1cm;><b>NOA</b></td>
                                                <td colspan=3><b>SELISIH DGN TANGGAL PEMBANDING</b></td>
                                            </tr> 
                                            <tr>
                                                <td style='width: 3cm;'><b>Nominal</b></td>
                                                <td colspan='1'><b>NOA</b></td>	
                                                <td colspan='1'><b>%</b></td>	
                                            </tr>
                                        </thead>
                                        <tr>	
                                            <th width=190> BK LANCAR</th>
                                            <td width=200>Rp. " . number_format($result2->total) . "</td>
                                            <td width=200 align='center'>$result2->total_noa</td>
                                            <td width=200>Rp. " . number_format($selisih_nom_bklancar) . "</td>
                                            <td width=200 align='center'>$selisih_noa_bklancar</td>
                                            <td width=200 class='redtext' align='center'><b>$per_lancar %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> BK DPK</th>
                                            <td width=200>Rp. " . number_format($result3->total) . "</td>
                                            <td width=200 align='center'>$result3->total_noa</td>
                                            <td width=200>Rp. " . number_format($selisih_nom_bkdpk) . "</td>
                                            <td width=200 align='center'>$selisih_noa_bkdpk</td>
                                            <td width=200 class='redtext' align='center'><b>$per_dpk %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> BK KL</th>
                                            <td width=200>Rp. " . number_format($result4->total) . "</td>
                                            <td width=200 align='center'>$result4->total_noa</td>
                                            <td width=200>Rp. " . number_format($selisih_nom_bkkl) . "</td>
                                            <td width=200 align='center'>$selisih_noa_bkkl</td>
                                            <td width=200 class='redtext' align='center'><b>$per_kl %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> BK DIRAGUKAN</th>
                                            <td width=200>Rp. " . number_format($result5->total) . "</td>
                                            <td width=200 align='center'>$result5->total_noa</td>
                                            <td width=200>Rp. " . number_format($selisih_nom_bkdir) . "</td>
                                            <td width=200 align='center'>$selisih_noa_bkdir</td>
                                            <td width=200 class='redtext' align='center'><b>$per_dir %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> BK MACET</th>
                                            <td width=200>Rp. " . number_format($result6->total) . "</td>
                                            <td width=200 align='center'>$result6->total_noa</td>
                                            <td width=200>Rp. " . number_format($selisih_nom_bkm) . "</td>
                                            <td width=200 align='center'>$selisih_noa_bkm</td>
                                            <td width=200 class='redtext' align='center'><b>$per_m %</b></td>
                                        </tr>
                                        <tr>	
                                            <th width=190> TOTAL BAKI DEBET</th>
                                            <td width=200 class='redtext'><b>Rp. " . number_format($total) . "</b></td>
                                            <td width=200 class='redtext' align='center'><b>$total_noa</b></td>
                                            <td width=200><b></b></td>
                                            <td width=200><b></b></td>
                                            <td width=200><b></b></td>
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
								$periode = $_POST['periode'];
								$ftanggal = date("Y/m/d", strtotime($periode));
								$pembanding = $_POST['pembanding'];
								$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
								$tampil = $keg2->tampil_bakidebet_ciwideysatu();
								if (mysqli_num_rows($tampil) > 0) {
									$tampil_seb = $keg2->tampil_bakidebet_ciwideysatu_seb();
									$tampil_tot = $keg2->tampil_bakidebet_total();
									$result = mysqli_fetch_object($tampil);
									$result_seb = mysqli_fetch_object($tampil_seb);
									$result_tot = mysqli_fetch_object($tampil_tot);
									$total = $result->total_lancar + $result->total_dpk + $result->total_kl + $result->total_dir + $result->total_m;
									$total_noa = $result->noa_lancar + $result->noa_dpk + $result->noa_kl + $result->noa_dir + $result->noa_m;
									$total_seb = $result_seb->total_lancar + $result_seb->total_dpk + $result_seb->total_kl + $result_seb->total_dir + $result_seb->total_m;
									$total_noa_seb = $result_seb->noa_lancar + $result_seb->noa_dpk + $result_seb->noa_kl + $result_seb->noa_dir + $result_seb->noa_m;
									$total_tot = $result_tot->total_lancar + $result_tot->total_dpk + $result_tot->total_kl + $result_tot->total_dir + $result_tot->total_m;

									$per_kontrib = round($total / $total_tot * 100);
									$selisih_nom_bk = $total - $total_seb;
									$selisih_noa_bk = $total_noa - $total_noa_seb;
									$per_bk = round($selisih_nom_bk / $total * 100);

									echo "<table align='center' class='table1' height=90>
														<tr>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL BAKIDEBET</b><br><h3> Rp." . number_format($total) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa . "</h3><br/><br/><br/> </div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total BK thdp pembanding</b><span class='percent'><br> $per_bk%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_nom_bk) . " <br/>(NOA: $selisih_noa_bk)</div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontrib%</span> <br/><br/><br/><br/><br/></div></td>
															
														</tr>
														";

									echo "
														</table><br><hr/>";
								} else {
									echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="23">
										<h4><b>SELISIH DENGAN TANGGAL PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #00FF00;"><b>BK Lancar</b></td>
									<td colspan="4" style="background-color: #32CD32;"><b>BK DPK</b></td>
									<td colspan="4" style="background-color: #4169E1;"><b>BK KL</b></td>
									<td colspan="4" style="background-color: #FF6347;"><b>BK Diragukan</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>BK Macet</b></td>
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

								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideysatu();
								while ($data = $tampil->fetch_object()) { 
									$ao = $data->username;
									$tampil2 = $keg2->tampil_bakidebetlancar_ciwideysatu($ao);
									$tampil3 = $keg2->tampil_bakidebetlancar_ciwideysatu_seb($ao);
									$tampil4 = $keg2->tampil_bakidebetdpk_ciwideysatu($ao);
									$tampil5 = $keg2->tampil_bakidebetdpk_ciwideysatu_seb($ao);
									$tampil6 = $keg2->tampil_bakidebetkl_ciwideysatu($ao);
									$tampil7 = $keg2->tampil_bakidebetkl_ciwideysatu_seb($ao);
									$tampil8 = $keg2->tampil_bakidebetdir_ciwideysatu($ao);
									$tampil9 = $keg2->tampil_bakidebetdir_ciwideysatu_seb($ao);
									$tampil10 = $keg2->tampil_bakidebetm_ciwideysatu($ao);
									$tampil11 = $keg2->tampil_bakidebetm_ciwideysatu_seb($ao);
									$result = mysqli_fetch_object($tampil2);
									$result2 = mysqli_fetch_object($tampil3);
									$result3 = mysqli_fetch_object($tampil4);
									$result4 = mysqli_fetch_object($tampil5);
									$result5 = mysqli_fetch_object($tampil6);
									$result6 = mysqli_fetch_object($tampil7);
									$result7 = mysqli_fetch_object($tampil8);
									$result8 = mysqli_fetch_object($tampil9);
									$result9 = mysqli_fetch_object($tampil10);
									$result10 = mysqli_fetch_object($tampil11);

									$selisih_nom_bk_ciwideysatu = $total - $total_seb;
									$selisih_noa_bk_ciwideysatu = $total_noa - $total_noa_seb;
									$per_bk_ciwidey_satu = round($selisih_nom_bk_ciwideysatu / $total * 100);

									$selisih_nom_bklancar = $result->total - $result2->total;
									$selisih_noa_bklancar = $result->total_noa - $result2->total_noa;
									$per_lancar = round($selisih_nom_bklancar / $result->total * 100);

									$selisih_nom_bkdpk = $result3->total - $result4->total;
									$selisih_noa_bkdpk = $result3->total_noa - $result4->total_noa;
									$per_dpk = round($selisih_nom_bkdpk / $result3->total * 100);

									$selisih_nom_bkkl = $result5->total - $result6->total;
									$selisih_noa_bkkl = $result5->total_noa - $result6->total_noa;
									$per_kl = round($selisih_nom_bkkl / $result5->total * 100);

									$selisih_nom_bkdir = $result7->total - $result8->total;
									$selisih_noa_bkdir = $result7->total_noa - $result8->total_noa;
									$per_dir = round($selisih_nom_bkdir / $result7->total * 100);

									$selisih_nom_bkm = $result9->total - $result10->total;
									$selisih_noa_bkm = $result9->total_noa - $result10->total_noa;
									$per_m = round($selisih_nom_bkm / $result9->total * 100);

									$total_ao = $result->total + $result3->total + $result5->total + $result7->total + $result9->total;
									$per_kontrib = round($total_ao / $total * 100);

							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bklancar) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bklancar ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_lancar ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdpk) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdpk ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dpk ?>%<b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkkl) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkkl ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_kl ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdir) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdir ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dir ?>%<b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_m ?>%<b></td>
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
								$periode = $_POST['periode'];
								$ftanggal = date("Y/m/d", strtotime($periode));
								$pembanding = $_POST['pembanding'];
								$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
								$tampil = $keg3->tampil_bakidebet_ciwideydua();
								if (mysqli_num_rows($tampil) > 0) {
									$tampil_seb = $keg3->tampil_bakidebet_ciwideydua_seb();
									$tampil_tot = $keg3->tampil_bakidebet_total();
									$result = mysqli_fetch_object($tampil);
									$result_seb = mysqli_fetch_object($tampil_seb);
									$result_tot = mysqli_fetch_object($tampil_tot);
									$total = $result->total_lancar + $result->total_dpk + $result->total_kl + $result->total_dir + $result->total_m;
									$total_noa = $result->noa_lancar + $result->noa_dpk + $result->noa_kl + $result->noa_dir + $result->noa_m;
									$total_seb = $result_seb->total_lancar + $result_seb->total_dpk + $result_seb->total_kl + $result_seb->total_dir + $result_seb->total_m;
									$total_noa_seb = $result_seb->noa_lancar + $result_seb->noa_dpk + $result_seb->noa_kl + $result_seb->noa_dir + $result_seb->noa_m;
									$total_tot = $result_tot->total_lancar + $result_tot->total_dpk + $result_tot->total_kl + $result_tot->total_dir + $result_tot->total_m;

									$per_kontrib = round($total / $total_tot * 100);
									$selisih_nom_bk = $total - $total_seb;
									$selisih_noa_bk = $total_noa - $total_noa_seb;
									$per_bk = round($selisih_nom_bk / $total * 100);

									echo "<table align='center' class='table1' height=90>
														<tr>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL BAKIDEBET</b><br><h3> Rp." . number_format($total) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa . "</h3><br/><br/><br/> </div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total BK thdp pembanding</b><span class='percent'><br> $per_bk%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_nom_bk) . " <br/>(NOA: $selisih_noa_bk)</div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontrib%</span> <br/><br/><br/><br/><br/></div></td>
															
														</tr>
														";

									echo "
														</table><br><hr/>";
								} else {
									echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="23">
										<h4><b>SELISIH DENGAN TANGGAL PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #00FF00;"><b>BK Lancar</b></td>
									<td colspan="4" style="background-color: #32CD32;"><b>BK DPK</b></td>
									<td colspan="4" style="background-color: #4169E1;"><b>BK KL</b></td>
									<td colspan="4" style="background-color: #FF6347;"><b>BK Diragukan</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>BK Macet</b></td>
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

								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideydua();
								while ($data = $tampil->fetch_object()) {
									$ao = $data->username;
									$tampil2 = $keg3->tampil_bakidebetlancar_ciwideydua($ao);
									$tampil3 = $keg3->tampil_bakidebetlancar_ciwideydua_seb($ao);
									$tampil4 = $keg3->tampil_bakidebetdpk_ciwideydua($ao);
									$tampil5 = $keg3->tampil_bakidebetdpk_ciwideydua_seb($ao);
									$tampil6 = $keg3->tampil_bakidebetkl_ciwideydua($ao);
									$tampil7 = $keg3->tampil_bakidebetkl_ciwideydua_seb($ao);
									$tampil8 = $keg3->tampil_bakidebetdir_ciwideydua($ao);
									$tampil9 = $keg3->tampil_bakidebetdir_ciwideydua_seb($ao);
									$tampil10 = $keg3->tampil_bakidebetm_ciwideydua($ao);
									$tampil11 = $keg3->tampil_bakidebetm_ciwideydua_seb($ao);
									$result = mysqli_fetch_object($tampil2);
									$result2 = mysqli_fetch_object($tampil3);
									$result3 = mysqli_fetch_object($tampil4);
									$result4 = mysqli_fetch_object($tampil5);
									$result5 = mysqli_fetch_object($tampil6);
									$result6 = mysqli_fetch_object($tampil7);
									$result7 = mysqli_fetch_object($tampil8);
									$result8 = mysqli_fetch_object($tampil9);
									$result9 = mysqli_fetch_object($tampil10);
									$result10 = mysqli_fetch_object($tampil11);

									$selisih_nom_bk_ciwideydua = $total - $total_seb;
									$selisih_noa_bk_ciwideydua = $total_noa - $total_noa_seb;
									$per_bk_ciwidey_satu = round($selisih_nom_bk_ciwideydua / $total * 100);

									$selisih_nom_bklancar = $result->total - $result2->total;
									$selisih_noa_bklancar = $result->total_noa - $result2->total_noa;
									$per_lancar = round($selisih_nom_bklancar / $result->total * 100);

									$selisih_nom_bkdpk = $result3->total - $result4->total;
									$selisih_noa_bkdpk = $result3->total_noa - $result4->total_noa;
									$per_dpk = round($selisih_nom_bkdpk / $result3->total * 100);

									$selisih_nom_bkkl = $result5->total - $result6->total;
									$selisih_noa_bkkl = $result5->total_noa - $result6->total_noa;
									$per_kl = round($selisih_nom_bkkl / $result5->total * 100);

									$selisih_nom_bkdir = $result7->total - $result8->total;
									$selisih_noa_bkdir = $result7->total_noa - $result8->total_noa;
									$per_dir = round($selisih_nom_bkdir / $result7->total * 100);

									$selisih_nom_bkm = $result9->total - $result10->total;
									$selisih_noa_bkm = $result9->total_noa - $result10->total_noa;
									$per_m = round($selisih_nom_bkm / $result9->total * 100);

									$total_ao = $result->total + $result3->total + $result5->total + $result7->total + $result9->total;
									$per_kontrib = round($total_ao / $total * 100);

							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bklancar) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bklancar ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_lancar ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdpk) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdpk ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dpk ?>%<b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkkl) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkkl ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_kl ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdir) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdir ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dir ?>%<b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_m ?>%<b></td>
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
								$periode = $_POST['periode'];
								$ftanggal = date("Y/m/d", strtotime($periode));
								$pembanding = $_POST['pembanding'];
								$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
								$tampil = $keg4->tampil_bakidebet_ciwideytiga();
								if (mysqli_num_rows($tampil) > 0) {
									$tampil_seb = $keg4->tampil_bakidebet_ciwideytiga_seb();
									$tampil_tot = $keg4->tampil_bakidebet_total();
									$result = mysqli_fetch_object($tampil);
									$result_seb = mysqli_fetch_object($tampil_seb);
									$result_tot = mysqli_fetch_object($tampil_tot);
									$total = $result->total_lancar + $result->total_dpk + $result->total_kl + $result->total_dir + $result->total_m;
									$total_noa = $result->noa_lancar + $result->noa_dpk + $result->noa_kl + $result->noa_dir + $result->noa_m;
									$total_seb = $result_seb->total_lancar + $result_seb->total_dpk + $result_seb->total_kl + $result_seb->total_dir + $result_seb->total_m;
									$total_noa_seb = $result_seb->noa_lancar + $result_seb->noa_dpk + $result_seb->noa_kl + $result_seb->noa_dir + $result_seb->noa_m;
									$total_tot = $result_tot->total_lancar + $result_tot->total_dpk + $result_tot->total_kl + $result_tot->total_dir + $result_tot->total_m;

									$per_kontrib = round($total / $total_tot * 100);
									$selisih_nom_bk = $total - $total_seb;
									$selisih_noa_bk = $total_noa - $total_noa_seb;
									$per_bk = round($selisih_nom_bk / $total * 100);

									echo "<table align='center' class='table1' height=90>
														<tr>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>TOTAL BAKIDEBET</b><br><h3> Rp." . number_format($total) . "</h3> <br/><b>TOTAL NOA</b><br/><h3>" . $total_noa . "</h3><br/><br/><br/> </div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Pertumbuhan total BK thdp pembanding</b><span class='percent'><br> $per_bk%</span> <br/><br/><br/><br/><br/> Rp." . number_format($selisih_nom_bk) . " <br/>(NOA: $selisih_noa_bk)</div></td>
															<td rowspan='' width=350 height=200><div class='easypiechart' id='easypiechart' data-percent=''><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br> $per_kontrib%</span> <br/><br/><br/><br/><br/></div></td>
															
														</tr>
														";

									echo "
														</table><br><hr/>";
								} else {
									echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
								}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped table1" id="datatables">
							<thead align="center">
								<tr>
									<td colspan="23">
										<h4><b>SELISIH DENGAN TANGGAL PEMBANDING</b></h4>
									</td>
								</tr>
								<tr>
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td colspan="4" style="background-color: #00FF00;"><b>BK Lancar</b></td>
									<td colspan="4" style="background-color: #32CD32;"><b>BK DPK</b></td>
									<td colspan="4" style="background-color: #4169E1;"><b>BK KL</b></td>
									<td colspan="4" style="background-color: #FF6347;"><b>BK Diragukan</b></td>
									<td colspan="4" style="background-color: #FF0000"><b>BK Macet</b></td>
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

								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideytiga();
								while ($data = $tampil->fetch_object()) {
									$ao = $data->username;
									$tampil2 = $keg4->tampil_bakidebetlancar_ciwideytiga($ao);
									$tampil3 = $keg4->tampil_bakidebetlancar_ciwideytiga_seb($ao);
									$tampil4 = $keg4->tampil_bakidebetdpk_ciwideytiga($ao);
									$tampil5 = $keg4->tampil_bakidebetdpk_ciwideytiga_seb($ao);
									$tampil6 = $keg4->tampil_bakidebetkl_ciwideytiga($ao);
									$tampil7 = $keg4->tampil_bakidebetkl_ciwideytiga_seb($ao);
									$tampil8 = $keg4->tampil_bakidebetdir_ciwideytiga($ao);
									$tampil9 = $keg4->tampil_bakidebetdir_ciwideytiga_seb($ao);
									$tampil10 = $keg4->tampil_bakidebetm_ciwideytiga($ao);
									$tampil11 = $keg4->tampil_bakidebetm_ciwideytiga_seb($ao);
									$result = mysqli_fetch_object($tampil2);
									$result2 = mysqli_fetch_object($tampil3);
									$result3 = mysqli_fetch_object($tampil4);
									$result4 = mysqli_fetch_object($tampil5);
									$result5 = mysqli_fetch_object($tampil6);
									$result6 = mysqli_fetch_object($tampil7);
									$result7 = mysqli_fetch_object($tampil8);
									$result8 = mysqli_fetch_object($tampil9);
									$result9 = mysqli_fetch_object($tampil10);
									$result10 = mysqli_fetch_object($tampil11);

									$selisih_nom_bk_ciwideytiga = $total - $total_seb;
									$selisih_noa_bk_ciwideytiga = $total_noa - $total_noa_seb;
									$per_bk_ciwidey_satu = round($selisih_nom_bk_ciwideytiga / $total * 100);

									$selisih_nom_bklancar = $result->total - $result2->total;
									$selisih_noa_bklancar = $result->total_noa - $result2->total_noa;
									$per_lancar = round($selisih_nom_bklancar / $result->total * 100);

									$selisih_nom_bkdpk = $result3->total - $result4->total;
									$selisih_noa_bkdpk = $result3->total_noa - $result4->total_noa;
									$per_dpk = round($selisih_nom_bkdpk / $result3->total * 100);

									$selisih_nom_bkkl = $result5->total - $result6->total;
									$selisih_noa_bkkl = $result5->total_noa - $result6->total_noa;
									$per_kl = round($selisih_nom_bkkl / $result5->total * 100);

									$selisih_nom_bkdir = $result7->total - $result8->total;
									$selisih_noa_bkdir = $result7->total_noa - $result8->total_noa;
									$per_dir = round($selisih_nom_bkdir / $result7->total * 100);

									$selisih_nom_bkm = $result9->total - $result10->total;
									$selisih_noa_bkm = $result9->total_noa - $result10->total_noa;
									$per_m = round($selisih_nom_bkm / $result9->total * 100);

									$total_ao = $result->total + $result3->total + $result5->total + $result7->total + $result9->total;
									$per_kontrib = round($total_ao / $total * 100);

							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bklancar) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bklancar ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_lancar ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdpk) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdpk ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dpk ?>%<b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkkl) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkkl ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_kl ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkdir) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkdir ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_dir ?>%</b></td>
									<td colspan="2" align="center"><?php echo number_format($selisih_nom_bkm) ?></td>
									<td colspan="1" align="center"><?php echo $selisih_noa_bkm ?></td>
									<td colspan="1" align="center" class="redtext"><b><?php echo $per_m ?>%</b></td>
									<td colspan="2" align="center" class="redtext"><b><?php echo $per_kontrib ?>%</b></td>
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