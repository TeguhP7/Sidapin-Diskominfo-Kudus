<!DOCTYPE html>
<html>

<head>
    <title>QR Code Inventaris</title>
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
    <table border="1" cellpadding="80" cellspacing="0" width="100%">
        <strong>
            <h1 class="text-center">
                QR Code Inventaris
            </h1>
        </strong>
        <?php
        require_once("assets/phpqrcode/qrlib.php");

        //Nama Folder file QR Code kita nantinya akan disimpan
        $tempdir = "assets/qrcodeinven/";
        //jika folder belum ada, buat folder 
        if (!file_exists($tempdir)) {
            mkdir($tempdir);
        }
        foreach ($data as $key => $value) {
            QRcode::png("$value->kode_aset", $tempdir . "QR_Code_" . $value->kode_aset . "_" . $value->nama_pegawai . ".png", "H", 5.5, 5.5);
        }

        $kolom = 4;
        $i = 1;
        foreach ($data as $key => $value) {
            if ($i % $kolom == 1) {
                echo '<tr>';
            }
            echo '<td align="center" width="300px" height="150px">
            <img width="100px" src="' . base_url('assets/qrcodeinven/QR_Code_' . $value->kode_aset . '_' . $value->nama_pegawai . '.png') . '" alt="">
            <br>' . $value->nama_pegawai . ', ' . $value->nama_aset . '
            </td>';
            if ($i % $kolom == 0) {
                echo '</tr>';
            }
            $i++;
        }
        ?>
    </table>
    <br>
    <center><a href="" class="no-print btn btn-primary" onclick="window.print();"><i class="fa fa-file"></i> Cetak / Print</a>
        <a href="<?= base_url('Inventaris') ?>" class="no-print btn btn-primary"><i class="fa fa-history"></i> Kembali</a></center>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/'); ?>js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>js/bootstrap.min.js" type="text/javascript"></script>

</html>