var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
		ajaxLoad(__base_url__+"farmasi/supplier");
    }); 
});

$('#modal-form-baru').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	ajaxLoad(button.data('href'), 'modal-content-form-baru');
});

$('#modal-form-detail').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	ajaxLoad(button.data('href'), 'modal-content-form-detail');
});

$('#modal-delete').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	$('#delete_id').val(button.data('id'));
});

$(document).on('click', '.edit-detail', function(event){
	$("input[name='id_obat']").val($(this).data('id_obat'));
	$("input[name='id_detail']").val($(this).data('id'));
	$("input[name='batch']").val($(this).data('batch'));
	$("input[name='kadaluarsa']").val($(this).data('kadaluarsa'));
	$("input[name='stok']").val($(this).data('stok'));
});

$(document).on('submit', 'form#frmTindakan', function (event) {
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
				var err="";
				var dtKrt="";
				for (control in data.errors) {
					$('input[name=' + control + ']').addClass('is-invalid');
					$('textarea[name=' + control + ']').addClass('is-invalid');
					console.log('#error-' + control);
					$('#error-' + control).html(data.errors[control]);
					dtKrt = "<p style='margin-bottom: 0.2rem;'  class='text-danger'>"+data.errors[control]+"</p>";
					err = err+ dtKrt;
				}
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  html: err,
				})
			} else {
				$('#modal-form-baru').modal('hide');
				ajaxLoad(__base_url__+"/farmasi/supplier");
			}
		},
		error: function (xhr, textStatus, errorThrown) {
			alert("Error: " + errorThrown);
		}
	});
	return false;
});

function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
			if(content == "modal-content-form-detail"){
				$("input[name='kadaluarsa']").mask('00-00-0000');
			}
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}

function ajaxDelete(filename, id) {
	$.ajax({
		type: 'GET',
		data: {id: id},
		url: filename,
		success: function (data) {
			$('#modal-delete').modal('hide');
			ajaxLoad(__base_url__+"farmasi/supplier");
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}

