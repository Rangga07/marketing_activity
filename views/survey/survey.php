<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "models/m_survey.php";
	require_once('config/+koneksi.php');
	require_once('models/database.php');

	$keg = new SUR($connection);



	if (@$_GET['act'] == '') {
	?>
		<style>
			.redtext {
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
				<h1 class="page-header">SURVEY</h1>
			</div>
		</div>
		<!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><em class="fa fa-motorcycle">&nbsp;</em>DATA SURVEY</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table>
							<?php
							require_once('config/+koneksi.php');
							require_once('models/database.php');
							$nama_ao = $_SESSION['username'];
							$tgl = date("Y/m/d");
							$data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_survey WHERE ao='$nama_ao' AND tgl='$tgl'");

							$target_noa = mysqli_num_rows($data);
							?>
						</table>
						<br />
						<table class="table table-hover table-striped" id="datatables">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Realisasi</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$tampil = $keg->kegiatan_awal_survey_tampil();
								while ($data = $tampil->fetch_object()) {
								?>
									<tr>
										<td><?php echo $data->nama_nas; ?></td>
										<td><?php echo $data->alamat; ?></td>
										<?php
										$nama_ao = $_SESSION['username'];
										$tgl = date('Y/m/d');
										$nama_nas = $data->nama_nas;
										$sql2 = mysqli_query($dbconnect, "SELECT ket,keterangan FROM survey WHERE ao='$nama_ao' AND tgl='$tgl' AND nama='$nama_nas'");
										if (mysqli_num_rows($sql2) > 0) {
											while ($data = $sql2->fetch_object()) {
										?>
												<?php if ($data->ket == 'Tersurvey') { ?>
													<td class="redtext"><?php echo $data->ket ?></td>
												<?php } else { ?>
													<td class="redtext"><?php echo $data->ket ?></td>
												<?php } ?>
												<td></td>
											<?php
											}
										} else {
											?>
											<td class="redtext">-</td>
											<td align="center">
												<a id="terlaksana" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#tersurvey" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-almt="<?php echo $data->alamat ?>" data-pengajuan="<?php echo $data->nominal ?>">
													Tersurvey
												</a>
												<a id="tidak" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ttersurvey" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-almt="<?php echo $data->alamat ?>" data-pengajuan="<?php echo $data->nominal ?>">
													Tidak
												</a>
											</td>
										<?php } ?>

									</tr>
								<?php
								} ?>
							</tbody>
						</table>

						<!-- Modal Bayar-->
						<div class="modal fade" id="tersurvey" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="center"><b>TERSURVEY</b></h4>
									</div>
									<div class="modal-body">
										<form role="form" action="action/survey_action.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<input class="form-control" type="hidden" placeholder="Nama" name="kode_sur" value="SR<?php echo rand(200, 1000000) ?>" readonly><br />
												<table border="0">
													<input class="form-control" type="hidden" placeholder="Nama" name="nama" id="nama" readonly>
													<input class="form-control" type="hidden" placeholder="Nama" name="alamat" id="almt" readonly>
													<input class="form-control" type="hidden" placeholder="Nama" name="nominal_peng" id="pengajuan" readonly>
													<input type="hidden" name="ket" value="Tersurvey" />
													<tr>
														<td width="140px" height="50px"><label>Keterangan</label></td>
														<td><textarea name="keterangan" id="" cols="30" rows="4"></textarea></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Foto Kunjungan</label></td>
														<td><input class="form-control" type="file" name="foto_knj"></td>
													</tr>
												</table>
												<br />
												<?php
												$tampil = $keg->survey_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" name="id_keg" value="<?php echo $data->kode ?>">
													<br />
												<?php } ?>
												<input class="form-control" type="hidden" name="tgl" value="<?php echo date("Y/m/d"); ?>">
												<input type="hidden" name="ao" value="<?php echo $_SESSION['username']; ?>" />

												<div class="modal-footer">
													<input type="submit" class="btn btn-success" name="tambahsurvey" value="Simpan">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Bayar-->
						<div class="modal fade" id="ttersurvey" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="center"><b>TIDAK TERSURVEY</b></h4>
									</div>
									<div class="modal-body">
										<form role="form" action="action/survey_action.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<input class="form-control" type="hidden" placeholder="Nama" name="kode_sur" value="SR<?php echo rand(200, 1000000) ?>" readonly><br />
												<table border="0">
													<input class="form-control" type="hidden" placeholder="Nama" name="nama" id="nama" readonly>
													<input class="form-control" type="hidden" placeholder="Nama" name="alamat" id="almt" readonly>
													<input class="form-control" type="hidden" placeholder="Nama" name="nominal_peng" id="pengajuan" readonly>
													<input type="hidden" name="ket" value="Tidak Tersurvey" />
													<tr>
														<td width="140px" height="50px"><label>Keterangan</label></td>
														<td><textarea name="keterangan" id="" cols="30" rows="4"></textarea></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Foto Kunjungan</label></td>
														<td><input class="form-control" type="file" name="foto_knj"></td>
													</tr>
												</table>
												<br />
												<?php
												$tampil = $keg->survey_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" name="id_keg" value="<?php echo $data->kode ?>">
													<br />
												<?php } ?>
												<input class="form-control" type="hidden" name="tgl" value="<?php echo date("Y/m/d"); ?>">
												<input type="hidden" name="ao" value="<?php echo $_SESSION['username']; ?>" />

												<div class="modal-footer">
													<input type="submit" class="btn btn-success" name="tambahsurvey" value="Simpan">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>



						<script type="text/javascript">
							$(document).on("click", "#terlaksana", function() {
								var kode = $(this).data('kd');
								var name = $(this).data('nama');
								var alm = $(this).data('almt');
								var pngjn = $(this).data('pengajuan');
								$(".modal-body #kd").val(kode);
								$(".modal-body #nama").val(name);
								$(".modal-body #almt").val(alm);
								$(".modal-body #pengajuan").val(pngjn);
							})
							$(document).on("click", "#tidak", function() {
								var kode = $(this).data('kd');
								var name = $(this).data('nama');
								var alm = $(this).data('almt');
								var pngjn = $(this).data('pengajuan');
								$(".modal-body #kd").val(kode);
								$(".modal-body #nama").val(name);
								$(".modal-body #almt").val(alm);
								$(".modal-body #pengajuan").val(pngjn);
							})
						</script>
					</div>
				</div>
			</div>
		</div>


	<?php
	} else if (@$_GET['act'] == 'del') {

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
	<script src="js/custom.js"></script>