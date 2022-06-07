<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_promosi.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new PRO($connection);



if(@$_GET['act'] == '') {
?>
		<style>
			.redtext{
				color: red;
			}
		</style>

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
				<h1 class="page-header">PROMOSI</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
			<div class="col-md-12">
				<div class="panel panel-danger">
					<div class="panel-heading"><em class="fa fa-users">&nbsp;</em>DETAIL PROMOSI</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class= "table table-bordered table-hover table-striped" id="datatables">
								<thead align=center>
								<tr>
									<td rowspan="2" style="width: 5cm;"><b>Wilayah</b></td>
									<td rowspan="2" style="width: 2cm;"><b>T NOA</b></td>
									<td colspan="3"><b>REALISASI</b></td>
									<td rowspan="2"><b></b></td>
								</tr> 
								<tr>
									<td><b>NOA</b></td>
									<td colspan="2"><b>NOMINAL</b></td>	
								</tr>
								</thead>
								<tbody>
								<?php 
									$no=1;
									$tampil = $keg->kegiatan_awal_promosi_tampil();
									while($data = $tampil->fetch_object()) { 
								?> 
								<tr>
									<td><?php echo $data->wilayah; ?></td>
									<td align="center"><?php echo $data->noa; ?></td>
									<?php
										$nama_ao = $_SESSION['username']; 
										$tgl = date('Y/m/d');
										$wilayah = $data->wilayah;	
										$sql1 = mysqli_query($dbconnect,"SELECT * FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl' AND wilayah='$wilayah'");
										$sql2 = mysqli_query($dbconnect,"SELECT nominal as jumlah FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl' AND wilayah='$wilayah'");
										$data2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl' AND wilayah='$wilayah'");
										
										$realisasi_noa = mysqli_num_rows($sql1);
										$realisasi_nom = mysqli_fetch_array($data2);
										if(mysqli_num_rows($sql2) > 0){
											
										?>
										<td class="redtext" align="center"><?php echo $realisasi_noa; ?></td>
										<td class="redtext" colspan="2" align="center">Rp. <?php echo number_format($realisasi_nom['total']) ?></td>
										<td align="center" style="width:3cm"><a id="detailpromosi" type="button" class="btn btn-danger btn-sm fa fa-plus" data-toggle="modal" 
												data-target="#detail" data-kd="<?php echo $data->kode ?>" data-wil="<?php echo $data->wilayah ?>" data-n="<?php echo $data->noa ?>">
										</a></td>
										<?php 
										}else{
										?>
										<td class="redtext" align="center">0</td>
										<td class="redtext" colspan="2" align="center">0</td>
										<td align="center" style="width:3cm"><a id="detailpromosi" type="button" class="btn btn-danger btn-sm fa fa-plus" data-toggle="modal" 
												data-target="#detail" data-kd="<?php echo $data->kode ?>" data-wil="<?php echo $data->wilayah ?>" data-n="<?php echo $data->noa ?>">
										</a></td>
										<?php }?>
									</tr>
									<?php
									} ?> 
								</tbody>
							</table>

							<!-- Modal Bayar-->
							<div class="modal fade" id="detail" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="center">DETAIL PROMOSI</h4>
									</div>
										<form role="form" action="action/proses_detail_promosi.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="control-group after-add-more-detpro">
														<table>
															<tr>
																<td width="140px" height="50px"><label>Wilayah</label></td>
																<td><b><input class="form-control" placeholder="Nama" name="wilayah" id="wil" readonly></b></td>
																<td width="80px"><button class="btn btn-primary add-more-detpro" type="button" style="float:right;">
															<i class="fa fa-user"></i> Add
														</button></td>
															</tr>
														</table>
												</div>
														<hr>
														<br>
													<input type="hidden" name="ket" value="Bayar" />
													<div class="modal-footer">
														<input type="submit" class="btn btn-success" name="tambahpromosi" value="Simpan">
													</div>

													
												</div>
										</form>

										<div class="copy-detpro hide">
											<div class="control-group-detpro">
												<table border="0" height="50px">
													<tr>
														<td width="140px" height="50px"><label>Nama</label></td>
														<td colspan="2"><input class="form-control" placeholder="Nama" name="nama[]" require></td>
														<td width="40px" align="center"><button class="remove-detpro" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Alamat</label></td>
														<td colspan="2"><input class="form-control" placeholder="Alamat" name="alamat[]"></td>
														<td></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>No HP</label></td>
														<td colspan="2"><input class="form-control" placeholder="No HP" name="no_hp[]"></td>
														<td></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Keputusan</label></td>
														<td width="100px"><input type="checkbox" name="kep[]" value="Deal" class="form"/><b> Deal  </td>
														<td width="100px"><input type="checkbox" name="kep[]" value="No Deal" class="form"/> <b> No Deal</td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Produk</label></td>
														<td colspan="2"><select name='produk[]' class="form-control"> 
															<option disabled value="-" selected>-- Pilih Produk</option>
															<option value='Tabungan'>Tabungan</option>
															<option value='Deposito'>Deposito</option>
															<option value='Kredit'>Kredit</option>
														</select><p></p></td>
														<td></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Nominal</label></td>
														<td colspan="2"><input class="form-control" placeholder="Nominal" id="fc" name="nominal[]"></td>
														<td></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Keterangan</label></td>
														<td colspan="2"><textarea class="form-control" name="keterangan[]" rows="5" cols="10"></textarea></td>
														<td></td>
													</tr>
													<?php 
														$tampil = $keg->promosi_tampil();
														while($data = $tampil->fetch_object()) { 
													?>
													<input class="form-control" placeholder="Nomor HP" type="hidden" value="<?php echo $data->kode; ?>" name="id_keg[]">
													<?php
														}
													?>
													<input class="form-control" type="hidden" placeholder="Nominal" name="tgl[]" value="<?php echo date("Y/m/d");?>"><br/>
													<input class="form-control" type="hidden" placeholder="Nominal" name="ao[]" value="<?php echo $_SESSION['username']; ?>"><br/>
													
													<hr>
													<hr>
												</table>
											</div>
										</div>
									</div>
									</div>
								</div>
							</div>

						
							<script type="text/javascript">
								$(document).on("click", "#detailpromosi", function() {
									var kode = $(this).data('kd');
									var wilayah = $(this).data('wil');
									var noa = $(this).data('n');
									$(".modal-body #kd").val(kode);
									$(".modal-body #wil").val(wilayah);
									$(".modal-body #n").val(noa);
								})
							</script>
						</div>
					</div>
				</div>
			</div>

										
	  <?php
} else if(@$_GET['act'] == 'del') {

	header("location: ?page=tagihan");
}

?>



<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="../../assets/js/jquery.js"></script>