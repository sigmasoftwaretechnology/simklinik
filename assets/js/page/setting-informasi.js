var __base_url__ = $("#base_url").val();
$(function () {
});
$(document).on('submit', 'form#frmInformasi', function (event) {
	event.preventDefault();
	var form = $(this);
	var data = new FormData($(this)[0]);
	var url = form.attr("action");
	$("#preloader").css("display", "block");
	$.ajax({
		type: form.attr('method'),
		url: url,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			$("#preloader").css("display", "none");
			Swal.fire(
			  'Sukses',
			  'Informasi berhasil di rubah',
			  'success'
			)		
		},
		error: function (xhr, textStatus, errorThrown) {
			alert("Error: " + errorThrown);
		}
	});
	return false;
});
