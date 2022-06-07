<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    include "../models/m_survey.php";
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');

    $keg = new SUR($connection);


    if (@$_GET['act'] == 'det') {
    ?>

        <style>
            .redtext {
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
                <h1 class="page-header">DETAIL SURVEY</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">DATA DETAIL SURVEY MASUK</div>
                <div class="panel-body">
                    <div class="table-responsive">

                        <?php
                        $id_keg = $_GET['id_keg'];
                        $data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_survey WHERE kode_keg='$id_keg'");

                        $target = mysqli_fetch_array($data);

                        echo "<a href='../report/cetak_survey.php?id_keg=$id_keg'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>";

                        echo "<table width=290 height=160>
							<tr>
								<th height=25> Tanggal </th>
								<td>: " . $target['tgl'] . " </td>
							</tr>
							<tr>
								<th height=25> AO </th>
								<td>: " . $target['ao'] . " </td>
							</tr>
                            <tr>
								<th height=25> Target</th>
                                <td>:</td>
							</tr>";
                        $nama = $keg->detail_full_tampil_target_survey($_GET['id_keg']);
                        while ($data = $nama->fetch_object()) {
                            echo "
								</tr>
                                    <td></td>
									<td colspan='2'>Nama : " . $data->nama_nas . "<br/>
                                    Alamat : " . $data->alamat . "<hr/>
                                    </td>
								</tr>";
                        }

                        echo "
							</table>";

                        echo '<hr/>';
                        ?>

                        <table class="table table-bordered table-hover table-striped" id="datatables">
                            <thead>
                                <tr></tr>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Nasabah</th>
                                    <th>Alamat</th>
                                    <th>Pengajuan</th>
                                    <th>Pelaksanaan</th>
                                    <th>Keterangan</th>
                                    <th>Foto Kunjungan</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = $keg->detail_full_tampil($_GET['id_keg']);
                                while ($data = $tampil->fetch_object()) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data->nama ?></td>
                                        <td><?php echo $data->alamat ?></td>
                                        <td>Rp. <?php echo number_format($data->nominal_peng) ?></td>
                                        <td><?php echo $data->ket ?></td>
                                        <td><?php echo $data->keterangan ?></td>
                                        <td><a href="#id<?= $data->kode_sur; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a></td>
    									<div class="modal fade" id="id<?= $data->kode_sur; ?>" role="dialog">
    										<div class="modal-dialog">
    										
    										<!-- Modal content-->
    										<div class="modal-content">
    											<div class="modal-header">
    											<button type="button" class="close" data-dismiss="modal">&times;</button>
    											</div>
    											<div class="modal-body">
    											<img style="display: block;margin-left: auto;margin-right: auto;" src="<?= "../assets/images/kunjungan/".$data->foto_knj ?>" width='60%' height='60%'><br>
    											</div>
    											<div class="modal-footer">
    											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    											</div>
    										</div>
    										
    										</div>
    									</div>
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
    } else if (@$_GET['act'] == 'del') {

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