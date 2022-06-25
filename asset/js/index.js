// voice = "Indonesian Female";

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
			pangil_end();
		}	
		msg.onerror = function(e)
		{
			console.log(e);
			console.log('error');
		}
	}, 1000);

}
voice = $("input[name='voice']").val();
rate = {rate: 1, onend: pangil_end};
url = window.location.pathname.split( 'index.php' ); //jadinya ["/antrian-ci/", "/antrian/ruang/1"]
base_url = window.location.hostname + url[0];
ruang = $("input[name='ruang_sidang']").val();
// console.log(ruang);
// console.log(voice);
$(document).ready(function(){
	var tabel_jadwal = $('#jadwal').DataTable({
		fnDrawCallback: function (oSettings) {
			$('.dataTables_filter').each(function () {
				$(this).prepend($("#tambah"));
			});
			
			tombol_panggil();
			// cetak();
		}
	});

	// fungsi cetak
	$('#jadwal tbody').on('click', "a[name='cetak']", function(){
		var data = tabel_jadwal.row($(this).parents('tr')).data();
		antrian = data[2].trim();
		perkara = data[3].trim();
		jadwal = data[6].trim();
		ruang = data[7].trim();
		$.ajax({
			type: "POST",
			url: "http://" + base_url + "index.php/antrian/cetak",
			data: {antrian: antrian, jadwal: jadwal, ruang: ruang, perkara: perkara},
			dataType: 'json',
			beforeSend: function(){
				$(".loader2").show();
			},
			success: function(respon){
				// console.log("ini ip nya " + respon.ip);
				if(respon.success == 1)
				{
					// console.log("berhasil");
				}
				else
				{
					// console.log("gagal");
					alert("gagal");
				}
			},
			complete: function(){
				// console.log("yay");
				$(".loader2").hide();
				
			}
		});
	});
	// end fungsi cetak
});


function kasubagHonor(ruang)
{
	if(rsvc != false)
	{
		responsiveVoice.speak("Abang Jay. Ruang sidang " + ruang, voice, rate);
	}
	else
	{
		myTimeout = setTimeout(myTimer, 10000);
		msg.text = "Abang Jay. Ruang sidang " + ruang;		
		speechSynthesis.speak(msg);
	}
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
	if(rsvc != false)
	{
		responsiveVoice.cancel();
	}
	else
	{
		speechSynthesis.cancel();
	}
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
	$no_antrian = $no_antrian.replace(/\s\s+/g, ' ');
	$perkara = $cols.filter("[name='perkara']").text();
	$perkara = $perkara.replace(/\s\s+/g, ' ');
	$p = $perkara.split("PA"); //diganti jadi P,A biar gak dibaca pa
	$penggugat = $cols.filter("[name='penggugat']").text();
	$penggugat = $penggugat.replace(/\s\s+/g, ' ');
	$tergugat = $cols.filter("[name='tergugat']").text();
	$tergugat = $tergugat.replace(/\s\s+/g, ' ');
	$ruang_sidang = $cols.filter("[name='ruang sidang']").text();
	$ruang_sidang = $ruang_sidang.replace(/\s\s+/g, ' ');
	if(!$tergugat.replace(/\s/g, '').length){ //kalo tergugat kosong, cuma ada spasi aja
		if(rsvc != false)
		{
			responsiveVoice.speak("Nomor antrian \n" + $no_antrian
				+ ". Nomor perkara " + $p[0] + "P,A" + $p[1] + ". "
				+ $penggugat
				+ ". \n Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
		}
		else
		{
			myTimeout = setTimeout(myTimer, 10000);
			msg.text = "Nomor antrian, " + $no_antrian + ". Nomor perkara " + $p[0] + "P,A" + $p[1] + ". " + $penggugat + ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang;
			
			speechSynthesis.speak(msg);
		}
	}else{
		if(rsvc != false)
		{
			responsiveVoice.speak("Nomor antrian \n" + $no_antrian
				+ ". Nomor perkara " + $p[0] + "P,A" + $p[1] + ". "
				+ $penggugat + " \n Berlawanan dengan "
				+ $tergugat + ". \n Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
		}
		else
		{
			myTimeout = setTimeout(myTimer, 10000);
			msg.text = "Nomor antrian, " + $no_antrian + ". Nomor perkara " + $p[0] + "P,A" + $p[1] + ". " + $penggugat + " Berlawanan dengan" + $tergugat + ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang;
			
			speechSynthesis.speak(msg);
		}
	}
	//bikin tabel baru terakhir dipanggil

	antrian_sebelumnya = $("#antrian_sebelumnya").val();
	if(antrian_sebelumnya=="")
	{
		antrian_sebelumnya=0;
	}
		$.ajax({
			type: "ajax",
			url: "http://" + base_url + "index.php/antrian/sidang_masuk/" + ruang + "/" + sidang_masuk,
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


});

$("a[name='saksi']").click(function(e){
	e.preventDefault();
	$("a[name='panggil']").hide();
	$("a[name='stop']").show();
	$("a[name='saksi']").hide();
	$row = this.closest('tr');
	$cols = $($row).find("td");
	$penggugat = $cols.filter("[name='penggugat']").text();
	$penggugat = $penggugat.replace(/\s\s+/g, ' ');
	$tergugat = $cols.filter("[name='tergugat']").text();
	$tergugat = $tergugat.replace(/\s\s+/g, ' ');
	$ruang_sidang = $cols.filter("[name='ruang sidang']").text();
	$ruang_sidang = $ruang_sidang.replace(/\s\s+/g, ' ');
	if (!$tergugat.replace(/\s/g, '').length)
	{
		if(rsvc != false)
		{
			responsiveVoice.speak("Saksi-saksi dari " + $penggugat
				+ " \n Dipersilahkan masuk ke ruang sidang " + $ruang_sidang, voice, rate);
		}
		else
		{
			myTimeout = setTimeout(myTimer, 10000);
			msg.text = "Saksi-saksi dari " + $penggugat + "Dipersilahkan masuk ke ruang sidang " + $ruang_sidang;
			
			speechSynthesis.speak(msg);
		}
	}
	else
	{
		if(rsvc != false)
		{
			responsiveVoice.speak("Saksi-saksi dari " + $penggugat
				+ " Atau " + $tergugat
				+ ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang , voice, rate);
		}
		else
		{
			myTimeout = setTimeout(myTimer, 10000);
			msg.text = "Saksi-saksi dari " + $penggugat + " Atau " + $tergugat + ". Dipersilahkan masuk ke ruang sidang " + $ruang_sidang;
			
			speechSynthesis.speak(msg);
		}
	}
	
});
	
}

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});



