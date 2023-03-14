<?php 
namespace App\Controllers;
use  App\Models\TindakanModel;

class Master extends BaseController
{
	public function tindakan()
	{
		$isi = $this->request->getVar('isi');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		$where = $where." AND a.nama like '%$isi%'";
		$query 	= $db->query("SELECT a.* FROM tindakan a where $where  AND a.deleted_at IS NULL");
		$row 	= $query->getResult();
        if ($this->request->isAJAX()) {
			return view('tindakan/tabel', compact('row'));
        } else {
			return view('tindakan/list', compact('row'));
        }
	}

	public function tambahTindakan() {
		if ($this->request->getMethod() == "get") {
            return view('tindakan/form');
        } else {
			$data = $this->request->getVar();
			$pasien = new TindakanModel();
			$dtPas = [
				"nama" => $data['nama'],
				"tarif" => $data['tarif'],
			];
			$pasien->insert($dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahTindakan() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$tindakan = new TindakanModel();
			$data = $tindakan->find($id);
            return view('tindakan/form',compact('data'));
        } else {
			$data = $this->request->getVar();
			$tindakan = new TindakanModel();
			$dtPas = [
				"nama" => $data['nama'],
				"tarif" => $data['tarif'],
			];
			$tindakan->update($data["id"], $dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function hapusTindakan()
    {
		$id = $this->request->getVar('id');
		$tindakan = new TindakanModel();
		$data = [
			'deleted_at' => date("Y-m-d H:i:s")
		];
		$tindakan->update($id, $data);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }


	public function getTindakan() {
		$q = $this->request->getVar('nama');
		$where = "";
        if (isset($q)) {
            $q = strtoupper($q);
            $select = "*";
            $where = "where nama like '%$q%'";
        }
        else{
            $select = "*";
        }
		$db     = \Config\Database::connect();
		$query 	= $db->query("select $select from tindakan $where");
		$row 	= $query->getResult();
        $list = array();
        $key=0;   
        foreach($row as $dtTindakan){
            $list[$key]['id'] = $dtTindakan->tarif;
            $list[$key]['text'] = $dtTindakan->nama; 
            $key++;
        }
        echo json_encode($list);
	}
	
	public function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

}

