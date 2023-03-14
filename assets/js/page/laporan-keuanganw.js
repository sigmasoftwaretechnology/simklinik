var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
         ajaxLoad(__base_url__+"laporan-keuangan");
    }); 

	$('.filterTanggal').daterangepicker({
		singleDatePicker:true,
		autoclose: true,
		locale: {
		  format: 'DD-MM-YYYY'
		}

	});

});

function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}