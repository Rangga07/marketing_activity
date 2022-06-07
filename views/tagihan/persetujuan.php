<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_tagihan.php";
include "../models/m_users.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new TAG($connection);
$users = new USR($connection);

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
				<h1 class="page-header">PERSETUJUAN TAGIHAN</h1>
			</div>
		</div><!--/.row-->

		<div class="col-md-12">
				<div class="panel panel-danger">
					<div class="panel-heading">Persetujuan Data
					</div>
					
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">   
                                            <div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Data</th>
                                                        </tr>
                                                        <?php 
                                                        $tgl = date('Y/m/d');
														if ($_SESSION['level'] == 'korwilsatu') {
															 $tampil = $users->users_tampil_ciwideysatu();
														} else if ($_SESSION['level'] == 'korwildua') {
															$tampil = $users->users_tampil_ciwideydua();
														} else if ($_SESSION['level'] == 'korwiltiga') {
															$tampil = $users->users_tampil_ciwideytiga();
														} 
                                                        while($data = $tampil->fetch_object()) { 
                                                    ?>
                                                        <tr>
                                                            <td><?= $data->nama ?></td>
															<?php
																$nama_ao = $data->nama;
																$tanggal = date('Y/m/d');
																$sql = mysqli_query($dbconnect,"SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tanggal' AND status IS NULL");
																if(mysqli_num_rows($sql) > 0){
															?>
															<td><a href="#id<?= $data->nama; ?>" data-toggle="modal"><button class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail </button></a></td>
															<div class="modal fade" id="id<?= $data->nama ?>" role="dialog">
																<div class="modal-dialog">
																<!-- Modal content-->
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title" align="center"><b>PERSETUJUAN</b></h4>
																	</div>
																	
																	<form action="../action/edit_persetujuan.php" method="POST">
																		<?php while($data2 = $sql->fetch_object()) { ?>
																		<div class="modal-body">
																			<label for="">Nama :</label> 
																			<?= $data2->nama_nas; ?> <br>
																			<input type="hidden" type="text" name="nama_nas[]" class="form-control" placeholder="" value="<?= $data2->nama_nas?>">
																			<label for="">Alamat :</label>
																			<?= $data2->alamat; ?><br>
																			<input type="hidden" type="text" name="alamat[]" class="form-control" placeholder="" value="<?= $data2->alamat?>">
																			<label for="">Status : </label>
																			<select style="width:100px" class="form-control" name="status[]" id="">
																				<option value="1">Setuju</option>
																				<option value="2">Tolak</option>
																			</select>
																			<input type="hidden" type="text" name="kode[]" class="form-control" placeholder="" value="<?= $data2->kode?>">
																			<hr>
																		</div>
																		<?php } ?>
																		<div class="modal-footer">
																		<input type="submit" class="btn btn-success" name="submit" value="SUBMIT" class="btnSubmit" onClick="setOkAction();">
																		</div>
																	</form>
																</div>
																</div>
															</div>
															<?php }else{ ?>
															<td style="font-style: italic;">CLEAR</td>
																<?php }?>
															
                                                        </tr>
                                                    <?php } ?>
                                                    </thead>
                                                   
										</table>
										</tbody>
								</div>
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