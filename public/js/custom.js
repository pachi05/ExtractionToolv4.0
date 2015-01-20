$(document).ready(function($) {
	//Settings/Save Changes
	var mifp = $("#mdb-input-filepath");
	var midu = $("#mdb-input-dbusername");
	var midp = $("#mdb-input-dbpassword");
	var midt = $("#mdb-input-dbtablname");
	var mis  = $("#mdb-input-submit");

	mifp.keyup(function() {
		if((mifp.val() == null) && (midu.val() == null) && (midp.val() == null) && (midt.val() == null))
		{
			mis.attr('disabled', 'disabled');
			mis.attr('class', 'btn btn-disabled navbar-right');
		}
		else
		{
			mis.removeAttr('disabled');
			mis.attr('class', 'btn btn-primary navbar-right');
		}
	});

	//Extraction/Extract Now
	var fen = $("#form-extract-now");
	var dpb = $("#div-progress-bar");
	var der = $("#div-extract-result");
	var dpt = $("#div-progress-text");
	var dpp = $("#div-progress-post");

	fen.on('submit', function() {
		dpb.attr('class', 'progress');
		der.attr('class', 'input-center hide');
		dpt.attr('class', 'col-md-12');


		$.ajax({
			type: "POST",
			url: fen.attr("action"),
			data: fcdb.serialize(),
			success: function(response) {
				if(response.status == 'success') {
					dpb.attr('class', 'progress hide');
					dpt.attr('class', 'col-md-12 hide');
					dpp.attr('class', 'col-md-12 input-center');
				}
			}
		});

		return false;

	});

	//Reports/download
	var fdl = $("#form-download");

	fdl.on('submit', function() {
		
	});

	// //Dashboard/Check Database
	// var bcdb = $("#btn-check-database");
	// var swl  = $("#span-wait-load");
	// var fcdb = $("#form-check-database");


	// // fcdb.click(function(e){	
	// fcdb.on('submit', function() {

	// 	bcdb.attr('class', 'btn btn-default hide');
	// 	swl.removeAttr('hidden');
		
	// 	$.ajax({
	// 		type: "POST",
	// 		url: fcdb.attr("action"),
	// 		data: fcdb.serialize(),
	// 		success: function(response) {
	// 			if(response.status == 'success') {
	// 				console.log(response);
	// 			}
	// 			else
	// 			{
					
	// 			}
	// 		}
	// 	});

	// 	return false;

	// });
	
});
