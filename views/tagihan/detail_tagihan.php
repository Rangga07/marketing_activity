<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "../models/m_tagihan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new TAG($connection);


if(@$_GET['act'] == 'det') {
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
				<h1 class="page-header">DETAIL TAGIHAN</h1>
			</div> 
		</div><!--/.row-->
			<div class="col-md-12">
				<div class="panel panel-warning">
					<div class="panel-heading">DATA DETAIL TAGIHAN MASUK</div>
					<div class="panel-body">
						<div class="table-responsive">
						
						<?php  
							error_reporting(0);
							$id_keg = $_GET['id_keg'];
							$data = mysqli_query($dbconnect,"SELECT * FROM kegiatan_awal_tagihan WHERE kode_keg='$id_keg' AND status='1'");
							$data2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan WHERE kode_keg='$id_keg' AND status='1'");
							$data3 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE id_keg='$id_keg'");

							$target_noa = mysqli_num_rows($data);
							$bio = mysqli_fetch_array($data);
							$target_nom = mysqli_fetch_array($data2);
							$realisasi_nom = mysqli_fetch_array($data3);

							echo "<a href='../report/cetak_tagihan.php?id_keg=$id_keg'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>";

							echo "<table width=290 height=120>
							<tr>
								<th> Tanggal </th>
								<td>: ".$bio['tgl']." </td>
							</tr>
							<tr>
								<th> Petugas </th>
								<td>: ".$bio['ao']." </td>
							</tr>
							<tr>
								<th> Target NOA</th>
								<td>: $target_noa </td>
							</tr>
							<tr>
								<th> Target Nominal</th>
								<td>: Rp. ".number_format($target_nom['total'])." </td>
							</tr>
							<tr>
								<th> Realisasi</th>
								<td class='redtext'>: Rp. ".number_format($realisasi_nom['total'])." </td>
							</tr>
							</table>";
							
							echo '<hr/>';
						?>
						
							<table class= "table table-bordered table-hover table-striped" id="datatables">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Nasabah</th>
										<th>Alamat</th>
										<th>Kol</th>
										<th>Keputusan</th>
										<th>Pokok</th>
										<th>Bunga</th>
										<th>Jumlah</th>
										<th>Keterangan</th>
										<th>Foto Kunjungan</th>
									</tr>
									
								</thead>
								<tbody>
								<?php 
									$no=1;
									$tampil = $keg->detail_full_tampil($_GET['id_keg']);
									while($data = $tampil->fetch_object()) { 
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $data->nama ?></td>
									<td><?= $data->alamat ?></td>
									<td><?php echo $data->kolek ?></td>	
									<td><?php echo $data->ket ?></td></td>
									<?php if($data->jml_pokok || $data->jml_bunga > 0){ ?>
									<td>Rp. <?php echo number_format($data->jml_pokok) ?></td></td>
									<td>Rp. <?php echo number_format($data->jml_bunga) ?></td></td>
									<?php }else{ ?>
									<td align="center">-</td>
									<td align="center">-</td>
									<?php } ?>
									<?php if($data->ket == 'Bayar'){ ?>
									<td>Rp. <?php echo number_format($data->jumlah); ?></td>
									<td><?php echo $data->keterangan; ?></td>
									<td><a href="#id<?= $data->kode_tag; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a></td>
									<div class="modal fade" id="id<?= $data->kode_tag; ?>" role="dialog">
										<div class="modal-dialog">
										 
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
											<img style="display: block;margin-left: auto;margin-right: auto;" src="<?= "../assets/images/kunjungan/".$data->foto_knj ?>" width='60%' height='60%'><br>
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
										
										</div>
									</div>
									<?php }else{ ?>
									<td align="center">-</td>
									<td><?php echo $data->keterangan; ?></td>
									<td><a href="#id<?= $data->kode_tag; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a></td>
									<div class="modal fade" id="id<?= $data->kode_tag; ?>" role="dialog">
										<div class="modal-dialog">
										
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
											<img style="display: block;margin-left: auto;margin-right: auto;" src="<?= "../assets/images/kunjungan/".$data->foto_knj ?>" width='60%' height='60%'><br>
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
										
										</div>
									</div>
									<?php } ?>
								</tr>
								<?php
								} ?>
								<?php
									require_once('../config/+koneksi.php');
									require_once('../models/database.php');
									$tgl = date("Y/m/d");
									$tampil = $keg->detail_full_tampil($_GET['id_keg']);
									$data = $tampil->fetch_object();
									$nama_ao = $data->nama_ao;
									$kode = $data->kode;
									$sql2 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama_ao' AND id_keg='$kode'");

									$total = mysqli_fetch_array($sql2);
								?>
								<tr>
									<td colspan="6" align="center"><b>TOTAL REALISASI TAGIHAN</b></td>
									<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total['total']) ?></b></td>
								</tr>
								</table>
								</tbody>
                                
						</div>
						
					</div>
				</div>
			</div>

										
	  <?php
} else if(@$_GET['act'] == 'del') {

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