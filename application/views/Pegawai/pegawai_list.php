<?php $this->load->view('templates/header'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <span style="float: right" class="container-fluid">
                            <br>
                            <?php if ($this->session->userdata('status') == 'admin') { ?>
                                <?php echo anchor(site_url("Pegawai/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                            <?php } ?>
                        </span>
                        <h4 class="title">Data Pegawai</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                        <br>
                        <div>
                            <?php if ($this->session->userdata('status') == 'admin') {
                                echo anchor(site_url("Laporan/pegawai"), '<i class="fa fa-file"></i> Cetak', 'class="btn btn-dark"');
                            } ?>
                        </div>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <!-- <th>ID Pegawai</th> -->
                                <th>No.</th>
                                <th>
                                    <center>Foto</center>
                                </th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Telepon</th>
                                <th>
                                    <center>Detail</center>
                                </th>
                                <?php if ($this->session->userdata('status') == 'admin') { ?>
                                    <th>
                                        <center>Hapus</center>
                                    </th>
                                <?php } ?>
                            </thead>
                            <?php
                            $no = $this->uri->segment('3') + 1;
                            ?>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <center>
                                                <?php if ($value->nama_file == null) { ?>
                                                    <a href="<?= base_url("assets/images/pegawai/user3x4.png") ?>">
                                                        <?php echo "<img src='" . base_url("assets/images/pegawai/user3x4.png") . "' width='105' height='140'>"; ?>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="<?= base_url("assets/images/pegawai/" . $value->nama_file) ?>">
                                                        <?php echo "<img src='" . base_url("assets/images/pegawai/" . $value->nama_file) . "' width='105' height='140'>"; ?>
                                                    </a>
                                                <?php } ?>
                                            </center>
                                        </td>
                                        <td><?php echo $value->nip_pegawai; ?></td>
                                        <td><?php echo $value->nama_pegawai; ?></td>
                                        <td><?php echo $value->jabatan; ?></td>
                                        <td><?php echo $value->telepon; ?></td>
                                        <td>
                                            <center><?php echo anchor(site_url('Pegawai/profile/' . $value->id_peg), '<i class="fa fa-info-circle"></i>', 'class="btn btn-primary"') ?></center>
                                        </td>
                                        <?php if ($this->session->userdata('status') == 'admin') { ?>
                                            <td>
                                                <center>
                                                    <?php echo anchor(
                                                        site_url('Pegawai/delete/' . $value->id_peg),
                                                        '<i class="fa fa-trash"></i>',
                                                        'class="btn btn-danger"'
                                                    ); ?>
                                                </center>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col">
                                <!--Tampilkan pagination-->
                                <?php echo $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php $this->load->view('templates/footer'); ?>