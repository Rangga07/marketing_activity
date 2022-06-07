<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_rbb_kredit.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new RBBKRE($connection);

if(@$_GET['act'] == '') {
?>

	<style>
		.redtext{
			color: red;
		}
	</style>
	<script type="text/javascript">
		$( function() {
			$("#from").datepicker();
		});
	</script>
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
				<h1 class="page-header">RBB kredit</h1>
			</div>
            <div class="col-lg-12">
			</div>
			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body tabs">
						<ul class="nav nav-pills">
							<li class="active"><a href="#pilltab" data-toggle="tab">ALL</a></li>
							<li><a href="#pilltab1" data-toggle="tab">Bulan</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Wilayah</a></li>
							<li><a href="#pilltab3" data-toggle="tab">AO</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab">
                                <div class="panel-body">
                                    <form role="form" action="../action/rbb_kredit_action.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" placeholder="Nama" name="kode" value="RTAB<?php echo rand(200,1000) ?>" readonly><br/>
                                            <label>Tahun</label><br/>
                                            <select name='periode' class="form-control"> 
                                                <option selected='selected' disabled>-- Pilih Tahun</option>
                                                <option value='2020'>2020</option>
												<option value='2021'>2021</option>
                                                <option value='2022'>2022</option>
                                                <option value='2023'>2023</option>
												<option value='2024'>2024</option>
												<option value='2024'>2025</option>
                                            </select>
                                            <br/>
                                            <label>Nominal</label>
                                            <input class="form-control" placeholder="Nominal" name="nominal" id="fc"><br/>
                                            
                                            <br>
                                            <input type="submit" class="btn btn-success" name="tambahall" style="float:right" value="Simpan">
                                        </div>
                                    </form>
									<br><br>
									<hr>
									<h4 align="center"><b> RBB KREDIT KESELURUHAN </b></h4>
									<br>
									<table class= "table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th>Periode</th>
												<th>Target</th>
											</tr>
										</thead>
										<?php  
											$no = 1;
											$tampil = $keg->rbb_all_tampil();
											while($data = $tampil->fetch_object()) { 
										?>	
										<tbody>
											<tr>
												<td><?php echo $data->periode; ?></td>
												<td>Rp. <?php echo number_format($data->nominal) ?> ,-</td>
											</tr>
										</tbody>
										<?php 
											}
										?>
									</table>
                                </div>
							</div>
							<div class="tab-pane fade" id="pilltab1">
                                <div class="panel-body">
                                    <form role="form" action="../action/rbb_kredit_action.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" placeholder="Nama" name="kode" value="RBUL<?php echo rand(200,1000) ?>" readonly><br/>
                                            <label>Tahun</label><br/>
                                            <select class="form-control" name="kode_all" id="tahun">
												<option selected='selected' disabled>-- Pilih Periode</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												$sql = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_all");

												while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
													echo "<option value='".$data['kode']."'>".$data['periode']."</option>";
												}
												?>
											</select>
											<br>
											<label>Bulan</label><br/>
                                            <select name='bulan' class="form-control"> 
                                                <option selected='selected' disabled>-- Pilih Bulan</option>
                                                <option value='1'>JANUARI</option>
                                                <option value='2'>FEBRUARI</option>
                                                <option value='3'>MARET</option>
												<option value='4'>APRIL</option>
												<option value='5'>MEI</option>
												<option value='6'>JUNI</option>
												<option value='7'>JULI</option>
												<option value='8'>AGUSTUS</option>
												<option value='9'>SEPTEMBER</option>
												<option value='10'>OKTOBER</option>
												<option value='11'>NOVEMBER</option>
												<option value='12'>DESEMBER</option>
                                            </select>
                                            <br/>
                                            <label>Nominal</label>
                                            <input class="form-control" placeholder="Nominal" name="nominal_bul" id="fd"><br/>
                                            
                                            <br>
                                            <input type="submit" class="btn btn-success" name="tambahbul" style="float:right" value="Simpan">
                                        </div>
                                    </form>
									<br><br>
									<hr>
									<h4 align="center"><b> RBB KREDIT PERBULAN </b></h4>
									<br>
									<table class= "table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th>Periode</th>
												<th>Bulan</th>
												<th>Target</th>
											</tr>
										</thead>
										<?php  
											$no = 1;
											$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
											$tampil = $keg->rbb_bul_tampil();
											while($data = $tampil->fetch_object()) { 

										?>	
										<tbody>
											<tr>
												<td><?php echo $data->periode; ?></td>
												<td><?php echo $nama_bulan[$data->bulan] ?></td>
												<td>Rp. <?php echo number_format($data->nominal_bul) ?> ,-</td>
											</tr>
										</tbody>
										<?php 
											}
										?>
									</table>
                                </div>
							</div>
							<div class="tab-pane fade" id="pilltab2">
                                <div class="panel-body">
                                    <form role="form" action="../action/rbb_kredit_action.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
										<label>Tahun</label><br/>
											<select class="form-control" name="kode_all" id="tahun">
											<option selected='selected' disabled>-- Pilih Tahun</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												$sql = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_all");

												while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
													echo "<option value='".$data['kode']."'>".$data['periode']."</option>";
												}
												?>
											</select>
                                            <input class="form-control" type="hidden" placeholder="Nama" name="kode" value="RWIL<?php echo rand(200,10000) ?>" readonly><br/>
											<label>Bulan</label><br/>
                                            <select class="form-control" name="kode_bul" id="tahun">
												<option selected='selected' disabled>-- Pilih Bulan</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												$sql = mysqli_query($dbconnect, "SELECT rbb_kredit_bul.kode,rbb_kredit_bul.bulan,rbb_kredit_all.periode FROM rbb_kredit_bul JOIN rbb_kredit_all ON rbb_kredit_bul.kode_all=rbb_kredit_all.kode");
												$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

												while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
													echo "<option value='".$data['kode']."'>".$nama_bulan[$data['bulan']]." ".$data['periode']."</option>";
												}
												?>
											</select>
											<br>
											<label>Wilayah</label><br/>
                                            <select name='wilayah' class="form-control"> 
                                                <option selected='selected' disabled>-- Pilih Wilayah</option>
                                                <option value='Ciwidey 1'>Ciwidey 1</option>
                                                <option value='Ciwidey 2'>Ciwidey 2</option>
                                                <option value='Ciwidey 3'>Ciwidey 3</option>
                                            </select>
											<br>
                                            <label>Target</label>
                                            <input class="form-control" placeholder="Nominal" name="nominal_wil" id="fe"><br/>
                                            </p>
                                            <br>
                                            <input type="submit" class="btn btn-success" name="tambahwil" style="float:right" value="Simpan">
                                        </div>
                                    </form>
									<br><br>
									<hr>
									<h4 align="center"><b> RBB KREDIT PER WILAYAH </b></h4>
									<br>
									<table class= "table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<th>Wilayah</th>
												<th>Target</th>
												<th>Periode</th>
												<th>Bulan</th>
											</tr>
										</thead>
										<?php  
											$no = 1;
											$tampil = $keg->rbb_wil_tampil();
											$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
											while($data = $tampil->fetch_object()) { 
										?>	
										<tbody>
											<tr>
												<td><?php echo $data->wilayah; ?></td>
												<td>Rp. <?php echo number_format($data->nominal_wil) ?> ,-</td>
												<td><?php echo $data->periode; ?></td>
												<td><?php echo $nama_bulan[$data->bulan] ?></td>
											</tr>
										</tbody>
										<?php 
											}
										?>
									</table>
                                </div>
                                <hr>
							</div>
							<div class="tab-pane fade" id="pilltab3">
							<div class="panel-body">
								<form role="form" action="../action/rbb_kredit_action.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
											<label>Periode</label><br/>
											<select class="form-control" name="kode_all" id="tahun">
												<option selected='selected' disabled>-- Pilih Tahun</option>
													<?php
													require_once('../config/+koneksi.php');
													require_once('../models/database.php');

													$sql = mysqli_query($dbconnect, "SELECT * FROM rbb_kredit_all");

													while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
														echo "<option value='".$data['kode']."'>".$data['periode']." </option>";
													}
													?>
											</select>
											<br>
											<label>Bulan</label><br/>
											<select class="form-control" name="kode_bul" id="tahun">
												<option selected='selected' disabled>-- Pilih Bulan</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												$sql = mysqli_query($dbconnect, "SELECT rbb_kredit_bul.kode, rbb_kredit_bul.bulan, rbb_kredit_all.periode FROM rbb_kredit_bul JOIN rbb_kredit_all ON rbb_kredit_bul.kode_all=rbb_kredit_all.kode");
												$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

												while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
													echo "<option value='".$data['kode']."'>".$nama_bulan[$data['bulan']]." ".$data['periode']."</option>";
												}
												?>
											</select>
											<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="RAO<?php echo rand(200,100000) ?>" readonly><br/>
											<label>AO</label><br/>
											<select class="form-control" name="id_user">
												<option selected='selected' disabled>-- Pilih AO</option>
												<?php
												require_once('../config/+koneksi.php');
												require_once('../models/database.php');

												$sql="SELECT * FROM user WHERE level='AO'";

												$hasil=mysqli_query($dbconnect,$sql);
												$no=0;
												while ($data = mysqli_fetch_array($hasil)) {
													$no++;

													$ket="";
													if (isset($_GET['id'])) {
														$no_id = trim($_GET['id']);

														if ($no_id==$data['id'])
														{
															$ket="selected";
														}
													}
													?>
												<option <?php echo $ket; ?> value="<?php echo $data['id'];?>"><?php echo $data['nama'];?> - <?php echo $data['wilayah']?></option>
													<?php
													}
													?>
											</select>
										<br>
										<label>Target</label>
										<input class="form-control" placeholder="Nominal" name="nominal_ao" id="ff"><br/>
										</p>
										<br>
										<input type="submit" class="btn btn-success" name="tambahao" style="float:right" value="Simpan">
									</div>
								</form>
								<br><br>
								<hr>
								<h4 align="center"><b> RBB kredit PER AO </b></h4>
								<br>
								<table class= "table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>AO</th>
											<th>Wilayah</th>
											<th>Target</th>
											<th>Bulan</th>
											<th>Periode</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<?php  
										$no = 1;
										$tampil = $keg->rbb_ao_tampil();
										$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
										while($data = $tampil->fetch_object()) { 
									?>	
									<tbody>
										<tr>
											<td><?php echo $data->nama; ?></td>
											<td><?php echo $data->wilayah; ?></td>
											<td>Rp. <?php echo number_format($data->nominal_ao) ?> ,-</td>
											<td><?php echo $nama_bulan[$data->bulan] ?></td>
											<td><?php echo $data->periode; ?></td>
											<td align="center"><a href="?page=rbb_kredit&act=del&kode=<?php echo $data->kode; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
											<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </button>
											</a></td>
										</tr>
									</tbody>
									<?php 
										}
										
									?>
								</table>
							</div>
							<hr>
							</div>
						</div>
						
					</div>
				</div><!--/.panel-->
			</div><!-- /.col-->
    </div><!--/.row-->

		
			
										
	  <?php
} else if(@$_GET['act'] == 'del') {

	$keg->hapus_rbb_ao($_GET['kode']);
	header("location: ?page=rbb_kredit");
}

?>


	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>