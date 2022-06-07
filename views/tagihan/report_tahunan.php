<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


<?php
include "../models/m_tagihan.php";
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$keg = new TAG($connection);

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
				<h1 class="page-header">REPORT HARIAN TAGIHAN</h1>
			</div>
		</div><!--/.row-->

		<div class="col-md-12">
				<div class="panel panel-warning">
					<div class="panel-heading">Data Report Harian 
					</div>
					
					<div class="panel-body">
								<form action="" method="POST">
										<div class="form-group col-md-5">
										<label for="">AO</label>
										<input type="text" name="ao" class="form-control" required><br/>
										<label for="">Tanggal</label>
										<input type="date" id="from" name="tgl" class="form-control" required><br/>
										<input type="submit" class="btn btn-success" name="submit" value="Cari">
									</div>
								</form>
						<div class="row">
							<div class="col-md-12">   
								
							<hr/>
								
										
										<?php 
											if(!isset($_POST['submit'])){

														?>
												<?php
																	
												}
												else{
													$nama = $_POST['ao'];
													$tanggal = $_POST['tgl'];
													$ftanggal = strtotime($tanggal);
													$ftanggal = date("Y/m/d", $ftanggal);
													if($nama != "" || $ftanggal != ""){
														$no=1;
													$tampil = $keg->report_harian();
													if(mysqli_num_rows($tampil) > 0){
                                                        $result = mysqli_fetch_object($tampil);
                                                        $tercapai = mysqli_num_rows($tampil);
                            
                                                        echo "<a href='../report/cetak_tagihan.php?id_keg=$result->id_keg' target='_blank'><button class='btn btn-default btn-md' style='float:right' ><i class='fa fa-print'></i> Cetak</button></a>";
                            
                                                        echo "<table width=250 height=120>
                                                        <tr>
                                                            <th> Tanggal </th>
                                                            <td>: $result->tanggal </td>
                                                        </tr>
                                                        <tr>
                                                            <th> AO </th>
                                                            <td>: $result->nama_ao </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Target NOA</th>
                                                            <td>: $result->target_noa </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Target Nominal</th>
                                                            <td>: Rp. ".number_format($result->target_nom)." </td>
                                                        </tr>
                                                        </table>";
                                                        
                                                        echo '<hr/>';

                                                        ?>
                                                        <div class="table-responsive">
									            <table class= "table table-bordered table-hover table-striped" id="datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Nasabah</th>
                                                            <th>Kolek</th>
                                                            <th>(Bayar/Tidak Bayar)</th>
                                                            <th>Pokok</th>
                                                            <th>Bunga</th>
                                                            <th>Jumlah</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <?php
                                                    $tampil = $keg->report_harian();
													while($data = $tampil->fetch_object()) { 

													?>
                                                    
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?php echo $data->nama; ?></td>
														<td><?php echo $data->kolek; ?></td>
														<td><?php echo $data->ket ?></td></td>
                                                        <?php if($data->jml_pokok || $data->jml_bunga > 0){ ?>
                                                        <td>Rp. <?php echo number_format($data->jml_pokok) ?></td></td>
                                                        <td>Rp. <?php echo number_format($data->jml_bunga) ?></td></td>
                                                        <?php }else{ ?>
                                                        <td align="center">-</td>
                                                        <td align="center">-</td>
                                                        <?php } ?>
                                                        <?php if($data->ket == 'Bayar'){ ?>
                                                        <td>Rp. <?php echo number_format($data->jumlah); ?></td>
                                                        <td align="center">-</td>
                                                        <?php }else{ ?>
                                                        <td align="center">-</td>
                                                        <td><?php echo $data->keterangan; ?></td>
                                                        
                                                        <?php } ?>
													
													</tr>
													<?php
													
                                                }
									require_once('../config/+koneksi.php');
									require_once('../models/database.php');
									$tgl = date("Y/m/d");
									$tampil = $keg->report_harian();
									$data = $tampil->fetch_object();
									$nama_ao = $data->nama_ao;
									$kode = $data->kode;
									$sql2 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE ao='$nama_ao' AND id_keg='$kode'");

									$total = mysqli_fetch_array($sql2);
								?>
								<tr>
									<td colspan="6" align="center"><b>TOTAL REALISASI TAGIHAN</b></td>
									<td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total['total']) ?></b></td>
								</tr>
                                <?php
											}else{
												?>
												<td colspan="7" align="center">Data Tidak Ditemukan!</td>
												<?php
													}
												}

									}
									?>
										</table>
										</tbody>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

										
	  <?php
} else if(@$_GET['act'] == 'del') {

	$keg->hapus_kegiatan($_GET['kode']);
	header("location: ?page=kegiatan_awal");
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