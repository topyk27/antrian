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
<script>const rsvc = true;</script>
<?php $this->load->view("_partials/js.php") ?>
<script type="text/javascript">	
	var msg = new SpeechSynthesisUtterance();
	var suara;
	var myTimeout;
	function myTimer()
	{
		speechSynthesis.pause();
		speechSynthesis.resume();
		myTimeout = setTimeout(myTimer, 10000);
	}
	if(rsvc==false)
	{
		setTimeout(() => {		
			suara = window.speechSynthesis.getVoices();		
			msg.voice = suara[11];	
			msg.lang = 'in-ID';
			msg.rate = 0.9;		
			msg.onstart = function(e)
			{
				// console.log('gas cukk');
			}
			msg.onend = function(e)
			{			
				// console.log('end cukk');
				clearTimeout(myTimeout);
				// pangil_end();
			}	
			msg.onerror = function(e)
			{
				console.log(e);
				console.log('error');
			}
		}, 1000);

	}
	voice = $("input[name='voice']").val();
	rate = {rate:1};
	$("input[value='Umumkan']").click(function(e){
		if(rsvc != false)
		{
			responsiveVoice.speak($('#text').val(), voice, rate);
		}
		else
		{
			myTimeout = setTimeout(myTimer, 10000);
			msg.text = $('#text').val();
			speechSynthesis.speak(msg);
		}
	});
</script>
</body>
<footer class="fixed-bottom footer-fixed-bottom page-footer font-small green">
	<div class="footer-copyright text-center py-3">
		Copyright &copy; <a href="https://topyk27.github.io/">Taufik Dwi Wahyu Putra</a> <?php echo date("Y"); ?>
	</div>
</footer>
</html>