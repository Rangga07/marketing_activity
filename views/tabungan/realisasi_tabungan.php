<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_rbb_tabungan.php";
include "../models/m_users.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new RBBTAB($connection);
$users = new USR($connection);

if(@$_GET['act'] == '') {
?>

	<style>
		.redtext{
			color: red;
		}
	</style>
	<script type="text/javascript">
		$( function() {
			$("#from").datepicker();
		});
	</script>
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div>
    <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">REALISASI TABUNGAN</h1>
			</div>
		</div><!--/.row-->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>PERSENTASE TABUNGAN</b></div>
					<div class="panel-body">
					<form action="" method="POST">
						<table>
							<tr>
								<td width="950px"><label for="">Periode</label>
								<select class="form-control" name="periode">
									<option selected='selected' disabled>-- Pilih Periode</option>
									<?php
									require_once('../config/+koneksi.php');
									require_once('../models/database.php');

									$sql="SELECT * FROM rbb_tabungan_all";

									$hasil=mysqli_query($dbconnect,$sql);
									$no=0;
									while ($data = mysqli_fetch_array($hasil)) {
										$no++;

										$ket="";
										if (isset($_GET['kode'])) {
											$no_id = trim($_GET['kode']);

											if ($no_id==$data['kode'])
											{
												$ket="selected";
											}
										}
										?>
										<option <?php echo $ket; ?> value="<?php echo $data['periode'];?>"><?php echo $data['periode'];?> </option>
										<?php
									}
									?>
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
								$fperiode = strtotime($periode);
								$fperiode = date("Y", $fperiode);
								if($fperiode != "" ){
									$tampil = $keg->rbb_all_tampil_periode();
									if(mysqli_num_rows($tampil) > 0){
										$result = mysqli_fetch_object($tampil);
										$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE YEAR(tgl)='$periode'");
										$total = mysqli_fetch_array($sql2);

										echo "<hr/><table width=290 height=90>
										<tr>	
											<th> Periode</th>
											<td>: $result->periode </td>
										</tr>
										<tr>
											<th> RBB Tabungan</th>
											<td>: Rp. ".number_format($result->nominal)." ,-</td>
										</tr>
										<tr>	
											<th> Realisasi</th>
											<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
										</tr>
										</table>";

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
													$fperiode = strtotime($periode);
													$fperiode = date("Y", $fperiode);
													$tampil = $keg->rbb_wil_tampil_periode_ciwideysatu();
													if(mysqli_num_rows($tampil) > 0){
														$result = mysqli_fetch_object($tampil);
														$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode'");
														$total = mysqli_fetch_array($sql2);
														$nilai1 = $total['total'];
														$nilai2 = $result->nominal_wil;
														$persen = round($nilai1/$nilai2*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='2' width=540>
															<div class='easypiechart' id='easypiechart-red' data-percent='$persen'><span class='percent'>$persen %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
															<td></td>
														</tr>
														";

														echo"
														</table><hr/>";
													}else{
														echo "<b><label class='redtext'>DATA TARGET WILAYAH BELUM DITENTUKAN !</label></b><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
														<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
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
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM user 
																		JOIN rbb_tabungan_ao 
																		ON user.id=rbb_tabungan_ao.id_user 
																		JOIN rbb_tabungan_all
																		ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE wilayah='Ciwidey 1' AND nama='$ao' AND periode='$periode'");
													$total = mysqli_fetch_array($sql2);
													$total_noa = mysqli_fetch_array($sql);
													$target = mysqli_fetch_array($sql3);
													$pers1 = $total['total'];
													$pers2 = $target['nominal_ao'];
													$persen_ao = round($pers1/$pers2*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
															<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
															<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
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
										<div class="panel-heading" align="center"><b>CIWIDEY II</b></div>
										<div class="panel-body">
											<?php 
												$periode = $_POST['periode'];
												$fperiode = strtotime($periode);
												$fperiode = date("Y", $fperiode);
												$tampil = $keg->rbb_wil_tampil_periode_ciwideydua();
												if(mysqli_num_rows($tampil) > 0){
													$result = mysqli_fetch_object($tampil);
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode'");
													$total = mysqli_fetch_array($sql2);
													$nilai1 = $total['total'];
													$nilai2 = $result->nominal_wil;
													$persen = round($nilai1/$nilai2*100);

													echo "<table height=90>
													<tr>
														<th> Target Wilayah</th>
														<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
														<td rowspan='2' width=540>
														<div class='easypiechart' id='easypiechart-blue' data-percent='$persen'><span class='percent'>$persen %</span></div></td>
													</tr>
													<tr>	
														<th> Realisasi</th>
														<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
														<td></td>
													</tr>
													</table><hr/>";
												}else{
													echo "<b><label class='redtext'>DATA TARGET WILAYAH BELUM DITENTUKAN !</label></b><br/>";
												}
											?>	
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
														<tr>
															<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
															<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
															<td colspan="3"><b>REALISASI</b></td>
															<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
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
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM user 
																		JOIN rbb_tabungan_ao 
																		ON user.id=rbb_tabungan_ao.id_user 
																		JOIN rbb_tabungan_all
																		ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																		WHERE wilayah='Ciwidey 2' AND nama='$ao' AND periode='$periode'");
													$total = mysqli_fetch_array($sql2);
													$total_noa = mysqli_fetch_array($sql);
													$target = mysqli_fetch_array($sql3);
													$pers1 = $total['total'];
													$pers2 = $target['nominal_ao'];
													$persen_ao = round($pers1/$pers2*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
															<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
															<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
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
												$fperiode = strtotime($periode);
												$fperiode = date("Y", $fperiode);
												$tampil = $keg->rbb_wil_tampil_periode_ciwideytiga();
												if(mysqli_num_rows($tampil) > 0){
													$result = mysqli_fetch_object($tampil);
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM tabungan WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode'");
													$total = mysqli_fetch_array($sql2);
													$nilai1 = $total['total'];
													$nilai2 = $result->nominal_wil;
													$persen = round($nilai1/$nilai2*100);


													echo "<table height=90>
													<tr>
														<th> Target Wilayah</th>
														<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
														<td rowspan='2' width=540>
														<div class='easypiechart' id='easypiechart-orange' data-percent='$persen'><span class='percent'>$persen %</span></div></td>
													</tr>
													<tr>	
														<th> Realisasi</th>
														<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
														<td></td>
													</tr>
													</table><hr/>";
												}else{
													echo "<b><label class='redtext'>DATA TARGET WILAYAH BELUM DITENTUKAN !</label></b><br/>";
												} 
											?>	
												<div class="table-responsive">
													<table class= "table table-bordered table-hover table-striped" id="datatables">
														<thead align="center">
															<tr>
																<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
																<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
																<td colspan="3"><b>REALISASI</b></td>
																<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
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
														$sql3 = mysqli_query($dbconnect,"SELECT * FROM user 
																			JOIN rbb_tabungan_ao 
																			ON user.id=rbb_tabungan_ao.id_user 
																			JOIN rbb_tabungan_all
																			ON rbb_tabungan_ao.kode_all=rbb_tabungan_all.kode
																			WHERE wilayah='Ciwidey 3' AND nama='$ao' AND periode='$periode'");
														$total = mysqli_fetch_array($sql2);
														$total_noa = mysqli_fetch_array($sql);
														$target = mysqli_fetch_array($sql3);
														$pers1 = $total['total'];
														$pers2 = $target['nominal_ao'];
														$persen_ao = round($pers1/$pers2*100);
														?>
														
															<tr>
																<td><?php echo $data->nama?></td>
																<td>Rp.<?php echo number_format($target['nominal_ao'])?></td>
																<td align="center" class="redtext"><b><?php echo $total_noa['total']?></b></td>
																<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total['total']) ?></b></td>
																<td class="redtext"><b><?php echo $persen_ao?> %</b></td>
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