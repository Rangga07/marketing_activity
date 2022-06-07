<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "../models/m_promosi.php";
	require_once('../config/+koneksi.php');
	require_once('../models/database.php');

	$keg = new PRO($connection);


	if (@$_GET['act'] == 'det') {
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
				<h1 class="page-header">DETAIL PROMOSI</h1>
			</div>
		</div>
		<!--/.row-->
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">DATA DETAIL PROMOSI MASUK</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php

						$id_keg = $_GET['id_keg'];
						$data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_promosi WHERE kode_keg='$id_keg'");
						$data2 = mysqli_query($dbconnect, "SELECT SUM(noa) AS total FROM kegiatan_awal_promosi WHERE kode_keg='$id_keg'");
						$sql = mysqli_query($dbconnect, "SELECT * FROM promosi INNER JOIN kegiatan_awal ON promosi.id_keg=kegiatan_awal.kode WHERE id_keg='$id_keg'");

						$target_noa = mysqli_fetch_array($data2);
						$bio = mysqli_fetch_array($data);
						$tercapai = mysqli_num_rows($sql);

						echo "<a href='../report/cetak_promosi.php?id_keg=$id_keg' target='_blank'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>";

						echo "<table width=290 height=150>
							<tr>
								<th> Tanggal </th>
								<td>: " . $bio['tgl'] . " </td>
							</tr>
							<tr>
								<th> AO </th>
								<td>: " . $bio['ao'] . " </td>
							</tr>
							<tr>
									<th> Target</th>
									<td>: " . $target_noa['total'] . "</td>
							</tr>
							";
						$target = $keg->detail_full_tampil_target_promosi($_GET['id_keg']);
						while ($data = $target->fetch_object()) {
							echo "
								</tr>
									<td></td>
									<td colspan='2'> - " . $data->wilayah . " (NOA: " . $data->noa . ")</td>
								</tr>";
						}
						echo "
							<tr>
								<th> Tercapai </th>
								<td class='redtext'>: $tercapai </td>
							</tr>
							</table>";

						echo '<hr/>';
						?>
						<table class="table table-bordered table-hover table-striped" id="datatables">
							<thead>
								<tr>
									<th>No</th>
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
							<tbody>
								<?php
								$no = 1;
								$tampil = $keg->detail_full_tampil($_GET['id_keg']);
								while ($data = $tampil->fetch_object()) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
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
								} ?>
								<?php
								require_once('../config/+koneksi.php');
								require_once('../models/database.php');
								$tampil = $keg->detail_full_tampil($_GET['id_keg']);
								$data = $tampil->fetch_object();
								$nama_ao = $data->ao;
								$kode = $data->id_keg;
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
						</table>
						</tbody>

					</div>
				</div>
			</div>
		</div>


	<?php
	} else if (@$_GET['act'] == 'del') {

		$intel->hapus($_GET['id']);
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
	<script src="js/custom.js"></script>