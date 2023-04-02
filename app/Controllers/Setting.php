<?php

namespace App\Controllers;
use  App\Models\KaryawanModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;
use CodeIgniter\Files\File;

class Setting extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }

    public function dataErm()
    {
		$tanggal = $this->request->getVar('tanggal');
		if(is_null($tanggal)){
			$tanggal = date("d-m-Y");
		}
		$dataRegis = $this->mongo->get("assessment", ["tanggal" => $tanggal,'lunas' => "lunas"]);
		$data = [
			"reg" => $dataRegis
		];
        if ($this->request->isAJAX()) {
            return view('setting-erm/tabel',$data);
        } else {
			return view('setting-erm/list', $data);
        }
    }
	
	public function bukaErm()
    {
		$no_reg = $this->request->getVar('id');
		$pemeriksaan["lunas"] = "";		
		$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $no_reg]);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

	public function informasi()
    {
		if ($this->request->getMethod() == "get") {
			$data = $this->mongo->getOne("profil");
			return view('setting-informasi/form',compact('data'));
		}
		else{
			$data = $this->request->getVar();
			$id = $data['id'];
			$dtInf = [
				"nama" => $data['nama'],
				"alamat" => $data['alamat'],
				"telp" => $data['telp']
			];
			$result = $this->mongo->updateById("profil",$dtInf,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
		}
    }

	public function poli()
	{
		$dataPoli = $this->mongo->get("poli", ['tanggal_dihapus' => ""]);
		$data = [
			"poli" => $dataPoli
		];
        if ($this->request->isAJAX()) {
            return view('setting-poli/tabel',$data);
        } else {
			return view('setting-poli/list', $data);
        }
	}

	public function tambahPoli() {
		if ($this->request->getMethod() == "get") {
			$db     = \Config\Database::connect();
			$dokter = $this->mongo->get("karyawan", ['tanggal_dihapus' => ""]);
            return view('setting-poli/form',compact('dokter'));
        } else {
			$data = $this->request->getVar();
			$dtDokter = explode("-",$data['dokter']);
			$dtPoli = [
				"kode" 		=> $data['kode'],
				"nama" 		=> $data['nama'],
				"id_dokter" => $dtDokter[0],
				"dokter" 	=> $dtDokter[1],
				"tanggal_dibuat" =>  date("Y-m-d"),
				"tanggal_dihapus" => "",
			];
			$result = $this->mongo->insert("poli",$dtPoli);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahPoli() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$obat = new DetailObatModel();
			$data = $obat->find($id);
            return view('obat/form',compact('data'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$obat = new DetailObatModel();
			$dtPas = [
				"nama" => $data['nama'],
				"satuan" => $data['satuan'],
				"stok" => $data['stok'],
				"harga" => $data['harga'],
				"harga_pokok" => $data['harga_pokok']
			];
			$obat->update($data["id"], $dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function hapusPoli()
    {
		$id = $this->request->getVar('id');
		$dtInf = [
			"tanggal_dihapus" => date("Y-m-d H:i:s"),
		];
		$result = $this->mongo->updateById("poli",$dtInf,$id);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

	public function unit()
	{
		$dataUnit = $this->mongo->get("unit_kerja", ['tanggal_dihapus' => ""]);
		$data = [
			"unit" => $dataUnit
		];
        if ($this->request->isAJAX()) {
            return view('setting-unit/tabel',$data);
        } else {
			return view('setting-unit/list', $data);
        }
	}

	public function tambahUnit() {
		if ($this->request->getMethod() == "get") {
			$dataParent = $this->mongo->get("unit_kerja", ['tanggal_dihapus' => ""]);
            return view('setting-unit/form',compact('dataParent'));
        } else {
			$data = $this->request->getVar();
			$parent = "";
			if(isset($data["parent"])){
				$parent = $data["parent"];
			}
			$dataUnit = [
				"nama" => $data['nama'],
				"parent" => $parent,
				"tanggal_dibuat" =>  date("Y-m-d"),
				"tanggal_dihapus" => "",
			];
			$result = $this->mongo->insert("unit_kerja",$dataUnit);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahUnit() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$obat = new DetailObatModel();
			$data = $obat->find($id);
            return view('obat/form',compact('data'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$obat = new DetailObatModel();
			$dtPas = [
				"nama" => $data['nama'],
				"satuan" => $data['satuan'],
				"stok" => $data['stok'],
				"harga" => $data['harga'],
				"harga_pokok" => $data['harga_pokok']
			];
			$obat->update($data["id"], $dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function pengguna()
	{
		$dataPengguna = $this->mongo->get("pengguna", ['tanggal_dihapus' => ""]);
		$data = [
			"pengguna" => $dataPengguna
		];
        if ($this->request->isAJAX()) {
            return view('setting-pengguna/tabel',$data);
        } else {
			return view('setting-pengguna/list', $data);
        }
	}

	public function tambahPengguna() {
		if ($this->request->getMethod() == "get") {
			$dataKaryawan = $this->mongo->get("karyawan", ['tanggal_dihapus' => ""]);
			$hakAkses=[];
            return view('setting-pengguna/form',compact('dataKaryawan','hakAkses'));
        } else {
			$data = $this->request->getVar();
			$dataPengguna = [
				"nama_karyawan" => $data['karyawan'],
				"nama_pengguna" => $data['nama_pengguna'],
				"password" => password_hash($data['password'], PASSWORD_BCRYPT),
				"role"=> $data['menu'],
				"tanggal_dibuat" =>  date("Y-m-d"),
				"tanggal_dihapus" => "",
			];
			$result = $this->mongo->insert("pengguna",$dataPengguna);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahPengguna() {
		if ($this->request->getMethod() == "get") {
			$dataKaryawan = $this->mongo->get("karyawan", ['tanggal_dihapus' => ""]);
			$id = $this->request->getVar('id');
			$data = $this->mongo->getOneById("pengguna",$id);
			$hakAkses = json_decode(json_encode(iterator_to_array($data["role"])), TRUE);
			return view('setting-pengguna/form',compact('data','dataKaryawan','hakAkses'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$dataPengguna = [
				"nama_karyawan" => $data['karyawan'],
				"nama_pengguna" => $data['nama_pengguna'],
				"password" => password_hash($data['password'], PASSWORD_BCRYPT),
				"tanggal_dibuat" =>  date("Y-m-d")
			];
			$result = $this->mongo->updateById("pengguna",$dataPengguna,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);        
		}   
	}

	public function hapusPengguna()
    {
		$id = $this->request->getVar('id');
		$dtInf = [
			"tanggal_dihapus" => date("Y-m-d H:i:s"),
		];
		$result = $this->mongo->updateById("pengguna",$dtInf,$id);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

  	public function antrian()
    {
		$dataAntrian = $this->mongo->get("antrian");
		$data = [
			"antrian" => $dataAntrian
		];
        if ($this->request->isAJAX()) {
            return view('setting-antrian/tabel',$data);
        } else {
			return view('setting-antrian/list', $data);
        }
    }
	
	public function nonaktifAntrian()
    {
		$no_reg = $this->request->getVar('id');
		$pemeriksaan["aktif"] = "no";		
		$result = $this->mongo->updateById("antrian",$pemeriksaan,$no_reg);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }
	
	public function aktifAntrian()
    {
		$no_reg = $this->request->getVar('id');
		$pemeriksaan["aktif"] = "yes";		
		$result = $this->mongo->updateById("antrian",$pemeriksaan,$no_reg);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }
	
	public function resetAntrian()
    {
		$no_reg = $this->request->getVar('id');
		$pemeriksaan["no_antrian"] = "0";		
		$result = $this->mongo->updateById("antrian",$pemeriksaan,$no_reg);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

	public function displayAntrian()
    {
		if ($this->request->getMethod() == "get") {
			$data = $this->mongo->getOne("display");
			return view('setting-display/form',compact('data'));
		}
		else{
			$data = $this->request->getVar();
			$file = $this->request->getFile("file_video");
			if($file->getPath() == ""){
				$dataResponse = [
					"fail" => true,
					'errors' => (object) array('file_video' => 'Pilih file dulu'),
				];
				return $this->response->setJSON($dataResponse);    
			}
			$file_type = $file->getMimeType();
			if ($file_type !=='video/mp4')
			{
				$dataResponse = [
					"fail" => true,
					'errors' => (object) array('file_video' => 'File wajib mp4'),
				];
				return $this->response->setJSON($dataResponse);    
			}
			$newName = $file->getRandomName();
			$file->move(ROOTPATH . 'public/display', $newName);
			$id = $data['id'];
			$dtInf = [
				"file" => $newName,
			];
			$result = $this->mongo->updateById("display",$dtInf,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
		}
    }

}