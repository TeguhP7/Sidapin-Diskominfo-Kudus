<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>img/box.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SIDAPIN - Sistem Data Pegawai dan Inventaris</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/'); ?>css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url('assets/'); ?>css/light-bootstrap-dashboard.css" rel="stylesheet" />

    <link href="<?php echo base_url('assets/'); ?>css/styleqr.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<nav class="navbar container-fluid" style="background-color: red; padding: 20px 20px 0px 20px; color:antiquewhite;">
    <a href="<?= base_url('Home') ?>" class="h1" style="text-decoration: none;">
        <img src="<?= base_url('assets/img/logo2.png') ?>" width="59.125px" height="73.425px" alt="Logo">
        Sidapin
    </a>
    <span style="float: right" class="container-fluid">
        <br>
        <?php if ($this->session->userdata('logined')) {
            echo anchor(
                base_url('Home'),
                '<i class="fa fa-reply"></i> <strong>Kembali ',
                'class="btn" style="border:none; background-color:black; color:white; width:120px; opacity:100;"'
            );
        } else {
            echo anchor(
                base_url('Login'),
                '<i class="fa fa-sign-in"></i> Login ',
                'class="btn" style="border:none; background-color:black; color:white; width:120px; opacity:100"'
            );
        } ?>
    </span>
</nav>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div style="float: right" class="container-fluid">
                            <br>
                            <?php echo anchor(
                                base_url('Inventaris'),
                                '<i class="fa fa-reply"></i> Kembali',
                                'class="btn btn-primary"'
                            ); ?>
                        </div>
                        <h4 class="title">Data Inventaris</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                        <br>
                    </div>
                    <div class="container-fluid">
                        <div class="content table-responsive table-full-width" style="margin: 5mm;">
                            <table class="table table-hover">
                                <tr>
                                    <a href="<?= base_url("assets/images/aset/" . $foto) ?>">
                                        <center><?php echo "<img src='" . base_url("assets/images/aset/" . $foto) . "' width='200' height='200'>"; ?></center>
                                    </a>
                                    <br>
                                </tr>
                                <tr>
                                    <th>Kode Aset</th>
                                    <td> <?= $kode_aset ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Aset</th>
                                    <td><?= $nama_aset ?></td>
                                </tr>
                                <tr>
                                    <th>Tahun Masuk</th>
                                    <td><?= $tahun ?></td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td><?= $kondisi ?></td>
                                </tr>
                                <tr>
                                    <th>Pengguna</th>
                                    <td><?= $pengguna ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan Lain</th>
                                    <td><?= $ket_lain ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--   Core JS Files   -->
            <script src="<?php echo base_url('assets/'); ?>js/jquery-1.10.2.js" type="text/javascript"></script>
            <script src="<?php echo base_url('assets/'); ?>js/bootstrap.min.js" type="text/javascript"></script>

            <!--  Checkbox, Radio & Switch Plugins -->
            <script src="<?php echo base_url('assets/'); ?>js/bootstrap-checkbox-radio-switch.js"></script>

            <!--  Charts Plugin -->
            <script src="<?php echo base_url('assets/'); ?>js/chartist.min.js"></script>

            <!--  Notifications Plugin    -->
            <script src="<?php echo base_url('assets/'); ?>js/bootstrap-notify.js"></script>

            </body>

</html>