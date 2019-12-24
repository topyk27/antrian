<html>
<?php $this->load->view("_partials/head.php") ?>
<body>
	
<div class="container">
	<input type="hidden" name="voice" value="<?php echo $this->session->userdata('voice'); ?>">
	<h2>Pengumuman</h2>
	<div class="container-fluid">
	<textarea id="text" rows="7" class="form-control" placeholder="Masukkan pengumumannya kemudian klik tombol umumkan"></textarea>
		<div style="float:right;">
			<input type="submit" value="Umumkan" class="btn btn-success mr-1">
			<input type="button" value="Batal" class="btn btn-danger mr-1" onclick="location.href='<?php echo site_url('c_jadwal/'); ?>'">
		</div>
	</div>
</div>

<?php $this->load->view("_partials/js.php") ?>
<script type="text/javascript">
	voice = $("input[name='voice']").val();
	rate = {rate:1};
	$("input[value='Umumkan']").click(function(e){
		responsiveVoice.speak($('#text').val(), voice, rate);
	});
</script>
</body>
<footer class="fixed-bottom footer-fixed-bottom page-footer font-small green">
	<div class="footer-copyright text-center py-3">
		Copyright &copy; <a href="https://www.instagram.com/topyk27">Taufik Dwi Wahyu Putra</a> 2019
	</div>
</footer>
</html>