<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_bulanan.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new BUL($connection);



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
				<h1 class="page-header">PELUNASAN</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading"><em class="fa fa-cube">&nbsp;</em>BAKI DEBET
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form role="form" action="action/bakidebet_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<table border="0">
								<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="BD<?php echo rand(200,10000000) ?>" readonly><br/>
									<tr>
										<td width="120px" height="50px"><label>BK Lancar</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="bk_lancar" id="fc"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_lancar"><br/></td>
									</tr>
                                    <tr>
										<td width="80px" height="50px"><label>BK DPK</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="bk_dpk" id="fd"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_dpk" ><br/></td>
									</tr>
                                    <tr>
										<td width="80px" height="50px"><label>BK KL</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="bk_kl" id="fe"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_kl"><br/></td>
									</tr>
                                    <tr>
										<td width="100px" height="50px"><label>BK Diragukan</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="bk_dir" id="ff"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_dir"><br/></td>
									</tr>
                                    <tr>
										<td width="100px" height="50px"><label>BK Macet</label></td>
										<td width="250px"><input class="form-control" placeholder="Nominal" name="bk_m" id="fg"></td>
									</tr>
									<tr>
										<td height="70px"><label>NOA</label></td>
										<td><input style="width: 60px;" class="form-control" placeholder="Noa" name="noa_m"><br/></td>
									</tr>
									<tr>
									    <td height="70px"><label>Tanggal</label></td>
									    <td><input class="form-control" type="date" placeholder="Nominal" name="tgl"><br /></td>
								    </tr>
								</table>
								<hr>
								<?php 
									$tampil = $keg->users_tampil_session();
									while($data = $tampil->fetch_object()) { 
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="wilayah" value="<?php echo $data->wilayah ?>">
								<?php
									}
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="ao" value="<?php echo $_SESSION['username']; ?>"><br/>
								<input type="submit" class="btn btn-success" name="tambahbakidebet" style="float:right" value="Simpan">
							</div>
						</form>
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