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

function nomor_antrian($poli,$tanggal)
{
	$db     = \Config\Database::connect();
	$mongo = new Mongo();
	$query = $db->query("select * from pendaftaran a  where a.tanggal = '".$tanggal."' and a.poli='".$poli."'");
	$jml = $query->getNumRows();
	$antrian = $jml+1;
	$poli = $mongo->getOne("poli", ["nama" => $poli]);
	return $poli->kode."-".$antrian;
}
?>
