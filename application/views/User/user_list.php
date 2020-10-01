<?php $this->load->view('templates/header'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <span style="float: right">
                            <?php echo anchor(site_url("User/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                        </span>
                        <h4 class="title">Data Pengguna</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Edit / Hapus</th>
                            </thead>
                            <?php
                            $no = $this->uri->segment('3') + 1;
                            ?>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $value->username; ?></td>
                                        <td><?php echo $value->password; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $value->status; ?></td>

                                        <td><?php echo anchor(
                                                site_url('User/edit/' . $value->username),
                                                '<i class="fa fa-pencil"></i>',
                                                'class="btn btn-warning"'
                                            ); ?>

                                            <?php echo anchor(
                                                site_url('User/delete/' . $value->username),
                                                '<i class="fa fa-trash"></i>',
                                                'class="btn btn-danger"'
                                            ); ?></td>
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