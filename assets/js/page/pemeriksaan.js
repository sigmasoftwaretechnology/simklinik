var __base_url__ = $("#base_url").val();
var __no_reg__ = $("#no_reg").text();
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

	$('.summernote').summernote({
		height: 200,
		minHeight: 200,              
		maxHeight: 600,
		fontSize:10,
		toolbar: [
		]
	});
	
	$('.summernote-rendah').summernote({
		height: 100,
		minHeight: 100,              
		maxHeight: 600,
		fontSize:10
	});
	
    $("input[id='dosis']").mask('0-0-0');

	getTindakan();

	getIcdx();
	
	getObat();
		
	ajaxLoadDataAssessment(__no_reg__);
	
	ajaxLoadDataKunjungan();
		
	$("#cari-icdx").on("select2:select", function (e) { 
        var select_val = $(e.currentTarget).val();
        var vv = $('#cari-icdx');     
        var label = $(vv).children("option[value='"+$(vv).select2("val")+"']").first().html();
        addTableIcdx(select_val,label);
    });
	
	$("#masuk-resep").on("click", function (e) { 
		addTableResep($("#nama-obat").val(),$("#jumlah").val(),$("#dosis").val(),$("#aturan_minum").val());
    });
	
	$("#masuk-icdx").on("click", function (e) { 
        addTableIcdx($("#manual-icdx").val(),$("#manual-icdx").val());
    });
	
	$("#masuk-tindakan").on("click", function (e) { 
	    var select_val = $('#cari-tindakan').val();
        var vv = $('#cari-tindakan');     
        var label = $(vv).children("option[value='"+$(vv).select2("val")+"']").first().html();
        addTableTindakan(select_val,label);
    });

	$("#simpan-pemeriksaan-fisik").click(function(){
		if($("input[type='hidden'][name='lunas']").val() == "lunas"){
			Swal.fire(
			  'Error',
			  'Registrasi sudah terbayar',
			  'error'
			)		
		}
		else{
			savePemeriksaanFisik();
		}
	});
	
	$("#simpan-dokument-penunjang").click(function(){
		saveDokument();
	});
	
	$("#simpan-diagnosa").click(function(){
		saveDiagnosa();
	});
	
	$("#simpan-odontogram").click(function(){
		saveOdontogram();
	});
	
	$("#simpan-tindakan").click(function(){
		saveTindakan();
	});
	
	$("#simpan-resep").click(function(){
		saveResep();
	});
	
});

