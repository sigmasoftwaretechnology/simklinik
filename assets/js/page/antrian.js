var __base_url__ = $("#base_url").val();
$(function () {	
	/* setTimeout(function() {
        loadlink();
	}, 5000);	
	
	function loadlink() {
		$('#nomor').load(__base_url__+'antrian/data', function() {
			$(this).unwrap();
		});
	} */
function slides(x) {
	$('#nomor').load(__base_url__+'antrian/data', function() {
			$(this).unwrap();
		});
      console.log("sd");
};
setInterval(function() {
    slides(-30);
}, 4000);

});


window.onload = function() {
	jam();
}

function jam() {
	var e = document.getElementById('jam'),
		d = new Date(),
		h, m, s;
	h = d.getHours();
	m = set(d.getMinutes());
	s = set(d.getSeconds());
	e.innerHTML = h + ':' + m + ':' + s;
	setTimeout('jam()', 1000);
}

function set(e) {
	e = e < 10 ? '0' + e : e;
	return e;
}
var tanggallengkap = new String();
var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
namahari = namahari.split(" ");
var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
namabulan = namabulan.split(" ");
var tgl = new Date();
var hari = tgl.getDay();
var tanggal = tgl.getDate();
var bulan = tgl.getMonth();
var tahun = tgl.getFullYear();
tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;
document.getElementById("hasil").innerHTML = tanggallengkap;
