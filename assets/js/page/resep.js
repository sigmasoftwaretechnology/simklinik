var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
		ajaxLoad(__base_url__+"farmasi/resep?tanggal="+$("#filterTanggal1").val()+"&text="+$("#nama").val());
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

$(document).on('click', '#simpan-resep', function(event){
	saveResep();
});

$(document).on('click', '#cetak-invoice', function(event){
	alert("cetak invoice");
});

$(document).on('click', '.edit-detail', function(event){
	$("input[name='id_obat']").val($(this).data('id_obat'));
	$("input[name='id_detail']").val($(this).data('id'));
	$("input[name='batch']").val($(this).data('batch'));
	$("input[name='kadaluarsa']").val($(this).data('kadaluarsa'));
	$("input[name='stok']").val($(this).data('stok'));
});

/* $(document).on('submit', 'form#frmTindakan', function (event) {
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
				Swal.fire(
				  'Sukses',
				  'Resep direkam',
				  'success'
				)
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
 */
function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
			if(content == "modal-content-form-detail"){
				getObat();
				$("#masuk-resep").on("click", function (e) { 
					var vv = $('#cari-obat');     
					var label = $(vv).children("option[value='"+$(vv).select2("val")+"']").first().html();
					if($(vv).select2("val")  == null){
						Swal.fire(
						  'Error',
						  'Mohon pilih obat',
						  'error'
						)
					}
					else if($('#jumlah').val()  == ""){
						Swal.fire(
						  'Error',
						  'Mohon isi jumlah obat',
						  'error'
						)
					}
					else if($('#kali_sehari').val()  == ""){
						Swal.fire(
						  'Error',
						  'Mohon isi frequensi minum obat',
						  'error'
						)
					}
					else if($('#waktu_minum').val()  == ""){
						Swal.fire(
						  'Error',
						  'Mohon isi waktu minum obat',
						  'error'
						)
					}
					addTableResep($(vv).select2("val"),$("#nama-obat").val(),$("#batch-obat").val(),$("#kali_sehari").val(),$("#waktu_minum").val(),$("#harga-obat").val(),$("#jumlah").val());
				});
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
		$('#view-stok').text($(this).select2('data')[0].stok);
		$('#nama-obat').val($(this).select2('data')[0].nama_obat);
		$('#batch-obat').val($(this).select2('data')[0].batch_obat);
	})

}

function addTableResep(id,nama,batch,kali,waktu,harga,jumlah){
	if(parseInt(jumlah) > parseInt($('#stok-obat').val())){
		Swal.fire(
		  'Error',
		  'Stok batch ini kurang',
		  'error'
		);
	}
	else{
		var row_tabel = $("#body-resep tr").length;
		no_tabel = row_tabel + 1; 
		var isi_resep = "<tr>"+
		"<td><input type='hidden' name='id_obat["+no_tabel+"]' value='"+id+"'/><input type='hidden' name='nama_obat["+no_tabel+"]' value='"+nama+"'/><input type='hidden' name='batch_obat["+no_tabel+"]' value='"+batch+"'/><input type='hidden' name='harga_obat["+no_tabel+"]' value='"+harga+"'/><input type='hidden' name='jumlah_obat["+no_tabel+"]' value='"+jumlah+"'/>"+nama+"</td>"+
		"<td>"+jumlah+"</td>"+
		"<td style='text-align:right'>"+formatRupiah(harga, 'Rp ')+"</td>"+
		"<td style='text-align:right'>"+formatRupiah((jumlah*harga).toString(), 'Rp ')+"</td>"+
		"<td class='d-none'><input type='hidden' name='kali["+no_tabel+"]' value='"+kali+"'/><input type='hidden' name='waktu_minum["+no_tabel+"]' value='"+waktu+"'/>"+kali+" "+waktu+"</td>"+
		"<td class='text-center'><a onclick='delTr(this)' class='text-dangcer'><i class='fa fa-trash'></i></a></td>"+
		"</tr>";
		$('#body-resep').append(isi_resep);
	}
}

function formatRupiah(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function delTr(obj){
	$(obj).parent().parent().remove();
}

function saveResep() {
    var form = $('form#frm-resep');
    var data = new FormData($('form#frm-resep')[0]);
    var url = form.attr("action");
    $("#preloader").css("display", "block");
    data.append("nama", $("#nama_pasien").text());
    data.append("no_reg", $("#no_reg").text());
    data.append("no_rm", $("#rm_pasien").text());
    data.append("umur", $("#umur_pasien").text());
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
				  'Resep direkam',
				  'success'
				)
			/* var txtbtn = "<div class='col-6'>"+
							"<button type='button' id='simpan-resep' class='btn btn-block btn-outline-success btn-xs'>Update Resep</button>"+
							"</div>"+
							"<div class='col-6'>"+
							"<a type='button' href='"+__base_url__+"/kasir/invoice?reg="+$("#no_reg").text()+"' id='cetak-invoice' class='btn btn-block btn-outline-warning btn-xs'>Invoice</a>"+
							"</div>"+
							"<div class='col-4'>"+
							"<button type='button' id='cetak-label' class='btn btn-block btn-outline-danger btn-xs'>Label</button>"+
						"</div>";
			$("#btn-grup").html(txtbtn); */
			ajaxLoad(_base_url__+"farmasi/resep?tanggal="+$("#filterTanggal1").val()+"&text="+$("#nama").val());
        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
}




