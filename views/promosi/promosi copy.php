<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<?php
include "models/m_promosi.php";
require_once('config/+koneksi.php');
require_once('models/database.php');

$keg = new PRO($connection);



if(@$_GET['act'] == '') {
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
				<h1 class="page-header">PROMOSI</h1>
			</div>
		</div><!--/.row-->
		<p id="timestamp"></p>
		<div class="col-md-4">
				<div class="panel panel-danger">
                <?php 
                        $tampil = $keg->promosi_tampil();
                        while($data = $tampil->fetch_object()) { 
                    ?>
					<div class="panel-heading"><?php echo $data->nama_kegiatan; ?>
						<span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form role="form" action="action/promosi_action.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<input class="form-control" type="hidden" placeholder="Nama" name="kode" value="PRO<?php echo rand(200,1000000) ?>">
								<label>Wilayah</label>
								<input class="form-control" placeholder="Wilayah" name="wilayah" autocomplete="off"><p></p>
								<label>Nama</label>
								<input class="form-control" placeholder="Nama" name="nama" autocomplete="off"><p></p>
								<label>Alamat</label>
								<input class="form-control" placeholder="Alamat" name="alamat" autocomplete="off"><p></p>
								<label>No HP</label>
								<input class="form-control" placeholder="Nomor HP" name="no_hp"><br/>
								<table align="center">
									<tr>
										<td width="100px"><input type="radio" name="kep" value="Deal" class="form"/><b> Deal  </td>
										<td width="100px"><input type="radio" name="kep" value="No Deal" class="form"/> <b> No Deal</td>
									</tr>
								</table><br/> 
								<hr/>
									<div id="form-deal">
										<label>Produk</label>	
										<select name='produk' class="form-control"> 
											<option disabled value="-" selected>-- Pilih Produk</option>
											<option value='Tabungan'>Tabungan</option>
											<option value='Deposito'>Deposito</option>
											<option value='Kredit'>Kredit</option>
										</select><p></p>
										<label>Nominal</label>
										<input type="text" class="form-control" placeholder="Nominal" name="nominal" autocomplete="off" ><p></p>
									</div>
									<label>Keterangan</label>
									<input class="form-control" placeholder="Keterangan" name="keterangan" autocomplete="off"><p></p>
								<?php 
									$tampil = $keg->promosi_tampil();
									while($data = $tampil->fetch_object()) { 
								?>
								<input class="form-control" placeholder="Nomor HP" type="hidden" value="<?php echo $data->kode; ?>" name="id_keg">
								<?php
									}
								?>
								<input class="form-control" type="hidden" placeholder="Nominal" name="tgl" value="<?php echo date("Y/m/d");?>"><br/>
								<input class="form-control" type="hidden" placeholder="Nominal" name="ao" value="<?php echo $_SESSION['username']; ?>"><br/>
								<br />
								<input type="submit" class="btn btn-success" name="tambahpromosi" style="float:right" value="Simpan">
							</div>
						</form> 
					</div>

                        <?php } ?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-danger">
					<div class="panel-heading">DATA PROMOSI MASUK</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table>
								<?php 
									$no=1;
									$tampil = $keg->promosi_tampil();
									while($data = $tampil->fetch_object()) { 
								?>
									<tr>
										<td width="120px"><b>Target Promosi</b></td>
										<td>: <?php echo $data->target_pro ?></td>
									</tr>
								<?php } ?> 
							</table>
							<br/>
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
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$no=1;
									$tampil = $keg->promosi_detail_tampil();
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
									<td align="center"><a href="?page=promosi&act=del&kode=<?php echo $data->kode; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </button>
									</a></td>
								</tr>
								<?php
								} ?>
								<?php
									error_reporting(0);
									require_once('config/+koneksi.php');
									require_once('models/database.php');
									$tgl = date("Y/m/d");
									$tampil = $keg->promosi_detail_tampil();
									$data = $tampil->fetch_object();
									$nama_ao = $data->ao;
									$kode = $data->kode;
									$sql2 = mysqli_query($dbconnect,"SELECT SUM(nominal) AS total FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl'");
									$total = mysqli_fetch_array($sql2);
								?>
								<tr>
									<td colspan="7" align="center"><b>TOTAL REALISASI PROMOSI</b></td>
									<td colspan="2" class="redtext" align="center" class="redtext"><b>Rp. <?php echo number_format($total['total']) ?></b></td>
								</tr>
								</table>
								</tbody>
						</div>
					</div>
				</div>
			</div>

										
	  <?php
} else if(@$_GET['act'] == 'del') {

	$keg->hapus_promosi($_GET['kode']);
	header("location: ?page=promosi");
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