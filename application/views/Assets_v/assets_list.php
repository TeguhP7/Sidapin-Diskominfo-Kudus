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
								echo anchor(site_url("Data_assets/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
							} ?>
						</span>
						<h4 class="title">Data Aset</h4>
						<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
						<br>
						<div>
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Laporan/aset"), '<i class="fa fa-file"></i> Cetak', 'class="btn btn-dark"');
							} ?>
						</div>
						<br>
						<!-- <input type="text" id="keyword">
						<button type="button" id="btn-search" class=""><i class="fa fa-search"></i>Cari</button> -->
					</div>
					<div class="content table-responsive table-full-width" id="view">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>
										<center>Foto</center>
									</th>
									<th>Kode Aset</th>
									<th>Nama Aset</th>
									<th>Tahun Masuk</th>
									<th>Kondisi</th>
									<th>Keterangan Lain</th>
									<!-- <th>Cetak</th> -->
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
										<td>
											<center>
												<?php if ($value->foto_aset == null) { ?>
													<a href="<?= base_url("assets/images/aset/tambahaset.png") ?>">
														<?php echo "<img src='" . base_url("assets/images/aset/tambahaset.png") . "' width='100' height='100'>"; ?>
													</a>
												<?php } else { ?>
													<a href="<?= base_url("assets/images/aset/" . $value->foto_aset) ?>">
														<?php echo "<img src='" . base_url("assets/images/aset/" . $value->foto_aset) . "' width='100' height='100'>"; ?>
													</a>
												<?php } ?>
											</center>
										</td>
										<td><?php echo $value->kode_aset; ?></td>
										<td><?php echo $value->nama_aset; ?></td>
										<td><?php echo $value->tahun; ?></td>
										<td><?php echo $value->kondisi; ?></td>
										<td><?php echo $value->ket_lain; ?></td>
										<!-- <td><?php //echo anchor(site_url('Data_assets/download/' . $value->id_assets), '<i class="fa fa-download"></i>', 'class="btn btn-primary"') 
													?></td> -->
										<td>
											<center>
												<?php if ($this->session->userdata('status') == 'admin') {
													echo anchor(
														site_url('Data_assets/edit/' . $value->id_assets),
														'<i class="fa fa-pencil"></i>',
														'class="btn btn-warning"'
													);
												} ?>

												<?php if ($this->session->userdata('status') == 'admin') {
													echo anchor(
														site_url('Data_assets/delete/' . $value->id_assets),
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