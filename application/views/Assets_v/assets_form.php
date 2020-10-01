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
							<h4 class="title">Data Aset</h4>
							<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
						</div>
						<br>
					</div>

					<div class="content container-fluid">
						<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Kode Aset</label>
										<input type="text" placeholder="Jumlah" value="<?php echo $kode_aset; ?>" class="form-control" name="kode_aset" required>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Aset</label>
										<input type="text" placeholder="Nama Aset" value="<?php echo $nama_aset; ?>" class="form-control" name="nama_aset" required>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tahun Masuk</label>
										<select name="tahun" class="form-control select2" style="width: 100%; height:100%;" required>
											<option value="<?= $tahun  ?>"><?= $tahun ? $tahun : "Pilih tahun..." ?></option>
											<?php
											$thn_skr = date('Y');
											for ($x = $thn_skr; $x >= 2010; $x--) {
											?>
												<option value="<?php echo $x ?>"><?php echo $x ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Kondisi</label>
										<select class="form-control select2" name="kondisi" style="width: 100%; height:100%;" required>
											<option value="<?= $kondisi  ?>"><?= $kondisi ? $kondisi : "Pilih..." ?></option>
											<option value="Baik">Baik</option>
											<option value="Rusak">Rusak</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Keterangan Lain</label>
										<input type="text" placeholder="Keterangan lainnya (Bila ada)" value="<?php echo $ket_lain; ?>" class="form-control" name="ket_lain">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Gambar / Foto</label>
										<input type="file" class="form-control" name="foto_aset" style="width:100%; height:100%;">
										<small>(Max. 5 MB)</small>
									</div>
								</div>
							</div>

							<input type="hidden" name="id_assets" value="<?php echo $id_assets; ?>">
							<br>
							<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> <?php echo $button; ?></button>
							<a href="<?php echo site_url('Data_assets') ?>" class="btn btn-default"> <i class="fa fa-times"></i> Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>