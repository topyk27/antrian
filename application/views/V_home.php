<html>
<?php $this->load->view("_partials/head.php") ?>
<body>
	<!-- buat simpan id antrian sebelumnya biar update statusnya -->
	<input type="hidden" value="<?php echo $this->session->userdata('antrian_sebelumnya'); ?>" id="antrian_sebelumnya">
	<input type="hidden" name="ruang_sidang" value="<?php echo $this->session->userdata('ruang_sidang'); ?>">
<div class="container">
	<div class="container-fluid">
		<div style="float:right">
			<h3><?php echo $this->session->userdata('username'); ?></h3>
			<input type="hidden" name="voice" value="<?php echo $this->session->userdata('voice'); ?>">
			<a href="<?php echo site_url('login/logout') ?>" class="btn btn-small" title="Keluar">
				<i class="fas fa-sign-out-alt"> Keluar</i>
			</a>
		</div>
	
	<h2>Panggil Nomor Antrian</h2>
	<a id="tambah" href="<?php echo site_url('c_jadwal/create') ?>" class="btn btn-small" title="tambah antrian">
		<i class="fas fa-plus"></i>Tambah Antrian
	</a>
	<a id="abidin" href="#" class="btn btn-small" title="Panggil Pak Abidin" onclick="kasubagHonor(<?php echo $this->session->userdata('ruang_sidang'); ?>)">
		<i class="fas fa-phone"></i>Panggil Abang Jay
	</a>
	<a id="buka_sidang" href="#" class="btn btn-small" title="Teks Buka Sidang" onclick="buka_sidang()">
		<i class="fas fa-microphone"></i>Buka Sidang
	</a>
	<a id="anti_korupsi" href="#" class="btn btn-small" title="Anti Korupsi" onclick="anti_korup()">
		<i class="fas fa-dollar-sign"></i> Anti Korupsi
	</a>
	<a id="anti_korupsi2" href="#" class="btn btn-small" title="Anti Korupsi" onclick="anti_korup2()">
		<i class="fas fa-dollar-sign"></i> Anti Korupsi 2 Jam
	</a>
	<a id="pengumuman" href="<?php echo site_url('c_jadwal/pengumuman') ?>" class="btn btn-small" title="pengumuman">
		<i class="fas fa-bullhorn"></i>Pengumuman
	</a>
	<?php if($this->session->flashdata('success')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
	<?php endif; ?>
		
	<!-- data tables -->
	<table id="jadwal" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Panggil</th>
				<th>Panggil Saksi</th>
				<th>Antrian</th>
				<th>Perkara</th>
				<th>Penggugat</th>
				<th>Tergugat</th>
				<th>Jadwal</th>
				<th>Ruang Sidang</th>
				<th>Aksi</th>
				<th>Cetak</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($jadwals as $jadwal): ?>
			<tr <?php echo ($jadwal->status == "masuk") ? "class='sidang-active'" : '';  ?>>
				<td align="center">
					<a href="#" class="btn btn-small" name="panggil">
						<i class="fas fa-play" title="panggil"></i>
					</a>
					<a href="#" class="btn btn-small" name="stop">
						<i class="fas fa-stop" title="stop"></i>
					</a>
					<input type="hidden" value="<?php echo $jadwal->id; ?>" name="id_perkara">
				</td>
				<td align="center">
					<a href="#" class="btn btn-small" name="saksi">
						<i class="fas fa-play" title="panggil saksi"></i>
					</a>
					<a href="#" class="btn btn-small" name="stop">
						<i class="fas fa-stop" title="stop"></i>
					</a>
				</td>
				<td name="no antrian">
					<?php echo $jadwal->no_antrian; ?>
				</td>
				<td name="perkara">
					<?php echo $jadwal->perkara; ?>
				</td>
				<td name="penggugat">
					<?php echo $jadwal->penggugat; ?>
				</td>
				<td name="tergugat">
					<?php echo $jadwal->tergugat; ?>
				</td>
				<td name="jadwal sidang">
					<?php echo date('d F Y', strtotime($jadwal->jadwal_sidang)); ?>
				</td>
				<td name="ruang sidang">
					<?php echo $jadwal->ruang_sidang; ?>
				</td>
				<td>
					<a href="<?php echo site_url('c_jadwal/update/'.$jadwal->id) ?>" class="btn btn-small">
						<i class="fas fa-edit" title="ubah"></i>Ubah
					</a>
					<a href="<?php echo site_url('c_jadwal/delete/'.$jadwal->id) ?>" onclick="return confirm('Hapus perkara <?php echo $jadwal->perkara ?> ?')" class="btn btn-small text-danger">
						<i class="fas fa-trash" title="hapus"></i>Hapus
					</a>
				</td>
				<td name="ctk">
					<a href="#" name="cetak" class="btn btn-lg">
						<i class="fas fa-print"></i>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</div>
</div>
<!-- loader -->
<div class="loader2" style="display:none;">
	<div class="scene" style="--hue: 260; --saturation: 53; --lightness: 67">
		<div class="word">
			<div class="letter__wrap" style="--index: 0">
				<div class="letter" data-letter="L"><span class="letter__panel" aria-hidden="true">L</span><span class="letter__panel" aria-hidden="true">W</span><span class="letter__panel" aria-hidden="true">L</span><span class="letter__panel" aria-hidden="true">W</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 1">
				<div class="letter" data-letter="o"><span class="letter__panel" aria-hidden="true">o</span><span class="letter__panel" aria-hidden="true">a</span><span class="letter__panel" aria-hidden="true">o</span><span class="letter__panel" aria-hidden="true">a</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 2">
				<div class="letter" data-letter="a"><span class="letter__panel" aria-hidden="true">a</span><span class="letter__panel" aria-hidden="true">i</span><span class="letter__panel" aria-hidden="true">a</span><span class="letter__panel" aria-hidden="true">i</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 3">
				<div class="letter" data-letter="d"><span class="letter__panel" aria-hidden="true">d</span><span class="letter__panel" aria-hidden="true">t</span><span class="letter__panel" aria-hidden="true">d</span><span class="letter__panel" aria-hidden="true">t</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 4">
				<div class="letter" data-letter="i"><span class="letter__panel" aria-hidden="true">i</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel" aria-hidden="true">i</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 5">
				<div class="letter" data-letter="n"><span class="letter__panel" aria-hidden="true">n</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel" aria-hidden="true">n</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel"></span></div>
			</div>
			<div class="letter__wrap" style="--index: 6">
				<div class="letter" data-letter="g"><span class="letter__panel" aria-hidden="true">g</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel" aria-hidden="true">g</span><span class="letter__panel" aria-hidden="true">.</span><span class="letter__panel"></span></div>
			</div>
		</div>
	</div>
</div>
<!-- end loader -->



<?php $this->load->view("_partials/js.php") ?>
</body>
<footer class="page-footer font-small green">
	<div class="footer-copyright text-center py-3">
		Copyright &copy; <a href="http://taufikdwp.tk">Taufik Dwi Wahyu Putra</a> 2020
	</div>
</footer>
</html>