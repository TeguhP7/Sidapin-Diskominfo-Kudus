<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>img/logo2.ico">
    <title>Sidapin - Kartu Pegawai</title>
    <link rel="icon" href="<?= base_url('assets/') ?>/img/logo2.png">
    <style type="text/css">
        body {
            font-family: Arial;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        table {
            border-collapse: collapse;
        }
    </style>

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<body>
    <nav class="" style="background-color: red; padding: 20px 20px 15px 20px; color:antiquewhite;">
        <span class="h1">
            <img src="<?= base_url('assets/img/logo2.png') ?>" width="59.125px" height="73.425px" alt="Logo">
            Sidapin
        </span>
    </nav>
    <table cellpadding="80" cellspacing="0" width="100%" style="margin-bottom: 40px;" border="1">
        <strong>
            <h1 class=" text-center" style="margin-bottom: 40px;">
                Kartu Pegawai
            </h1>
        </strong>

        <tr height="330px">
            <td width="15%"> </td>
            <td width="30%" align="center">
                <img src="<?= base_url('assets/images/top.png') ?>" alt="" width="250px" style="padding: 20px 20px 0px 10px;">
                <div style="padding: 20px;">
                    <img src="<?= base_url('assets/images/pegawai/' . $data->nama_file) ?>" width="120px" height="160px"><br>
                </div>
                <strong><?= $data->nip_pegawai ?><br><?= $data->nama_pegawai ?></strong><br>
                <img src="<?= base_url('assets/images/bottom.png') ?>" alt="" width="250px" height="70px">
            </td>
            <td width="10%"></td>
            <?php
            $kode = $data->nip_pegawai;
            require_once("assets/phpqrcode/qrlib.php");

            //Nama Folder file QR Code kita nantinya akan disimpan
            $tempdir = "assets/qrcodepeg/";
            //jika folder belum ada, buat folder 
            if (!file_exists($tempdir)) {
                mkdir($tempdir);
            }
            QRcode::png("$kode", $tempdir . "QR_Code" . $kode . ".png", "H", 5.5, 5.5);
            ?>

            <td width="30%" align="center">
                <img src="<?= base_url('assets/qrcodepeg/QR_Code' . $data->nip_pegawai . '.png') ?>" alt="QR_CODE" width="200px" height="200px"><br>
                <small>(Scan QR Code)</small>
            </td>
            <td width="15%"></td>
        </tr>
    </table>
    <center><a href="" class="no-print btn btn-primary" onclick="window.print();"><i class="fa fa-file"></i> Cetak / Print</a>
        <a href="<?= base_url('Pegawai/profile/' . $data->id_peg) ?>" class="no-print btn btn-primary"><i class="fa fa-history"></i> Kembali</a></center>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/'); ?>js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>js/bootstrap.min.js" type="text/javascript"></script>

</html>