<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "models/m_tagihan.php";
	require_once('config/+koneksi.php');
	require_once('models/database.php');

	$keg = new TAG($connection);



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
				<h1 class="page-header">TAGIHAN</h1>
			</div>
		</div>
		<!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-12">
			<div class="panel panel-warning">
				<div class="panel-heading"><em class="fa fa-clipboard">&nbsp;</em>DATA TAGIHAN</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table>
							<?php
							require_once('config/+koneksi.php');
							require_once('models/database.php');
							$nama_ao = $_SESSION['username'];
							$tgl = date("Y/m/d");
							$data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1'");
							$data2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1'");
							$data3 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1'");

							$target_noa = mysqli_num_rows($data);
							$target_nom = mysqli_fetch_array($data2);
							$realisasi_nom = mysqli_fetch_array($data3);
							?>
							<tr>
								<td width="120px"><b>Target NOA</b></td>
								<td>: <?php echo $target_noa; ?></td>
							</tr>
							<tr>
								<td><b>Total Target</b></td>
								<td>: Rp. <?php echo number_format($target_nom['total']) ?></td>
							</tr>
							<tr height="30px">
								<td><b>Total Realisasi</b></td>
								<td class="redtext">: <b>Rp.<?php echo number_format($realisasi_nom['total']) ?></b></td>
							</tr>
						</table>
						<br />

						<table class="table table-hover table-striped" id="datatables">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Target</th>
									<th>Realisasi</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$tampil = $keg->kegiatan_awal_tagihan_tampil();
								while ($data = $tampil->fetch_object()) {
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?php echo $data->nama_nas; ?></td>
										<td><?= $data->alamat; ?></td>
										<td>Rp. <?php echo number_format($data->nominal) ?></td>
										<?php
										$nama_ao = $_SESSION['username'];
										$tgl = date('Y/m/d');
										$nama_nas = $data->nama_nas;
										$sql2 = mysqli_query($dbconnect, "SELECT jumlah,ket,keterangan FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND nama='$nama_nas'");
										if (mysqli_num_rows($sql2) > 0) {
											while ($data = $sql2->fetch_object()) {
										?>
												<?php if ($data->ket == 'Bayar') { ?>
													<td class="redtext">Rp. <?php echo number_format($data->jumlah) ?></td>
												<?php } else { ?>
													<td class="redtext"><?php echo $data->ket ?></td>
												<?php } ?>
												<td></td>
											<?php
											}
										} else {
											?>
											<td class="redtext">Rp. 0</td>
											<?php
											$status = $data->status;
											if ($status == 0) {
											?>
												<td align="center">PERLU PERSETUJUAN!</td>
											<?php
											} else if ($status == 2) {
											?>
												<td align="center">DITOLAK</td>
											<?php
											} else {
											?>
												<?php
												$tampilt = $keg->kegiatan_awal_tagihan_tampil();
												$tot = mysqli_num_rows($tampilt);
												if ($tot >= 10) {
												?>
													<td align="center">
														<a id="bayartagihan" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#bayar" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-alamat="<?php echo $data->alamat ?>" data-kolek="<?php echo $data->kolek ?>">
															Bayar
														</a>
														<a id="tbayartagihan" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#tbayar" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-alamat="<?php echo $data->alamat ?>" data-kolek="<?php echo $data->kolek ?>">
															Tidak
														</a>
													</td>
												<?php } else if ($tot <= 10) { ?>
													<td align="center">
														<a id="bayartagihan" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-alamat="<?php echo $data->alamat ?>" data-kolek="<?php echo $data->kolek ?>" disabled>
															Bayar
														</a>
														<a id="tbayartagihan" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#" data-kd="<?php echo $data->kode ?>" data-nama="<?php echo $data->nama_nas ?>" data-alamat="<?php echo $data->alamat ?>" data-kolek="<?php echo $data->kolek ?>" disabled>
															Tidak
														</a>
													</td>
												<?php } ?>

											<?php } ?>
										<?php } ?>
										<td></td>
									</tr>
								<?php
								} ?>
								<?php
								$tampil = $keg->kegiatan_awal_tagihan_tampil();
								$tot = mysqli_num_rows($tampil);
								if ($tot >= 10) {
								?>

								<?php } else if ($tot <= 10) { ?>
									<p class="redtext"><strong> Target belum memenuhi batas minimal! batas minimal = 10</strong></p>
								<?php } ?>
							</tbody>
						</table>

						<!-- Modal Bayar-->
						<div class="modal fade" id="bayar" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="center">BAYAR TAGIHAN</h4>
									</div>
									<div class="modal-body">
										<form role="form" action="action/tagihan_action.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<input class="form-control" type="hidden" placeholder="Nama" name="kode_tag" value="TG<?php echo rand(200, 1000000) ?>" readonly><br />
												<table>
													<tr>
														<td width="140px" height="50px"><label>Nama Nasabah</label></td>
														<td><b><input class="form-control" placeholder="Nama" name="nama" id="nama" readonly></b><br /></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Alamat</label></td>
														<td><b><input class="form-control" placeholder="Alamat" name="alamat" id="alamat" readonly></b><br /></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Kolektabilitas</label></td>
														<td><b><input style="width: 40px;" class="form-control" placeholder="Kolek" name="kolek" id="kolek" readonly></b><br /></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Jumlah(pokok)</label></td>
														<td><input class="form-control" placeholder="Rp." name="jml_pokok" id="fc" autocomplete="off"></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Jumlah(bunga)</label></td>
														<td><input class="form-control" placeholder="Rp." name="jml_bunga" id="fd" autocomplete="off"></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Keterangan</label></td>
														<td><textarea class="form-control" name="keterangan" rows="5" cols="10"></textarea></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Foto Kunjungan</label></td>
														<td><input class="form-control" type="file" name="foto_knj"></td>
													</tr>
												</table>
												<input type="hidden" name="ket" value="Bayar" />
												<br />
												<?php
												$tampil = $keg->tagihan_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="id_keg" value="<?php echo $data->kode ?>">
													<br />
												<?php } ?>
												<input class="form-control" type="hidden" id="Bayar Bunga" name="tgl" value="<?php echo date("Y/m/d"); ?>">
												<input type="hidden" name="ao" value="<?php echo $_SESSION['username']; ?>" />

												<div class="modal-footer">
													<input type="submit" class="btn btn-success" name="tambahtagihan" value="Simpan">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Bayar-->
						<div class="modal fade" id="tbayar" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="center">TIDAK BAYAR</h4>
									</div>
									<div class="modal-body">
										<form role="form" action="action/tagihan_action.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<input class="form-control" type="hidden" placeholder="Nama" name="kode_tag" value="TG<?php echo rand(200, 1000000) ?>" readonly><br />
												<table>
													<tr>
														<td width="140px" height="50px"><label>Nama Nasabah</label></td>
														<td><b><input class="form-control" placeholder="Nama" name="nama" id="nama" readonly></b><br /></td>
													</tr>
													<tr>
														<td width="140px" height="50px"><label>Alamat</label></td>
														<td><b><input class="form-control" placeholder="Alamat" name="alamat" id="alamat" readonly></b><br /></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Keterangan</label></td>
														<td><textarea class="form-control" name="keterangan" rows="5" cols="10"></textarea></td>
													</tr>
													<tr>
														<td width="140px" height="70px"><label>Foto Kunjungan</label></td>
														<td><input class="form-control" type="file" name="foto_knj"></td>
													</tr>
												</table>
												<input style="width: 100px;" type="hidden" class="form-control" placeholder="Kolek" name="kolek" id="kolek" readonly>
												<input type="hidden" name="ket" value="Tidak Bayar" />
												<br />
												<?php
												$tampil = $keg->tagihan_tampil();
												while ($data = $tampil->fetch_object()) {
												?>
													<input class="form-control" type="hidden" placeholder="Keterangan" id="Tidak Bayar" name="id_keg" value="<?php echo $data->kode ?>">
													<br />
												<?php } ?>
												<input class="form-control" type="hidden" id="Bayar Bunga" name="tgl" value="<?php echo date("Y/m/d"); ?>">
												<input type="hidden" name="ao" value="<?php echo $_SESSION['username']; ?>" />

												<div class="modal-footer">
													<input type="submit" class="btn btn-success" name="tambahtagihan" value="Simpan">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<script type="text/javascript">
							$(document).on("click", "#bayartagihan", function() {
								var kode = $(this).data('kd');
								var name = $(this).data('nama');
								var klk = $(this).data('kolek');
								var almt = $(this).data('alamat');
								$(".modal-body #kd").val(kode);
								$(".modal-body #nama").val(name);
								$(".modal-body #kolek").val(klk);
								$(".modal-body #alamat").val(almt);
							})
							$(document).on("click", "#tbayartagihan", function() {
								var kode = $(this).data('kd');
								var name = $(this).data('nama');
								var klk = $(this).data('kolek');
								var almt = $(this).data('alamat');
								$(".modal-body #kd").val(kode);
								$(".modal-body #nama").val(name);
								$(".modal-body #kolek").val(klk);
								$(".modal-body #alamat").val(almt);
							})
						</script>
					</div>
				</div>
			</div>
		</div>

	<?php
	} else if (@$_GET['act'] == 'del') {

		$keg->hapus_tagihan($_GET['kode']);
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