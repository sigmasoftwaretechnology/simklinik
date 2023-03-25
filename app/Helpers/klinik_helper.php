<?php
use App\Libraries\Mongo;
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

function new_number($kode)
{
	$mongo = new Mongo();
	$nomor =  $mongo->getOne("no_transaksi", ["kode" => $kode]);
	if ($nomor->tahun_sekarang == date('Y')) {
		if ($nomor->bulan_sekarang == date('m')) {
			$serial = $nomor->serial_berikutnya;
			$update = array('serial_berikutnya' => $serial + 1);
		}
		else {
			$update = array (
				'bulan_sekarang' => date('m'),
			);
			
			if ($nomor->reset_serial == 'bulanan') {
				$serial = 1;
				$update['serial_berikutnya'] = 2;
			}
			else {
				$serial = $nomor->serial_berikutnya;
				$update['serial_berikutnya'] = $serial + 1;
			}
		}
	}
	else {
		$serial = 1;
		$update = array (
			'tahun_sekarang' => date('Y'),
			'bulan_sekarang' => date('m'),
			'serial_berikutnya' => 2,
		);
	}
	
	$where = array('kode' => $kode);
	$mongo->update('no_transaksi', $update, $where);
	
	$serial_str = str_pad($serial, $nomor->digit_serial, '0', STR_PAD_LEFT);
	
	$wildcard = array('#Y4#', '#Y2#', '#M#', '#SERIAL#');
	$replace = array(date('Y'), date('y'), date('m'), $serial_str);
	
	return str_replace($wildcard, $replace, $nomor->format);
}

function nomor_antrian($poli)
{
	$mongo = new Mongo();
	$nomor = $mongo->getOne("no_antrian", ["nama_poli" => $poli]);
	if ($nomor->tgl_sekarang == date('d')) {
		$serial = $nomor->no_berikutnya;
		$update = array('no_berikutnya' => $serial + 1);
	}
	else{
		$serial = 1;
		$update = array (
			'tgl_sekarang' => date('d'),
			'no_berikutnya' => 2,
		);
	}
	$where = array('nama_poli' => $poli);
	$mongo->update('no_antrian', $update, $where);	
	return $nomor->kode."-".$serial;
}
?>