function buka_sidang()
{
	// responsiveVoice.enableEstimationTimeout = false;
	if(rsvc != false)
	{
		responsiveVoice.speak("Assalamualaikum Warahmatullahi Wabarakatuh. "
			+ "Para pengunjung sidang yang terhormat, "
			+ "selamat datang di pengadilan agama tenggarong. "
			+ "Kami ucapkan semoga bapak ibu sehat wal'afiat. "
			+ "dan selalu dalam curahan rahmat kasih sayang Allah subhanahu wata'ala. "
			+ "Sebelum persidangan dimulai, demi keamanan dan kenyamanan. "
			+ "untuk ketertiban selama berada di lingkungan kantor pengadilan agama tenggarong. "
			+ "Kami menyediakan fasilitas sarana penunjang sebagai berikut. "
			+ "1. Tempat parkir kendaraan roda 4 dan roda 2, mohon diparkir dengan rapi. "
			+ "2. Kursi tempat duduk agar pengunjung duduk dan sambil istirahat menunggu antrian sidang. "
			+ "3. Charger tempat pengisian baterai HP terletak di ruang tunggu masing-masing. "
			+ "4. Galon air minum secara cuma-cuma. "
			+ "5. Ruang untuk ibu hamil dan menyusui. "
			+ "6. Ruang untuk pengacara. "
			+ "7. Televisi. "
			+ "8. Toilet umum berada di samping mushalla, khusus untuk pengunjung. "
			+ "9. Mushalla dan tempat wudhu jika pada saatnya pengunjung akan melaksanakan shalat. "
			+ "10. Kantin umum berada di belakang gedung pengadilan agama. "
			+ "Dalam rangka ikut memutuskan tali rantai penyebaran virus covid 19 di pengadilan agama tenggarong. "
			+ "Maka jam pelayanan kantor pengadilan agama tenggarong diubah. "
			+ "menjadi dari jam 8 pagi sampai dengan jam 3 sore. Terhitung mulai tanggal 1 September 2020. "
			+ "Dan setiap orang yang datang ke pengadilan agama tenggarong diwajibkan. "
			+ "1. Cuci tangan dengan sabun di wastafel yang telah disediakan. "
			+ "2. Memakai masker. "
			+ "3. Menjaga jarak. "
			+ "4. Menduduki tempat yang telah disediakan dan tidak duduk pada tempat yang ada tanda silangnya. "
			+ "Semoga kita terhindar dari virus corona dan semoga pandemi covid 19 cepat berlalu. "
			+ "Aamiin, ya robbal alamin. "
			+ "Untuk pengunjung yang akan mengikuti sidang. harap diperhatikan aturan-aturan di dalam ruang sidang. "
			+ "1. Dilarang membawa anak. "
			+ "2. Dilarang membawa senjata tajam. "
			+ "3. Dilarang membawa senjata api. "
			+ "4. Dilarang menggunakan jaket. "
			+ "5. Dilarang menggunakan topi. "
			+ "6. Dilarang menggunakan kacamata hitam. "
			+ "7. Handphone dimatikan atau dinonaktifkan. "
			+ "Demikian yang bisa kami berikan. "
			+ "Dimohon kepada para pengunjung sidang. "
			+ "agar mengikuti persidangan dengan sikap sopan dan berpakaian rapi serta islami. "
			+ "Apabila ada yang ditanyakan kami siap melayani. "
			+ "Semoga bisa diindahkan bersama. "
			+ "Terima kasih atas perhatian anda. "
			+ "Wassalamualaikum Warahmatullahi Wabarakatuh." , "Indonesian Male", rate);
	}
	else
	{
		myTimeout = setTimeout(myTimer, 10000);
		msg.text = "Assalamualaikum Warahmatullahi Wabarakatuh. Para pengunjung sidang yang terhormat, selamat datang di pengadilan agama tenggarong. Kami ucapkan semoga bapak ibu sehat wal'afiat. Dan selalu dalam curahan rahmat kasih sayang Allah subhanahu wata'ala. Sebelum persidangan dimulai, demi keamanan dan kenyamanan. Untuk ketertiban selama berada di lingkungan kantor pengadilan agama tenggarong. Kami menyediakan fasilitas sarana penunjang sebagai berikut. 1. Tempat parkir kendaraan roda 4 dan roda 2, mohon diparkir dengan rapi. 2. Kursi tempat duduk agar pengunjung duduk dan sambil istirahat menunggu antrian sidang. 3. Charger tempat pengisian baterai HP terletak di ruang tunggu masing-masing. 4. Galon air minum secara cuma-cuma. 5. Ruang untuk ibu hamil dan menyusui. 6. Ruang untuk pengacara. 7. Televisi. 8. Toilet umum berada di samping mushalla, khusus untuk pengunjung. 9. Mushalla dan tempat wudhu jika pada saatnya pengunjung akan melaksanakan shalat. 10. Kantin umum berada di belakang gedung pengadilan agama. Dalam rangka ikut memutuskan tali rantai penyebaran virus covid 19 di pengadilan agama tenggarong. Maka jam pelayanan kantor pengadilan agama tenggarong diubah. menjadi dari jam 8 pagi sampai dengan jam 3 sore. Terhitung mulai tanggal 1 September 2020. Dan setiap orang yang datang ke pengadilan agama tenggarong diwajibkan. 1. Cuci tangan dengan sabun di wastafel yang telah disediakan. 2. Memakai masker. 3. Menjaga jarak. 4. Menduduki tempat yang telah disediakan dan tidak duduk pada tempat yang ada tanda silangnya. Semoga kita terhindar dari virus corona dan semoga pandemi covid 19 cepat berlalu. Aamiin, ya robbal alamin. Untuk pengunjung yang akan mengikuti sidang. harap diperhatikan aturan-aturan di dalam ruang sidang. 1. Dilarang membawa anak. 2. Dilarang membawa senjata tajam. 3. Dilarang membawa senjata api. 4. Dilarang menggunakan jaket. 5. Dilarang menggunakan topi. 6. Dilarang menggunakan kacamata hitam. 7. Handphone dimatikan atau dinonaktifkan. Demikian yang bisa kami berikan. Dimohon kepada para pengunjung sidang. agar mengikuti persidangan dengan sikap sopan dan berpakaian rapi serta islami. Apabila ada yang ditanyakan kami siap melayani. Semoga bisa diindahkan bersama. Terima kasih atas perhatian anda. Wassalamualaikum Warahmatullahi Wabarakatuh.";
		
		speechSynthesis.speak(msg);			
	}
}

