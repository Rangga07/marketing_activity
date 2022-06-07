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

if(@$_GET['act'] == '') {
?>

	<style>
		.redtext{
			color: red;
		}

		.table1 {
			font-size: 13px;
		}
	</style>
	<div class="col-lg-12 main">
    <div class="row">
		</div><!--/.row-->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>PERSENTASE TAHUNAN TABUNGAN</b></div>
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
                                </select><br/></td>
								<td width="100px" align="center"><input type="submit" class="btn btn-success" name="submit" value="CETAK"></td>
							</tr>
                        </table>
					</form>
						<?php
							if(!isset($_POST['submit'])){
						?>
						<?php
							}else{
                                $periode = $_POST['periode'];
								$periode_seb = $_POST['periode']-1;
                               
								if($periode != "" | $bulan != "" ){
									$tampil = $keg->rbb_all_tampil_periode();
									if(mysqli_num_rows($tampil) >= 0){
										$result = mysqli_fetch_object($tampil);
										$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode'");
										$sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode_seb'");
										$total = mysqli_fetch_array($sql2);
										$total2 = mysqli_fetch_array($sql3);
										$nilai1 = $total['total'];
										$nilai2 = $result->nominal;
										$persen = round($nilai1/$nilai2*100);

										$selisih = $total['total'] - $total2['total'];
										$per_selisih = round($selisih/$total['total']*100);

										echo "<hr/><table class='table1' height=120> <h3 align='center'><b>PERSENTASE TABUNGAN PERIODE ".$periode = $_POST['periode']."</b></h3>
										<hr/><table height=120>
										<tr>
											<th width=200> Target Realisasi Tabungan</th>
                                            <td>: Rp. ".number_format($result->nominal)." ,-</td>
											<td rowspan='4' width=290><div class='easypiechart' id='easypiechart' data-percent='$persen'><b>Pencapaian Tabungan thdp target</b><span class='percent'><br>$persen %</span></div></td>
											<td rowspan='4' width=290><div class='easypiechart' id='easypiechart' data-percent='$per_selisih'><b>Perbandingan dgn tahun sebelumnya </b><span class='percent'><br>$per_selisih %</span> <br/><br/><br/><br/> Rp. ".number_format($selisih)."</div></td>
                                        </tr>
										<tr>	
											<th width=200> Tabungan</th>
											<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
                                        </tr>
										</table>
										<br/><br/>";

										?>
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="panel panel-success">
										<div class="panel-heading" align="center"> <b>CIWIDEY I</b>
										</div>
											<div class="panel-body">
												<?php 
                                                    $periode = $_POST['periode'];
													$periode_seb = $_POST['periode']-1;

													if(mysqli_num_rows($tampil) >= 0){
														$result = mysqli_fetch_object($tampil);
														$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode'");
														$sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode_seb'");
														$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode'");
														$total = mysqli_fetch_array($sql2);
														$total2 = mysqli_fetch_array($sql3);
														$total3 = mysqli_fetch_array($sql4);

														$nilai1 = $total['total'];
														$nilai2 = $result->nominal_wil;
														$persen = round($nilai1/$nilai2*100);

														$selisih = $total['total'] - $total2['total'];
														$per_selisih = round($selisih/$total['total']*100);
														$per_kontribusi = round($total['total']/$total3['total']*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart' data-percent='$persen'><b>Pencapaian thdp target wilayah</b><span class='percent'><br>$persen %</span></div></td>
															<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_selisih'><b>Perbandingan dgn tahun sebelumnya </b><span class='percent'><br>$per_selisih %</span> <br/><br/><br/><br/> Rp. ".number_format($selisih)."</div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_kontribusi'><b>Kontribusi wilayah thdp keseluruhan</b><span class='percent'><br>$per_kontribusi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
														</tr>
														";

														echo"
														</table><br/><hr/>";
													}else{
														echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Pencapaian thdp target</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Kontribusi thdp wilayah</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideysatu();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND periode='$periode' AND wilayah='Ciwidey 1'");
													$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode'");
													$total = mysqli_fetch_array($sql2);
													$total_wil = mysqli_fetch_array($sql4);
													$total_noa = mysqli_fetch_array($sql);
													$target = mysqli_fetch_array($sql3);
													$pers1 = $total['total'];
													$pers2 = $target['nominal_ao'];
													$persen_ao = round($pers1/$pers2*100);

													$per_kontri = round($total['total']/$total_wil['total']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
															<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
															<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
															<td class="redtext"><b><?php echo $per_kontri ?> %</b></td>
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
									<div class="panel panel-primary">
										<div class="panel-heading" align="center"> <b>CIWIDEY II</b>
										</div>
											<div class="panel-body">
												<?php 
                                                    $periode = $_POST['periode'];
													$periode_seb = $_POST['periode']-1;

													if(mysqli_num_rows($tampil) >= 0){
														$result = mysqli_fetch_object($tampil);
														$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode'");
														$sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode_seb'");
														$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode'");
														$total = mysqli_fetch_array($sql2);
														$total2 = mysqli_fetch_array($sql3);
														$total3 = mysqli_fetch_array($sql4);

														$nilai1 = $total['total'];
														$nilai2 = $result->nominal_wil;
														$persen = round($nilai1/$nilai2*100);

														$selisih = $total['total'] - $total2['total'];
														$per_selisih = round($selisih/$total['total']*100);
														$per_kontribusi = round($total['total']/$total3['total']*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart' data-percent='$persen'><b>Pencapaian thdp target wilayah</b><span class='percent'><br>$persen %</span></div></td>
															<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_selisih'><b>Perbandingan dgn tahun sebelumnya </b><span class='percent'><br>$per_selisih %</span> <br/><br/><br/><br/> Rp. ".number_format($selisih)."</div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_kontribusi'><b>Kontribusi wilayah thdp keseluruhan</b><span class='percent'><br>$per_kontribusi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
														</tr>
														";

														echo"
														</table><br/><hr/>";
													}else{
														echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Pencapaian thdp target</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Kontribusi thdp wilayah</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideydua();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND periode='$periode' AND wilayah='Ciwidey 2'");
													$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode'");
													$total = mysqli_fetch_array($sql2);
													$total_wil = mysqli_fetch_array($sql4);
													$total_noa = mysqli_fetch_array($sql);
													$target = mysqli_fetch_array($sql3);
													$pers1 = $total['total'];
													$pers2 = $target['nominal_ao'];
													$persen_ao = round($pers1/$pers2*100);

													$per_kontri = round($total['total']/$total_wil['total']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
															<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
															<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
															<td class="redtext"><b><?php echo $per_kontri ?> %</b></td>
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
									<div class="panel panel-danger">
										<div class="panel-heading" align="center"> <b>CIWIDEY III</b>
										</div>
											<div class="panel-body">
												<?php 
                                                    $periode = $_POST['periode'];
													$periode_seb = $_POST['periode']-1;

													if(mysqli_num_rows($tampil) >= 0){
														$result = mysqli_fetch_object($tampil);
														$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode'");
														$sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode_seb'");
														$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode'");
														$total = mysqli_fetch_array($sql2);
														$total2 = mysqli_fetch_array($sql3);
														$total3 = mysqli_fetch_array($sql4);

														$nilai1 = $total['total'];
														$nilai2 = $result->nominal_wil;
														$persen = round($nilai1/$nilai2*100);

														$selisih = $total['total'] - $total2['total'];
														$per_selisih = round($selisih/$total['total']*100);
														$per_kontribusi = round($total['total']/$total3['total']*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart' data-percent='$persen'><b>Pencapaian thdp target wilayah</b><span class='percent'><br>$persen %</span></div></td>
															<td rowspan='4' width=210><div class='easypiechart' id='easypiechart' data-percent='$per_selisih'><b>Perbandingan dgn tahun sebelumnya </b><span class='percent'><br>$per_selisih %</span> <br/><br/><br/><br/> Rp. ".number_format($selisih)."</div></td>
															<td rowspan='4' width=230><div class='easypiechart' id='easypiechart' data-percent='$per_kontribusi'><b>Kontribusi wilayah thdp keseluruhan</b><span class='percent'><br>$per_kontribusi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
														</tr>
														";

														echo"
														</table><br/><hr/>";
													}else{
														echo "<div class='alert bg-default' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> TARGET RBB BELUM DITENTUKAN <a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Pencapaian thdp target</b></td>
														<td rowspan="2" style="width: 1cm;"><b>Kontribusi thdp wilayah</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideytiga();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_tabungan_ao JOIN user ON rbb_tabungan_ao.id_user=user.id 
                                                                        JOIN rbb_tabungan_bul ON rbb_tabungan_ao.kode_bul=rbb_tabungan_bul.kode
                                                                        JOIN rbb_tabungan_all ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE nama='$ao' AND periode='$periode' AND wilayah='Ciwidey 3'");
													$sql4 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode'");
													$total = mysqli_fetch_array($sql2);
													$total_wil = mysqli_fetch_array($sql4);
													$total_noa = mysqli_fetch_array($sql);
													$target = mysqli_fetch_array($sql3);
													$pers1 = $total['total'];
													$pers2 = $target['nominal_ao'];
													$persen_ao = round($pers1/$pers2*100);

													$per_kontri = round($total['total']/$total_wil['total']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
															<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
															<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
															<td class="redtext"><b><?php echo $per_kontri ?> %</b></td>
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
									}else{
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
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>