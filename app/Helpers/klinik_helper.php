<?php
function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
		$data = [
				'tahun'=>0,
				'bulan'=>0,
				'hari'=>0
			];
		return $data;	
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	$data = [
		'tahun'=>$y,
		'bulan'=>$m,
		'hari'=>$d
	];
	return $data;
}

function hapus_spasi($text){
	$words = trim($text);
	return $words;
}
?>
