 <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_tagihan.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new TAG($connection);
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
             <span style=" font-size :25px;"><b>REPORT DATA TAGIHAN BAGIAN MARKETING</b></span><br />
             <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br />
             <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
         </div>
         <br />
         <hr />
         <?php
            $id_keg = $_GET['id_keg'];
            $data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_tagihan WHERE kode_keg='$id_keg' AND status='1'");
            $data2 = mysqli_query($dbconnect, "SELECT SUM(nominal) AS total FROM kegiatan_awal_tagihan WHERE kode_keg='$id_keg' AND status='1'");
            $data3 = mysqli_query($dbconnect, "SELECT SUM(jumlah) AS total FROM tagihan WHERE id_keg='$id_keg'");
            $data4 = mysqli_query($dbconnect, "SELECT * FROM tagihan WHERE id_keg='$id_keg'");

            $target_noa = mysqli_num_rows($data);
            $bio = mysqli_fetch_array($data);
            $target_nom = mysqli_fetch_array($data2);
            $realisasi_nom = mysqli_fetch_array($data3);
            $tgl = $bio['tgl'];
            $tanggal = date("d-M-Y", strtotime($tgl));
            ?>
         <div style="padding:5px 0 10px 0; font-size:15px;">
             <table width=250 height=120>
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
                     <td>: <?= $target_noa ?></td>
                 </tr>
                 <tr>
                     <th align="left">Target Nominal</th>
                     <td>: <?= number_format($target_nom['total']) ?></td>
                 </tr>
                 <tr>
                     <th align="left">Realisasi</th>
                     <td class="redtext">: <?= number_format($realisasi_nom['total']) ?><b></b></td>
                 </tr>
             </table>
         </div> <br />

         <table border="1px" class="tabel" align="center">
             <tr>
                 <th>No</th>
                 <th>Nama Nasabah</th>
                 <th>Alamat</th>
                 <th>Kol</th>
                 <th>Keputusan</th>
                 <th>Pokok</th>
                 <th>Bunga</th>
                 <th>Jumlah</th>
                 <th>Keterangan</th>
             </tr>
             <?php
                $no = 1;
                if (@$_GET['id_keg'] != '') {
                    $data4 = mysqli_query($dbconnect, "SELECT * FROM tagihan WHERE id_keg='$id_keg'");
                }
                while ($data = $data4->fetch_array()) {
                ?>
                 <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $data['nama'] ?></td>
                     <td><?= $data['alamat'] ?></td>
                     <td align="center"><?= $data['kolek'] ?></td>
                     <td><?= $data['ket'] ?></td>
                     <td><?= number_format($data['jml_pokok']) ?></td>
                     <td><?= number_format($data['jml_bunga']) ?></td>
                     <td><?= number_format($data['jumlah']) ?></td>
                     <td><?= $data['keterangan'] ?></td>
                 </tr>
             <?php } ?>
         </table>
     </page>

     <script>
         window.print();
     </script>

 </body>

 </html>