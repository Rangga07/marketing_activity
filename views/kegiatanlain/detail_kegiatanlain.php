<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "../models/m_kegiatanlain.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new KL($connection);

 
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
				<h1 class="page-header">DETAIL KEGIATAN LAIN</h1>
			</div>
		</div><!--/.row-->
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DATA DETAIL KEGIATAN LAIN MASUK</div>
					<div class="panel-body">
						<div class="table-responsive">
                        <?php 
                            error_reporting(0);
                            
							$tampil = $keg->detail_full_tampil($_GET['id_keg']);
							$result = mysqli_fetch_object($tampil);
							$tercapai = mysqli_num_rows($tampil);

							echo "<a href='../report/cetak_kegiatanlain.php?id_keg=$result->id_keg'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>";

							echo "<table width=250 height=120>
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
							<table class= "table table-hover table-striped" id="datatables">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Kegiatan</th>
										<th>Dari Jam</th>
										<th>Sampai Jam</th>
										<th>Keterangan</th>
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
									<td><?php echo $data->nama_keg ?></td>
									<td><?php echo $data->f_jam ?></td>	
									<td><?php echo $data->to_jam ?></td></td>
									<td><?php echo $data->keterangan ?></td></td>
								</tr>
								<?php
								} ?>
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