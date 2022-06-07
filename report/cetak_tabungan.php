 <?php
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_tabungan.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new TAB($connection);
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
             <span style=" font-size :25px;"><b>REPORT DATA TABUNGAN BAGIAN MARKETING</b></span><br />
             <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br />
             <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
         </div>
         <br />
         <hr />
         <?php
            error_reporting(0);
            $tampil = $keg->detail_full_tampil($_GET['id_keg']);
            $result = mysqli_fetch_object($tampil);
            $tgl = $result->tgl;
            $tanggal = date("d-M-Y", strtotime($tgl));

            echo "<table width=250 height=120>
							<tr>
								<th> Tanggal </th>
								<td>: $tanggal </td>
							</tr>
							<tr>
								<th> AO </th>
								<td>: $result->ao </td>
							</tr>
							</table>";

            echo '<hr/>';
            ?>

         <?php
            $no = 1;
            $tampil = $keg->detail_full_tampil($_GET['id_keg']);
            while ($data = $tampil->fetch_object()) {
                echo '
						<table border="1px" class="tabel" align="center">

							<tr>
								<th width="200px"></th>
								<th width="200px">NOMINAL</th>
								<th width="100px" align="center">NOA</th>
							</tr>
							<tr>
								<th width="100px">PKM</th>
								<td>Rp. ' . number_format($data->pkm) . '</td>
								<td>' . $data->noa_pkm . '</td>
							</tr>
							<tr>
								<th>SIBUMBUNG</th>
								<td>Rp. ' . number_format($data->sibumbung) . '</td>
								<td>' . $data->noa_sibumbung . '</td>
							</tr>
							<tr>
								<th>SIMASPRO</th>
								<td>Rp. ' . number_format($data->simaspro) . '</td>
								<td>' . $data->noa_simaspro . '</td>
							</tr>
							<tr>
								<th>SIMPEDIK</th>
								<td>Rp. ' . number_format($data->simpedik) . '</td>
								<td>' . $data->noa_simpedik . '</td>
							</tr>
							<tr>
								<th>SIMASTU</th>
								<td>Rp. ' . number_format($data->simastu) . '</td>
								<td>' . $data->noa_simastu . '</td>
							</tr>
							<tr>
								<th>TAHARA</th>
								<td>Rp. ' . number_format($data->tahara) . '</td>
								<td>' . $data->noa_tahara . '</td>
							</tr>
							<tr>
								<th class="redtext">TOTAL</th>
								<td class="redtext"><b>Rp. ' . number_format($data->jumlah) . '</b></td>
								<td class="redtext"><b>' . $data->jumlah_noa . '</b></td>
							</tr>
                        </table>
                        </div>';
            }
            ?>

     </page>

     <script>
         window.print();
     </script>

 </body>

 </html>