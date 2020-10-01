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
                                base_url('Pegawai'),
                                '<i class="fa fa-reply"></i> Kembali',
                                'class="btn btn-primary"'
                            ); ?>
                        </div>
                        <h4 class="title">Data Pegawai</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                        <br>
                        <div>
                            <?php echo anchor(
                                site_url('Laporan/kartu_pegawai/' . $id_peg),
                                '<i class="fa fa-file"></i>Kartu Pegawai',
                                'class="btn btn-primary"'
                            ); ?>
                            <?php if ($this->session->userdata('status') == 'admin') {
                                echo anchor(
                                    site_url('Pegawai/edit/' . $id_peg),
                                    '<i class="fa fa-pencil"></i>Edit Data',
                                    'class="btn btn-warning"'
                                );
                            } ?>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="content table-responsive table-full-width" style="margin: 5mm;">
                            <table class="table table-hover">
                                <tr>
                                    <th>
                                        <?php if ($foto == null) {
                                            echo "<center><img src='" . base_url("assets/images/pegawai/user3x4.png") . "' width='150' height='200'><center>";
                                        } else { ?>
                                            <a href="<?= base_url("assets/images/pegawai/" . $foto) ?>">
                                            <?php echo "<center><img src='" . base_url("assets/images/pegawai/" . $foto) . "' width='150' height='200'></center>";
                                        } ?>
                                    </th>
                                    <th>
                                        <center>
                                            <img src="<?= base_url('assets/qrcodepeg/' . 'QR_Code' . $nip_pegawai . '.png') ?>" alt="QR_CODE">
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td> <?= $nip_pegawai ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $nama_pegawai ?></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td><?= $jabatan ?></td>
                                </tr>
                                <tr>
                                    <th>Status Pegawai</th>
                                    <td><?= $status_p ?></td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td><?= $telepon ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?= $jenis_k ?></td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td><?= $agama ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?= $status ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= $alamat ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('templates/footer'); ?>