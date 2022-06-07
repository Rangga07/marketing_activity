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
				<h1 class="page-header">PENGATURAN AKSES</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">PENGATURAN BATAS WAKTU AKSES
				</div>
                <?php
                $no = 1;
                $tampil = $keg->waktu_tampil();
                while ($data = $tampil->fetch_object()) {
                ?>
				<div class="panel-body">
					<form role="form" action="../action/users_action.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Batas input rencana</label>
							<input class="form-control" placeholder="Nama" value="<?= $data->time ?>" name="nama" autocomplete="off" disabled>
							<p></p>
							
							<br>
							<a style="float: right;" href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data->id; ?>"><i class="fa fa-edit"></i>EDIT</a>
						</div>
					</form>
                    <div class="modal fade" id="myModal<?php echo $data->id; ?>" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <br>
                            <h6 align="center">EDIT WAKTU</h6>
                            <hr>
                            <div class="modal-body">
                                <form role="form" action="../action/edit_akses.php" method="get">
                                    <label for="">Batas Waktu</label>
                                    <input type="hidden" class="form-control" placeholder="Nama" value="<?= $data->id ?>" name="id" autocomplete="off"><br>
                                    <input type="time" class="form-control" placeholder="Nama" value="<?= $data->time ?>" name="time" autocomplete="off"><br>
                                    <button type="submit" class="btn btn-success">SIMPAN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
                <?php } ?>
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