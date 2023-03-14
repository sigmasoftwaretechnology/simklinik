var __base_url__ = $("#base_url").val();
$(function () {
     ajaxLoad(__base_url__+"setting/antrian");
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

function resetNomor (obj) {
	$.ajax({
		type: 'GET',
		data: {id: $(obj).data('id')},
		url: __base_url__+"setting/antrian/reset",
		success: function (data) {
			alert("Nomor antrian berhasil di reset");
			ajaxLoad(__base_url__+"setting/antrian");
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	})
}


$('#modal-delete').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	$('#delete_id').val(button.data('id'));
});

$('#modal-open').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	$('#delete_id').val(button.data('id'));
});

function ajaxDelete(filename, id) {
	$.ajax({
		type: 'GET',
		data: {id: id},
		url: filename,
		success: function (data) {
			$('#modal-delete').modal('hide');
			ajaxLoad(__base_url__+"setting/antrian");
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}
function ajaxOpen(filename, id) {
	$.ajax({
		type: 'GET',
		data: {id: id},
		url: filename,
		success: function (data) {
			$('#modal-open').modal('hide');
			ajaxLoad(__base_url__+"setting/antrian");
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}
