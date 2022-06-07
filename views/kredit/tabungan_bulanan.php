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
				<h1 class="page-header">TABUNGAN</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-5">
				<div class="panel panel-primary">
					<div class="panel-heading"><em class="fa fa-leanpub">&nbsp;</em>TABUNGAN
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form role="form" action="action/tabungan_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<table border="0">
								<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="TB<?php echo rand(200,1000000) ?>" readonly><br/>
                                    <tr>
										<td width="120px" height="50px"><label>Bulan</label></td>
										<td><input class="form-control" type="date" placeholder="Nominal" name="tgl" value="<?php echo date("Y/m/d");?>"></td>
									</tr>
                                    <tr>
										<td width="120px" height="80px"><label>Nominal</label></td>
										<td><input class="form-control" placeholder="Nominal" name="nominal"></td>
									</tr>
									<tr>
										<td width="120px" height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa"></td>
									</tr>
									<tr>
										<td width="120px" height="70px"><label>Data Nasabah(.xls)</label></td>
										<td><input class="form-control" type="file" name="file" autocomplete="off"></td>
									</tr>
								</table>
								<hr>
								<?php 
									$tampil = $keg->tabungan_tampil();
									while($data = $tampil->fetch_object()) { 
								?>
								<input class="form-control" type="hidden" placeholder="NOA" name="id_keg" value="<?php echo $data->kode ?>">
								<?php
									}
								?>
								<br/>
								<?php 
									$tampil = $keg->users_tampil_session();
									while($data = $tampil->fetch_object()) { 
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="wilayah" value="<?php echo $data->wilayah ?>">
								<?php
									}
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="ao" value="<?php echo $_SESSION['username']; ?>"><br/>
								<input type="submit" class="btn btn-success" name="tambahtabunganbul" style="float:right" value="Simpan">
							</div>
						</form>
					</div>

				</div>
			</div>
			

										
	  <?php
} else if(@$_GET['act'] == 'del') {

	$keg->hapus_tabungan($_GET['kode']);
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