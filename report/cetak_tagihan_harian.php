<?php

    require_once('../config/+koneksi.php');
    require_once('../models/database.php');
    include "../models/m_tagihan.php";
    $connection = new Database($host, $user, $pass, $database);
    $keg = new TAG($connection);

    $content = ' 
    <style>
        .tabel { border-collapse:collapse; }
        .tabel th { padding:8px 5px; background-color:#E6E6FA; color:black; }
        .tabel td { padding:3px; }
        img { 
            width:70px; 
            float:left;
            margin:3px
        }
        .judul {
            margin-left: -120px;
            padding:3mm;
            position: fixed;
            top: 50%;
            text-align: center;

        }
        .redtext{
            color: red;
        }
    </style>
    ';

	$content .='
    <page>
    
    <img src="../images/logo.jpg" alt="">

        <div class="judul">
            <span style="font-size :25px;"><b>REPORT DATA TAGIHAN BAGIAN MARKETING</b></span><br/>
            <span style="font-size :15px; align:center;">PT. BPR HAYURA ARTALOLA</span><br/>
            <span style="font-size :15px; align:center;">Jl. Raya Pasirjambu No.139 Bandung 40972</span>
        </div>
        <br/>
        <hr/>';
        $tampil = mysqli_query($connection,"SELECT * FROM tagihan INNER JOIN kegiatan_awal ON tagihan.id_keg=kegiatan_awal.kode WHERE nama_ao='$nama_ao' AND tagihan.tanggal='$tanggal'");
        $data = $tampil->fetch_object();
        $tercapai = mysqli_num_rows($tampil);
        $content .='
        <div style="padding:5px 0 10px 0; font-size:15px;">
            <table width=250 height=120>
                <tr> 
                    <th>Tanggal </th>
                    <td>: '.$data->tanggal.'</td>
                </tr>
                <tr>
                    <th>AO </th>
                    <td>:  '.$data->nama_ao.' </td>
                </tr>
                <tr>
                    <th>Target NOA</th>
                    <td>:  '.$data->target_noa.' </td>
                </tr>
                <tr>
                    <th>Target Nomimal</th>
                    <td>: Rp. '.number_format($data->target_nom).' </td>
                </tr>
           </table>
        </div> <br/>';
        
        $content .='
        <table border="1px" class="tabel" align="center">
            <tr>
                <th>No</th>
				<th>Nama Nasabah</th>
				<th>Kolek</th>
				<th>Keterangan</th>
				<th>Pokok</th>
                <th>Bunga</th>
                <th>Jumlah</th>
				<th>Penjelasan</th>
				
            </tr>';
    
            $no = 1;
            if(@$_GET['id_keg'] != ''){
                $tampil = $keg->report_harian();
            }
            while ($data = $tampil->fetch_array()){
                $content .= '
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$data['nama'].'</td>
                    <td align="center">'.$data['kolek'].'</td>
                    <td>'.$data['ket'].'</td>
                    <td> Rp. '.number_format($data['jml_pokok']).'</td>
                    <td> Rp. '.number_format($data['jml_bunga']).'</td>
                    <td> Rp. '.number_format($data['jumlah']).'</td>
                    <td>'.$data['keterangan'].'</td>
                </tr>
                ';
            }
                $tampil = $keg->detail_full_tampil($_GET['id_keg']);
                $data = $tampil->fetch_object();
                $nama_ao = $data->nama_ao;
                $kode = $data->kode;
                $sql2 = mysqli_query($dbconnect,"SELECT SUM(jumlah) AS total FROM tagihan WHERE nama_ao='$nama_ao' AND id_keg='$kode'");

                $total = mysqli_fetch_array($sql2);
            $content .= '
                <tr>
                    <td colspan="6" align="center"><b>TOTAL REALISASI</b></td>
                    <td colspan="2" align="center" class="redtext"><b>Rp. '.number_format($total['total']).'</b></td>
                </tr>
            ';

    $content .= '
        </table>
    </page>
    '; 

	require __DIR__.'../html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
    $html2pdf = new Html2Pdf('P','A4','fr', true, 'UTF-8', array(15, 15, 15, 15), false); 
    $html2pdf->setDefaultFont("courier");
    $html2pdf->writeHTML($content);
    
	$html2pdf->output();
?>

