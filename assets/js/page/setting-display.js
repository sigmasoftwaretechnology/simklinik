var __base_url__ = $("#base_url").val();
$(function () {
	bsCustomFileInput.init();
});
$(document).on('submit', 'form#frmDisplay', function (event) {
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
			$('.is-invalid').removeClass('is-invalid');
			if (data.fail) {
				var err = "";
				var dtKrt = "";
				for (control in data.errors) {
					$('input[name=' + control + ']').addClass('is-invalid');
					$('textarea[name=' + control + ']').addClass('is-invalid');
					$('#error-' + control).html(data.errors[control]);
					dtKrt = "<p style='margin-bottom: 0.2rem;'  class='text-danger'>" + data.errors[control] + "</p>";
					err = err + dtKrt;
				}
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					html: err,
				})
			}
			else{
				Swal.fire(
					'Sukses',
					'Video display berhasil di upload',
					'success'
				)			  
			}
		},
		error: function (xhr, textStatus, errorThrown) {
			alert("Error: " + errorThrown);
		}
	});
	return false;
});
