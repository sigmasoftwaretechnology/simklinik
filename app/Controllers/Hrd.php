<?php

namespace App\Controllers;
use  App\Models\KaryawanModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;

class Hrd extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }

	public function karyawan()
	{
		$dataKaryawan = $this->mongo->get("karyawan", ['tanggal_dihapus' => ""]);
		$data = [
			"karyawan" => $dataKaryawan
		];
        if ($this->request->isAJAX()) {
            return view('hrd-karyawan/tabel',$data);
        } else {
			return view('hrd-karyawan/list', $data);
        }
	}

	public function tambahKaryawan() {
		if ($this->request->getMethod() == "get") {
			$dataUnit = $this->mongo->get("unit_kerja", ['tanggal_dihapus' => ""]);
            return view('hrd-karyawan/form',compact('dataUnit'));
        } else {
			$data = $this->request->getVar();
			$parent = "";
			if(isset($data["parent"])){
				$parent = $data["parent"];
			}
			$dataUnit = [
				"nik" => $data['nik'],
				"gelar_depan" => $data['gelar_depan'],
				"nama" => $data['nama'],
				"gelar_belakang" => $data['gelar_belakang'],
				"unit" => $data['unit'],
				"atasan" => $data['atasan'],
				"str" => $data['str'],
				"tahun_akhir_str" => $data['tahun_akhir_str'],
				"tanggal_dibuat" =>  date("Y-m-d"),
				"tanggal_dihapus" => "",
			];
			$result = $this->mongo->insert("karyawan",$dataUnit);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahKaryawan() {
		if ($this->request->getMethod() == "get") {
			$dataUnit = $this->mongo->get("unit_kerja", ['tanggal_dihapus' => ""]);
			$id = $this->request->getVar('id');
			$data = $this->mongo->getOneById("karyawan",$id);
            return view('hrd-karyawan/form',compact('data','dataUnit'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$parent = "";
			if(isset($data["parent"])){
				$parent = $data["parent"];
			}
			$dataUnit = [
				"nik" => $data['nik'],
				"gelar_depan" => $data['gelar_depan'],
				"nama" => $data['nama'],
				"gelar_belakang" => $data['gelar_belakang'],
				"unit" => $data['unit'],
				"atasan" => $data['atasan'],
				"str" => $data['str'],
				"tahun_akhir_str" => $data['tahun_akhir_str'],
				"tanggal_dibuat" =>  date("Y-m-d"),
			];
			$result = $this->mongo->updateById("karyawan",$dataUnit,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);        
		}   
	}

	public function hapusKaryawan()
    {
		$id = $this->request->getVar('id');
		$dtInf = [
			"tanggal_dihapus" => date("Y-m-d H:i:s"),
		];
		$result = $this->mongo->updateById("karyawan",$dtInf,$id);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

}