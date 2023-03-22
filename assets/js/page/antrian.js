var __base_url__ = $("#base_url").val();
$(function () {
	function slides() {
		$.ajax({
			type: "GET",
			url: __base_url__ + 'antrian/data',
			contentType: false,
			success: function (data) {
				$("#nomor").html(data);
			},
			error: function (xhr, status, error) {
				alert(xhr.responseText);
			}
		});
		onYouTubeIframeAPIReady();
		function onYouTubeIframeAPIReady() {
			var player;
			player = new YT.Player('muteYouTubeVideoPlayer', {
				videoId: 'BNTs6-pNFRk', // YouTube Video ID
				width: 560,               // Player width (in px)
				height: 316,              // Player height (in px)
				playerVars: {
					autoplay: 1,        // Auto-play the video on load
					controls: 1,        // Show pause/play buttons in player
					showinfo: 0,        // Hide the video title
					modestbranding: 1,  // Hide the Youtube Logo
					loop: 1,            // Run the video in a loop
					fs: 0,              // Hide the full screen button
					cc_load_policy: 0, // Hide closed captions
					iv_load_policy: 3,  // Hide the Video Annotations
					autohide: 0         // Hide video controls when playing
				},
				events: {
					onReady: function (e) {
						e.target.setVolume(5);
					}
				}
			});
		}

	};

	setInterval(function () {
		slides();
	}, 4000);

});


window.onload = function () {
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
