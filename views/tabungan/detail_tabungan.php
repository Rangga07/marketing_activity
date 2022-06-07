<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<?php
	include "../models/m_tabungan.php";
	require_once('../config/+koneksi.php');
	require_once('../models/database.php');

	$keg = new TAB($connection);


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
				<h1 class="page-header">DETAIL TABUNGAN</h1>
			</div>
		</div>
		<!--/.row-->
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">DATA DETAIL TABUNGAN MASUK</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php
						error_reporting(0);
						$tampil = $keg->detail_full_tampil($_GET['id_keg']);
						$result = mysqli_fetch_object($tampil);

						echo "<a href='../report/cetak_tabungan.php?id_keg=$result->id_keg'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>";

						echo "<table width=250 height=120>
							<tr>
								<th> Tanggal </th>
								<td>: $result->tgl </td>
							</tr>
							<tr>
								<th> AO </th>
								<td>: $result->ao </td>
							</tr>
							</table>";

						echo '<hr/>';
						?>

						<?php
						$no = 1;
						$tampil = $keg->detail_full_tampil($_GET['id_keg']);
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
						}
						?>

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