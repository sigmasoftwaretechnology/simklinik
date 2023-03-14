var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
        ajaxLoad(__base_url__+"rekam-medis/pasien-registrasi?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val()+"&nama="+$("#filterNama").val());
    }); 
	$('.filterTanggal').daterangepicker({
		singleDatePicker:true,
		autoclose: true,
		locale: {
		  format: 'DD-MM-YYYY'
		}

	});
    ajaxLoad(__base_url__+"rekam-medis/pasien-registrasi?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val()+"&nama="+$("#filterNama").val());
});
$(document).on('change', "select[name='poli']", function (event) {
	$("#dpjp").val($(this).find(":selected").attr("data-dokter"));
});

$(document).on('click', "button[id='panggil']", function (event) {
	
    var nomor = $(this).data("nomor").toString();
    var $nomorantri = $(this).data("nomor");
    var $suarapoli = $(this).data("suara");

    var n = nomor.length;
    var explode_no = [];
    for (var i=0; i < n; i++) {
        explode_no[i]= nomor.substr(i, 1)
	}
    console.log(nomor+"-"+$suarapoli);
    document.getElementById('suarabelopen').pause();
    document.getElementById('suarabelopen').currentTime=0;
    document.getElementById('suarabelopen').play();
    totalwaktu=document.getElementById('suarabelopen').duration*1000;
	setTimeout(function() {
		document.getElementById('suarabelnomorurut').pause();
		document.getElementById('suarabelnomorurut').currentTime=0;
		document.getElementById('suarabelnomorurut').play();
		totalwaktu=document.getElementById('suarabelnomorurut').duration*1000;	
	}, totalwaktu);
	totalwaktu=totalwaktu+1500;
	if($nomorantri<10){
		setTimeout(function() {
			document.getElementById('suarabel'+$nomorantri).pause();
			document.getElementById('suarabel'+$nomorantri).currentTime=0;
			document.getElementById('suarabel'+$nomorantri).play();
		}, totalwaktu);
	
		totalwaktu=totalwaktu+1000;
	} else if($nomorantri ==10){
	//JIKA 10 MAKA MAIKAN SUARA SEPULUH
		setTimeout(function() {
				document.getElementById('sepuluh').pause();
				document.getElementById('sepuluh').currentTime=0;
				document.getElementById('sepuluh').play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
	} else if($nomorantri ==11){
		//JIKA 11 MAKA MAIKAN SUARA SEBELAS
		setTimeout(function() {
				document.getElementById('sebelas').pause();
				document.getElementById('sebelas').currentTime=0;
				document.getElementById('sebelas').play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
	} else if($nomorantri < 20){
		//JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
		setTimeout(function() {
				document.getElementById('suarabel'+explode_no[1]).pause();
				document.getElementById('suarabel'+explode_no[1]).currentTime=0;
				document.getElementById('suarabel'+explode_no[1]).play();
			}, totalwaktu);
		totalwaktu=totalwaktu+800;
		setTimeout(function() {
				document.getElementById('belas').pause();
				document.getElementById('belas').currentTime=0;
				document.getElementById('belas').play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
	} else if($nomorantri < 100){				
		//JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
		setTimeout(function() {
				document.getElementById('suarabel'+explode_no[0]).pause();
				document.getElementById('suarabel'+explode_no[0]).currentTime=0;
				document.getElementById('suarabel'+explode_no[0]).play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
				document.getElementById('puluh').pause();
				document.getElementById('puluh').currentTime=0;
				document.getElementById('puluh').play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
				document.getElementById('suarabel'+explode_no[1]).pause();
				document.getElementById('suarabel'+explode_no[1]).currentTime=0;
				document.getElementById('suarabel'+explode_no[1]).play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
		
	}
	else if($nomorantri == 100){				
		setTimeout(function() {
				document.getElementById('seratus').pause();
				document.getElementById('seratus').currentTime=0;
				document.getElementById('seratus').play();
			}, totalwaktu);
		totalwaktu=totalwaktu+1000;
	}else if($nomorantri > 100){				
		//PLAY SERATUS
		setTimeout(function() {
			document.getElementById('seratus').pause();
			document.getElementById('seratus').currentTime=0;
			document.getElementById('seratus').play();
		}, totalwaktu);
		totalwaktu=totalwaktu+1000;
		var $puluhan = parseInt(explode_no[1]+""+explode_no[2]);
		if($puluhan<10){
			setTimeout(function() {
				document.getElementById('suarabel'+$puluhan).pause();
				document.getElementById('suarabel'+$puluhan).currentTime=0;
				document.getElementById('suarabel'+$puluhan).play();
			}, totalwaktu);
		
			totalwaktu=totalwaktu+1000;
		} else if($puluhan ==10){
		//JIKA 10 MAKA MAIKAN SUARA SEPULUH
			setTimeout(function() {
					document.getElementById('sepuluh').pause();
					document.getElementById('sepuluh').currentTime=0;
					document.getElementById('sepuluh').play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if($puluhan ==11){
			//JIKA 11 MAKA MAIKAN SUARA SEBELAS
			setTimeout(function() {
					document.getElementById('sebelas').pause();
					document.getElementById('sebelas').currentTime=0;
					document.getElementById('sebelas').play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if($puluhan < 20){
			//JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
			setTimeout(function() {
					document.getElementById('suarabel'+explode_no[2]).pause();
					document.getElementById('suarabel'+explode_no[2]).currentTime=0;
					document.getElementById('suarabel'+explode_no[2]).play();
				}, totalwaktu);
			totalwaktu=totalwaktu+500;
			setTimeout(function() {
					document.getElementById('belas').pause();
					document.getElementById('belas').currentTime=0;
					document.getElementById('belas').play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if($puluhan < 100){				
			//JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
			setTimeout(function() {
					document.getElementById('suarabel'+explode_no[1]).pause();
					document.getElementById('suarabel'+explode_no[1]).currentTime=0;
					document.getElementById('suarabel'+explode_no[1]).play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			setTimeout(function() {
					document.getElementById('puluh').pause();
					document.getElementById('puluh').currentTime=0;
					document.getElementById('puluh').play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			setTimeout(function() {
					document.getElementById('suarabel'+explode_no[2]).pause();
					document.getElementById('suarabel'+explode_no[2]).currentTime=0;
					document.getElementById('suarabel'+explode_no[2]).play();
				}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
		}
	}else{
		//JIKA LEBIH DARI 100 
		//Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
		//Selebihnya akan langsung disebutkan angkanya saja 
		//tanpa kata "RATUS", "PULUH", maupun "BELAS"

		for($i=0;$i<$panjang;$i++){

			totalwaktu=totalwaktu+1000;
			setTimeout(function() {
				document.getElementById('suarabel'+$nomorantri ).pause();
				document.getElementById('suarabel'+$nomorantri).currentTime=0;
				document.getElementById('suarabel'+$nomorantri).play();
			}, totalwaktu);
		}
	}
    totalwaktu=totalwaktu;
    setTimeout(function() {
		document.getElementById('suarabelsuarabelloket').pause();
		document.getElementById('suarabelsuarabelloket').currentTime=0;
		document.getElementById('suarabelsuarabelloket').play();
	}, totalwaktu);
    totalwaktu=totalwaktu+1000;
	setTimeout(function() {
		document.getElementById($suarapoli).pause();
		document.getElementById($suarapoli).currentTime=0;
		document.getElementById($suarapoli).play();
	}, totalwaktu);
	
	insertPanggilan($(this).data("no_reg"));

});

function insertPanggilan(no) {
    $.ajax({
        type: "GET",
        url: __base_url__+"rekam-medis/update-panggil?no_reg="+no,
        contentType: false,
        success: function (data) {
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

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

$('#modal-form-register').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	ajaxLoad(button.data('href'), 'modal-content-form-register');
});

$('#modal-form-baru').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	ajaxLoad(button.data('href'), 'modal-content-form-baru');
});

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
			$('.is-invalid').removeClass('is-invalid');
			if (data.fail) {
				var err="";
				var dtKrt="";
				for (control in data.errors) {
					$('input[name=' + control + ']').addClass('is-invalid');
					$('textarea[name=' + control + ']').addClass('is-invalid');
					$('select[name=' + control + ']').addClass('is-invalid');
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
				$('#modal-form-register').modal('hide');
				ajaxLoad(__base_url__+"rekam-medis/pendaftaran?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
			}
		},
		error: function (xhr, textStatus, errorThrown) {
			alert("Error: " + errorThrown);
		}
	});
	return false;
});

$(document).on('submit', 'form#frmPasien', function (event) {
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
					console.log(data.errors[control]);
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
				ajaxLoad(__base_url__+"rekam-medis/pendaftaran?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
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

function getPasienLama(){
	$('#nama-pasien').select2({
        placeholder: "Pilih Pasien",
        ajax: {
            url: __base_url__ + "rekam-medis/pendaftaran/get-pasien",
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

$('#modal-delete').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	$('#delete_id').val(button.data('id'));
});

function getPendaftaran() {
    //$("#preloader").css("display", "block");
    $.ajax({
        type: "GET",
        url: __base_url__+"rekam-medis/pendaftaran/get-data",
        contentType: false,
        success: function (data) {
            $("#content-pendaftaran").html(data);
            //$("#preloader").css("display", "none");
        },
        error: function (xhr, status, error) {
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
			 ajaxLoad(__base_url__+"rekam-medis/pendaftaran?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());

		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}
