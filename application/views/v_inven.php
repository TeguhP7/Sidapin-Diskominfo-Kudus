<?php $this->load->view('templates/header'); ?>

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
                                    <th>
                                        <a href="<?= base_url("assets/images/aset/" . $foto) ?>">
                                            <center><?php echo "<img src='" . base_url("assets/images/aset/" . $foto) . "' width='200' height='200'>"; ?></center>
                                        </a>
                                    </th>
                                    <th>
                                        <center>
                                            <?php
                                            $kode = $kode_aset;
                                            require_once("assets/phpqrcode/qrlib.php");

                                            //Nama Folder file QR Code kita nantinya akan disimpan
                                            $tempdir = "assets/qrcodeinven/";
                                            //jika folder belum ada, buat folder 
                                            if (!file_exists($tempdir)) {
                                                mkdir($tempdir);
                                            }
                                            QRcode::png("$kode", $tempdir . "QR_Code_" . $kode_aset . "_" . $pengguna . ".png", "H", 5.5, 5.5);
                                            ?>
                                            <img src="<?= base_url($tempdir . 'QR_Code_' . $kode_aset . '_' . $pengguna . '.png') ?>" alt="QR_CODE">
                                        </center>
                                    </th>
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
            <?php $this->load->view('templates/footer'); ?>