<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_kegiatanlain.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new KL($connection);



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
				<h1 class="page-header">KEGIATAN LAIN</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-4">
				<div class="panel panel-default">
                <?php 
                        $tampil = $keg->kegiatanlain_tampil();
                        while($data = $tampil->fetch_object()) { 
                    ?>
					<div class="panel-heading"><?php echo $data->nama_kegiatan; ?>
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form role="form" action="action/kegiatanlain_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="KL<?php echo rand(200,1000000) ?>">
								<label>Nama Kegiatan</label>
								<select name='nama_keg' class="form-control"> 
									<option value='Edukasi Keuangan'>Edukasi Keuangan</option>
									<option value='Supir'>Supir</option>
									<option value='Instansi Lainnya'>Instansi Lainnya</option>
									<option value='Penarikan'>Penarikan</option>
									<option value='Inklusi Keuangan'>Survey Ulang</option>
									<option value='Lainnya'>Lainnya</option>
								</select><br/>
								<label>Waktu</label>
								<input class="form-control" type="time" placeholder="Nama" name="f_jam">
								<label>s/d</label>
								<input class="form-control" type="time" placeholder="Alamat" name="to_jam"><br/>
								<label>Keterangan</label>
								<textarea class="form-control" name="keterangan" rows="5" cols="10"></textarea>
								<input class="form-control" type="hidden" placeholder="Nominal" name="ao" value="<?php echo $_SESSION['username']; ?>"><br/>
								<input class="form-control" type="hidden" placeholder="Nominal" name="tgl" value="<?php echo date("Y/m/d");?>"><br/>
								
								<?php 
									$tampil = $keg->kegiatanlain_tampil();
									while($data = $tampil->fetch_object()) { 
								?>
								<input class="form-control" placeholder="Nomor HP" type="hidden" value="<?php echo $data->kode; ?>" name="id_keg">
								<?php
									}
								?>
								<br />
								<input type="submit" class="btn btn-success" name="tambahkegiatanlain" style="float:right" value="Simpan">
							</div>
						</form>
					</div>

                        <?php } ?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">DATA KEGIATAN LAIN MASUK</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class= "table table-bordered table-hover table-striped" id="datatables">
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
									$tampil = $keg->kegiatanlain_detail_tampil();
									while($data = $tampil->fetch_object()) { 
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data->nama_keg; ?></td>
									<td><?php echo $data->f_jam; ?></td>	
									<td><?php echo $data->to_jam; ?></td>	
									<td><?php echo $data->keterangan; ?></td>	
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