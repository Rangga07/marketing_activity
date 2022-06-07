<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


	<?php
	include "../models/m_tabungan.php";
	require_once('../config/+koneksi.php');
	require_once('../models/database.php');

	$keg = new TAB($connection);

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
				<h1 class="page-header">REPORT HARIAN TABUNGAN</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Report Harian Tabungan
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
								}

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
									<option <?php echo $ket; ?> value="<?php echo $data['nama']; ?>"><?php echo $data['nama']; ?></option>
								<?php
								}
								?>
							</select><br>
							<label for="">Tanggal</label>
							<input type="date" id="from" name="tgl" class="form-control" required><br />
							<input type="submit" class="btn btn-success" name="submit" value="CETAK">
						</div>
					</form>
					<div class="row">
						<div class="col-md-12">

							<hr />


							<?php
							if (!isset($_POST['submit'])) {

							?>
								<?php

							} else {
								$nama = $_POST['ao'];
								$tanggal = $_POST['tgl'];
								$ftanggal = strtotime($tanggal);
								$ftanggal = date("Y/m/d", $ftanggal);
								if ($nama != "" || $ftanggal != "") {
									$no = 1;
									$tampil = $keg->report_harian();
									if (mysqli_num_rows($tampil) > 0) {
										$result = mysqli_fetch_object($tampil);
										$tercapai = mysqli_num_rows($tampil);

										echo "<a href='../report/cetak_tabungan.php?id_keg=$result->id_keg' target='_blank'><button class='btn btn-default btn-md' style='float:right' ><i class='fa fa-print'></i> Cetak PDF</button></a>";

										echo "<table width=290 height=120>
                                                        <tr>
                                                            <th> Tanggal </th>
                                                            <td>: $result->tanggal </td>
                                                        </tr>
                                                        <tr>
                                                            <th> AO </th> 
                                                            <td>: $result->nama_ao </td>
                                                        </tr>
                                                        </table>";

										echo '<hr/>';

								?>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-striped" id="datatables">

												<?php
												$tampil = $keg->report_harian();
												while ($data = $tampil->fetch_object()) {
													echo '
						<table class="table table-bordered table-hover table-striped" id="datatables">

							<tr>
								<th width="100px"></th>
								<th align>NOMINAL</th>
								<th>NOA</th>
							</tr>
							<tr>
								<th>SIMASPRO</th>
								<td>Rp. ' . number_format($data->simaspro) . '</td>
								<td>' . $data->noa_simaspro . '</td>
							</tr>
							<tr>
								<th>SIMPEDIK</th>
								<td>Rp. ' . number_format($data->simpedik) . '</td>
								<td>' . $data->noa_simpedik . '</td>
							</tr>
							<tr>
								<th width="100px">PKM</th>
								<td>Rp. ' . number_format($data->pkm) . '</td>
								<td>' . $data->noa_pkm . '</td>
							</tr>
							<tr>
								<th>SIBUMBUNG</th>
								<td>Rp. ' . number_format($data->sibumbung) . '</td>
								<td>' . $data->noa_sibumbung . '</td>
							</tr>
							<tr>
								<th>TAHARA</th>
								<td>Rp. ' . number_format($data->tahara) . '</td>
								<td>' . $data->noa_tahara . '</td>
							</tr>
							<tr>
								<th>SIMASTU</th>
								<td>Rp. ' . number_format($data->simastu) . '</td>
								<td>' . $data->noa_simastu . '</td>
							</tr>
							<tr>
								<th class="redtext">TOTAL</th>
								<td class="redtext"><b>Rp. ' . number_format($data->jumlah) . '</b></td>
								<td class="redtext"><b>' . $data->jumlah_noa . '</b></td>
							</tr>
						</table>';
												?>

												<?php

												}
												?>
											<?php
										} else {
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
	} else if (@$_GET['act'] == 'del') {

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