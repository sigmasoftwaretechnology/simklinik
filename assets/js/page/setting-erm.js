var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
        ajaxLoad(__base_url__+"setting/buka-erm?tanggal="+$("#filterTanggal1").val());
    }); 
	$('.filterTanggal').daterangepicker({
		singleDatePicker:true,
		autoclose: true,
		locale: {
		  format: 'DD-MM-YYYY'
		}

	});
    ajaxLoad(__base_url__+"setting/buka-erm?tanggal="+$("#filterTanggal1").val());
});
var keys = {};

$(document).keydown(function(e) {
    keys[e.which] = true;
    if (keys[16] && keys[65]) { // Ctrl + Alt + 1 in that order
		e.preventDefault();
		console.log("pressed shift a");
    }
    if (keys[16] && keys[83]) { // Ctrl + Alt + 1 in that order
		e.preventDefault();
		console.log("pressed shift a");
    }
});

$(document).keyup(function(e) {
  delete keys[e.which];
});

function mdata(v){
    v=v.replace(/\D/g,""); //Remove what is not a digit
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       

    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}

function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
			if(content == "modal-content-form-register"){
				getPasienLama();
			}
			else if(content == "modal-content-form-baru"){
				$("input[name='tgl_lahir']").mask('00/00/0000');
			}
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}


$('#modal-delete').on('show.bs.modal', function (event) {
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
			ajaxLoad(__base_url__+"setting/buka-erm?tanggal="+$("#filterTanggal1").val());
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}
