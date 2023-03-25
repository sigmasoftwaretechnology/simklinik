var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function () {
		ajaxLoad(__base_url__ + "farmasi/obat-keluar?awal=" + $("#filterTanggal1").val() + "&akhir=" + $("#filterTanggal2").val());
	});
	$('.filterTanggal').daterangepicker({
		singleDatePicker: true,
		autoclose: true,
		locale: {
			format: 'DD-MM-YYYY'
		}

	});
	ajaxLoad(__base_url__+"farmasi/obat-keluar?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
});
$(document).on('click', '#export', function (event) {
	window.open(__base_url__ + "farmasi/obat-keluar/export?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val(), "_blank");
});
function ajaxLoad(filename, content) {
	$("#preloader").css("display", "block");
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#preloader").css("display", "none");
			$("#" + content).html(data);
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}