function anti_korup()
{
	if(rsvc != false)
	{
		responsiveVoice.speak("Sebelum persidangan saya mulai, perlu saya sampaikan kepada penggugat dan pemohon, "
			+ "tergugat dan termohon, terdakwa penuntut umum, penasehat hukum, "
			+ "keluarga para pihak dan seluruh pengunjung sidang. "
			+ "Tolong bantu kami, warga Pengadilan Agama Tenggarong untuk berperilaku bersih "
			+ "dengan cara tidak menghubungi hakim, panitera, panitera pengganti, juru sita "
			+ "dan seluruh warga Pengadilan Agama Tenggarong. "
			+ "Untuk tidak menerima tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga. "
			+ "Dan apabila ada yang mengatasnamakan hakim, panitera, panitera pengganti, juru sita "
			+ "atau pegawai Pengadilan Agama Tenggarong "
			+ "menerima atau meminta tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga "
			+ "agar segera melaporkan kepada. "
			+ "1. KPK. Dinomor 08558575575. "
			+ "2. BAWAS MARI. Dinomor 02125578300. "
			+ "3. Pengadilan Tinggi Agama Kalimantan Timur. Dinomor 0541733337. "
			+ "4. Ketua Pengadilan Agama Tenggarong. Dinomor 081806496466. "
			+ "Atas perhatian dan kerjasamanya kami ucapkan terima kasih."
			, "Indonesian Male", 0.8);
	}
	else
	{
		myTimeout = setTimeout(myTimer, 10000);
		msg.text = "Sebelum persidangan saya mulai, perlu saya sampaikan kepada penggugat dan pemohon, "+ "tergugat dan termohon, terdakwa penuntut umum, penasehat hukum, "+ "keluarga para pihak dan seluruh pengunjung sidang. "+ "Tolong bantu kami, warga Pengadilan Agama Tenggarong untuk berperilaku bersih "+ "dengan cara tidak menghubungi hakim, panitera, panitera pengganti, juru sita "+ "dan seluruh warga Pengadilan Agama Tenggarong. "+ "Untuk tidak menerima tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga. "+ "Dan apabila ada yang mengatasnamakan hakim, panitera, panitera pengganti, juru sita "+ "atau pegawai Pengadilan Agama Tenggarong "+ "menerima atau meminta tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga "+ "agar segera melaporkan kepada. "+ "1. KPK. Dinomor 08558575575. "+ "2. BAWAS MARI. Dinomor 02125578300. "+ "3. Pengadilan Tinggi Agama Kalimantan Timur. Dinomor 0541733337. "+ "4. Ketua Pengadilan Agama Tenggarong. Dinomor 081806496466. "+ "Atas perhatian dan kerjasamanya kami ucapkan terima kasih.";
		speechSynthesis.speak(msg);
	}
}

