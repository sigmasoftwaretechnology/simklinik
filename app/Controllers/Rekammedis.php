<?php

namespace App\Controllers;
use  App\Models\PendaftaranModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;

class Rekammedis extends BaseController
{
	public $mongo;

    public function __construct(){
		helper('klinik_helper');
		$this->mongo = new Mongo();
    }

    public function pendaftaran()
    {
		$awal = $this->request->getVar('awal');
		$akhir = $this->request->getVar('akhir');
		$nama = $this->request->getVar('nama');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		if(isset($awal)){
			$where = $where." AND DATE_FORMAT(tanggal, '%d-%m-%Y') >= '$awal'";
		}
		if(isset($akhir)){
			$where = $where." AND DATE_FORMAT(tanggal, '%d-%m-%Y') <= '$akhir'";
		}
		if(isset($nama)){
			$nama = strtoupper($nama);
			$where = $where." AND UPPER(b.nama)  LIKE '%$nama%' ";
		}
		$query 	= $db->query("SELECT a.id,a.no_reg,a.poli,a.dpjp,a.antrian,a.status,b.id as no_rm,b.no_rm as no_rm2,b.nama,b.alamat,a.tanggal,b.tgl_lahir,a.perawat,a.dokter 
		FROM pendaftaran a left join pasien b on a.no_rm = b.id 
		where $where AND a.deleted_at IS NULL order by a.tanggal desc");
		$row 	= $query->getResult();
		$profil = $this->mongo->getOne("profil");
        if ($this->request->isAJAX()) {
            return view('pendaftaran/tabel', compact('row','profil'));
        } else {
			return view('pendaftaran/list', compact('row','profil'));
        }
    }
	
	public function tambahPendaftaran() {
		$session = session();
		$db     = \Config\Database::connect();
		if ($this->request->getMethod() == "get") {
			$poli = $this->mongo->get("poli", ['tanggal_dihapus' => ""]);
            return view('pendaftaran/registerForm',compact('poli'));
        } else {
			$validation =  \Config\Services::validation();
			$rules = [
				"no_rm" => [
					"label" => "Nama", 
					"rules" => "required",
					'errors' => [
						'required' => 'Nama wajib di isi',
					],
				],
				"poli" => [
					"label" => "Poli", 
					"rules" => "required",
					'errors' => [
						'required' => 'Poli wajib di isi',
					],
				]
			];
			if (!$this->validate($rules)) {
				$dataResponse = [
					"fail" => true,
					'errors' => $validation->getErrors(),
				];
				return $this->response->setJSON($dataResponse);

			}
			$data = $this->request->getVar();
			$registrasi = new PendaftaranModel();
			$poli = null;	
			if(isset($data['poli'])){
				$poli = $data['poli'];
			}

			//--get antrian
			$antrian = nomor_antrian($poli);
			$dtReg = [
				"no_reg" => $data['no_reg'],
				"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
				"jam" => date("h:i:s"),
				"no_rm" => $data['no_rm'],
				"poli" => $poli,
				"dpjp" => $data['dpjp'],
				"tipe" => $data['tipe_daftar'],
				"antrian" => $antrian,
				"user_input" => $session->get('nama_user'),
				"status" => "L"
			];
			$registrasi->insert($dtReg);
			
			//--get pasien MySQL
			$queryPasien 	= $db->query("select * from pasien a  where a.id='".$data['no_rm']."'");
			$rowPasien 	= $queryPasien->getRow();
			$dtRegMongo = [
				"no_reg" => $data['no_reg'],
				"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
				"jam" => date("h:i:s"),
				"no_rm" => $rowPasien->no_rm,
				"nama" => $rowPasien->nama,
				"alamat" => $rowPasien->alamat,
				"poli" => $poli,
				"dpjp" => $data['dpjp'],
				"tipe" => $data['tipe_daftar'],
				"antrian" => $antrian,
				"user_input" => $session->get('nama_user'),
				"status" => "L",
				"dilayani" => "",
				"tanggal_dibuat" => date("Y-m-d")
			];
			$result = $this->mongo->insert("pendaftaran",$dtRegMongo);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahPendaftaran() {
		$session = session();
		$db     = \Config\Database::connect();
		if ($this->request->getMethod() == "get") {
			$data = $this->request->getVar();
			$id=$data['id'];
			$query 	= $db->query("SELECT a.id,a.no_reg,a.poli,a.dpjp,a.antrian,a.status,b.id as no_rm,b.nama,b.alamat,a.tanggal,b.tgl_lahir,a.perawat,a.dokter,a.tipe 
			FROM pendaftaran a left join pasien b on a.no_rm = b.id 
			where a.id = $id AND a.deleted_at IS NULL order by a.tanggal desc");
			$data 	= $query->getRow();	
			$poli = $this->mongo->get("poli", ['tanggal_dihapus' => ""]);
            return view('pendaftaran/ubahRegisterForm',compact('poli','data'));
        } else {
			$validation =  \Config\Services::validation();
			$rules = [
				"no_rm" => [
					"label" => "Nama", 
					"rules" => "required",
					'errors' => [
						'required' => 'Nama wajib di isi',
					],
				],
				"poli" => [
					"label" => "Poli", 
					"rules" => "required",
					'errors' => [
						'required' => 'Poli wajib di isi',
					],
				]
			];
			if (!$this->validate($rules)) {
				$dataResponse = [
					"fail" => true,
					'errors' => $validation->getErrors(),
				];
				return $this->response->setJSON($dataResponse);

			}
			$data = $this->request->getVar();
			$registrasi = new PendaftaranModel();
			$poli = null;	
			if(isset($data['poli'])){
				$poli = $data['poli'];
			}

			//--get antrian
			$queryAntrian 	= $db->query("select count(a.id) as jumlah from pendaftaran a  where a.tanggal = '".date("Y-m-d",strtotime($data['tanggal']))."' and a.poli='".$poli."' AND a.deleted_at IS NULL");
			$rowAntrian 	= $queryAntrian->getRow();
			$antrian 		= $rowAntrian->jumlah+1;
			$id = $data['id'];
			$dtReg = [
				"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
				"jam" => date("h:i:s"),
				"no_rm" => $data['no_rm'],
				"poli" => $poli,
				"dpjp" => $data['dpjp'],
				"tipe" => $data['tipe_daftar'],
				"antrian" => $antrian,
				"user_input" => $session->get('nama_user')
			];
			$registrasi->update($id, $dtReg);

			//--get pasien MySQL
			$queryPasien 	= $db->query("select * from pasien a  where a.id='".$data['no_rm']."'");
			$rowPasien 	= $queryPasien->getRow();
			$no_reg = $data['no_reg'];
			$dtRegMongo = [
				"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
				"jam" => date("h:i:s"),
				"no_rm" => $rowPasien->no_rm,
				"nama" => $rowPasien->nama,
				"alamat" => $rowPasien->alamat,
				"poli" => $poli,
				"dpjp" => $data['dpjp'],
				"tipe" => $data['tipe_daftar'],
				"antrian" => $antrian,
				"user_input" => $session->get('nama_user'),
				"status" => "L",
				"dilayani" => "",
				"tanggal_dibuat" => date("Y-m-d")
			];
			$result = $this->mongo->update("pendaftaran",$dtRegMongo,["no_reg" => $no_reg]);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function hapusPendaftaran()
    {
		$id = $this->request->getVar('id');
		$pasien = new PendaftaranModel();
		$data = [
			'deleted_at' => date("Y-m-d H:i:s")
		];
		$pasien->update($id, $data);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

    public function pasien()
    {
		$by = $this->request->getVar('by');
		$isi = $this->request->getVar('isi');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		if($by == "nama"){
			$where = $where." AND a.nama like '%$isi%'";
		}
		if($by == "alamat"){
			$where = $where." AND a.alamat like '%$isi%'";
		}
		$query 	= $db->query("SELECT a.* FROM pasien a where $where AND a.deleted_at IS NULL");
		$row 	= $query->getResult();
        if ($this->request->isAJAX()) {
			return view('pasien/tabel-pasien', compact('row'));
        } else {
			return view('pasien/list', compact('row'));
        }
    }
	
	public function dataPasien() {
		$q = $this->request->getVar('nama');
        if (isset($q)) {
            $q = strtoupper($q);
            $select = "*";
            $where = "where (nama like '%$q%' OR no_rm like '%$q%') AND deleted_at IS NULL";
        }
        else{
            $select = "*";
			$where = "where deleted_at IS NULL";
        }
		$db     = \Config\Database::connect();
		$query 	= $db->query("select $select from pasien $where");
		$row 	= $query->getResult();
        $list = array();
        $key=0;   
        foreach($row as $dtPasien){
            $list[$key]['id'] = $dtPasien->id;
            $list[$key]['text'] = $dtPasien->no_rm." | ".$dtPasien->nama." | ".$dtPasien->alamat; 
            $key++;
        }
        echo json_encode($list);
	}

	public function pemeriksaan()
	{
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.id = '$id_reg'");
		$row 	= $query->getRow();
		return view('pemeriksaan/form-pemeriksaan',compact('row'));
	}

	public function dataKunjungan()
    {
		$db     = \Config\Database::connect();
		$no_rm = $this->request->getVar('no_rm');
		$query 	= $db->query("select a.id,DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,a.no_reg,b.no_rm from pendaftaran a join pasien b on b.id = a.no_rm  where b.no_rm = '$no_rm' order by a.tanggal desc");
		$row 	= $query->getResult();
		$data = [
            'status' => 'success',
            'data' => $row
        ];
		return $this->response->setJSON($data);			
	}
	
	public function viewPdf()
    {
		$filename = date('y-m-d-H-i-s'). '-qadr-labs-report';
        $dompdf = new Dompdf();
		$no_reg = $this->request->getVar('no_reg');
		$data = $this->mongo->get("assessment", ["no_reg" => $no_reg]);
		//var_dump($data[0]->object->ku);exit();
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.no_reg = '$no_reg'");
		$row 	= $query->getRow();
		//return view('pemeriksaan/rekam-medis',compact('data','row'));
        $dompdf->loadHtml(view('pemeriksaan/rekam-medis',compact('data','row')));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename);    
    }

	public function cetakAntrian()
    {
		$filename = date('y-m-d-H-i-s'). '-antrian';
        $dompdf = new Dompdf();

		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,a.poli,a.dpjp,a.tanggal,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir,a.antrian from pendaftaran a join pasien b on b.id = a.no_rm  where a.id = '$id_reg'");
		$row 	= $query->getRow();
		$profil = $this->mongo->getOne("profil");

		//return view('pendaftaran/no-antrian',compact('row','profil'));
        $dompdf->loadHtml(view('pendaftaran/no-antrian',compact('row','profil')));
        $customPaper = array(0,0,200,200);
        $dompdf->set_paper($customPaper);
        $dompdf->render();
        $dompdf->stream("tiket-antrian", array('Attachment'=>0)); //nama file pdf
    }
	
	public function updatePanggil()
    {
		$no_reg = $this->request->getVar('no_reg');
		$db     = \Config\Database::connect();
		$query 	= $db->query("select * from pendaftaran a where a.no_reg = '$no_reg'");
		$row 	= $query->getRow();
		$pemeriksaan["poli"] 		=  $row->poli;
		$pemeriksaan["no_antrian"] 	=  $row->antrian;
		$pemeriksaan["dpjp"] 	=  $row->dpjp;
		$pemeriksaan["aktif"] 	=  "yes";
		$cekData = $this->mongo->get("antrian", ["poli" => $row->poli]);
		if(count($cekData) == 0){
			$result = $this->mongo->insert("antrian",$pemeriksaan);
		}
		else{
			$result = $this->mongo->update("antrian",$pemeriksaan,["poli" => $pemeriksaan["poli"]]);
		}
		$data = [
            'status' => 'success',
            'data' => $result
        ];
		return $this->response->setJSON($data);			
	}

	public function pasienRegistrasi()
    {
		$session = session();
		$poli = $session->get('poli');
		$awal = $this->request->getVar('awal');
		$akhir = $this->request->getVar('akhir');
		$nama = $this->request->getVar('nama');
		$db     = \Config\Database::connect();
		$where = " 1=1 ";
		if(isset($awal)){
			$where = $where." AND DATE_FORMAT(tanggal, '%d-%m-%Y') >= '$awal'";
		}
		if(isset($akhir)){
			$where = $where." AND DATE_FORMAT(tanggal, '%d-%m-%Y') <= '$akhir'";
		}
		if($poli !== ""){
			$where = $where." AND a.poli = '$poli'";
		}
		if(isset($nama)){
			$nama = strtoupper($nama);
			$where = $where." AND UPPER(b.nama)  LIKE '%$nama%' ";
		}
		$query 	= $db->query("SELECT a.id,a.no_reg,a.poli,a.dpjp,a.antrian,a.status,b.id as no_rm,b.nama,b.alamat,a.tanggal,b.tgl_lahir,a.perawat,a.dokter 
		FROM pendaftaran a left join pasien b on a.no_rm = b.id 
		where $where AND a.deleted_at IS NULL order by a.tanggal desc");
		$row 	= $query->getResult();
		$profil = $this->mongo->getOne("profil");
        if ($this->request->isAJAX()) {
            return view('pemeriksaan/tabel', compact('row','profil'));
        } else {
			return view('pemeriksaan/list', compact('row','profil'));
        }
    }

	public function modalErm()
    {
		$no_reg = $this->request->getVar('no_reg');
		$data = $this->mongo->get("assessment", ["no_reg" => $no_reg]);		
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.no_reg = '$no_reg'");
		$row 	= $query->getRow();
		return view('pemeriksaan/rekam-medis',compact('data','row'));
    }
	
	public function getRM()
    {
		$db     = \Config\Database::connect();
		$query 	= $db->query("SELECT count(a.id) as jumlah FROM pasien a");
		$row 	= $query->getRow();
		$rm = date("m")."-".substr( date("Y"), -2)."-".($row->jumlah+1);
       	$data = [
            'status' => 'success',
            'data' => $rm
        ];
		return $this->response->setJSON($data);			
    }

}
