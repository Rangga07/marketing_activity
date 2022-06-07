 <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_kegiatanlain.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new KL($connection);
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
             <span style=" font-size :25px;"><b>REPORT DATA KEGIATAN LAIN BAGIAN MARKETING</b></span><br />
             <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br />
             <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
         </div>
         <br />
         <hr />
         <?php
            $id_keg = $_GET['id_keg'];
            $tgl = date("Y/m/d");
            $data = mysqli_query($dbconnect, "SELECT * FROM kegiatan_lain WHERE id_keg='$id_keg'");

            $target_noa = mysqli_num_rows($data);
            $bio = mysqli_fetch_array($data);
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

             </table>
         </div> <br />

         <table border="1px" class="tabel" align="center">
             <tr>
                 <th>No</th>
                 <th>Nama Kegiatan</th>
                 <th>Dari Jam</th>
                 <th>Sampai Jam</th>
                 <th>Keterangan</th>
             </tr>
             <?php
                $no = 1;
                if (@$_GET['id_keg'] != '') {
                    $data4 = mysqli_query($dbconnect, "SELECT * FROM kegiatan_lain WHERE id_keg='$id_keg'");
                }
                while ($data = $data4->fetch_array()) {
                ?>
                 <tr>
                     <td><?php echo $no++; ?></td>
                     <td><?php echo $data['nama_keg'] ?></td>
                     <td><?php echo $data['f_jam'] ?></td>
                     <td><?php echo $data['to_jam'] ?></td>
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