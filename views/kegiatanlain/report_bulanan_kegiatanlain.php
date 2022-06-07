<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_kegiatanlain.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new KL($connection);

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
				<h1 class="page-header">REPORT BULANAN KEGIATAN LAIN</h1>
			</div>
		</div><!--/.row-->

		<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Report Bulanan KEGIATAN LAIN
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
													$tampil = $keg->report_bulanan_kegiatanlain();
													if(mysqli_num_rows($tampil) > 0){ 
                                                        $data = mysqli_query($dbconnect,"SELECT * FROM kegiatan_awal WHERE nama_ao='$nama' AND nama_kegiatan='Kegiatan Lain' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
														
                                                        $bio = mysqli_fetch_array($data);
                                                        //$sql2 = mysqli_query($dbconnect,"SELECT SUM(target_nom) AS total FROM kegiatan_awal WHERE nama_ao='$nama' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' ");
                                                        
                             
                                                        echo '<b>Report Rincian Kegiatan Lain Bulan '.$nama_bulan[$_POST['bulan']].' </b><br /><br />';
                                                        echo "<table width=250 height=120>
														<tr>
														<th> Bulan </th>
														<td>: ".$bulan." </td>
														</tr>
														<tr>
															<th> AO </th>
															<td>: ".$bio['nama_ao']." </td>
														</tr>
                                                        </table>";
                                                        
                                                        echo '<hr/>';

                                                        ?>
                                                        <div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kegiatan</th>
                                                            <th>Dari Jam</th>
                                                            <th>Sampai Jam</th>
                                                            <th>Keterangan</th>
                                                            <th>Tanggal</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <?php
                                                    $tampil = $keg->report_bulanan_kegiatanlain();
													while($data = $tampil->fetch_object()) { 

													?>
                                                    
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?= $data->nama_keg ?></td>
                                                        <td><?= $data->f_jam ?></td>
                                                        <td><?= $data->to_jam ?></td>
														<td><?php echo $data->keterangan ?></td></td>
                                                        <td><?= $data->tgl ?></td>
													
													</tr>
													<?php
													
                                                }
							
								?>
                                <?php
											}else{
												?>
												<td colspan="6" align="center">Data Tidak Ditemukan!</td>
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