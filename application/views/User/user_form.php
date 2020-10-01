<?php $this->load->view('templates/header'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Data Pengguna</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                    </div>
                </div>
                <div class="content container-fluid">
                    <form action="<?php echo $action; ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $username; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" style="text-transform:capitalize; width: 100%; height:100%;" required>
                                        <option value="<?= $status  ?>">
                                            <?= $status ? $status : "Pilih..." ?>
                                        </option>
                                        <option value="admin">Admin</option>
                                        <option value="pegawai">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $username; ?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> <?php echo $button; ?></button>

                        <a href="<?php echo site_url('User') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel
                        </a>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <?php $this->load->view('templates/footer'); ?>