 <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_promosi.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new PRO($connection);
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

         <img src="../images/logo.jpg" alt="">

         <div class="" align="center">
             <span style=" font-size :25px;"><b>REPORT DATA PROMOSI BAGIAN MARKETING</b></span><br />
             <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br />
             <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
         </div>
         <br />
         <hr />
         <?php
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $ao = $_GET['ao'];
            $data = mysqli_query($dbconnect, "SELECT SUM(noa) as total FROM kegiatan_awal_promosi WHERE ao='$ao' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");
            $data4 = mysqli_query($dbconnect, "SELECT * FROM promosi WHERE ao='$ao' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");

            $target_noa = mysqli_fetch_array($data);
            $bio = mysqli_fetch_array($data4);
            $tanggal = date("M", strtotime($bulan));
            ?>
         <div style="padding:5px 0 10px 0; font-size:15px;">
             <table width=310 height=120>
                 <tr>
                     <th align="left">Tanggal</th>
                     <td>: <?= $tanggal ?></td>
                 </tr>
                 <tr>
                     <th align="left">AO</th>
                     <td>: <?= $bio['ao'] ?></td>
                 </tr>
                 <tr>
                     <th align="left">Target NOA</th>
                     <td>: <?= $target_noa['total'] ?></td>
                 </tr>
                 <?php $target = $keg->detail_full_tampil_target_promosi($_GET['bulan'], $_GET['tahun'], $_GET['ao']);
                    while ($data = $target->fetch_object()) {
                    ?>
                     </tr>
                     <td></td>
                     <td colspan='2'> - <?= $data->wilayah ?> (NOA: <?= $data->noa ?> )</td>
                     </tr>
                 <?php } ?>
             </table>
         </div> <br />

         <table border="1px" class="tabel" align="center">
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
                 <th>Tanggal</th>
             </tr>
             <?php
                $no = 1;
                if (@$_GET['bulan'] != '' && @$_GET['tahun'] != '' && @$_GET['ao'] != '') {
                    $tampil = $keg->detail_full_tampil_bulanan(@$_GET['bulan'], @$_GET['tahun'], @$_GET['ao']);
                }
                while ($data = $tampil->fetch_array()) {
                    $tanggal = date("d-M-Y", strtotime($data['tgl']));
                ?>
                 <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $data['wilayah'] ?></td>
                     <td align="center"><?= $data['nama'] ?></td>
                     <td><?= $data['alamat'] ?></td>
                     <td><?= $data['no_hp'] ?></td>
                     <td><?= $data['kep'] ?></td>
                     <td><?= $data['produk'] ?></td>
                     <td><?= number_format($data['nominal']) ?></td>
                     <td><?= $data['keterangan'] ?></td>
                     <td><?= $tanggal ?></td>
                 </tr>
             <?php }
                $tampil = $keg->detail_full_tampil_bulanan($_GET['bulan'], $_GET['tahun'], $_GET['ao']);
                $data = $tampil->fetch_object();
                $nama_ao = $data->ao;
                $kode = $data->id_keg;
                $sql2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$ao' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND produk='Kredit'");
                $sql3 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$ao' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND produk='Tabungan'");
                $sql4 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM promosi WHERE ao='$ao' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' AND produk='Deposito'");

                $total_kredit = mysqli_fetch_array($sql2);
                $total_tabungan = mysqli_fetch_array($sql3);
                $total_depo = mysqli_fetch_array($sql4);
                ?>
             <tr>
                 <td colspan="7" align="center"><b>TOTAL PROMOSI RENCANA KREDIT</b></td>
                 <td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_kredit['total']) ?></b></td>
             </tr>
             <tr>
                 <td colspan="7" align="center"><b>TOTAL PROMOSI TABUNGAN</b></td>
                 <td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_tabungan['total']) ?></b></td>
             </tr>
             <tr>
                 <td colspan="7" align="center"><b>TOTAL PROMOSI DEPOSITO</b></td>
                 <td colspan="8" align="center" class="redtext"><b>Rp. <?php echo number_format($total_depo['total']) ?></b></td>
             </tr>
         </table>
     </page>

     <script>
         window.print();
     </script>

 </body>

 </html>