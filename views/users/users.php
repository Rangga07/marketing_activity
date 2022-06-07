<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


	<?php
	include "../models/m_users.php";
	require_once('../config/+koneksi.php');
	require_once('../models/database.php');

	$keg = new USR($connection);

	if (@$_GET['act'] == '') {
	?>

		<style>
			.redtext {
				color: red;
			}
		</style>
		<script type="text/javascript">
			$(function() {
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
				<h1 class="page-header">MANAJEMEN USER</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">BUAT USER BARU
				</div>

				<div class="panel-body">
					<form role="form" action="../action/users_action.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" placeholder="Nama" name="nama" autocomplete="off">
							<p></p>
							<label>Username</label>
							<input class="form-control" placeholder="Username" name="username" autocomplete="off">
							<p></p>
							<label>Password</label>
							<input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
							<p></p><br>
							<label>Level</label><br><br>
							<table border="0" align="left">
								<tr>
									<td width="100px"><input type="radio" name="level" value="admin" class="form" /><b> Admin</td>
									<td width="100px"><input type="radio" name="level" value="AO" class="form" /> <b> AO</td>
									<td width="100px"><input type="radio" name="level" value="analis" class="form" /> <b> Analis</td>
								</tr>
							</table><br />
							<hr />
							<div id="form-ao">
								<label>Wilayah</label>
								<select name='wilayah' class="form-control">
									<option disabled value="-" selected>-- Pilih Wilayah</option>
									<option value='Ciwidey 1'>Ciwidey 1</option>
									<option value='Ciwidey 2'>Ciwidey 2</option>
									<option value='Ciwidey 3'>Ciwidey 3</option>
								</select>
								<p></p>
							</div>
							<div id="form-analis">
								<label>Bagian</label>
								<select name='wilayah' class="form-control">
									<option disabled value="-" selected>-- Pilih Bagian</option>
									<option value='Analis 1'>Analis 1</option>
									<option value='Analis 2'>Analis 2</option>
								</select>
								<p></p>
							</div>
							<br>
							<input type="submit" class="btn btn-success" name="tambahusers" style="float:right" value="Tambah User">
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">DATA USERS</div>
				<div class="panel-body">
					<div class="table-responsive">
						<br />
						<table class="table table-bordered table-hover table-striped" id="datatables">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Username</th>
									<th>Level</th>
									<th>Wilayah</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$tampil = $keg->users_tampil();
								while ($data = $tampil->fetch_object()) {
								?>
									<tr>
										<td><?php echo $data->nama; ?></td>
										<td><?php echo $data->username; ?></td>
										<td><?php echo $data->level; ?></td>
										<?php if ($data->level == 'AO') { ?>
											<td><?php echo $data->wilayah; ?></td>
										<?php } else if ($data->level == 'analis') { ?>
											<td><?php echo $data->wilayah; ?></td>
										<?php } else { ?>
											<td> - </td>
										<?php } ?>
										<td><a href="?page=users&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Anda yakin akan menghapus data ini ?')">
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
</div>



<?php
	} else if (@$_GET['act'] == 'del') {

		$keg->hapus_user($_GET['id']);
		header("location: ?page=users");
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