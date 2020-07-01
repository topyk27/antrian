<html>
<?php $this->load->view("_partials/head.php") ?>
<body>
	<div class="container">
		<div class="container-fluid">
			<h2>Silahkan Login</h2>
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php endif; ?>
			<div style="float: right;">
				<a href="/antrian/index.php/antrian/ruang/1" class="btn btn-small">
					<i class="fas fa-list" title="antrian ruang sidang 1"></i>
					Antrian ruang sidang 1
				</a>
				<a href="/antrian/index.php/antrian/ruang/2" class="btn btn-small">
					<i class="fas fa-list" title="antrian ruang sidang 2"></i>
					Antrian ruang sidang 2
				</a>
			</div>
			<!-- <form action="<?php echo 'login/proses_login'; ?>" method="post"> -->
			<form method="post">
				<div class="form-group form-inline">
					<label for="username">Username</label>
					<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>" type="text" name="username" placeholder="username" required>
					<div class="invalid-feedback">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				</div>
				<div class="form-group form-inline">
					<label for="password">Password</label>
					<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" type="password" name="password" placeholder="password" required>
					<div class="invalid-feedback">
						<?php echo form_error('password'); ?>
					</div>
				</div>
				<input class="btn btn-success" type="submit" value="login">
			</form>

		</div>
	</div>
</body>
<footer class="page-footer font-small green">
	<div class="footer-copyright text-center py-3">
		Copyright &copy; <a href="http://taufikdwp.tk">Taufik Dwi Wahyu Putra</a> 2020
	</div>
</footer>
</html>