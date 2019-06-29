<html>
<?php $this->load->view("_partials/head.php") ?>
<body>
	<div class="container">
		<h2>Tambah Nomor Antrian</h2>
		<div class="container-fluid">
			<?php if($this->session->flashdata('success')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php endif; ?>

			<form method="post" enctype="multipart/form-data">
				<div class="form-group form-inline">
					<label for="no_antrian" class="col-md-2">No Antrian</label>
					<input class="form-control <?php echo form_error('no_antrian') ? 'is-invalid':'' ?> col-md-10" type="number" name="no_antrian" placeholder="No Antrian" min="1">
					<div class="invalid-feedback">
						<?php echo form_error('no_antrian') ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="perkara" class="col-md-2">No Perkara</label>
					<input class="form-control <?php echo form_error('perkara') ? 'is-invalid':'' ?> col-md-10" type="text" name="perkara" placeholder="1234/G/2019" required>
					<div class="invalid-feedback">
						<?php echo form_error('perkara') ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="penggugat" class="col-md-2">Penggugat</label>
					<textarea class="form-control <?php echo form_error('penggugat') ? 'is-invalid':'' ?> col-md-10" name="penggugat" placeholder="Nama Penggugat" required></textarea>
					<div class="invalid-feedback">
						<?php echo form_error('penggugat') ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="tergugat" class="col-md-2">Tergugat</label>
					<textarea class="form-control <?php echo form_error('tergugat') ? 'is-invalid':'' ?> col-md-10" type="text" name="tergugat" placeholder="Nama tergugat"></textarea>
					<div class="invalid-feedback">
						<?php echo form_error('tergugat') ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="jadwal_sidang" class="col-md-2">Jadwal Sidang</label>
					<!-- <div id="kalender"></div> -->
					<input class="form-control <?php echo form_error('jadwal_sidang') ? 'is-invalid':'' ?>" type="date" name="jadwal_sidang" required>
					<div class="invalid-feedback">
						<?php echo form_error('jadwal_sidang') ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="ruang_sidang" class="col-md-2">Ruang Sidang</label>
					<select class="form-control <?php echo form_error('ruang_sidang') ? 'is-invalid':'' ?>" name="ruang_sidang" required>
					<?php if($this->session->userdata('role')=="admin"): ?>
						<option value="none">Pilih Ruang Sidang</option>
						<?php foreach($ruang_sidangs as $ruang_sidang): ?>
						<option value="<?php echo $ruang_sidang->id ?>"><?php echo $ruang_sidang->ruang_sidang; ?></option>
						<?php endforeach ?>
						<?php else: ?>
						<option value="<?php echo $this->session->userdata('ruang_sidang'); ?>"><?php echo $this->session->userdata('ruang_sidang'); ?></option>
					<?php endif ?>
					</select>
					<div class="invalid-feedback">
						<?php echo form_error('ruang_sidang') ?>
					</div>
					
				</div>
				<div style="float: right;">
					<input class="btn btn-success mr-1" type="submit" value="simpan">
					<input onclick="location.href='<?php echo site_url('c_jadwal/'); ?>'" class="btn btn-danger mr-1" type="button" value="batal">
				</div>
			</form>
		</div>
	</div>
</body>
</html>