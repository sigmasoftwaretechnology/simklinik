var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
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

$(document).on('click', '#addBatch', function (event) {
	addTableBatch($("#nobatch").val(),$("#expired").val(),$("#jumlah").val());
	var ind = 1;
	var gtt = 0;
	$('#body-batch > tr').each(function(index, tr) { 
		ind = ind+index;
		var harga_obat = $("input[name='harga_obat["+ind+"]']").val();
		var jumlah_obat = $("input[name='stok["+ind+"]']").val();
		var total_jual = harga_obat*jumlah_obat;
		gtt = gtt + total_jual;
		$("#gtt").text(formatRupiah(gtt.toString(), 'Rp '));
		$("#total-bayar").val(gtt);
	});
	$("#nobatch").val("");
	$("#expired").val("");
	$("#jumlah").val("");
});

$(document).on('click', '#simpan-resep', function(event){
	saveObatMasuk();
});

$(document).on('click', '#export', function (event) {
	var bulan = $("#filterBulan").val();
	var tahun = $("#filterTahun").val();
	window.open(__base_url__+'farmasi/obat-masuk/export?bulan=' + bulan + "&tahun=" + tahun , "_blank");
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

$(document).on('keyup', '#jumlah_bayar', function(event){
	var totalbayar = $("#total-bayar").val();
	$("#kembali-rupiah").text(format($(this).val()-totalbayar));
	$("#kembali").val($(this).val()-totalbayar);
});

function ajaxLoad(filename, content) {
	content = typeof content !== 'undefined' ? content : 'content';
	$.ajax({
		type: "GET",
		url: filename,
		contentType: false,
		success: function (data) {
			$("#" + content).html(data);
			if(content == "modal-content-form-baru"){
				getObat();
				$("#expired").mask('00/00/0000');
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
            url: __base_url__ + "farmasi/obat/data-obat-pemeriksaan",
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
		$('#nama-obat').val($(this).select2('data')[0].nama_obat);
		$('#id-obat').val($(this).select2('data')[0].id);
		console.log($(this).select2('data')[0].id);
	})

}

function addTableBatch(batch,expired,stok){
    var row_tabel = $("#body-batch tr").length;
    no_tabel = row_tabel + 1; 
    var isi_tindakan = "<tr>"+
    "<td><input type='hidden' name='id_obat["+no_tabel+"]' value='"+$('#id-obat').val()+"'/><input type='hidden' name='nama_obat["+no_tabel+"]' value='"+$('#nama-obat').val()+"'/>"+$('#nama-obat').val()+"</td>"+
    "<td><input type='hidden' name='harga_obat["+no_tabel+"]' value='"+$('#harga-obat').val()+"'/>"+formatRupiah(($('#harga-obat').val()).toString(), 'Rp ')+"</td>"+
	"<td><input type='hidden' name='batch["+no_tabel+"]' value='"+batch+"'/>"+batch+"</td>"+
    "<td><input type='hidden' name='expired["+no_tabel+"]' value='"+expired+"'/>"+expired+"</td>"+
    "<td><input type='hidden' name='stok["+no_tabel+"]' value='"+stok+"'/>"+stok+"</td>"+
	    "<td><input type='hidden' name='total_obat["+no_tabel+"]' value='"+($('#harga-obat').val()*stok)+"'/>"+formatRupiah(($('#harga-obat').val()*stok).toString(), 'Rp ')+"</td>"+
    "<td class='text-center'><a class='text-danger' onclick='delTr(this)'><i class='fa fa-trash'></i></a></td>"+
    "</tr>";
    $('#body-batch').append(isi_tindakan);
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
	return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
}

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

function delTr(obj){
	$(obj).parent().parent().remove();
}

function saveObatMasuk() {
    var form = $('form#frm-obat');
    var data = new FormData($('form#frm-obat')[0]);
    var url = form.attr("action");
    $("#preloader").css("display", "block");
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
			$('#modal-form-baru').modal('hide');

        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
}




