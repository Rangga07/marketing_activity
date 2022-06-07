<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


	<?php
	include "../models/m_promosi.php";
	require_once('../config/+koneksi.php');
	require_once('../models/database.php');

	$keg = new PRO($connection);

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
				<h1 class="page-header">REPORT HARIAN PROMOSI</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">Report Harian Promosi
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
										$data = mysqli_query($dbconnect, "SELECT SUM(noa) as total FROM kegiatan_awal_promosi WHERE ao='$nama' AND tgl='$ftanggal'");
										$data2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM kegiatan_awal_promosi WHERE ao='$nama' AND tgl='$ftanggal'");
										$data3 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama' AND tgl='$ftanggal'");
										$data4 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE ao='$nama' AND tgl='$ftanggal'");

										$target_noa = mysqli_fetch_array($data);
										$bio = mysqli_fetch_array($data4);
										$realisasi_nom = mysqli_fetch_array($data3);

										echo "<a href='../report/cetak_promosi.php?id_keg=$bio[id_keg]' target='_blank'><button class='btn btn-default btn-md' style='float:right' ><i class='fa fa-print'></i> Cetak PDF</button></a>";

										echo "<table width=300 height=120>
                                                        <tr>
                                                            <th> Tanggal </th>
                                                            <td>: " . $bio['tgl'] . " </td>
                                                        </tr>
                                                        <tr>
                                                            <th> AO </th>
                                                            <td>: " . $bio['ao'] . " </td>
														</tr>
														<tr>
                                                            <th> Target NOA Promosi </th>
                                                            <td>: " . $target_noa['total'] . " </td>
                                                        </tr>
                                                        </table>";

										echo '<hr/>';

								?>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-striped" id="datatables">
												<thead>
													<tr>
														<th>Wilayah</th>
														<th>Nama</th>
														<th>Alamat</th>
														<th>No HP</th>
														<th>Keputusan</th>
														<th>Produk</th>
														<th>Nominal</th>
														<th>Keterangan</th>
													</tr>

												</thead>
												<?php
												$tampil = $keg->report_harian();
												while ($data = $tampil->fetch_object()) {

												?>

													<tr>
														<td><?php echo $data->wilayah ?></td>
														<td><?php echo $data->nama ?></td>
														<td><?php echo $data->alamat ?></td>
														</td>
														<td><?php echo $data->no_hp ?></td>
														</td>
														<td><?php echo $data->kep ?></td>
														</td>
														<?php if ($data->kep == 'Deal') { ?>
															<td><?php echo $data->produk; ?></td>
															<td>Rp. <?php echo number_format($data->nominal) ?></td>
														<?php } else { ?>
															<td>-</td>
															<td>-</td>
														<?php } ?>
														<td><?php echo $data->keterangan; ?></td>
													</tr>
												<?php

												}
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');
												$tgl = date("Y/m/d");
												$tampil = $keg->report_harian();
												$data = $tampil->fetch_object();
												$nama_ao = $data->nama_ao;
												$kode = $data->kode;
												//$sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND id_keg='$kode'");
												$sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND id_keg='$kode' AND produk='Kredit'");
												$sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND id_keg='$kode' AND produk='Tabungan'");
												$sql4 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND id_keg='$kode' AND produk='Deposito'");

												$total_kredit = mysqli_fetch_array($sql2);
												$total_tabungan = mysqli_fetch_array($sql3);
												$total_depo = mysqli_fetch_array($sql4);
												?>
												<tr>
													<td colspan="7" align="center"><b>TOTAL PROMOSI RENCANA KREDIT</b></td>
													<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_kredit['total']) ?></b></td>
												</tr>
												<tr>
													<td colspan="7" align="center"><b>TOTAL PROMOSI TABUNGAN</b></td>
													<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_tabungan['total']) ?></b></td>
												</tr>
												<tr>
													<td colspan="7" align="center"><b>TOTAL PROMOSI DEPOSITO</b></td>
													<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_depo['total']) ?></b></td>
												</tr>
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