function anti_korup2()
{
	if(rsvc != false)
	{
		responsiveVoice.speak("Assalamualaikum Warahmatullahi Wabarakatuh. "
			+"Mohon perhatian akan sebuah pemberitahuan, "
			+ "yang berasal dari Pimpinan Ketua Pengadilan Agama Tenggarong. "
			+"Kepada para pihak berperkara, keluarga para pihak dan seluruh pengunjung pengadilan. "
			+ "Tolong bantu kami, warga Pengadilan Agama Tenggarong untuk berperilaku bersih "
			+ "dengan cara tidak menghubungi hakim, panitera, panitera pengganti, juru sita "
			+ "dan seluruh warga Pengadilan Agama Tenggarong. "
			+ "Untuk tidak menerima tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga. "
			+ "Dan apabila ada yang mengatasnamakan hakim, panitera, panitera pengganti, juru sita "
			+ "atau pegawai Pengadilan Agama Tenggarong "
			+ "menerima atau meminta tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga "
			+ "agar segera melaporkan kepada. "
			+ "1. KPK. Dinomor 08558575575. "
			+ "2. BAWAS MARI. Dinomor 02125578300. "
			+ "3. Pengadilan Tinggi Agama Kalimantan Timur. Dinomor 0541733337. "
			+ "4. Ketua Pengadilan Agama Tenggarong. Dinomor 081806496466. "
			+ "Atas perhatian dan kerjasamanya kami ucapkan terima kasih."
			, "Indonesian Male", 0.8);
	}
	else
	{
		myTimeout = setTimeout(myTimer, 10000);
		msg.text = "Assalamualaikum Warahmatullahi Wabarakatuh. "+"Mohon perhatian akan sebuah pemberitahuan, "+ "yang berasal dari Pimpinan Ketua Pengadilan Agama Tenggarong. "+"Kepada para pihak berperkara, keluarga para pihak dan seluruh pengunjung pengadilan. "+ "Tolong bantu kami, warga Pengadilan Agama Tenggarong untuk berperilaku bersih "+ "dengan cara tidak menghubungi hakim, panitera, panitera pengganti, juru sita "+ "dan seluruh warga Pengadilan Agama Tenggarong. "+ "Untuk tidak menerima tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga. "+ "Dan apabila ada yang mengatasnamakan hakim, panitera, panitera pengganti, juru sita "+ "atau pegawai Pengadilan Agama Tenggarong "+ "menerima atau meminta tip, sogokan, suap, pemberian atau janji dalam bentuk apapun juga "+ "agar segera melaporkan kepada. "+ "1. KPK. Dinomor 08558575575. "+ "2. BAWAS MARI. Dinomor 02125578300. "+ "3. Pengadilan Tinggi Agama Kalimantan Timur. Dinomor 0541733337. "+ "4. Ketua Pengadilan Agama Tenggarong. Dinomor 081806496466. "+ "Atas perhatian dan kerjasamanya kami ucapkan terima kasih.";
		speechSynthesis.speak(msg);
	}
}