$(document).ready(function () {
	$ruang_sidang = $('#id_ruang').val();
	url = window.location.pathname.split( 'index.php' ); //jadinya ["/antrian-ci/", "/antrian/ruang/1"]
	base_url = window.location.hostname + url[0];
	daftar_sidang = {};
	// tampil_data_sidang();
	yg_masuk = 0;
	function tampil_data_sidang () {
		$.ajax({
			type: 'ajax',
			url: "http://"+ base_url + "index.php/antrian/daftar_sidang/" + $ruang_sidang,
			async: false,
			dataType: 'json',
			success : function(data){
				// console.log('sukses');
				// var html = '';
				daftar_sidang = data;
				// for(var i=0; i<data.length; i++)
				// {
				// 	var tr = (data[i].status == "masuk") ? "<tr class='sidang-active'>" : "<tr>"
				// 	html += tr +
				// 	'<td>' + data[i].no_antrian + '</td>' +
				// 	'<td>' + data[i].perkara + '</td>' +
				// 	'<td>' + data[i].penggugat + '</td>' +
				// 	'<td>' + data[i].tergugat + '</td>' +
				// 	'</tr>'
				// }
				// $("#tampil_data").html(html);
			},
			error: function(err){
				console.log("gagal");
				console.log(err);
			}
		});
	}

	

	var tabel = $("#tabel_sidang").DataTable({
		"paging": false,
		"searching": false,
		"info": false,
		
		"ajax": {

			"url": "http://" + base_url + "index.php/antrian/daftar_sidang/" + $ruang_sidang,
			"dataSrc": "",
		},
		"columns": [
		{"data" : "no_antrian"},
		{"data" : "perkara"},
		{"data" : "penggugat"},
		{"data" : "tergugat"},
		],
		"createdRow": function(row, data, dataIndex){
			if(data['status']=="masuk")
			{
				$(row).addClass("sidang-active");
				yg_masuk = data['no_antrian'];
				$("#no_antrian").text(yg_masuk);
				$("#no_perkara").text(data['perkara']);
			}
		},
		
	});
	
	setInterval(function(){
		console.log("mau reload");
		tabel.ajax.reload()
	}, 5000);

});