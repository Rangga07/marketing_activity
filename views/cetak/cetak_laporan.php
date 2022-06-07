<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    include "models/m_cetaklaporan.php";
    require_once('config/+koneksi.php');
    require_once('models/database.php');

    $cetak = new CTK($connection);

    error_reporting(0);

    if (@$_GET['act'] == '') {
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
        <br>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">CETAK LAPORAN</h1>
            </div>
        </div>
        <!--/.row-->
        <p id="timestamp"></p>
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading"><em class="fa fa-users">&nbsp;</em>CETAK LAPORAN HARIAN</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $nama = $_GET['username'];
                        ?>
                        <div class="table-responsive">
                            <?php
                            echo "<a href='report/cetak_kegiatan.php?nama_ao='$nama' target='_blank'><button class='btn btn-default btn-md' style='float:right'><i class='fa fa-print'></i> Cetak</button></a>"
                            ?>
                            <table>
                                <tr>
                                    <td width="120px"><b>NAMA </b></td>
                                    <td> : <?php echo $_SESSION['username'] ?></td>
                                </tr>
                                <tr>
                                    <td width="120px"><b>HARI/TANGGAL </b></td>
                                    <td> : <?php echo date('d/m/Y') ?></td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead align=center>
                                <tr>
                                    <td style="width: 5cm;"><b>KEGIATAN</b></td>
                                    <td><b>TARGET</b></td>
                                    <td><b>REALISASI</b></td>
                                    <td><b>KETERANGAN</b></td>
                                </tr>
                            </thead>
                            <tr>
                                <td>TAGIHAN KREDIT</td>
                                <?php
                                $nama_ao = $_SESSION['username'];
                                $tgl = date("Y/m/d");
                                $sql6 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1' ORDER BY nama_nas ASC");
                                if (mysqli_num_rows($sql6) > 0) {
                                    $tampil_tag = $cetak->target_tagihan_tampil();

                                ?>
                                    <td width='200px'><?php while ($data = $tampil_tag->fetch_object()) { ?>Nama : <?= $data->nama_nas ?> <br> Tagihan : <b>Rp.<?= number_format($data->nominal) ?></b> <br> Kol : <?= $data->kolek ?> <br>------------ <br> <?php } ?></td>
                                <?php

                                } else {  ?>
                                    <td></td>
                                <?php } ?>

                                <?php
                                $nama_ao = $_SESSION['username'];
                                $tgl = date("Y/m/d");
                                $sql7 = mysqli_query($dbconnect, "SELECT * FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1' ORDER BY nama DESC");
                                if (mysqli_num_rows($sql7) > 0) {
                                    $tampil_hasil = $cetak->hasil_tagihan_tampil();
                                ?>
                                    <td width='450px'><?php while ($data = $tampil_hasil->fetch_object()) { ?>Nama : <?= $data->nama ?> <br> Bayar : <b>Rp.<?= number_format($data->jumlah) ?></b> <br>
                                        Keterangan : <?= $data->keterangan ?> <br>------------ <br> <?php } ?></td>
                                <?php

                                } else {  ?>
                                    <td></td>
                                <?php } ?>
                                <?php $data1 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan  WHERE ao='$nama_ao' AND tgl='$tgl' AND status='1'");
                                $data2 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tagihan  WHERE ao='$nama_ao' AND tgl='$tgl'");
                                $target = mysqli_fetch_array($data1);
                                $hasil = mysqli_fetch_array($data2);
                                ?>

                                <td>NOMINAL TARGET TAGIHAN : <b style="color: red;">Rp. <?= number_format($target['total']); ?></b><br>
                                    <br> NOMINAL YANG TERCAPAI : <b style="color: green;">Rp. <?= number_format($hasil['total']); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>TABUNGAN</td>


                                <td>-</td>
                                <?php
                                $data3 = mysqli_query($dbconnect, "SELECT * FROM tabungan WHERE ao='$nama_ao' AND tgl='$tgl'");
                                $hasil_tab = mysqli_fetch_array($data3);
                                ?>
                                <td>SIBUMBUNG : <b>Rp. <?= number_format($hasil_tab['sibumbung']); ?></b> / <?= $hasil_tab['noa_sibumbung'] ?><br>SIMASPRO : <b>Rp. <?= number_format($hasil_tab['simaspro']); ?></b> / <?= $hasil_tab['noa_simaspro'] ?>
                                    <br>SIMASTU : <b>Rp. <?= number_format($hasil_tab['simastu']); ?></b> / <?= $hasil_tab['noa_simastu'] ?><br>SIMPEDIK : <b>Rp. <?= number_format($hasil_tab['simpedik']); ?></b> / <?= $hasil_tab['noa_simpedik'] ?><br>
                                    PKM : <b>Rp. <?= number_format($hasil_tab['pkm']); ?></b> / <?= $hasil_tab['noa_pkm'] ?>
                                </td>
                                <td>TOTAL KOLEK TABUNGAN : <b style="color: green;">Rp. <?= number_format($hasil_tab['jumlah']) ?> </b><br><br>
                                    NOA : <b style="color: green;"><?= $hasil_tab['jumlah_noa'] ?> </b>
                                </td>

                            </tr>
                            <tr>
                                <td>PROMOSI</td>
                                <?php
                                $nama_ao = $_SESSION['username'];
                                $tgl = date("Y/m/d");
                                $sql12 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_promosi WHERE ao='$nama_ao' AND tgl='$tgl'");
                                if (mysqli_num_rows($sql12) > 0) {
                                    $tampil_pro = $cetak->target_promosi_tampil();

                                ?>
                                    <td width='200px'><?php while ($data = $tampil_pro->fetch_object()) { ?>Wilayah : <b><?= $data->wilayah ?></b> <br> NOA : <b><?= $data->noa ?></b><br>------------ <br> <?php } ?></td>
                                <?php

                                } else {  ?>
                                    <td></td>
                                <?php } ?>

                                <?php
                                $nama_ao = $_SESSION['username'];
                                $tgl = date("Y/m/d");
                                $no = 1;
                                $sql13 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE ao='$nama_ao' AND tgl='$tgl'");
                                if (mysqli_num_rows($sql13) > 0) {
                                    $tampil_hasil_pro = $cetak->hasil_promosi_tampil();

                                ?>
                                    <td width='200px'><?php while ($data = $tampil_hasil_pro->fetch_object()) { ?><?= $no++ ?>. <b><?= $data->nama ?></b> / <b><?= $data->wilayah ?></b> / <b><?= $data->no_hp ?></b> / <b><?= $data->produk ?></b> / <b><?= $data->nominal ?></b><br>------------ <br> <?php } ?></td>
                                <?php

                                } else {  ?>
                                    <td></td>
                                <?php } ?>
                                <?php $data1 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi  WHERE produk='Tabungan' AND ao='$nama_ao' AND tgl='$tgl'");
                                $data2 = mysqli_query($dbconnect, "SELECT * FROM promosi  WHERE produk='Tabungan' AND ao='$nama_ao' AND tgl='$tgl'");
                                $data3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi  WHERE produk='Kredit' AND ao='$nama_ao' AND tgl='$tgl'");
                                $data4 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE produk='Kredit' AND ao='$nama_ao' AND tgl='$tgl'");
                                $nom_tab = mysqli_fetch_array($data1);
                                $nom_kre = mysqli_fetch_array($data3);
                                $noa_tab = mysqli_num_rows($data2);
                                $noa_kre = mysqli_num_rows($data4);
                                ?>
                                <td>TOTAL PEMBUKAAN TABUNGAN BARU : <b style="color: green;">Rp. <?= number_format($nom_tab['total']) ?></b><br />NOA : <b style="color: green;"><?= $noa_tab ?></b><br>-------------<br>
                                    TOTAL PROMOSI KREDIT : <b style="color: green;">Rp. <?= number_format($nom_kre['total']) ?></b><br />NOA : <b style="color: green;"><?= $noa_kre ?></b><br>-------------<br>
                                </td>
                            </tr>
                            <?php
                            $nama_ao = $_SESSION['username'];
                            $tgl = date("Y/m/d");
                            $sql21 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal WHERE nama_kegiatan='Survey' AND nama_ao='$nama_ao' AND tanggal='$tgl'");
                            if (mysqli_num_rows($sql21) > 0) {
                            ?>
                                <tr>
                                    <td>SURVEY</td>
                                    <?php
                                    $nama_ao = $_SESSION['username'];
                                    $tgl = date("Y/m/d");
                                    $sql6 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_survey WHERE ao='$nama_ao' AND tgl='$tgl'");
                                    if (mysqli_num_rows($sql6) > 0) {
                                        $tampil_sur = $cetak->target_survey_tampil();
                                    ?>
                                        <td width='250px'><?php while ($data = $tampil_sur->fetch_object()) { ?>Nama : <?= $data->nama_nas ?> <br> Alamat : <?= $data->alamat ?> <br> Pengajuan : <b>Rp. <?= number_format($data->nominal) ?></b> <br>------------ <br> <?php } ?></td>
                                    <?php

                                    } else {  ?>
                                        <td></td>
                                    <?php } ?>

                                    <?php
                                    $nama_ao = $_SESSION['username'];
                                    $tgl = date("Y/m/d");
                                    $sql7 = mysqli_query($dbconnect, "SELECT * FROM survey WHERE ao='$nama_ao' AND tgl='$tgl' ORDER BY nama DESC");
                                    if (mysqli_num_rows($sql7) > 0) {
                                        $tampil_hasil = $cetak->hasil_survey_tampil();
                                    ?>
                                        <td width='450px'><?php while ($data = $tampil_hasil->fetch_object()) { ?>Nama : <?= $data->nama ?> <br> Hasil : <b><?= $data->ket ?></b> <br>
                                            Keterangan : <?= $data->keterangan ?> <br>------------ <br> <?php } ?></td>
                                    <?php

                                    } else {  ?>
                                        <td></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>KEGIATAN LAIN</td>
                                <?php
                                $nama_ao = $_SESSION['username'];
                                $tgl = date("Y/m/d");
                                $sql6 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_lain WHERE ao='$nama_ao' AND tgl='$tgl'");
                                if (mysqli_num_rows($sql6) > 0) {
                                    $tampil_keg = $cetak->hasil_kegiatanlain_tampil();
                                ?>
                                    <td colspan="3"><?php while ($data = $tampil_keg->fetch_object()) { ?><?= $data->keterangan ?>, <?php } ?></td>
                                <?php

                                } else {  ?>
                                    <td colspan="3"></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td height='80px'></td>
                                <td colspan="3"></td>
                            </tr>
                        </table>

                        <!-- Modal Bayar-->

                    </div>


                    <script type="text/javascript">
                        $(document).on("click", "#detailpromosi", function() {
                            var kode = $(this).data('kd');
                            var wilayah = $(this).data('wil');
                            var noa = $(this).data('n');
                            $(".modal-body #kd").val(kode);
                            $(".modal-body #wil").val(wilayah);
                            $(".modal-body #n").val(noa);
                        })
                    </script>
                </div>
            </div>
        </div>
</div>


<?php
    } else if (@$_GET['act'] == 'del') {

        header("location: ?page=tagihan");
    }

?>



<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="../../assets/js/jquery.js"></script>