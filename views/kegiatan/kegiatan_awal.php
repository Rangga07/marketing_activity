<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "models/m_kegiatan.php";
	include "models/m_tagihan.php";
	include "models/m_promosi.php";
	include "models/m_survey.php";
	require_once('config/+koneksi.php');
	require_once('models/database.php');

	$keg = new KA($connection);
	$tag = new TAG($connection);
	$pro = new PRO($connection);
	$sur = new SUR($connection);

	if (@$_GET['act'] == '') {

		$sql = mysqli_query($dbconnect, "SELECT * FROM akses");
		$akses = mysqli_fetch_array($sql);

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
				<h1 class="page-header">KEGIATAN AWAL</h1>
			</div>
		</div>
		<!--/.row-->
		<p id="timestamp"></p>
		<p class="redtext"><b>( * Batas penginputan Kegiatan Tagihan Kredit,Tabungan,Survey dan Promosi dilakukan sebelum pukul 09:00. Jika terlambat input kegiatan awal mohon di input pada kegiatan lainnya. Terima Kasih ) </b></p>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data kegiatan <a data-toggle="modal" data-target="#tambah" class="btn btn-success btn-sm" style="float:right">Tambah</a>
				</div>
				<div id="tambah" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" align="center"><b>TAMBAH KEGIATAN</b></h4>
							</div>
							<form action="action/kegiatan_action.php" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<input type="hidden" name="kode" value="KG<?php echo rand(200, 1000000) ?>" />
									<div class="form-group">
										<table id="tampilan">
											<?php if (date('H:i:s') >= $akses['time']) { ?>
												<tr>
													<td width="140px">
														<p></p>
														<label for="nama_kegiatan" disabled>
															<input type="radio" name="nama_kegiatan" value="Tagihan" class="detail" disabled /> Tagihan Kredit <p></p>
														</label><br />
													</td>
													<td>
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan" disabled>
															<input type="radio" name="nama_kegiatan" value="Tabungan" class="detail" disabled /> Tabungan <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan" disabled>
															<input type="radio" name="nama_kegiatan" value="Promosi" class="detail" disabled /> Promosi <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan" disabled>
															<input type="radio" name="nama_kegiatan" value="Survey" class="detail" disabled /> Survey <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan" disabled>
															<input type="radio" name="nama_kegiatan" value="Kegiatan Lain" class="detail" /> Kegiatan Lain <p></p>
														</label>
													</td>
												</tr>
											<?php } else { ?>
												<tr>
													<td width="140px">
														<p></p>
														<label for="nama_kegiatan">
															<input type="radio" name="nama_kegiatan" value="Tagihan" class="detail" /> Tagihan Kredit <p></p>
														</label><br />
													</td>
													<td>
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan">
															<input type="radio" name="nama_kegiatan" value="Tabungan" class="detail" /> Tabungan <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan">
															<input type="radio" name="nama_kegiatan" value="Promosi" class="detail" /> Promosi <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan">
															<input type="radio" name="nama_kegiatan" value="Survey" class="detail" /> Survey <p></p>
														</label><br />
													</td>
												</tr>
												<tr>
													<td>
														<label for="nama_kegiatan">
															<input type="radio" name="nama_kegiatan" value="Kegiatan Lain" class="detail" /> Kegiatan Lain <p></p>
														</label>
													</td>
												</tr>
											<?php } ?>
										</table>


										<input type="hidden" class="form-control" name="tanggal" value="<?php echo date("Y/m/d h:i:s"); ?>">
									</div>
								</div>
								<input type="hidden" name="nama_ao" value="<?php echo $_SESSION['username']; ?>" />
								<div class="modal-footer">
									<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="table-responsive">
								<table class="table table-hover table-striped" id="datatables">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Kegiatan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$tampil = $keg->kegiatan_tampildet();
										while ($data = $tampil->fetch_object()) {
										?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $data->nama_kegiatan; ?></td>
												<?php if ($data->nama_kegiatan == 'Tagihan') { ?>
													<td align="center">
														<a data-toggle="modal" data-target="#detailtagihan" class="btn btn-danger btn-sm fa fa-plus" style="float:right">
													</td>
												<?php } ?>
												<?php if ($data->nama_kegiatan == 'Tabungan') { ?>
													<td></td>
												<?php } ?>
												<?php if ($data->nama_kegiatan == 'Promosi') { ?>
													<td align="center">
														<a data-toggle="modal" data-target="#detailpromosi" class="btn btn-danger btn-sm fa fa-plus" style="float:right">
													</td>
												<?php } ?>
												<?php if ($data->nama_kegiatan == 'Survey') { ?>
													<td align="center">
														<a data-toggle="modal" data-target="#detailsurvey" class="btn btn-danger btn-sm fa fa-plus" style="float:right">
													</td>
												<?php } ?>
												<?php if ($data->nama_kegiatan == 'Kegiatan Lain') { ?>
													<td></td>
												<?php } ?>
											</tr>
										<?php
										} ?>
								</table>
								</tbody>
							</div>
						</div>
					</div>
				</div>

				<div id="detailtagihan" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" align="center"><b>TARGET TAGIHAN</b></h4>
							</div>
							<form action="action/proses_target_tagihan.php" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<p style="color: red;">* Pengisian target tagihan kredit tidak melebihi pukul 09:00 pagi, jika melebih jam tersebut tombol akan otomatis tidak aktif</p>
									<div class="control-group after-add-more">
										<table border="0">
											<tr height="50px">
												<td width="150px"><label>Nama Nasabah</label></td>
												<td><input type="text" name="nama_nas[]" class="form-control" placeholder="Nama Nasabah"></td>
												<?php
												$tampil = $tag->tagihan_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
													<br />
												<?php }
												?>
												<?php if (date('H:i:s') >= $akses['time']) { ?>
													<td width="80px"><button class="btn btn-primary add-more" type="button" style="float:right;" disabled>
															<i class="fa fa-user"></i> Add
														</button></td>
												<?php } else { ?>
													<td width="80px"><button class="btn btn-primary add-more" type="button" style="float:right;">
															<i class="fa fa-user"></i> Add
														</button></td>
												<?php } ?>
											</tr>
											<tr height="50px">
												<td width="120px"><label>Alamat</label></td>
												<td><input type="text" name="alamat[]" class="form-control" placeholder="Alamat"></td>
											</tr>
											<tr>
												<td width="150px"><label>Target</label></td>
												<td><input type="text" name="nominal[]" class="form-control" placeholder="Rp."></td>
											</tr>
											<tr>
												<td height="40px"><label>Kolektabilitas</label></td>
												<td><select name='kolek[]' class="form-control" style="width: 60px;">
														<option value='1' selected='selected'>1</option>
														<option value='2'>2</option>
														<option value='3'>3</option>
														<option value='4'>4</option>
														<option value='5'>5</option>
													</select></td>
											</tr>
											<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
											<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
										</table>
										<hr>
									</div>
									<br>
									<?php if (date('H:i:s') >= $akses['time']) { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan" disabled>
										</div>
									<?php } else { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan">
										</div>
									<?php } ?>
								</div>
							</form>

							<div class="copy hide">
								<div class="control-group">
									<table border="0" height="50px">
										<tr>
											<td width="150px"><label>Nama Nasabah</label></td>
											<td><input type="text" name="nama_nas[]" class="form-control" placeholder="Nama Nasabah"></td>
											<?php
											$tampil = $tag->tagihan_tampil();
											while ($data = $tampil->fetch_object()) {
											?>
												<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
												<br />
											<?php }
											?>
											<td width="40px" width="80px" align="center"><button class="remove" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>
										<tr height="50px">
											<td width="120px"><label>Alamat</label></td>
											<td><input type="text" name="alamat[]" class="form-control" placeholder="Alamat"></td>
										</tr>
										<tr>
											<td width="150px"><label>Target</label></td>
											<td><input type="text" name="nominal[]" class="form-control" placeholder="Rp."></td>
										</tr>
										<tr>
											<td height="40px"><label>Kolektabilitas</label></td>
											<td><select name='kolek[]' class="form-control" style="width: 60px;">
													<option value='1' selected='selected'>1</option>
													<option value='2'>2</option>
													<option value='3'>3</option>
													<option value='4'>4</option>
													<option value='5'>5</option>
												</select></td>
										</tr>
										</tr>
										<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
										<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
									</table>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="detailsurvey" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" align="center"><b>TARGET SURVEY</b></h4>
							</div>
							<form action="action/proses_target_survey.php" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<p style="color: red;">* Pengisian target survey tidak melebihi pukul 09:00 pagi, jika melebih jam tersebut tombol akan otomatis tidak aktif</p>
									<div class="control-group-survey after-add-more-survey">
										<table border="0">
											<tr height="50px">
												<td width="120px"><label>Nama Nasabah</label></td>
												<td><input type="text" name="nama_nas[]" class="form-control" placeholder="Nama Nasabah"></td>
												<?php
												$tampil = $sur->survey_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
													<br />
												<?php }
												?>
												<?php if (date('H:i:s') >= $akses['time']) { ?>
													<td width="80px"><button class="btn btn-primary add-more-survey" type="button" style="float:right;" disabled>
															<i class="fa fa-user"></i> Add
														</button></td>
												<?php } else { ?>
													<td width="80px"><button class="btn btn-primary add-more-survey" type="button" style="float:right;">
															<i class="fa fa-user"></i> Add
														</button></td>
												<?php } ?>
											</tr>
											<tr>
												<td width="120px"><label>Alamat</label></td>
												<td><input type="text" name="alamat[]" class="form-control" placeholder="Alamat"></td>
											</tr>
											<tr>
												<td width="120px"><label>Pengajuan</label></td>
												<td><input type="text" name="nominal[]" class="form-control" placeholder="Rp."></td>
											</tr>
											<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
											<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
										</table>
										<hr>
									</div>
									<br>
									<?php if (date('H:i:s') >= $akses['time']) { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan" disabled>
										</div>
									<?php } else { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan">
										</div>
									<?php } ?>
								</div>
							</form>

							<div class="copy-survey hide">
								<div class="control-group-survey">
									<table border="0" height="50px">
										<tr height="50px">
											<td width="120px"><label>Nama Nasabah</label></td>
											<td><input type="text" name="nama_nas[]" class="form-control" placeholder="Nama Nasabah"></td>
											<?php
											$tampil = $sur->survey_tampil();
											while ($data = $tampil->fetch_object()) {
											?>
												<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
												<br />
											<?php }
											?>
											<td width="40px" width="80px" align="center"><button class="remove-survey" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>
										</tr>
										<tr>
											<td width="120px"><label>Alamat</label></td>
											<td><input type="text" name="alamat[]" class="form-control" placeholder="Alamat"></td>
										</tr>
										<tr>
											<td width="120px"><label>Pengajuan</label></td>
											<td><input type="text" name="nominal[]" class="form-control" placeholder="Rp."></td>
										</tr>
										<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
										<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
									</table>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="detailpromosi" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" align="center"><b>TARGET PROMOSI</b></h4>
							</div>
							<form action="action/proses_target_promosi.php" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<p style="color: red;">* Pengisian target promosi tidak melebihi pukul 09:00 pagi, jika melebih jam tersebut tombol akan otomatis tidak aktif</p>
									<div class="control-group-promosi after-add-more-promosi">
										<table border="0" height="50px">
											<tr>
												<td width="100px" height="40px"><label>Kelurahan</label></td>
												<td align="center">
													<select class="form-control" name="wilayah[]">
														<option selected='selected' disabled>-- Pilih Kelurahan</option>
														<?php
														$sql = "SELECT * FROM wilayah";

														$hasil = mysqli_query($dbconnect, $sql);
														$no = 0;
														while ($data = mysqli_fetch_array($hasil)) {
															$no++;

															$ket = "";
															if (isset($_GET['id'])) {
																$no_id = trim($_GET['id']);

																if ($no_id == $data['id']) {
																	$ket = "selected";
																}
															}
														?>
															<option <?php echo $ket; ?> value="<?php echo $data['wilayah']; ?>"><?php echo $data['wilayah']; ?></option>
														<?php
														}
														?>
													</select>
												</td>

												<?php
												$tampil = $pro->promosi_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
													<br />
												<?php }
												?>
												<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
												<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
												<?php if (date('H:i:s') >= $akses['time']) { ?>
													<td width="80px"><button class="btn btn-primary add-more-promosi" type="button" style="float:right;" disabled>
															<i class="glyphicon glyphicon-plus"></i> Add
														</button></td>
												<?php } else { ?>
													<td width="80px"><button class="btn btn-primary add-more-promosi" type="button" style="float:right;">
															<i class="glyphicon glyphicon-plus"></i> Add
														</button></td>
												<?php } ?>
											</tr>
											<tr>
												<td width="100px"><label>NOA</label></td>
												<td><input type="text" name="noa[]" class="form-control" style="height: 40px;"></td>
											</tr>
										</table>
									</div>
									<br>
									<?php if (date('H:i:s') >= $akses['time']) { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan" disabled>
										</div>
									<?php } else { ?>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" name="tambahkegiatan" value="Simpan">
										</div>
									<?php } ?>
								</div>
							</form>

							<div class="copy-promosi hide">
								<div class="control-group-promosi">
									<table border="0" height="50px">
										<tr>
											<td width="100px" height="40px"><label>Kelurahan</label></td>
											<td><select class="form-control" name="wilayah[]">
													<option selected='selected' disabled>-- Pilih Kelurahan</option>
													<?php
													$sql = "SELECT * FROM wilayah";

													$hasil = mysqli_query($dbconnect, $sql);
													$no = 0;
													while ($data = mysqli_fetch_array($hasil)) {
														$no++;

														$ket = "";
														if (isset($_GET['id'])) {
															$no_id = trim($_GET['id']);

															if ($no_id == $data['id']) {
																$ket = "selected";
															}
														}
													?>
														<option <?php echo $ket; ?> value="<?php echo $data['wilayah']; ?>"><?php echo $data['wilayah']; ?></option>
													<?php
													}
													?>
												</select>
											</td>
											<?php
											$tampil = $pro->promosi_tampil();
											while ($data = $tampil->fetch_object()) {
											?>
												<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="kode_keg[]" value="<?php echo $data->kode ?>">
												<br />
											<?php }
											?>
											<input type="hidden" class="form-control" name="tgl[]" value="<?php echo date("Y/m/d"); ?>">
											<input type="hidden" name="ao[]" value="<?php echo $_SESSION['username']; ?>" />
											<td width="40px" align="center"><button class="remove-promosi" type="button"><i class="glyphicon glyphicon-remove"></i></button></td>
										</tr>
										<tr>
											<td width="100px"><label>NOA</label></td>
											<td><input type="text" name="noa[]" class="form-control" style="height: 40px;"></td>
										</tr>
										<hr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
</div>


<?php
	} else if (@$_GET['act'] == 'del') {

		$keg->hapus_kegiatan($_GET['kode']);
		header("location: ?page=kegiatan_awal");
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