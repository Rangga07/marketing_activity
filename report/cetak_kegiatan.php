 <?php
    session_start();
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_cetaklaporan.php";
    $connection = new Database($host, $user, $pass, $database);
    $cetak = new CTK($connection);

    error_reporting(0);
    ?>

 <html>

 <head>

     <style>
         .tabel {
             border-collapse: collapse;
         }

         .tabel th {
             padding: 8px 5px;
             background-color: #E6E6FA;
             color: black;
         }

         .tabel td {
             padding: 3px;
         }

         img {
             width: 70px;
             float: left;
             margin: 3px
         }

         .judul {
             margin-left: -120px;
             padding: 3mm;
             position: fixed;
             top: 50%;
             text-align: center;

         }

         .redtext {
             color: red;
         }
     </style>
 </head>

 <body>

     <page>


         <div class="" align="center">
             <span style=" font-size :25px;"><b>LAPORAN KINERJA HARIAN BAGIAN MARKETING</b></span><br />
         </div>
         <br />
         <hr />
         <div style="padding:5px 0 10px 0; font-size:15px;">
             <?php
                $string = $_SESSION['username'];
                $string_name = ucfirst($string);
                $tgl = date("Y/m/d");
                ?>
             <table width=250 height=50>
                 <tr>
                     <th align="left">AO</th>
                     <td>: <?= $string_name ?></td>
                 </tr>
                 <tr>
                     <th align="left">Tanggal</th>
                     <td>: <?= date('d/m/Y') ?></td>
                 </tr>
             </table>
             <table class="table table-bordered table-hover table-striped" border="1">
                 <thead align=center>
                     <tr>
                         <td style="width: 2cm;"><b>KEGIATAN</b></td>
                         <td style="width: 7cm;"><b>TARGET</b></td>
                         <td style="width: 9cm;"><b>REALISASI</b></td>
                         <td style="width: 9cm;"><b>KETERANGAN</b></td>
                     </tr>
                 </thead>
                 <tr>
                     <td>TAGIHAN KREDIT</td>
                     <?php
                        $nama_ao = $_SESSION['username'];
                        $tgl = date("Y/m/d");
                        $sql6 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_tagihan WHERE ao='$nama_ao' AND tgl='$tgl' ORDER BY nama_nas ASC");
                        if (mysqli_num_rows($sql6) > 0) {
                            $tampil_tag = $cetak->target_tagihan_tampil();

                        ?>
                         <td><?php while ($data = $tampil_tag->fetch_object()) { ?>Nama : <?= $data->nama_nas ?> <br> Tagihan : <b>Rp.<?= number_format($data->nominal) ?></b> <br> Kol : <?= $data->kolek ?> <br>------------ <br> <?php } ?></td>
                     <?php

                        } else {  ?>
                         <td></td>
                     <?php } ?>

                     <?php
                        $nama_ao = $_SESSION['username'];
                        $tgl = date("Y/m/d");
                        $sql7 = mysqli_query($dbconnect, "SELECT * FROM tagihan WHERE ao='$nama_ao' AND tgl='$tgl' ORDER BY nama DESC");
                        if (mysqli_num_rows($sql7) > 0) {
                            $tampil_hasil = $cetak->hasil_tagihan_tampil();
                        ?>
                         <td><?php while ($data = $tampil_hasil->fetch_object()) { ?>Nama : <?= $data->nama ?> <br> Bayar : <b>Rp.<?= number_format($data->jumlah) ?></b> <br>
                             Keterangan : <?= $data->keterangan ?> <br>------------ <br> <?php } ?></td>
                     <?php

                        } else {  ?>
                         <td></td>
                     <?php } ?>
                     <?php $data1 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan  WHERE ao='$nama_ao' AND tgl='$tgl'");
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
                         <td><?php while ($data = $tampil_pro->fetch_object()) { ?>Wilayah : <b><?= $data->wilayah ?></b> <br> NOA : <b><?= $data->noa ?></b><br>------------ <br> <?php } ?></td>
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
                         <td><?php while ($data = $tampil_hasil_pro->fetch_object()) { ?><?= $no++ ?>. <b><?= $data->nama ?></b> / <b><?= $data->wilayah ?></b> / <b><?= $data->no_hp ?></b> / <b><?= $data->produk ?></b> / <b><?= $data->nominal ?></b><br>------------ <br> <?php } ?></td>
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
                             <td><?php while ($data = $tampil_sur->fetch_object()) { ?>Nama : <?= $data->nama_nas ?> <br> Alamat : <?= $data->alamat ?> <br> Pengajuan : <b>Rp. <?= number_format($data->nominal) ?></b> <br>------------ <br> <?php } ?></td>
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
                             <td><?php while ($data = $tampil_hasil->fetch_object()) { ?>Nama : <?= $data->nama ?> <br> Hasil : <b><?= $data->ket ?></b> <br>
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
             <br>
             <table width=250 height=50>
                 <tr>
                     <th align="center">PETUGAS</th>
                 </tr>
                 <tr>
                     <th height="120px" align="center">(______________)</th>
                 </tr>
             </table>
         </div> <br />


     </page>

     <script>
         window.print();
     </script>

 </body>

 </html>