function ajaxLoadDataKunjungan(no_rm) {
    $.ajax({
        type: "GET",
        url: __base_url__ + "rekam-medis/get-kunjungan?no_rm=" + $("#rm_pasien").text(),
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
			if(data.data !== null){
				$("#body-kunjungan").empty();
				$.each(data.data, function(i, item) {
					var isi_tindakan = "<tr>"+
					"<td>"+item.no_reg+"</td>"+
					"<td>"+item.tanggal+"</td>"+
					"<td class='text-center'>"+
                    "<a href='"+ __base_url__ + "rekam-medis/view?no_reg=" + item.no_reg+"' target='_blank'><img src='"+__base_url__+"/assets/img/icon/printer.png'></a>"+
                    "&nbsp;<a data-noreg='"+item.no_reg+"' data-tglperiksa='"+item.tanggal+"' onclick='getPemeriksaan(this)'><img src='"+__base_url__+"/assets/img/icon/file.png'></a>"+
                    "</td>"+
					"</tr>";
					$('#body-kunjungan').append(isi_tindakan);
                });
			}
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function ajaxLoadDataAssessment(no_reg) {
    $.ajax({
        type: "GET",
        url: __base_url__ + "pemeriksaan/data?no_reg=" + no_reg,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
			console.log(data.data);
			$("#body-icdx").empty();
			$("#body-tindakan").empty();
			if(data.data !== null){
				$("form#frm-pemeriksaan-fisik textarea[name='subject']").val(data.data.subject);
				$("form#frm-pemeriksaan-fisik textarea[name='resep']").summernote('code',data.data.plant.resep);
                $("form#frm-pemeriksaan-fisik textarea[name='pemeriksaan_penunjang']").summernote('code',data.data.pemeriksaan_penunjang);
				if(data.data.lunas !== null){
					 $("form#frm-pemeriksaan-fisik input[type='hidden'][name='lunas']").val(data.data.lunas);
				}
				$.each(data.data.object, function(i, item) {
                    $("form#frm-pemeriksaan-fisik input[type='text'][name='"+i+"']").val(item);
                    $("form#frm-pemeriksaan-fisik input[type='hidden'][name='"+i+"']").val(item);
                    $("form#frm-pemeriksaan-fisik textarea[name='"+i+"']").val(item);
                });
				$("#body-icdx").empty();
				var no_diagnosis = 0;
				$.each(data.data.assessment.icdx, function(i, item) {
					var isi_icdx = "<tr>"+
					"<td><input type='hidden' name='nama_icdx["+no_diagnosis+"]' value='"+item.nama_icdx+"'/>"+item.nama_icdx+"</td>"+
					"<td><button type='button'  onclick='delTr(this)' class='btn  btn-outline-danger btn-xs'>Hapus</button></td>"+
					"</tr>";
					$('#body-icdx').append(isi_icdx);
					no_diagnosis++;
                });
				
				$("#body-tindakan").empty();
				var no_tindakan = 0;
				$.each(data.data.assessment.tindakan, function(i, item) {
					var isi_tindakan = "<tr>"+
					"<td><input type='hidden' name='tarif_tindakan["+no_tindakan+"]' value='"+item.tarif_tindakan+"'/><input type='hidden' name='nama_tindakan["+no_tindakan+"]' value='"+item.nama_tindakan+"'/>"+item.nama_tindakan+"</td>"+
					"<td><button type='button'  onclick='delTr(this)' class='btn  btn-outline-danger btn-xs'>Hapus</button></td>"+
					"</tr>";
					$('#body-tindakan').append(isi_tindakan);
					no_tindakan++;
                });
			}
			$("#body-dokument").empty();
			var no_dokument = 0;
			if(data.dataDokument !== null){
				$.each(data.dataDokument.file_dokument, function(i, item) {
					var isi_dokument = "<tr>"+
					"<td>"+item.jns_dokument+"</td>"+
					"<td><a href='"+__base_url__+"/uploads/file-px/"+item.nama_file+"' data-toggle='lightbox'>"+item.nama_file+"</a></td>"+
					"</tr>";
					$('#body-dokument').append(isi_dokument);
					no_dokument++;
				});
			}
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function savePemeriksaanFisik() {
    var form = $('form#frm-pemeriksaan-fisik');
    var data = new FormData($('form#frm-pemeriksaan-fisik')[0]);
    var url = form.attr("action");
    $("#preloader").css("display", "block");
    data.append("nama", $("#nama_pasien").text());
    data.append("no_reg", $("#no_reg").text());
    data.append("no_rm", $("#rm_pasien").text());
    data.append("umur", $("#umur_pasien").text());
    data.append("alamat_pasien", $("#alamat_pasien").text());
    data.append("tanggal", $("input[name='tanggal_periksa']").val());
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
			  'Asessment berhasil direkam',
			  'success'
			)
        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
}

function saveDokument() {
    var form = $('form#frm-dokument-penunjang');
    var data = new FormData($('form#frm-dokument-penunjang')[0]);
    var url = form.attr("action");
    $("#preloader").css("display", "block");
    data.append("nama", $("#nama_pasien").text());
    data.append("no_reg", $("#no_reg").text());
    data.append("no_rm", $("#rm_pasien").text());
    data.append("umur", $("#umur_pasien").text());
    data.append("alamat_pasien", $("#alamat_pasien").text());
    data.append("tanggal", $("input[name='tanggal_periksa']").val());
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
			  'Dokument berhasil direkam',
			  'success'
			);
			ajaxLoadDataAssessment(__no_reg__);
        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
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
    data.append("alamat_pasien", $("#alamat_pasien").text());
    data.append("tanggal", $("input[name='tanggal_periksa']").val());
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
        },
        error: function (xhr, status, error) {
            $("#preloader").css("display", "none");
        }
    });
}

function delTr(obj){
	$(obj).parent().parent().remove();
}

function getPemeriksaan(obj){
	$('#modal-view-erm').modal('show');
    $.ajax({
        type: "GET",
        url: __base_url__ + "rekam-medis/modal-erm?no_reg=" + $(obj).data("noreg"),
        contentType: false,
        success: function (data) {
            $("#modal-content-view-erm").html(data);
        },
        error: function (xhr, status, error) {
        }
    });
}

function showModalErm() {
    $.ajax({
        type: "GET",
        url: __base_url__+"rekam-medis/pendaftaran/get-data",
        contentType: false,
        success: function (data) {
            $("#content-pendaftaran").html(data);
        },
        error: function (xhr, status, error) {
        }
    });
}

function addTableTindakan(id,isi){
    var row_tabel = $("#body-tindakan tr").length;
    no_tabel = row_tabel + 1; 
    var isi_tindakan = "<tr>"+
    "<td><input type='hidden' name='tarif_tindakan["+no_tabel+"]' value='"+id+"'/><input type='hidden' name='nama_tindakan["+no_tabel+"]' value='"+isi+"'/>"+isi+"</td>"+
    "<td><button type='button'  onclick='delTr(this)' class='btn  btn-outline-danger btn-xs'>Hapus</button></td>"+
    "</tr>";
    $('#body-tindakan').append(isi_tindakan);
}

function addTableIcdx(id,isi){
    var row_tabel = $("#body-icdx tr").length;
    no_tabel = row_tabel + 1; 
    var isi_icdx = "<tr>"+
    "<td><input type='hidden' name='nama_icdx["+no_tabel+"]' value='"+isi+"'/>"+isi+"</td>"+
    "<td><button type='button'  onclick='delTr(this)' class='btn  btn-outline-danger btn-xs'>Hapus</button></td>"+
    "</tr>";
    $('#body-icdx').append(isi_icdx);
}

function getTindakan(){
	$('#cari-tindakan').select2({
        placeholder: "Pilih Tindakan",
        ajax: {
            url: __base_url__ + "tindakan/get-tindakan",
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

function getIcdx(){
	$('#cari-icdx').select2({
        placeholder: "Pilih Icd",
        ajax: {
            url: __base_url__ + "diagnosa/get-icdx",
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
		$('#nama-obat').val($(this).select2('data')[0].nama_obat);
	})

}

function addTableResep(nama,no,aturan_pakai,aturan_minum){
	if($("form#frm-pemeriksaan-fisik textarea[name='resep']").summernote('isEmpty')){
		isi = "";
	}
	else{
		isi =  $("form#frm-pemeriksaan-fisik textarea[name='resep']").summernote('code');
	}
   isi = isi+"<p>"+nama+" No "+no+" "+aturan_pakai+" "+aturan_minum+"</p>";
   $("form#frm-pemeriksaan-fisik textarea[name='resep']").summernote('code',isi);
}


