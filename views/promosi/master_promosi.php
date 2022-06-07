<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_promosi.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new PRO($connection);



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
				<h1 class="page-header">MASTER PROMOSI</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DATA MASTER PROMOSI</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class= "table table-bordered table-hover table-striped" id="datatables">
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
                                        <th>Tanggal</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$no=1;
									$tampil = $keg->full_tampil_ao();
									while($data = $tampil->fetch_object()) { 
								?>
								<tr>
                                <td><?php echo $no++; ?></td>
									<td><?php echo $data->wilayah; ?></td>
									<td><?php echo $data->nama; ?></td>	
									<td><?php echo $data->alamat; ?></td>	
									<td><?php echo $data->no_hp; ?></td>
									<td><?php echo $data->kep; ?></td>
									<?php if($data->kep == 'Deal'){ ?>
									<td><?php echo $data->produk; ?></td>
									<td>Rp. <?php echo number_format($data->nominal) ?></td>
									<?php }else{ ?>
									<td>-</td>
									<td>-</td>
									<?php } ?>
									<td><?php echo $data->keterangan; ?></td>
                                    <td><?php echo $data->tgl; ?></td>
									<td align="center"><a href="?page=promosi&act=del&kode=<?php echo $data->kode; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
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

	$intel->hapus_promosi($_GET['kode']);
	header("location: ?page=master_promosi");
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