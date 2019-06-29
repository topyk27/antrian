voice = "Indonesian Female";
rate = {rate: 1.1, onend: pangil_end};
url = window.location.pathname.split( 'index.php' ); //jadinya ["/antrian-ci/", "/antrian/ruang/1"]
base_url = window.location.hostname + url[0];

var tabel_jadwal = $('#jadwal').dataTable({
	fnDrawCallback: function (oSettings) {
		$('.dataTables_filter').each(function () {
			$(this).prepend($("#tambah"));
		});
		$('.dataTables_length').each(function () {
			$(this).append($("#abidin"));
		});
		tombol_panggil();
	}
});

function kasubagHonor($ruang)
{
	responsiveVoice.speak("Bapak Abidin. Ruang sidang " + $ruang, voice, rate);
}

function pangil_end(){
	$("a[name='stop']").hide();
	$("a[name='panggil']").show();
	$("a[name='saksi']").show();
}

function tombol_panggil () {
$("a[name='stop']").hide();
$("a[name='stop']").click(function(e){
	e.preventDefault();
	$("a[name='panggil']").show();
	$("a[name='saksi']").show();
	$("a[name='stop']").hide();
	responsiveVoice.cancel();
});

$("a[name='panggil']").click(function(e){
	e.preventDefault();
	
	$("a[name='panggil']").hide();
	$("a[name='stop']").show();
	$("a[name='saksi']").hide();
	$row = this.closest('tr');
	$cols = $($row).find("td");
	$input = $($row).find("input");
	sidang_masuk = $input.filter("[name='id_perkara']").val();
	$no_antrian = $cols.filter("[name='no antrian']").text();
	$perkara = $cols.filter("[name='perkara']").text();
	$p = $perkara.split("PA"); //diganti jadi P,A biar gak dibaca pa
	$penggugat = $cols.filter("[name='penggugat']").text();
	$tergugat = $cols.filter("[name='tergugat']").text();
	$ruang_sidang = $cols.filter("[name='ruang sidang']").text();
	if(!$tergugat.replace(/\s/g, '').length){ //kalo tergugat kosong, cuma ada spasi aja
		responsiveVoice.speak("Nomor antrian " + $no_antrian
			+ ". Nomor perkara " + $p[0] + "P,A" + $p[1]
			+ ". " + $penggugat
			+ ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
	}else{
		responsiveVoice.speak("Nomor antrian " + $no_antrian
			+ ". Nomor perkara " + $p[0] + "P,A" + $p[1]
			+ ". " + $penggugat
			+ ". Berlawanan dengan " + $tergugat
			+ ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
	}
	antrian_sebelumnya = $("#antrian_sebelumnya").val();
	if(antrian_sebelumnya=="")
	{
		antrian_sebelumnya=0;
	}
	// {
		$.ajax({
			type: "ajax",
			url: "http://" + base_url + "index.php/antrian/sidang_masuk/" + antrian_sebelumnya + "/" + sidang_masuk,
			dataType: "text",
			success: function(data)
			{
				//datanya kalo sukses = 1
				
				$("#antrian_sebelumnya").val(sidang_masuk);
				$("tr.sidang-active").removeClass("sidang-active");
				$($row).addClass('sidang-active');
			},
			error: function(err)
			{
				console.log(err);
			}
		});
	// }
});

$("a[name='saksi']").click(function(e){
	e.preventDefault();
	$("a[name='panggil']").hide();
	$("a[name='stop']").show();
	$("a[name='saksi']").hide();
	$row = this.closest('tr');
	$cols = $($row).find("td");
	$penggugat = $cols.filter("[name='penggugat']").text();
	$tergugat = $cols.filter("[name='tergugat']").text();
	$ruang_sidang = $cols.filter("[name='ruang sidang']").text();
		responsiveVoice.speak("Saksi-saksi dari " + $penggugat
			+ ". Atau " + $tergugat
			+ ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
	
});
	
}

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});