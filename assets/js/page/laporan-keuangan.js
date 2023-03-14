var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
		ajaxLoad(__base_url__+"farmasi/supplier");
    }); 
});

$(document).on('click', '#export', function (event) {
	var bulan = $("#filterBulan").val();
	var tahun = $("#filterTahun").val();
	window.open(__base_url__+'keuangan/laporan-keuangan/export?bulan=' + bulan + "&tahun=" + tahun , "_blank");
});

$('#modal-form-detail').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	ajaxLoad(button.data('href'), 'modal-content-form-detail');
});

$('#modal-delete').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	$('#delete_id').val(button.data('id'));
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

