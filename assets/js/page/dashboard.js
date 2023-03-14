var __base_url__ = $("#base_url").val();
$(function () {
	$("#filter").click(function(){
        getRekapKunjungan(__base_url__+"dashboard/get-rekap-kunjungan?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
		getGrafik(__base_url__+"dashboard/get-grafik-kunjungan?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
	}); 
	$('.filterTanggal').daterangepicker({
		singleDatePicker:true,
		autoclose: true,
		locale: {
		  format: 'DD-MM-YYYY'
		}

	});
	getRekapKunjungan(__base_url__+"dashboard/get-rekap-kunjungan?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
	getGrafik(__base_url__+"dashboard/get-grafik-kunjungan?awal="+$("#filterTanggal1").val()+"&akhir="+$("#filterTanggal2").val());
}); 

function getRekapKunjungan(url){
	$.ajax({
		type: 'GET',
		url: url,
		success: function (data) {
			$("#pasien-masuk").html(data.jmlPasien);
			$("#pasien-lama").html(data.jmlPasienL);
			$("#pasien-baru").html(data.jmlPasienB);
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}

function getGrafik(url){
	$.ajax({
		type: 'GET',
		url: url,
		success: function (data) {
			console.log(data);
			visitorData(data);
		},
		error: function (xhr, status, error) {
			alert(xhr.responseText);
		}
	});
}

function visitorData (data) {
	Highcharts.chart('myChart', {
		title: {
			text: 'Jumlah Kunjungan '+data[2]
		},
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		xAxis: {
			categories: data[0]
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 0
			}
		},
		series: [{
			name: 'Jumlah pasien',
			data: data[1]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
}

