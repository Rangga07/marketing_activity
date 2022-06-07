<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


    <?php
    include "../models/m_kegiatan.php";
    require_once('../config/+koneksi.php');
    require_once('../models/database.php');

    $keg = new KA($connection);

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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">KEGIATAN AWAL MASUK</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data kegiatan
                </div>

                <div class="panel-body">
                    <form action="" method="POST">
                        <div class="form-group col-md-5">
                            Cari Berdasarkan :<br /><br />
                            <label for="">Petugas</label>
                            <select class="form-control" name="nama_ao">
                                <option selected='selected' disabled>-- Pilih</option>
                                <?php
                                require_once('../config/+koneksi.php');
                                require_once('../models/database.php');

                                if ($_SESSION['level'] == 'admin') {
                                    $sql = "SELECT * FROM user WHERE level='AO' OR level='analis' ORDER BY nama ASC";
                                } else if ($_SESSION['level'] == 'korwildua') {
                                    $sql = "SELECT * FROM user WHERE wilayah='Ciwidey 2'";
                                } else if ($_SESSION['level'] == 'korwilsatu') {
                                    $sql = "SELECT * FROM user WHERE wilayah='Ciwidey 1'";
                                } else if ($_SESSION['level'] == 'korwiltiga') {
                                    $sql = "SELECT * FROM user WHERE wilayah='Ciwidey 3'";
                                } else if ($_SESSION['level'] == 'direksi') {
                                    $sql = "SELECT * FROM user WHERE wilayah='Supervisi'";
                                }

                                $hasil = mysqli_query($dbconnect, $sql);
                                $no = 0;
                                while ($data = mysqli_fetch_array($hasil)) {
                                    $no++;

                                    $ket = "";
                                    if (isset($_GET['id'])) {
                                        $no_id = trim($_GET['id']);

                                        if ($no_id == $data['id']) {
                                            $ket = "selected";
                                        }
                                    }
                                ?>
                                    <option <?php echo $ket; ?> value="<?php echo $data['nama']; ?>"><?php echo $data['nama']; ?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            <label for="">Tanggal</label>
                            <input type="date" id="from" name="tanggal" class="form-control" required><br />
                            <input type="submit" class="btn btn-success" name="submit" value="Cari">
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">

                            <hr />
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Petugas</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!isset($_POST['submit'])) {
                                            $no = 1;

                                        ?>
                                            <?php



                                            ?>

                                            <?php


                                        } else {
                                            $nama = $_POST['nama_ao'];
                                            $tanggal = $_POST['tanggal'];
                                            $ftanggal = strtotime($tanggal);
                                            $ftanggal = date("Y/m/d", $ftanggal);
                                            if ($nama != "" || $ftanggal != "") {
                                                $no = 1;
                                                $tampil = $keg->kegiatan_tampil_filter_admin();
                                                if (mysqli_num_rows($tampil) > 0) {
                                                    while ($data = $tampil->fetch_object()) {

                                            ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $data->nama_kegiatan; ?></td>
                                                            <td><?php echo $data->nama_ao; ?></td>
                                                            <td><?php echo $data->tanggal; ?></td>
                                                            <?php if ($data->nama_kegiatan == 'Tagihan') { ?>
                                                                <td><a href="?page=detail_tagihan&act=det&id_keg=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($data->nama_kegiatan == 'Promosi') { ?>
                                                                <td><a href="?page=detail_promosi&act=det&id_keg=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($data->nama_kegiatan == 'Tabungan') { ?>
                                                                <td><a href="?page=detail_tabungan&act=det&id_keg=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($data->nama_kegiatan == 'Kegiatan Lain') { ?>
                                                                <td><a href="?page=detail_kegiatanlain&act=det&id_keg=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($data->nama_kegiatan == 'PPOB') { ?>
                                                                <td><a href="?page=detail_ppob&act=det&kode=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs" target="_blank"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($data->nama_kegiatan == 'Survey') { ?>
                                                                <td><a href="?page=detail_survey&act=det&id_keg=<?php echo $data->kode; ?>" target="_blank">
                                                                        <button class="btn btn-info btn-xs" target="_blank"><i class="fa fa-info"></i> Detail </button>
                                                                    </a>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php

                                                    }
                                                } else {
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
    } else if (@$_GET['act'] == 'del') {

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