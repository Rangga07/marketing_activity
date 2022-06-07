<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KEGIATAN MARKETING | ADMIN</title>
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../assets/css/datepicker3.css" rel="stylesheet">
	<link href="../../assets/css/styles.css" rel="stylesheet">
  <script src="../../assets/js/config.js"></script>
  <link rel="icon" href="../../images/logo.jpg">
  <script type="text/javascript" src="../../js/jquery-ui.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


<?php
include "../../models/m_rbb_kredit.php";
include "../../models/m_users.php";
require_once('../../config/+koneksi.php');
require_once('../../models/database.php');

$keg = new RBBKRE($dbconnect);
$users = new USR($dbconnect);

?>

	<style>
		.redtext{
			color: red;
		}
	</style>
    <div class="col-lg-12 main">
        <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">PERSENTASE BULANAN KREDIT</h1>
			</div>
		</div><!--/.row-->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center"> <b>PERSENTASE KREDIT</b></div>
					<div class="panel-body">
						<?php 
							if(@$_POST['submit']){
                                $periode = $_POST['periode'];
                                $bulan = $_POST['bulan'];
						?>
						<?php
							}else{
                                $periode = $connection->conn->real_escape_string($_POST['periode']);
                                $bulan = $connection->conn->real_escape_string($_POST['bulan']);
                                $nama_bulan = array('', 'JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER');
								if($periode != "" | $bulan != "" ){
									$tampil = $keg->rbb_all_tampil_bulan();
									if(mysqli_num_rows($tampil) > 0){
										$result = mysqli_fetch_object($tampil);
                                        $sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan' ");
                                        $sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan' ");
                                        $total = mysqli_fetch_array($sql2);
                                        $total2 = mysqli_fetch_array($sql3);
                                        $selisih = $total['total'] - $total2['total'];
                                        $per_realisasi = round($total['total']/$result->nominal_bul*100);
                                        $per_kredit = round($selisih/$result->nominal_bul*100);
                                        

                                        echo "<hr/><table height=120> <h3 align='center'><b>PERSENTASE KREDIT PERIODE $result->periode BULAN ".$nama_bulan[$result->bulan]."</b></h3>
                                        <br>
										<tr>
											<th width=200> Target Pertahun</th>
                                            <td>: Rp. ".number_format($result->nominal_bul)." ,-</td>
                                            <td rowspan='4' width=320><div class='easypiechart' id='easypiechart-red' data-percent='$per_kredit'><b>Pertumbuhan Kredit</b><span class='percent'><br>$per_kredit %</span></div></td>
                                            <td rowspan='4' width=320><div class='easypiechart' id='easypiechart' data-percent='$per_realisasi'><b>Persentase Target Realisasi</b><span class='percent'><br>$per_realisasi %</span></div></td>
                                        </tr>
										<tr>	
											<th width=200> Realisasi</th>
											<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
                                        </>
                                        <tr>	
											<th width=200> Pelunasan</th>
											<td class='redtext'>:<b> Rp. ".number_format($total2['total'])." ,-</b></td>
                                        </tr>
                                        <tr>	
											<th width=200> Selisisih</th>
											<td class='redtext'>:<b> Rp. ".number_format($selisih)." ,-</b></td>
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
                                                    $periode = $_GET['periode'];
                                                    $bulan = $_GET['bulan'];
													$tampil = $keg->rbb_wil_tampil_bulan_ciwideysatu();
													if(mysqli_num_rows($tampil) > 0){
														$result = mysqli_fetch_object($tampil);
                                                        $sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 1' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $total = mysqli_fetch_array($sql2);
                                                        $total2 = mysqli_fetch_array($sql3);
                                                        $selisih = $total['total'] - $total2['total'];
														$per_realisasi = round($total['total']/$result->nominal_wil*100);
														$per_kredit = round($selisih/$result->nominal_wil*100);
                                        
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart-teal' data-percent='$per_kredit'><b>Pertumbuhan Kredit</b><span class='percent'><br>$per_kredit %</span></div></td>
                                                            <td rowspan='4' width=360><div class='easypiechart' id='easypiechart' data-percent='$per_realisasi'><b>Persentase Target Realisasi</b><span class='percent'><br>$per_realisasi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
															<th> Pelunasan Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total2['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
                                                            <th width=200> Selisisih</th>
                                                            <td class='redtext'>:<b> Rp. ".number_format($selisih)." ,-</b></td>
                                                        </tr>
														";

														echo"
														</table><br><hr/>";
													}else{
														echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
                                                        <td colspan="3"><b>PELUNASAN</b></td>
														<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
                                                        <td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideysatu();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
                                                    $bulan = $_POST['bulan'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM realisasi WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 1'");
                                                    $sql4 = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM pelunasan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql5 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 1' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql6 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 1'");
                                                    $total_noa_rea = mysqli_fetch_array($sql);
                                                    $total_rea = mysqli_fetch_array($sql2);
                                                    $target_rea = mysqli_fetch_array($sql3);
                                                    
                                                    $total_noa_pel = mysqli_fetch_array($sql4);
                                                    $total_pel = mysqli_fetch_array($sql5);
                                                    $target_pel = mysqli_fetch_array($sql6);

                                                    $per_realisasi = round($total_rea['total']/$target_rea['nominal_ao']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>

															<?php if(mysqli_num_rows($sql6) > 0){ ?>
															<td>Rp.<?php echo number_format($target_rea['nominal_ao'])?></td>
															<?php }else{ ?> 
															<td>TARGET BELUM DITENTUKAN</td>
															<?php } ?>
															<td align="center" class="redtext"><b><?php echo $total_noa_rea['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_rea['total']) ?></b></td>
                                                            <td align="center" class="redtext"><b><?php echo $total_noa_pel['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_pel['total']) ?></b></td>
                                                            <td align="center" class="redtext" colspan="2"><b>%<?php echo $per_realisasi ?></b></td>
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
                                                    $bulan = $_POST['bulan'];
													$tampil = $keg->rbb_wil_tampil_bulan_ciwideydua();
													if(mysqli_num_rows($tampil) > 0){
														$result = mysqli_fetch_object($tampil);
                                                        $sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $total = mysqli_fetch_array($sql2);
                                                        $total2 = mysqli_fetch_array($sql3);
                                                        $selisih = $total['total'] - $total2['total'];

														$per_realisasi = round($total['total']/$result->nominal_wil*100);
														$per_kredit = round($selisih/$result->nominal_wil*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart-orange' data-percent='$per_kredit'><b>Pertumbuhan Kredit</b><span class='percent'><br>$per_kredit %</span></div></td>
                                                            <td rowspan='4' width=360><div class='easypiechart' id='easypiechart' data-percent='$per_realisasi'><b>Persentase Target Realisasi</b><span class='percent'><br>$per_realisasi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
															<th> Pelunasan Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total2['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
                                                            <th width=200> Selisisih</th>
                                                            <td class='redtext'>:<b> Rp. ".number_format($selisih)." ,-</b></td>
                                                        </tr>
														";

														echo"
														</table><br><hr/>";
													}else{
														echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
                                                        <td colspan="3"><b>PELUNASAN</b></td>
														<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
                                                        <td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideydua();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
                                                    $bulan = $_POST['bulan'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 2'");
                                                    $sql4 = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql5 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 2' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql6 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 2'");
                                                    $total_noa_rea = mysqli_fetch_array($sql);
                                                    $total_rea = mysqli_fetch_array($sql2);
                                                    $target_rea = mysqli_fetch_array($sql3);
                                                    
                                                    $total_noa_pel = mysqli_fetch_array($sql4);
                                                    $total_pel = mysqli_fetch_array($sql5);
                                                    $target_pel = mysqli_fetch_array($sql6);

                                                    $per_realisasi = round($total_rea['total']/$target_rea['nominal_ao']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<?php if(mysqli_num_rows($sql6) > 0){ ?>
															<td>Rp.<?php echo number_format($target_rea['nominal_ao'])?></td>
															<?php }else{ ?> 
															<td>TARGET BELUM DITENTUKAN</td>
															<?php } ?>
															<td align="center" class="redtext"><b><?php echo $total_noa_rea['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_rea['total']) ?></b></td>
                                                            <td align="center" class="redtext"><b><?php echo $total_noa_pel['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_pel['total']) ?></b></td>
                                                            <td align="center" class="redtext" colspan="2"><b>%<?php echo $per_realisasi ?></b></td>
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
                                                    $bulan = $_POST['bulan'];
													$tampil = $keg->rbb_wil_tampil_bulan_ciwideytiga();
													if(mysqli_num_rows($tampil) > 0){
														$result = mysqli_fetch_object($tampil);
                                                        $sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $sql3 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 3' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                        $total = mysqli_fetch_array($sql2);
                                                        $total2 = mysqli_fetch_array($sql3);
                                                        $selisih = $total['total'] - $total2['total'];

														$per_realisasi = round($total['total']/$result->nominal_wil*100);
														$per_kredit = round($selisih/$result->nominal_wil*100);
														echo "<table height=90>
														<tr>
															<th> Target Wilayah</th>
															<td>: Rp. ".number_format($result->nominal_wil)." ,-</td>
															<td rowspan='4' width=320><div class='easypiechart' id='easypiechart-blue' data-percent='$per_kredit'><b>Pertumbuhan Kredit</b><span class='percent'><br>$per_kredit %</span></div></td>
                                                            <td rowspan='4' width=360><div class='easypiechart' id='easypiechart-red' data-percent='$per_realisasi'><b>Persentase Target Realisasi</b><span class='percent'><br>$per_realisasi %</span></div></td>
														</tr>
														<tr>	
															<th> Realisasi Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
															<th> Pelunasan Wilayah</th>
															<td class='redtext'>:<b> Rp. ".number_format($total2['total'])." ,-</b></td>
                                                        </tr>
                                                        <tr>	
                                                            <th width=200> Selisisih</th>
                                                            <td class='redtext'>:<b> Rp. ".number_format($selisih)." ,-</b></td>
                                                        </tr>
														";

														echo"
														</table><br><hr/>";
													}else{
														echo "<div class='alert bg-primary' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> DATA TARGET WILAYAH BELUM DITENTUKAN <a href='#' class='pull-right'></a></div><br/>";
													}
												?>
											<div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead align="center">
													<tr>
														<td rowspan="2" style="width: 5cm;"><b>AO</b></td>
														<td rowspan="2" style="width: 6cm;"><b>Target RBB</b></td>
														<td colspan="3"><b>REALISASI</b></td>
                                                        <td colspan="3"><b>PELUNASAN</b></td>
														<td rowspan="2" style="width: 1cm;"><b>PERSENTASE/AO</b></td>
													</tr> 
													<tr>
														<td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
                                                        <td style="width: 3cm;"><b>NOA</b></td>
														<td colspan="2"><b>NOMINAL</b></td>	
													</tr>
                                                    </thead>
													<?php
                                                    $tampil = $users->users_tampil_ciwideytiga();
													while($data = $tampil->fetch_object()) { 
													$ao = $data->nama;
                                                    $periode = $_POST['periode'];
                                                    $bulan = $_POST['bulan'];
													$sql = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM realisasi WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM realisasi WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
													$sql3 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 3'");
                                                    $sql4 = mysqli_query($dbconnect,"SELECT SUM(noa) AS total FROM pelunasan WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql5 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM pelunasan WHERE wilayah='Ciwidey 3' AND ao='$ao' AND YEAR(tgl)='$periode' AND MONTH(tgl)='$bulan'");
                                                    $sql6 = mysqli_query($dbconnect,"SELECT * FROM rbb_kredit_ao JOIN user ON rbb_kredit_ao.id_user=user.id 
                                                                        JOIN rbb_kredit_bul ON rbb_kredit_ao.kode_bul=rbb_kredit_bul.kode
                                                                        JOIN rbb_kredit_all ON rbb_kredit_ao.kode_all=rbb_kredit_all.kode
                                                                        WHERE nama='$ao' AND bulan='$bulan' AND periode='$periode' AND wilayah='Ciwidey 3'");
                                                    $total_noa_rea = mysqli_fetch_array($sql);
                                                    $total_rea = mysqli_fetch_array($sql2);
                                                    $target_rea = mysqli_fetch_array($sql3);
                                                    
                                                    $total_noa_pel = mysqli_fetch_array($sql4);
                                                    $total_pel = mysqli_fetch_array($sql5);
                                                    $target_pel = mysqli_fetch_array($sql6);

                                                    $per_realisasi = round($total_rea['total']/$target_rea['nominal_ao']*100);
													?>
													
														<tr>
															<td><?php echo $data->nama?></td>
															<?php if(mysqli_num_rows($sql6) > 0){ ?>
															<td>Rp.<?php echo number_format($target_rea['nominal_ao'])?></td>
															<?php }else{ ?> 
															<td>TARGET BELUM DITENTUKAN</td>
															<?php } ?>
															<td align="center" class="redtext"><b><?php echo $total_noa_rea['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_rea['total']) ?></b></td>
                                                            <td align="center" class="redtext"><b><?php echo $total_noa_pel['total']?></b></td>
															<td align="center" class="redtext" colspan="2"><b>Rp.<?php echo number_format($total_pel['total']) ?></b></td>
                                                            <td align="center" class="redtext" colspan="2"><b>%<?php echo $per_realisasi ?></b></td>
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
                                        <td colspan="7" align="center">Data RBB Belum Ditentukan Atau Data Tidak Ditemukan!</td>
                                        <?php 
                                    }
								}
							}
						?>
					
			</div>
            

										
	  <?php


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