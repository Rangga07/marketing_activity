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
				<h1 class="page-header">REPORT HARIAN TAGIHAN</h1>
			</div>
		</div><!--/.row-->

		<div class="col-md-12">
				<div class="panel panel-warning">
					<div class="panel-heading">Report Harian Tagihan
					</div>
					
					<div class="panel-body">
								<form action="" method="POST">
										<div class="form-group col-md-5">
										<label for="">Petugas</label>
										<select class="form-control" name="ao">
												<option selected='selected' disabled>-- Pilih Petugas</option>
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
										<label for="">Tanggal</label>
										<input type="date" id="from" name="tgl" class="form-control" required><br/>
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
													$tanggal = $_POST['tgl'];
													$ftanggal = strtotime($tanggal);
													$ftanggal = date("Y/m/d", $ftanggal);
													if($nama != "" || $ftanggal != ""){
														$no=1;
													$tampil = $keg->report_harian();
													if(mysqli_num_rows($tampil) > 0){
                                                        $data = mysqli_query($dbconnect,"SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama' AND tgl='$ftanggal' AND status='1'");
														$data2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan WHERE ao='$nama' AND tgl='$ftanggal' AND status='1'");
														$data3 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama' AND tgl='$ftanggal'");

														$target_noa = mysqli_num_rows($data);
														$bio = mysqli_fetch_array($data);
														$target_nom = mysqli_fetch_array($data2);
														$realisasi_nom = mysqli_fetch_array($data3);
                            
                                                        echo "<a href='../report/cetak_tagihan.php?id_keg=$bio[kode_keg]' target='_blank'><button class='btn btn-default btn-md' style='float:right' ><i class='fa fa-print'></i> Cetak PDF</button></a>";
                            
                                                        echo "<table width=290 height=120>
                                                        <tr>
															<th> Tanggal </th>
															<td>: ".$bio['tgl']." </td>
														</tr>   
														<tr>
															<th> Petugas </th>
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
                                                            <th>Alamat</th>
                                                            <th>Kol</th>
                                                            <th>Keputusan</th>
                                                            <th>Pokok</th>
                                                            <th>Bunga</th>
                                                            <th>Jumlah</th>
                                                            <th>Keterangan</th>
                                                            <th>Foto Kunjungan</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <?php
                                                    $tampil = $keg->report_harian();
													while($data = $tampil->fetch_object()) { 

													?>
                                                    
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?php echo $data->nama; ?></td>
														<td><?php echo $data->alamat; ?></td>
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
								?>
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
} else if(@$_GET['act'] == 'del') {

	$keg->hapus_kegiatan($_GET['kode']);
	header("location: ?page=kegiatan_awal");
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