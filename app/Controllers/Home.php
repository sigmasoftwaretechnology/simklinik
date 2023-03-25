<?php

namespace App\Controllers;
use App\Libraries\Mongo;
use App\Libraries\PCare;

class Home extends BaseController
{
	public $mongo;
	public $pcare;

    public function __construct(){
		$this->mongo = new Mongo();
		$this->pcare = new PCare();
    }

	public function index()
	{
		helper('klinik_helper');
		$nomor = nomor_antrian("6410269e205b0000b7003c05");
		echo $nomor;
		exit();
        $noka = $this->request->getVar('noka');
        $addHead = array( 
            'Content-Type: application/json; charset=utf-8',
            'Accept: Application/JSON'
        );
        $data =  $this->pcare->getDataDummy("peserta.json"); 
		return view('dashboard/dashboard');
	}

	public function rekamMedis()
	{
		return view('rekam-medis/menu');
	}

	public function farmasi()
	{
		return view('farmasi/menu');
	}

	public function keuangan()
	{
		return view('keuangan/menu');
	}

	public function setting()
	{
		$data = $this->mongo->getOne("profil");
		return view('setting/menu',compact('data'));
	}
	
	public function hrd()
	{
		$data = $this->mongo->getOne("profil");
		return view('hrd/menu',compact('data'));
	}

	public function rekapKunjungan()
	{
		$awal = $this->request->getVar('awal');
		$akhir = $this->request->getVar('akhir');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		if(isset($awal)){
			$where = $where." AND DATE_FORMAT(tanggal, '%Y-%m-%d') >= STR_TO_DATE('$awal', '%d-%m-%Y')";
		}
		if(isset($akhir)){
			$where = $where." AND DATE_FORMAT(tanggal, '%Y-%m-%d') <= STR_TO_DATE('$akhir', '%d-%m-%Y')";
		}
		$query 	= $db->query("SELECT a.*  FROM pendaftaran a  where $where AND a.deleted_at IS NULL order by a.tanggal desc");
		$jmlPasien 	= $query->getNumRows();
		$queryL 	= $db->query("SELECT a.*  FROM pendaftaran a  where $where AND a.status='L' AND a.deleted_at IS NULL order by a.tanggal desc");
		$jmlPasienL 	= $queryL->getNumRows();
		$queryB 	= $db->query("SELECT a.*  FROM pendaftaran a  where $where AND a.status='B' AND a.deleted_at IS NULL order by a.tanggal desc");
		$jmlPasienB 	= $queryB->getNumRows();
		$dataResponse = [
			'jmlPasien' => $jmlPasien ,
			'jmlPasienL' => $jmlPasienL ,
			'jmlPasienB' => $jmlPasienB ,
		];
		return $this->response->setJSON($dataResponse);
	}

	public function grafikKunjungan()
    {
		$awal = $this->request->getVar('awal');
		$akhir = $this->request->getVar('akhir');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		if(isset($awal)){
			$where = $where." AND a.tanggal >= '".date("Y-m-d H:i:s",strtotime($awal))."'";
		}
		if(isset($akhir)){
			$where = $where." AND a.tanggal <= '".date("Y-m-d H:i:s",strtotime($akhir))."'";
		}
		$tahun = date("Y");
		$q = "SELECT DATE_FORMAT(tanggal, '%m-%Y')tanggal,count(a.id) as jumlah 
		FROM pendaftaran a 
		where 1=1 AND DATE_FORMAT(tanggal, '%Y')=$tahun  AND a.deleted_at IS NULL group by DATE_FORMAT(tanggal, '%m')  ORDER BY `tanggal` ASC";
		$query 	= $db->query($q);
		$row 	= $query->getResult();
		if(count($row) > 0){
			foreach ($row as $data) {
				$tanggal[] = $data->tanggal;
				$jumlah[] = intval($data->jumlah);
			}
			return $this->response->setJSON(array($tanggal,$jumlah,$tahun));
		}
		else{
			$tanggal[]=0;
			$jumlah[]=0;	
			return $this->response->setJSON(array($tanggal,$jumlah,$tahun));
		}
	}
}
