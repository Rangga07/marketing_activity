 <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_survey.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new SUR($connection);
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
             <span style=" font-size :25px;"><b>REPORT DATA SURVEY BAGIAN MARKETING</b></span><br />
             <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br />
             <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
         </div>
         <br />
         <hr />
         <?php
            $id_keg = $_GET['id_keg'];
            $data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_awal_survey WHERE kode_keg='$id_keg'");

            $target = mysqli_fetch_array($data);
            $tgl = $target['tgl'];
            $tanggal = date("d-M-Y", strtotime($tgl));

            ?>
         <div style="padding:5px 0 10px 0; font-size:15px;">
             <table width=250 height=120>
                 <tr>
                     <th height=25> Tanggal </th>
                     <td>: <?= $tanggal ?></td>
                 </tr>
                 <tr>
                     <th height=25> AO </th>
                     <td>: <?= $target['ao'] ?></td>
                 </tr>
                 <tr>
                     <th height=25> Target</th>
                     <td>: </td>
                 </tr>
                 <?php $nama = $keg->detail_full_tampil_target_survey($_GET['id_keg']);
                    while ($data = $nama->fetch_object()) {
                    ?>
                     </tr>
                     <td></td>
                     <td colspan='2'>Nama : <?= $data->nama_nas ?><br />
                         Alamat : <?= $data->alamat ?>
                         <hr />
                     </td>
                     </tr>
                 <?php } ?>
             </table>
         </div> <br />

         <table border="1px" class="tabel" align="center">
             <tr>
                 <th>No</th>
                 <th>Nama Nasabah</th>
                 <th>Alamat</th>
                 <th>Pengajuan</th>
                 <th>Pelaksanaan</th>
                 <th>Keterangan</th>
             </tr>
             <?php
                $no = 1;
                if (@$_GET['id_keg'] != '') {
                    $data4 = mysqli_query($dbconnect, "SELECT * FROM survey WHERE id_keg='$id_keg'");
                }
                while ($data = $data4->fetch_array()) {
                ?>
                 <tr>
                     <td><?php echo $no++; ?></td>
                     <td><?php echo $data['nama'] ?></td>
                     <td><?php echo $data['alamat'] ?></td>
                     <td>Rp. <?php echo number_format($data['nominal_peng']) ?></td>
                     <td><?php echo $data['ket'] ?></td>
                     <td><?php echo $data['keterangan'] ?></td>
                 </tr>
             <?php } ?>
         </table>
     </page>

     <script>
         window.print();
     </script>

 </body>

 </html>