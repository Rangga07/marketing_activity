<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_tabungan.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new TAB($connection);



if(@$_GET['act'] == '') {
?>


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
				<h1 class="page-header">MASTER TABUNGAN</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DATA MASTER TABUNGAN</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class= "table table-bordered table-hover table-striped" id="datatables">
								<thead>
                                    <tr>
										<th>No</th>
										<th>Nominal</th>
										<th>NOA</th>
                                        <th>Tanggal</th>
										<th align="center">Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$no=1;
									$tampil = $keg->full_tampil_ao();
									while($data = $tampil->fetch_object()) { 
								?>
								<tr>
									<td width="15px"><?php echo $no++; ?></td>
									<td>Rp. <?php echo number_format($data->nominal) ?></td>
									<td><?php echo $data->noa; ?></td>
                                    <td><?php echo $data->tgl; ?></td>	
									<td align="center"><a href="?page=tabungan&act=del&kode=<?php echo $data->kode; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </button>
									</a></td>
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

	$intel->hapus_tabungan($_GET['kode']);
	header("location: ?page=master_tabungan");
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