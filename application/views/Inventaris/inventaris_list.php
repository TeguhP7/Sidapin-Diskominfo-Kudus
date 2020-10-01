<?php
$this->load->view('templates/header');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<span style="float: right" class="container-fluid">
							<br>
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Inventaris/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
							} ?>
						</span>
						<h4 class="title">Data Inventaris</h4>
						<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
						<br>
						<div>
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Laporan/qrinven"), '<i class="fa fa-qrcode"></i> Cetak QR Code', 'class="btn btn-dark"');
							} ?>
						</div>
						<br>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Aset</th>
									<th>Pengguna / Penanggung Jawab</th>
									<th>Keterangan Lain</th>
									<th>
										<center>Detail</center>
									</th>
									<th>
										<center>Unduh QR Code</center>
									</th>
									<?php if ($this->session->userdata('status') == 'admin') { ?>
										<th>
											<center>Edit / Hapus</center>
										</th>
									<?php } ?>
								</tr>
							</thead>
							<?php
							$no = $this->uri->segment('3') + 1;
							?>
							<tbody>
								<?php foreach ($data as $value) { ?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $value->nama_aset; ?></td>
										<td><?php echo $value->nama_pegawai; ?></td>
										<td><?php echo $value->ket_lain; ?></td>
										<td>
											<center><?php echo anchor(site_url('Inventaris/inven/' . $value->id), '<i class="fa fa-info-circle"></i>', 'class="btn btn-primary"') ?></center>
										</td>

										<td>
											<center><?php echo anchor(site_url('Inventaris/download/' . $value->id), '<i class="fa fa-download"></i>', 'class="btn btn-dark"')
													?></center>
										</td>
										<td>
											<center>
												<?php if ($this->session->userdata('status') == 'admin') {
													echo anchor(
														site_url('Inventaris/edit/' . $value->id),
														'<i class="fa fa-pencil"></i>',
														'class="btn btn-warning"'
													);
												} ?>

												<?php if ($this->session->userdata('status') == 'admin') {
													echo anchor(
														site_url('Inventaris/delete/' . $value->id),
														'<i class="fa fa-trash"></i>',
														'class="btn btn-danger"'
													);
												} ?>
											</center>
										</td>
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

			<?php
			$this->load->view('templates/footer');
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#example').DataTable();

				});
			</script>