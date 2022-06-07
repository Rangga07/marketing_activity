<head>
	<title>PERSENTASE PLAFOND</title>
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

$connection = new Database($host, $user, $pass, $database);

$keg = new RBBKRE($connection);
$users = new USR($connection);

//error_reporting(0);

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
				<div class="panel-heading" align="center"> <b>PERSENTASE BULANAN KREDIT</b></div>
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
							<td width="100px" align="center"><a href="?page=tampilan" target="_blank"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></a></td>
							</tr>-->

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
						if ($ftanggal != "" | $ftanggal_pem != "") {
							$tampil = $keg->rbb_all_tampil_bulan();
							if (mysqli_num_rows($tampil) >= 0) {
								$result = mysqli_fetch_object($tampil);
								$sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE tgl='$ftanggal'");
								$sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE tgl='$ftanggal'");
								$sql4 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE tgl='$ftanggal_pem'");
								$sql5 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE tgl='$ftanggal_pem'");
								$sql6 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total_noa FROM realisasi WHERE tgl='$ftanggal'");
								$sql7 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total_noa FROM realisasi WHERE tgl='$ftanggal_pem'");
								$sql8 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total_noa FROM pelunasan WHERE tgl='$ftanggal'");
								$sql9 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total_noa FROM pelunasan WHERE tgl='$ftanggal_pem'");
								$total = mysqli_fetch_array($sql2);
								$total2 = mysqli_fetch_array($sql3);
								$total3 = mysqli_fetch_array($sql4);
								$total4 = mysqli_fetch_array($sql5);
								$total5 = mysqli_fetch_array($sql6);
								$total6 = mysqli_fetch_array($sql7);
								$total7 = mysqli_fetch_array($sql8);
								$total8 = mysqli_fetch_array($sql9);
								
								$selisih = $total['total'] - $total2['total'];
								$per_realisasi = round($total['total'] / $result->nominal_bul * 100);
								$per_kredit = round($selisih / $result->nominal_bul * 100);
								$selisih_realisasi = $total['total'] - $total3['total'];
								$per_selisih_rea = round($selisih_realisasi / $total['total'] * 100);
								$selisih_pelunasan = $total2['total'] - $total4['total'];
								$per_selisih_pel = round($selisih_pelunasan / $total2['total'] * 100);
								$selisih_noa_realisasi = $total5['total_noa'] - $total6['total_noa'];
								$selisih_noa_pelunasan = $total7['total_noa'] - $total8['total_noa'];

								$ftanggal = date("d-m-Y", strtotime($_POST['periode']));
								$ftanggal_seb = date("d-m-Y", strtotime($_POST['pembanding']));


								echo "<hr/><table class='table1' height=120> <h3 align='center'><b>PERSENTASE KREDIT</b></h3>
										<h4 align='center'>POSISI DATA = " . $ftanggal . "</h4>
										<h4 align='center'>PEMBANDING = " . $ftanggal_seb . "</h4>
										<br>
										<h3 align='center'><b>KESELURUHAN</b></h3>
										<hr/>
										<tr>
											<th width=190> TARGET " . $nama_bulan[$result->bulan] . "</th>
                                            <td>: Rp. " . number_format($result->nominal_bul) . "</td>
											<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_kredit'><b>Pertumbuhan kredit thdp target</b><span class='percent'><br>$per_kredit %</span></div></td>
											<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_selisih_rea'><b>Pertumbuhan realisasi thdp pembanding </b><span class='percent'><br>$per_selisih_rea %</span> <br/><br/><br/><br/> Rp. " . number_format($selisih_realisasi) . "</div></td>
											<td rowspan='4' width=210><div class='easypiechart' id='easypiechart'><b>Pertumbuhan NOA realisasi thdp pembanding </b><span class='percent'><br>$selisih_noa_realisasi</span> <br/><br/><br/><br/></div></td>
											<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_selisih_pel'><b>Pertumbuhan pelunasan thdp pembanding </b><span class='percent'><br>$per_selisih_pel %</span> <br/><br/><br/><br/> Rp. " . number_format($selisih_pelunasan) . "</div></td>
											<td rowspan='4' width=210><div class='easypiechart' id='easypiechart'><b>Pertumbuhan NOA pelunasan thdp pembanding </b><span class='percent'><br>$selisih_noa_pelunasan</span> <br/><br/><br/><br/></div></td>
                                            <td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_realisasi'><b>Persentase Realisasi thdp target</b><span class='percent'><br>$per_realisasi %</span></div></td>
                                        </tr>
										<tr>	
											<th width=190> REALISASI " . $nama_bulan[$result->bulan] . "</th>
											<td class='redtext' width=170>:<b> Rp. " . number_format($total['total']) . "</b></td>
										</tr>
                                        <tr>	
											<th width=190> PELUNASAN " . $nama_bulan[$result->bulan] . "</th>
											<td class='redtext' width=117>:<b> Rp. " . number_format($total2['total']) . "</b></td>
                                        </tr>
                                        <tr>	
											<th width=190> SELISIH </th>
											<td class='redtext' width=117>:<b> Rp. " . number_format($selisih) . "</b></td>
										</tr>
										</table><br><br>";

						?>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading" align="center"> <b>CIWIDEY II</b>
				</div>
				<div class="panel-body">
					<?php
								$periode = $_POST['periode'];
								$ftanggal = date("Y/m/d", strtotime($periode));
								$pembanding = $_POST['pembanding'];
								$ftanggal_pem = date("Y/m/d", strtotime($pembanding));
								$tampil = $keg->rbb_wil_tampil_bulan_ciwideydua();
								if (mysqli_num_rows($tampil) >= 0) {
									$result = mysqli_fetch_object($tampil);
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND tgl='$ftanggal'");
									$sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND tgl='$ftanggal'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE tgl='$ftanggal'");
									$sql5 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE tgl='$ftanggal_pem' AND wilayah='Ciwidey 2'");
									$sql6 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE tgl='$ftanggal_pem' AND wilayah='Ciwidey 2'");
									$total = mysqli_fetch_array($sql2);
									$total2 = mysqli_fetch_array($sql3);
									$total3 = mysqli_fetch_array($sql4);
									$total4 = mysqli_fetch_array($sql5);
									$total5 = mysqli_fetch_array($sql6);
									$selisih = $total['total'] - $total2['total'];

									$per_realisasi = round($total['total'] / $result->nominal_wil * 100);
									$per_kredit = round($selisih / $result->nominal_wil * 100);
									$per_kontribusi = round($total['total'] / $total3['total'] * 100);
									$selisih_realisasi = $total['total'] - $total4['total'];
									$per_selisih_rea = round($selisih_realisasi / $total['total'] * 100);
									$selisih_pelunasan = $total2['total'] - $total5['total'];
									$per_selisih_pel = round($selisih_pelunasan / $total2['total'] * 100);

									echo "<table border='0' class='table1' height=90>
														<tr>
															<th width=150> Target Wilayah</th>
															<td>: Rp. " . number_format($result->nominal_wil) . "</td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_kredit'><b>Pertumbuhan kredit thdp target</b><span class='percent'><br>$per_kredit %</span></div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_selisih_rea'><b>Pertumbuhan realisasi thdp pembanding </b><span class='percent'><br>$per_selisih_rea %</span> <br/><br/><br/><br/> Rp. " . number_format($selisih_realisasi) . "</div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_selisih_pel'><b>Pertumbuhan pelunasan thdp pembanding </b><span class='percent'><br>$per_selisih_pel %</span> <br/><br/><br/><br/> Rp. " . number_format($selisih_pelunasan) . "</div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_realisasi'><b>Persentase realisasi thdp target</b><span class='percent'><br>$per_realisasi %</span></div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_kontribusi'><b>Kontribusi Wilayah thdp keseluruhan</b><span class='percent'><br>$per_kontribusi %</span></div></td>
														</tr>
														<tr>	
															<th width=150> Realisasi Wilayah</th>
															<td class='redtext' width=170>:<b> Rp. " . number_format($total['total']) . "</b></td>
                                                        </tr>
                                                        <tr>	
															<th width=150> Pelunasan Wilayah</th>
															<td class='redtext' width=170>:<b> Rp. " . number_format($total2['total']) . "</b></td>
                                                        </tr>
                                                        <tr>	
                                                            <th width=150> Selisisih</th>
                                                            <td class='redtext' width=170>:<b> Rp. " . number_format($selisih) . "</b></td>
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
									<td rowspan="2" style="width: 1cm;"><b>AO</b></td>
									<td rowspan="2" style="width: 4cm;"><b>Target RBB</b></td>
									<td colspan="5" style="background-color:yellow"><b>REALISASI</b></td>
									<td colspan="5" style="background-color:chartreuse"><b>PELUNASAN</b></td>
									<td rowspan="2" style="width: 1cm;"><b>Persentase thdp target</b></td>
									<td rowspan="2" style="width: 1cm;"><b>Persentase thdp pembanding</b></td>
									<td rowspan="2" style="width: 1cm;"><b>Kontribusi thdp wilayah</b></td>
								</tr>
								<tr>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b><i class="fa fa-line-chart"></i></b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b><i class="fa fa-line-chart"></i></b></td>
									<td style="width: 3cm;"><b>NOA</b></td>
									<td style="width: 3cm;"><b><i class="fa fa-line-chart"></i></b></td>
									<td colspan="2"><b>Nominal</b></td>
									<td style="width: 3cm;"><b><i class="fa fa-line-chart"></i></b></td>
								</tr>
							</thead>
							<?php
								$tampil = $users->users_tampil_ciwideydua();
								while ($data = $tampil->fetch_object()) {
									$periode = $_POST['periode'];
									$fperiode = date("Y", strtotime($periode));
									$bulan = date("n", strtotime($periode));
									$ao = $data->username;
									$sql = mysqli_query($dbconnect, "SELECT SUM(noa) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal'");
									$sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal'");
									$sql3 = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$fperiode' AND wilayah='Ciwidey 2'");
									$sql4 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal'");
									$sql5 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal'");
									$sql6 = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
																		WHERE nama='$ao' AND bulan='$bulan' AND periode='$fperiode' AND wilayah='Ciwidey 2'");
									$sql7 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal_pem'");
									$sql8 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND tgl='$ftanggal'");
									$sql9 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal_pem'");
									$sql10 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal_pem'");
									$sql11 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND tgl='$ftanggal_pem'");
									
									$total_noa_rea = mysqli_fetch_array($sql);
									$total_rea = mysqli_fetch_array($sql2);
									$target_rea = mysqli_fetch_array($sql3);
									$total_noa_pel = mysqli_fetch_array($sql4);
									$total_pel = mysqli_fetch_array($sql5);
									$target_pel = mysqli_fetch_array($sql6);
									$total_seb = mysqli_fetch_array($sql7);
									$total_wil = mysqli_fetch_array($sql8);
									$total_noa_rea_seb = mysqli_fetch_array($sql9);
									$total_noa_pel_seb = mysqli_fetch_array($sql10);
									$total_pel_seb = mysqli_fetch_array($sql11);
									
									$selisih_rea_noa = $total_noa_rea['total'] - $total_noa_rea_seb['total'];
									$selisih_pel_noa = $total_noa_pel['total'] - $total_noa_pel_seb['total'];
									
									$selisih_realisasi = $total_rea['total'] - $total_seb['total'];
									$selisih_pelunasan = $total_pel['total'] - $total_pel_seb['total'];

									$per_realisasi = round($total_rea['total'] / $target_rea['nominal_ao'] * 100);
									$per_selisih = round($selisih_realisasi / $total_rea['total'] * 100);
									$per_kontri = round($total_rea['total'] / $total_wil['total'] * 100);
							?>

								<tr>
									<td><?php echo $data->nama ?></td>
									<?php if (mysqli_num_rows($sql6) > 0) { ?>
										<td>Rp.<?php echo number_format($target_rea['nominal_ao']) ?></td>
									<?php } else { ?>
										<td width='5px'>TARGET BELUM DITENTUKAN</td>
									<?php } ?>
									<td align="center"><b><?php echo $total_noa_rea['total'] ?></b></td>
									
									<?php if($total_noa_rea['total'] > $total_noa_rea_seb['total']) { ?>
									<td align="center" class="redtext">+<?php echo $selisih_rea_noa ?></td>
									<?php }else if ($total_noa_rea['total'] < $total_noa_rea_seb['total']){?>
									<td align="center" class="redtext"><?php echo $selisih_rea_noa ?></td>
									<?php } else { ?>
									<td align="center" class="redtext"><?php echo $selisih_rea_noa ?></td>
									<?php }?>
									
									<td align="center" colspan="2"><b>Rp.<?php echo number_format($total_rea['total']) ?></b></td>
									<?php if($total_rea['total'] > $total_seb['total']) { ?>
									<td align="center" class="redtext">+<?php echo number_format($selisih_realisasi) ?></td>
									<?php }else if ($total_rea['total'] < $total_seb['total']){?>
									<td align="center" class="redtext"><?php echo number_format($selisih_realisasi) ?></td>
									<?php } else { ?>
									<td align="center" class="redtext"><?php echo number_format($selisih_realisasi) ?></td>
									<?php }?>
									
									<td align="center"><b><?php echo $total_noa_pel['total'] ?></b></td>
									
									<?php if($total_noa_pel['total'] > $total_noa_pel_seb['total']) { ?>
									<td align="center" class="redtext">+<?php echo $selisih_pel_noa ?></td>
									<?php }else if ($total_noa_pel['total'] < $total_noa_pel_seb['total']){?>
									<td align="center" class="redtext"><?php echo $selisih_pel_noa ?></td>
									<?php } else { ?>
									<td align="center" class="redtext"><?php echo $selisih_pel_noa ?></td>
									<?php }?>
									
									<td align="center" colspan="2"><b>Rp.<?php echo number_format($total_pel['total']) ?></b></td>
									<?php if ($total_pel['total'] > $total_pel_seb['total']) { ?>
										<td align="center" class="redtext">+<?php echo number_format($selisih_pelunasan) ?></td>
									<?php } else if ($total_pel['total'] < $total_pel_seb['total']) { ?>
										<td align="center" class="redtext"><?php echo number_format($selisih_pelunasan) ?></td>
									<?php } else { ?>
										<td align="center" class="redtext"><?php echo number_format($selisih_pelunasan) ?></td>
									<?php } ?>
									<td align="center"><?php echo $per_realisasi ?> %</td>
									<td align="center"><?php echo $per_selisih ?> %</td>
									<td align="center"><?php echo $per_kontri ?> %</td>
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
		<td colspan="7" align="center">Data RBB Belum Ditentukan Atau Data Tidak Ditemukan!</td>
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