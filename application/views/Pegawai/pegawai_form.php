<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Data Pegawai</h4>
                            <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                            <br>
                        </div>
                    </div>
                    <div class="content container-fluid">
                        <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" name="nip_pegawai" class="form-control" placeholder="Nomor Induk Pegawai" value="<?php echo $nip_pegawai; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama" value="<?php echo $nama_pegawai; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo $jabatan; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status Pegawai</label>
                                        <select class="form-control select2" name="status_p" style="width: 100%; height:100%;" required>
                                            <option value="<?= $status_p  ?>"><?= $status_p ? $status_p : "Pilih..." ?></option>
                                            <option value="PNS">PNS</option>
                                            <option value="Honorer / Kontrak">Honorer / Kontrak</option>
                                            <option value="Lainnya">Lainnya...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="telepon" class="form-control" placeholder="No Telp" value="<?php echo $telepon; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control select2" name="jenis_k" style="width: 100%; height:100%;" required>
                                            <option value="<?= $jenis_k  ?>"><?= $jenis_k ? $jenis_k : "Pilih..." ?></option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <input type="text" name="agama" class="form-control" placeholder="Status" value="<?php echo $agama; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" name="status" style="width: 100%; height:100%;" required>
                                            <option value="<?= $status  ?>"><?= $status ? $status : "Pilih..." ?></option>
                                            <option value="Lajang">Lajang</option>
                                            <option value="Menikah">Menikah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                         <textarea name="alamat" class="form-control" placeholder="Alamat lengkap" required><?php echo $alamat; ?></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Foto </label>
                                        <input type="file" class="form-control" name="input_foto" style="width:100%; height:100%;">
                                        <small>(Max. 5 MB) <?= $small ?></small>
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="id_peg" value="<?php echo $id_peg; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> <?php echo $button; ?></button>

                            <a href="<?php echo base_url($cancel) ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel
                            </a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            <?php $this->load->view('templates/footer');
        } ?>