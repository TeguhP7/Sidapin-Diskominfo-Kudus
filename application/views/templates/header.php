<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>img/logo2.ico">
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

    <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
</head>

<body>
    <div class="wrapper" id="datacolaps">
        <div class="sidebar" data-color="red" data-image="<?= base_url('assets/'); ?>/img/menara1.jpg">
            <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?php echo site_url('Home') ?>" class="simple-text">
                        <img src="<?php echo base_url('assets/'); ?>img/box.png" height="25" width="25">
                        | SIDAPIN <br><br> Sistem Data Pegawai dan Inventaris
                    </a>
                    <center><span><?php echo $this->session->userdata('tanggal');  ?></span></center>
                </div>

                <ul class="nav">
                    <!-- <li>
                        <a href="<?php //echo site_url('Home') 
                                    ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Home</p>
                        </a>
                    </li> -->

                    <li>
                        <a href="<?php echo site_url('Pegawai') ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p>Pegawai</p>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('Data_assets') ?>">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <p>Aset</p>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('Inventaris') ?>">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <p>Inventaris</p>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('Scanner/profile') ?>">
                            <i class="fa fa-qrcode" aria-hidden="true"></i>
                            <p>Scan Data Pegawai</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Scanner/inven') ?>">
                            <i class="fa fa-qrcode" aria-hidden="true"></i>
                            <p>Scan Data Inventaris</p>
                        </a>
                    </li>

                    <?php if ($this->session->userdata('status') == 'admin') { ?>
                        <li>
                            <a href="<?php echo site_url('User') ?>">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>User</p>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div style="display:inline; padding-top:15px;">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#datacolaps" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" style="padding: 15px 15px 0px 15px;">
                        <a href="https://diskominfo.kuduskab.go.id/" class="h3" style="text-decoration: none;">
                            <!-- <img src="<?//= base_url('assets/img/logo2.png') ?>" width="44.34375px" height="55.06875px" alt="Logo"> -->
                            <img class="rounded-circle" src="<?= base_url('assets/img/kominfo.jpg') ?>" width="55.06875px" height="55.06875px" alt="Logo">
                            DISKOMINFO KUDUS
                        </a>
                        <ul class="nav navbar-nav navbar-right" id="datacolaps">
                            <li>
                                <a href="<?php echo site_url('Login/logout'); ?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
                            <li class="separator hidden-lg hidden-md"></li>
                            </li>

                        </ul>
                    </div>
                </div>

            </nav>