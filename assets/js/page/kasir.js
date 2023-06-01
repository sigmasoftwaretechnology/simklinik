var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
		ajaxLoad(__base_url__+"keuangan/kasir?tanggal="+$("#filterTanggal1").val()+"&text="+$("#nama").val());
    }); 
	
	$('.filterTanggal').daterangepicker({
		singleDatePicker:true,
		autoclose: true,
		locale: {
		  format: 'DD-MM-YYYY'
		}
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

var format = function(num){
	var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
	if(str.indexOf(",") > 0) {
		parts = str.split(",");
		str = parts[0];
	}
	str = str.split("").reverse();
	for(var j = 0, len = str.length; j < len; j++) {
		if(str[j] != ".") {
		  output.push(str[j]);
		  if(i%3 == 0 && j < (len - 1)) {
			output.push(".");
		  }
		  i++;
		}
	}
	formatted = output.reverse().join("");
	return("" + formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
};
$(document).on('keyup', '#jumlah-bayar', function(event){
	var totalbayar = $("#total-bayar").val();
	$("#kembali-rupiah").text(format($(this).val()-totalbayar));
	$("#kembali").val($(this).val()-totalbayar);
});

$(document).on('click', '#simpan-pembayaran', function(event){
if($('#jumlah-bayar').val()  == ""){
	Swal.fire(
	  'Error',
	  'Mohon isi jumlah pembayaran',
	  'error'
	)
}else{
	savePembayaran();
}
});

$(document).on('click', '#cetak-invoice', function(event){
	window.open(__base_url__+"keuangan/kwitansi?reg="+$("#no_reg").text(), '_blank');
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

function getObat(){
	$('#cari-obat').select2({
        placeholder: "Pilih Obat",
        ajax: {
            url: __base_url__ + "farmasi/obat/data-obat",
            dataType: 'json',
            data: function (params) {
                var query = {
                    nama: params.term
                }
                return query;
            },
			success: function(data) {
				 return data; 
			},
            processResults: function (data, page) {
				return {
				  results: data
				};
			},
        }
    });

	$('#cari-obat').on('change', function(e) {
		$('#harga-obat').val($(this).select2('data')[0].harga);
		$('#stok-obat').val($(this).select2('data')[0].stok);
		$('#nama-obat').val($(this).select2('data')[0].nama_obat);
	  console.log($(this).select2('data')[0].harga);
	})

}

function addTableResep(id,nama,kali,waktu,harga,jumlah){
    var row_tabel = $("#body-resep tr").length;
    no_tabel = row_tabel + 1; 
    var isi_resep = "<tr>"+
    "<td><input type='hidden' name='id_obat["+no_tabel+"]' value='"+id+"'/><input type='hidden' name='nama_obat["+no_tabel+"]' value='"+nama+"'/><input type='hidden' name='harga_obat["+no_tabel+"]' value='"+harga+"'/><input type='hidden' name='jumlah_obat["+no_tabel+"]' value='"+jumlah+"'/>"+nama+"</td>"+
    "<td><input type='hidden' name='kali["+no_tabel+"]' value='"+kali+"'/><input type='hidden' name='waktu_minum["+no_tabel+"]' value='"+waktu+"'/>"+kali+" "+waktu+"</td>"+
    "<td><button type='button'  onclick='delTr(this)' class='btn  btn-outline-danger btn-xs'>Hapus</button></td>"+
    "</tr>";
    $('#body-resep').append(isi_resep);
}

function delTr(obj){
	$(obj).parent().parent().remove();
}

function savePembayaran() {
    var form = $('form#frm-pembayaran');
    var data = new FormData($('form#frm-pembayaran')[0]);
    var url = form.attr("action");
    $("#preloader").css("display", "block");
    data.append("no_reg", $("#no_reg").text());
    data.append("total_bayar", $("#total-bayar").val());
    data.append("jumlah_bayar", $("#jumlah-bayar").val());
    data.append("kembali", $("#kembali").val());
    $.ajax({
        type: "POST",
        url: url,
        data:data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        success: function (data) {
            $("#preloader").css("display", "none");
				Swal.fire(
				  'Sukses',
				  'Pembayaran sukses',
				  'success'
				)
					var txtbtn = '<div class="row">'+
									'<div class="col-12">'+
										'<button type="button" id="cetak-invoice" class="btn btn-block btn-danger btn-xs"><img src="'+__base_url__+'/assets/img/icon/printer.png">Cetak Kwitansi</button>'+
									'</div>'+
								'</div>';
			$("#btn-grup").html(txtbtn);
			ajaxLoad(__base_url__+"keuangan/kasir?tanggal="+$("#filterTanggal1").val()+"&text="+$("#nama").val());
        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
}




