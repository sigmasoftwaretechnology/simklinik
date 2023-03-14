var __base_url__ = $("#base_url").val();
$(function () {
	$("input[id='kadaluarsa']").mask('00-00-0000');
	$('#jumlah').mask('#');
	getObat();
	getSupplier();
});

$(document).on('click', '#masuk-list', function(event){
	var err = 0;
	$('.cek-header').each(function(){
		$(this).removeClass("is-invalid");
		if($(this).val() == ""){
			$(this).addClass("is-invalid");
			$("#error-"+$(this).attr("id")).text("wajib di isi");
			err++;
		}	
		if($(this).val() == null){
			$(this).addClass("is-invalid");
			$("#error-"+$(this).attr("id")).text("wajib di isi");
			err++;
		}	
	});
	if(err > 0){
		return true;
	}
	var idSupplier = $("select[id='cari-supplier']").val();
	var namaSupplier = $("select[id='cari-supplier']").children("option[value='"+$("select[id='cari-supplier']").select2("val")+"']").first().html();;
	var idObat = $("select[id='cari-obat']").val();
	var namaObat = $("select[id='cari-obat']").children("option[value='"+$("select[id='cari-obat']").select2("val")+"']").first().html();
	var batch = $("input[id='batch']").val();
	var kadaluarsa = $("input[id='kadaluarsa']").val();
	var jumlah = $("input[id='jumlah']").val();
	var tr = "";
	tr = "<tr>"+
			"<td><input type='hidden' name='id_supplier[]' value='"+idSupplier+"'><input type='hidden' name='nama_supplier[]' value='"+namaSupplier+"'>"+namaSupplier+"</td>"+
			"<td><input type='hidden' name='id_obat[]' value='"+idObat+"'><input type='hidden' name='nama_obat[]' value='"+namaObat+"'>"+namaObat+"</td>"+
			"<td><input type='hidden' name='batch[]' value='"+batch+"'>"+batch+"</td>"+
			"<td><input type='hidden' name='kadaluarsa[]' value='"+kadaluarsa+"'>"+kadaluarsa+"</td>"+
			"<td><input type='hidden' name='jumlah[]' value='"+jumlah+"'>"+jumlah+"</td>"+
			"<td><button type='button' onclick='delTr(this)' class='btn btn-danger btn-flat btn-xs'><i class='fa fa-trash'></i></button></td>"+
		  "</tr>";
	$("#data-obat").append(tr);
});

function getObat(){
	$('#cari-obat').select2({
        placeholder: "Pilih Obat",
        ajax: {
            url: __base_url__ + "obat/get-obat",
            dataType: 'json',
            data: function (params) {
                var query = {
                    nama: params.term
                }
                return query;
            },
            processResults: function (data, page) {
            return {
              results: data
            };
          },
        }
    });
}

function getSupplier(){
	$('#cari-supplier').select2({
        placeholder: "Pilih Supplier",
        ajax: {
            url: __base_url__ + "supplier/get-supplier",
            dataType: 'json',
            data: function (params) {
                var query = {
                    nama: params.term
                }
                return query;
            },
            processResults: function (data, page) {
            return {
              results: data
            };
          },
        }
    });
}

function delTr(obj){
	$(obj).parent().parent().remove();
}

$(document).on('submit', 'form#frm', function (event) {
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
			if (data.fail) {
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  html: data.errors.nama_obat
				})
			} else {
				Swal.fire({
				  icon: 'success',
				  title: 'Success',
				  html: data.pesan
				});
				$("#data-obat").html("");
			}
		},
		error: function (xhr, textStatus, errorThrown) {
			alert("Error: " + errorThrown);
		}
	});
	return false;
});
