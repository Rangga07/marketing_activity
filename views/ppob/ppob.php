<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_kegiatan.php";
	require_once('config/+koneksi.php');
	require_once('models/database.php');

	$keg = new KA($connection);



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
				<h1 class="page-header">PPOB</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-5">
				<div class="panel panel-success">
					<div class="panel-heading"><em class="	fa fa-paypal">&nbsp;</em>PPOB
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form role="form" action="action/ppob_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<table border="0">
								<input type="hidden" name="kode" value="KG<?php echo rand(200,1000000) ?>"/>
									<tr>
                                        <input type="hidden" name="nama_kegiatan" value="PPOB" checked/>
										<td width="80px" height="50px"><label>Nominal</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" id="fe" name="nominal" required></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa" required></td>
									</tr>
								</table>
								<hr>
								<input type="hidden" class="form-control" name="tanggal" value="<?php echo date("Y/m/d");?>" >
								<input class="form-control" type="hidden" placeholder="Nominal" name="nama_ao" value="<?php echo $_SESSION['username']; ?>"><br/>
								<input type="submit" class="btn btn-success" name="tambahppob" style="float:right" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
			<div class="panel panel-success">
				<div class="panel-heading">DATA PPOB</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="datatables">
							<thead>
								<tr>
									<th>Nominal</th>
									<th>NOA</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$tampil = $keg->ppob_tampildet();
								while ($data = $tampil->fetch_object()) {
								?>
									<tr>
										<td>Rp. <?php echo number_format($data->nominal); ?></td>
										<td><?php echo $data->noa; ?></td>
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

	header("location: ?page=tabungan");
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