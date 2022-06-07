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
		<script type="text/javascript">
			$(function() {
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
				<h1 class="page-header">REPORT BULANAN TABUNGAN</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Report Bulanan Tabungan
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
							</select><br />
							<label for="">Tahun</label>
							<input type="text" name="tahun" class="form-control" required><br />
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
								$bulan = $_POST['bulan'];
								$tahun = $_POST['tahun'];
								$nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');


								if ($nama != "" || $bulan != "" || $tahun != "") {
									$no = 1;
									$tampil = $keg->report_bulanan();
									if (mysqli_num_rows($tampil) > 0) {
										$result = mysqli_fetch_object($tampil);
										$tercapai = mysqli_num_rows($tampil);

										echo "<a href='../report/cetak_tabungan_bulanan.php?id_keg=$result->id_keg' target='_blank'><button class='btn btn-default btn-md' style='float:right' ><i class='fa fa-print'></i> Cetak PDF</button></a>";
										echo '<b>Report Realisasi Tabungan Bulan ' . $nama_bulan[$_POST['bulan']] . '</b><br /><br />';
										echo "<table width=250 height=120>
                                                        <tr>
                                                            <th> Bulan </th>
                                                            <td>: " . $nama_bulan[$_POST['bulan']] . " </td>
                                                        </tr>
                                                        <tr>
                                                            <th> AO </th>
                                                            <td>: $result->ao </td>
                                                        </tr>
                                                        </table>";

										echo '<hr/>';

								?>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-striped" id="datatables">

												<?php
												$tampil = $keg->report_bulanan();
												while ($data = $tampil->fetch_object()) {
													echo '
						<table class="table table-bordered table-hover table-striped" id="datatables">

							<tr>
								<th width="100px"></th>
								<th align>NOMINAL</th>
								<th>NOA</th>
							</tr>
							<tr>
								<th width="100px">PKM</th>
								<td>Rp. ' . number_format($data->t_pkm) . '</td>
								<td>' . $data->tnoa_pkm . '</td>
							</tr>
							<tr>
								<th>SIBUMBUNG</th>
								<td>Rp. ' . number_format($data->t_sibumbung) . '</td>
								<td>' . $data->tnoa_sibumbung . '</td>
							</tr>
							<tr>
								<th>SIMASPRO</th>
								<td>Rp. ' . number_format($data->t_simaspro) . '</td>
								<td>' . $data->tnoa_simaspro . '</td>
							</tr>
							<tr>
								<th>SIMPEDIK</th>
								<td>Rp. ' . number_format($data->t_simpedik) . '</td>
								<td>' . $data->tnoa_simpedik . '</td>
							</tr>
							<tr>
								<th>SIMASTU</th>
								<td>Rp. ' . number_format($data->t_simastu) . '</td>
								<td>' . $data->tnoa_simastu . '</td>
							</tr>
							<tr>
								<th>TAHARA</th>
								<td>Rp. ' . number_format($data->t_tahara) . '</td>
								<td>' . $data->tnoa_tahara . '</td>
							</tr>
							<tr>
								<th class="redtext">TOTAL</th>
								<td class="redtext"><b>Rp. ' . number_format($data->total) . '</b></td>
								<td class="redtext"><b>' . $data->total_noa . '</b></td>
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