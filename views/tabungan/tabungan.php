<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "models/m_tabungan.php";
	require_once('config/+koneksi.php');
	require_once('models/database.php');

	$keg = new TAB($connection);

	if (@$_GET['act'] == '') {
	?>

		<style>
			.redtext {
				color: red;
			}

			.table1 {
				font-size: 13px;
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
				<h1 class="page-header">TABUNGAN</h1>
			</div>
		</div>
		<!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<?php
				$tampil = $keg->tabungan_tampil();
				while ($data = $tampil->fetch_object()) {
				?>
					<div class="panel-heading"><em class="fa fa-leanpub">&nbsp;</em><?php echo $data->nama_kegiatan; ?>
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<form role="form" action="action/tabungan_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<table border="0">
									<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="TB<?php echo rand(200, 1000000) ?>" readonly><br />
									<tr>
										<td width="120px" height="50px"><label>PKM</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="pkm" id="fc"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_pkm"><br /></td>
									</tr>
									<tr>
										<td width="80px" height="50px"><label>SIBUMBUNG</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="sibumbung" id="fd"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_sibumbung"><br /></td>
									</tr>
									<tr>
										<td width="80px" height="50px"><label>SIMASPRO</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="simaspro" id="fe"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_simaspro"><br /></td>
									</tr>
									<tr>
										<td width="100px" height="50px"><label>SIMPEDIK</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="simpedik" id="ff"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_simpedik"><br /></td>
									</tr>
									<tr>
										<td width="100px" height="50px"><label>SIMASTU</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="simastu" id="fg"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_simastu"><br /></td>
									</tr>
									<tr>
										<td width="100px" height="50px"><label>TAHARA</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="tahara" id="fg"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_tahara"><br /></td>
									</tr>
								</table>
								<hr>
								<?php
								$tampil = $keg->tabungan_tampil();
								while ($data = $tampil->fetch_object()) {
								?>
									<input class="form-control" type="hidden" placeholder="NOA" name="id_keg" value="<?php echo $data->kode ?>">
								<?php
								}
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="tgl" value="<?php echo date("Y/m/d"); ?>"><br />
								<?php
								$tampil = $keg->users_tampil_session();
								while ($data = $tampil->fetch_object()) {
								?>
									<input class="form-control" type="hidden" placeholder="Nominal" name="wilayah" value="<?php echo $data->wilayah ?>">
								<?php
								}
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="ao" value="<?php echo $_SESSION['username']; ?>"><br />
								<?php
								$nama_ao = $_SESSION['username'];
								$tgl = date("Y/m/d");
								$sql6 = mysqli_query($dbconnect, "SELECT * FROM tabungan WHERE ao='$nama_ao' AND tgl='$tgl'");
								if (mysqli_num_rows($sql6) > 0) {
								?>
									<input type="submit" class="btn btn-success" name="tambahtabungan" style="float:right" value="Simpan" disabled>
								<?php } else { ?>
									<input type="submit" class="btn btn-success" name="tambahtabungan" style="float:right" value="Simpan">
								<?php } ?>
							</div>
						</form>
					</div>

				<?php } ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading"><em class="fa fa-leanpub">&nbsp;</em>DATA TABUNGAN MASUK</div>
				<div class="panel-body">

					<div class="table-responsive">

						<?php
						$no = 1;
						$tampil = $keg->tabungan_detail_tampil();
						while ($data = $tampil->fetch_object()) {
						?>
							<a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data->kode; ?>"><i class="fa fa-edit"></i>EDIT</a>
							<p>

							<table class="table table-bordered table-hover table-striped" id="datatables">

								<tr>
									<th width="100px"></th>
									<th align>NOMINAL</th>
									<th>NOA</th>
								</tr>
								<tr>
									<th width="100px">PKM</th>
									<td>Rp. <?= number_format($data->pkm) ?></td>
									<td><?= $data->noa_pkm ?></td>
								</tr>
								<tr>
									<th>SIBUMBUNG</th>
									<td>Rp. <?= number_format($data->sibumbung) ?></td>
									<td><?= $data->noa_sibumbung ?></td>
								</tr>
								<tr>
									<th>SIMASPRO</th>
									<td>Rp. <?= number_format($data->simaspro) ?></td>
									<td><?= $data->noa_simaspro ?></td>
								</tr>
								<tr>
									<th>SIMPEDIK</th>
									<td>Rp. <?= number_format($data->simpedik) ?></td>
									<td><?= $data->noa_simpedik ?></td>
								</tr>
								<tr>
									<th>SIMASTU</th>
									<td>Rp. <?= number_format($data->simastu) ?></td>
									<td><?= $data->noa_simastu ?></td>
								</tr>
								<tr>
									<th>TAHARA</th>
									<td>Rp. <?= number_format($data->tahara) ?></td>
									<td><?= $data->noa_tahara ?></td>
								</tr>
								<tr>
									<th class="redtext">TOTAL</th>
									<td class="redtext"><b>Rp. <?= number_format($data->jumlah) ?></b></td>
									<td class="redtext"><b><?= $data->jumlah_noa ?> </b></td>
								</tr>
							</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal<?php echo $data->kode; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<br>
					<h6 align="center">EDIT TABUNGAN</h6>
					<hr>
					<div class="modal-body">
						<form role="form" action="action/edit_tabungan_action.php" method="get">
							<?php
							$id = $data->kode;
							$query_edit = mysqli_query($dbconnect, "SELECT * FROM tabungan WHERE kode='$id'");
							while ($row = mysqli_fetch_array($query_edit)) {
							?>
								<table class="table table-bordered table-hover table-striped" id="datatables">
									<input type="hidden" name="kode" value="<?php echo $row['kode']; ?>">
									<tr>
										<th width="100px"></th>
										<th align>NOMINAL</th>
										<th>NOA</th>
									</tr>
									<tr>
										<th width="100px">PKM</th>
										<td><input class="form-control" placeholder="Nominal" name="pkm" value="<?= $row['pkm']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_pkm" id="fe" value="<?= $row['noa_pkm']; ?>"></td>
									</tr>
									<tr>
										<th>SIBUMBUNG</th>
										<td><input class="form-control" placeholder="Nominal" name="sibumbung" value="<?= $row['sibumbung']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_sibumbung" id="fe" value="<?= $row['noa_sibumbung']; ?>"></td>
									</tr>
									<tr>
										<th>SIMASPRO</th>
										<td><input class="form-control" placeholder="Nominal" name="simaspro" value="<?= $row['simaspro']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_simaspro" id="fe" value="<?= $row['noa_simaspro']; ?>"></td>
									</tr>
									<tr>
										<th>SIMPEDIK</th>
										<td><input class="form-control" placeholder="Nominal" name="simpedik" value="<?= $row['simpedik']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_simpedik" id="fe" value="<?= $row['noa_simpedik']; ?>"></td>
									</tr>
									<tr>
										<th>SIMASTU</th>
										<td><input class="form-control" placeholder="Nominal" name="simastu" value="<?= $row['simastu']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_simastu" id="fe" value="<?= $row['noa_simastu']; ?>"></td>
									</tr>
									<tr>
										<th>TAHARA</th>
										<td><input class="form-control" placeholder="Nominal" name="tahara" value="<?= $row['tahara']; ?>"></td>
										<td width="100px"><input class="form-control" placeholder="NOA" name="noa_tahara" id="fe" value="<?= $row['noa_tahara']; ?>"></td>
									</tr>
								</table>
								<button type="submit" class="btn btn-success">SIMPAN</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">KELUAR</button>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

<?php
	} else if (@$_GET['act'] == 'del') {

		$keg->hapus_tabungan($_GET['kode']);
		header("location: ?page=tabungan");
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