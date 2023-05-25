$(document).ready(function () {
	// ruang_sidang = $('#id_ruang').val();
	ruang_sidang1 = 1;
	ruang_sidang2 = 2;
	url = window.location.pathname.split( 'index.php' ); //jadinya ["/antrian-ci/", "/antrian/ruang/1"]
	base_url = window.location.hostname + url[0];
	daftar_sidang = {};
	// tampil_data_sidang();
	yg_masuk = 0;
	function tampil_data_sidang () {
		$.ajax({
			type: 'ajax',
			url: "http://"+ base_url + "index.php/antrian/daftar_sidang/" + ruang_sidang1,
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

	

	var tabel1 = $("#tabel_sidang1").DataTable({
		"paging": false,
		"searching": false,
		"info": false,
		
		"ajax": {

			"url": "http://" + base_url + "index.php/antrian/daftar_sidang/" + ruang_sidang1,
			"dataSrc": "",
		},
		"columns": [
		// {"data" : "no_antrian"},
			{
				data: null, sortable: false, render: function(data,type,row,meta)
				{
					return "<p class='noAntrian'>"+row['no_antrian']+"</p>";
				}
			},
			{
				data: null, sortable: false, render: function(data,type,row,meta)
				{
					const no_perkara = row['perkara'];
					const penggugat = row['penggugat'];
					const tergugat = row['tergugat'];
					const br = "<br />"
					const renderNo = "Nomor Perkara : "+no_perkara+br;
					const renderPenggugat = "Penggugat : "+penggugat+br;
					const renderTergugat = "Tergugat : "+tergugat+br;
					return renderNo+renderPenggugat+renderTergugat;
				}
			}
		// {"data" : "perkara"},
		// {"data" : "penggugat"},
		// {"data" : "tergugat"},
		],
		columnDefs : [
			{
				targets: [0],
				className: 'text-center'
			}
		],
		"createdRow": function(row, data, dataIndex){			
			if(data['status']=="masuk")
			{
				$(row).addClass("sidang-active");
				yg_masuk = data['no_antrian'];
				
				// $("#no_perkara1").text(data['no_antrian']);
			}
		},
		
	});
	var tabel2 = $("#tabel_sidang2").DataTable({
		"paging": false,
		"searching": false,
		"info": false,
		
		"ajax": {

			"url": "http://" + base_url + "index.php/antrian/daftar_sidang/" + ruang_sidang2,
			"dataSrc": "",
		},
		"columns": [
		// {"data" : "no_antrian"},
			{
				data: null, sortable: false, render: function(data,type,row,meta)
				{
					return "<p class='noAntrian'>"+row['no_antrian']+"</p>";
				}
			},
			{
				data: null, sortable: false, render: function(data,type,row,meta)
				{
					const no_perkara = row['perkara'];
					const penggugat = row['penggugat'];
					const tergugat = row['tergugat'];
					const br = "<br />"
					const renderNo = "Nomor Perkara : "+no_perkara+br;
					const renderPenggugat = "Penggugat : "+penggugat+br;
					const renderTergugat = "Tergugat : "+tergugat+br;
					return renderNo+renderPenggugat+renderTergugat;
				}
			}
		// {"data" : "perkara"},
		// {"data" : "penggugat"},
		// {"data" : "tergugat"},
		],
		columnDefs : [
			{
				targets: [0],
				className: 'text-center'
			}
		],
		"createdRow": function(row, data, dataIndex){			
			if(data['status']=="masuk")
			{
				$(row).addClass("sidang-active");
				yg_masuk = data['no_antrian'];
				
				// $("#no_perkara2").text(data['no_antrian']);
			}
		},
		
	});
	
	setInterval(function(){
		// console.log("mau reload");
		tabel1.ajax.reload()
	}, 5000);
	setInterval(function(){
		// console.log("mau reload");
		tabel2.ajax.reload()
	}, 5000);
	jQuery("#no_perkara1").fitText();
	jQuery("#no_perkara2").fitText();

});