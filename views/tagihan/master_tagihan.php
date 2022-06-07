<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_tagihan.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new TAG($connection);



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
				<h1 class="page-header">MASTER TAGIHAN</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DATA MASTER TAGIHAN<a data-toggle="modal" data-target="#tambah" class="btn btn-success btn-sm" style="float:right">Tambah</a>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class= "table table-bordered table-hover table-striped" id="datatables">
								<thead>
									<tr>
                                        <th>No</th>
										<th>Nama Nasabah</th>
										<th>Kolek</th>
										<th>Ket</th>
										<th>Pokok</th>
										<th>Bunga</th>
										<th>Jumlah</th>
										<th>Penjelasan</th>
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
									<td><?php echo $data->nama; ?></td>
									<td><?php echo $data->kolek; ?></td>	
									<td><?php echo $data->ket; ?></td></td>
									<?php if($data->jml_pokok || $data->jml_bunga > 0){ ?>
									<td>Rp. <?php echo number_format($data->jml_pokok) ?></td></td>
									<td>Rp. <?php echo number_format($data->jml_bunga) ?></td></td>
									<?php }else{ ?>
									<td>-</td>
									<td>-</td>
									<?php } ?>
									<?php if($data->ket == 'Bayar'){ ?>
									<td>Rp. <?php echo number_format($data->jumlah); ?></td>
									<td>-</td>
									<?php }else{ ?>
									<td>-</td>
									<td><?php echo $data->keterangan; ?></td>
									<?php } ?>
                                    <td><?php echo $data->tgl; ?></td>
									<td align="center"><a href="?page=tagihan&act=del&kode=<?php echo $data->kode; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
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

	$intel->hapus_tagihan($_GET['kode']);
	header("location: ?page=master_tagihan");
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