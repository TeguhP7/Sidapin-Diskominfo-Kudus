<?php
$this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') {
?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<h4 class="title">Data Inventaris</h4>
							<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
						</div>
						<br>
					</div>
					<div class="content container-fluid">
						<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Aset</label>
										<select class="form-control select2" name="id_assets" id="anggota" style="width: 100%; height:100%;" required>
											<option value="">Pilih aset</option>
											<?php foreach ($nama_aset as $key => $value) { ?>
												<option value="<?php echo $value->id_assets; ?>" <?= $value->id_assets == $id_assets ? "selected" : null ?>><?php echo $value->nama_aset; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Pengguna</label>
										<select class="form-control select2" name="id_peg" id="anggota" style="width: 100%; height:100%;" required>
											<option value="">Pengguna atau penanggung jawab...</option>
											<?php foreach ($pengguna as $key => $value) { ?>
												<option value="<?php echo $value->id_peg; ?>" <?= $value->id_peg == $id_peg ? "selected" : null ?>><?php echo $value->nama_pegawai; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Keterangan Lain</label>
										<textarea name="ket_lain" class="form-control" placeholder="Keterangan lainnya (Bila ada)"><?php echo $ket_lain; ?></textarea>
									</div>
								</div>
							</div>

							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> <?php echo $button; ?></button>

							<a href="<?php echo site_url('Inventaris/unset_search') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>