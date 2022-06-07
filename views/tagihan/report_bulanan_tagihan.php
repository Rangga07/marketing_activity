<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_tagihan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new TAG($connection);

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
				<h1 class="page-header">REPORT BULANAN TAGIHAN</h1>
			</div>
		</div><!--/.row-->

		<div class="col-md-12">
				<div class="panel panel-warning">
					<div class="panel-heading">Report Bulanan Tagihan
					</div>
					
					<div class="panel-body">
								<form action="" method="POST">
										<div class="form-group col-md-5">
										<label for="">AO</label>
										<select class="form-control" name="ao">
												<option selected='selected' disabled>-- Pilih AO</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												if ($_SESSION['level'] == 'admin') {
                									$sql = "SELECT * FROM user WHERE level='AO' OR level='analis'";
                								} else if ($_SESSION['level'] == 'korwildua') {
                									$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 2'";
                								} else if ($_SESSION['level'] == 'korwilsatu') {
                									$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 1'";
                								} else if ($_SESSION['level'] == 'korwiltiga') {
                									$sql = "SELECT * FROM user WHERE wilayah='Ciwidey 3'";
                								} else if ($_SESSION['level'] == 'direksi') {
                									$sql = "SELECT * FROM user WHERE wilayah='Supervisi'";
                								}


												$hasil=mysqli_query($dbconnect,$sql);
												$no=0;
												while ($data = mysqli_fetch_array($hasil)) {
													$no++;

													$ket="";
													if (isset($_GET['id'])) {
														$no_id = trim($_GET['id']);

														if ($no_id==$data['id'])
														{
															$ket="selected";
														}
													}
													?>
												<option <?php echo $ket; ?> value="<?php echo $data['nama'];?>"><?php echo $data['nama'];?></option>
													<?php
													}
													?>
											</select><br>
										<label for="">Bulan</label>
										<select class="form-control" name="bulan" class="number_format">
                                            <option value="">Pilih</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
										</select><br/>
										<label for="">Tahun</label>
										<input type="text" name="tahun" class="form-control" required><br/>
										<input type="submit" class="btn btn-success" name="submit" value="CETAK">
									</div>
								</form>
						<div class="row">
							<div class="col-md-12">   
								
							<hr/>
								
										
										<?php 
											if(!isset($_POST['submit'])){

														?>
												<?php
																	
												}
												else{
                                                    $nama = $_POST['ao'];
													$bulan = $_POST['bulan'];
													$tahun = $_POST['tahun'];
                                                    $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

										
													if($nama != "" || $bulan != "" || $tahun != ""){
														$no=1;
													$tampil = $keg->report_bulanan();
													if(mysqli_num_rows($tampil) > 0){ 
														$data = mysqli_query($dbconnect,"SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND status='1'");
														$data2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND status='1'");
														$data3 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");

														$target_noa = mysqli_num_rows($data);
														$bio = mysqli_fetch_array($data);
														$target_nom = mysqli_fetch_array($data2);
														$realisasi_nom = mysqli_fetch_array($data3);
                                                        //$sql2 = mysqli_query($dbconnect,"SELECT SUM(target_nom) AS total FROM kegiatan_awal WHERE nama_ao='$nama' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' ");
                                                        
                            
                                                        echo '<b>Report Realisasi Tagihan Bulan '.$nama_bulan[$_POST['bulan']].' </b><br /><br />';
                                                        echo "<table width=250 height=120>
														<tr>
														<th> Bulan </th>
														<td>: ".$bulan." </td>
														</tr>
														<tr>
															<th> AO </th>
															<td>: ".$bio['ao']." </td>
														</tr>
														<tr>
															<th> Target NOA</th>
															<td>: $target_noa </td>
														</tr>
														<tr>
															<th> Target Nominal</th>
															<td>: Rp. ".number_format($target_nom['total'])." </td>
														</tr>
														<tr>
															<th> Realisasi</th>
															<td class='redtext'>: <b> Rp. ".number_format($realisasi_nom['total'])." </b></td>
														</tr>
                                                        </table>";
                                                        
                                                        echo '<hr/>';

                                                        ?>
                                                        <div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Nasabah</th>
                                                            <th>Kol</th>
                                                            <th style="width: 60px;">(Bayar/Tidak Bayar)</th>
                                                            <th>Pokok</th>
                                                            <th>Bunga</th>
                                                            <th>Jumlah</th>
                                                            <th style="width: 200px;">Keterangan</th>
                                                            <th>Tanggal</th>
                                                            <th>Foto Kunjungan</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <?php
                                                    $tampil = $keg->report_bulanan();
													while($data = $tampil->fetch_object()) { 

													?>
                                                    
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?php echo $data->nama; ?></td>
														<td align="center"><?php echo $data->kolek; ?></td>
														<td><?php echo $data->ket ?></td></td>
                                                        <?php if($data->jml_pokok || $data->jml_bunga > 0){ ?>
                                                        <td>Rp. <?php echo number_format($data->jml_pokok) ?></td></td>
                                                        <td>Rp. <?php echo number_format($data->jml_bunga) ?></td></td>
                                                        <?php }else{ ?>
                                                        <td align="center">-</td>
                                                        <td align="center">-</td>
                                                        <?php } ?>
                                                        <?php if($data->ket == 'Bayar'){ ?>
                                                        <td>Rp. <?php echo number_format($data->jumlah); ?></td>
                                                        <td><?php echo $data->keterangan; ?></td>
                                                        <td><?php echo $data->tgl; ?></td> 
                                                        <td><a href="#id<?= $data->kode_tag; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a></td>
                    									<div class="modal fade" id="id<?= $data->kode_tag; ?>" role="dialog">
                    										<div class="modal-dialog">
                    										
                    										<!-- Modal content-->
                    										<div class="modal-content">
                    											<div class="modal-header">
                    											<button type="button" class="close" data-dismiss="modal">&times;</button>
                    											</div>
                    											<div class="modal-body">
                    											<img style="display: block;margin-left: auto;margin-right: auto;" src="<?= "../assets/images/kunjungan/".$data->foto_knj ?>" width='60%' height='60%'><br>
                    											</div>
                    											<div class="modal-footer">
                    											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    											</div>
                    										</div>
                    										
                    										</div>
                    									</div>
                                                        <?php }else{ ?>
                                                        <td align="center">-</td>
                                                        <td><?php echo $data->keterangan; ?></td>
                                                        <td><?php echo $data->tgl; ?></td> 
                                                        <td><a href="#id<?= $data->kode_tag; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a></td>
                    									<div class="modal fade" id="id<?= $data->kode_tag; ?>" role="dialog">
                    										<div class="modal-dialog">
                    										
                    										<!-- Modal content-->
                    										<div class="modal-content">
                    											<div class="modal-header">
                    											<button type="button" class="close" data-dismiss="modal">&times;</button>
                    											</div>
                    											<div class="modal-body">
                    											<img style="display: block;margin-left: auto;margin-right: auto;" src="<?= "../assets/images/kunjungan/".$data->foto_knj ?>" width='60%' height='60%'><br>
                    											</div>
                    											<div class="modal-footer">
                    											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    											</div>
                    										</div>
                    										
                    										</div>
                    									</div>
                                                        <?php } ?>
													
													</tr>
													<?php
													
                                                }
									require_once('../config/+koneksi.php');
									require_once('../models/database.php');
									$tgl = date("Y/m/d");
									$tampil = $keg->report_bulanan();
									$data = $tampil->fetch_object();
									$nama = $_POST['ao'];
									$bulan = $_POST['bulan'];
									$tahun = $_POST['tahun'];
									$kode = $data->kode;
									$sql2 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");

									$total = mysqli_fetch_array($sql2);
								?>
								<tr>
									<td colspan="6" align="center"><b>TOTAL REALISASI TAGIHAN</b></td>
									<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total['total']) ?></b></td>
								</tr>
                                <?php
											}else{
												?>
												<td colspan="7" align="center">Data Tidak Ditemukan!</td>
												<?php
													}
												}

									}
									?>
										</table>
										</tbody>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

										
	  <?php
} 

?>


	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>