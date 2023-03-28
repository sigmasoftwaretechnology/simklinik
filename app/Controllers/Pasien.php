<?php namespace App\Controllers;
use  App\Models\PasienModel;
use  App\Models\PendaftaranModel;
use App\Libraries\Mongo;

class Pasien extends BaseController
{
	public $mongo;

    public function __construct(){
		helper('klinik_helper');
		$this->mongo = new Mongo();
    }

	public function tambah() {
		$session = session();
		$db     = \Config\Database::connect();
		if ($this->request->getMethod() == "get") {
			$poli = $this->mongo->get("poli", ['tanggal_dihapus' => ""]);
            return view('pasien/pasienBaruForm',compact('poli'));
        } else {
			$validation =  \Config\Services::validation();
			$rules = [
				"nama" => [
					"label" => "Nama", 
					"rules" => "required",
					'errors' => [
						'required' => 'Nama wajib di isi',
					],
				],
				"tgl_lahir" => [
					"label" => "Tanggal Lahir", 
					"rules" => "required",
					'errors' => [
						'required' => 'Tanggal lahir wajib di isi',
					],
				],
				"telp" => [
					"label" => "Telp", 
					"rules" => "required",
					'errors' => [
						'required' => 'Telp wajib di isi',
					],
				],
				"alamat" => [
					"label" => "Alamat", 
					"rules" => "required",
					'errors' => [
						'required' => 'Alamat wajib di isi',
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

			} else {
				$data = $this->request->getVar();
				$pasien = new PasienModel();
				$no_rm = new_number("pasien");
				$dtPas = [
					"no_rm" => $no_rm,
					"no_bpjs" => $data['no_bpjs'],
					"no_ktp" => $data['no_ktp'],
					"tgl_lahir" => date("Y-m-d",strtotime(str_replace("/", "-", $data['tgl_lahir']))),
					"nama" => ucwords(strtolower($data['nama'])),
					"alamat" => $data['alamat'],
					"telp" => $data['telp'],
					"jk" => $data['jk'],
					"agama" => $data['agama'],
					"pekerjaan" => $data['pekerjaan'],
					"pendidikan" => $data['pendidikan'],
					"status_perkawinan" => $data['status_perkawinan']
				];
				$pasien->insert($dtPas);
				$idPasien =  $pasien->insertID();
				
				$registrasi = new PendaftaranModel();
				$poli = null;	
				if(isset($data['poli'])){
					$poli = $data['poli'];
				}

				//--get antrian
				$antrian 		= nomor_antrian($poli,date("Y-m-d",strtotime($data['tanggal'])));
				$dtReg = [
					"no_reg" => 'RE-'.time(),
					"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
					"jam" => date("h:i:s"),
					"no_rm" => $idPasien,
					"poli" => $poli,
					"dpjp" => $data['dpjp'],
					"tipe" => $data['tipe_daftar'],
					"antrian" => $antrian,
					"user_input" => $session->get('nama_user'),
					"status" => "B"
				];

				$registrasi->insert($dtReg);

				$dtRegMongo = [
					"no_reg" => 'RE-'.time(),
					"tanggal" => date("Y-m-d",strtotime($data['tanggal'])),
					"jam" => date("h:i:s"),
					"no_rm" => $no_rm,
					"nama" => ucwords(strtolower($data['nama'])),
					"alamat" => $data['alamat'],
					"poli" => $poli,
					"dpjp" => $data['dpjp'],
					"tipe" => $data['tipe_daftar'],
					"antrian" => $antrian,
					"user_input" => $session->get('nama_user'),
					"status" => "B",
					"dilayani" => "",
					"tanggal_dibuat" => date("Y-m-d")
				];
				$result = $this->mongo->insert("pendaftaran",$dtRegMongo);

				$dataResponse = [
					"fail" => false,
					'errors' => "",
				];
				return $this->response->setJSON($dataResponse);			
			}
        }   
	}
	
	public function hapus()
    {
		$id = $this->request->getVar('id');
		$pasien = new PasienModel();
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

	public function ubah() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$pasien = new PasienModel();
			$data = $pasien->find($id);
            return view('pasien/pasienBaruForm',compact('data'));
        } else {
			$validation =  \Config\Services::validation();
			$rules = [
				"nama" => [
					"label" => "Nama", 
					"rules" => "required",
					'errors' => [
						'required' => 'Nama wajib di isi',
					],
				],
				"tgl_lahir" => [
					"label" => "Tanggal Lahir", 
					"rules" => "required",
					'errors' => [
						'required' => 'Tanggal lahir wajib di isi',
					],
				],
				"telp" => [
					"label" => "Telp", 
					"rules" => "required",
					'errors' => [
						'required' => 'Telp wajib di isi',
					],
				],
				"alamat" => [
					"label" => "Alamat", 
					"rules" => "required",
					'errors' => [
						'required' => 'Alamat wajib di isi',
					],
				]
			];
			if (!$this->validate($rules)) {
				$dataResponse = [
					"fail" => true,
					'errors' => $validation->getErrors(),
				];
				return $this->response->setJSON($dataResponse);

			} else {
				$data = $this->request->getVar();
				$pasien = new PasienModel();
				$dtPas = [
					"no_rm" => $data['no_rm'],
					"no_bpjs" => $data['no_bpjs'],
					"no_ktp" => $data['no_ktp'],
					"tgl_lahir" => date("Y-m-d",strtotime(str_replace("/", "-", $data['tgl_lahir']))),
					"nama" => $data['nama'],
					"alamat" => $data['alamat'],
					"telp" => $data['telp'],
					"jk" => $data['jk']
				];
				$pasien->update($data["id"], $dtPas);
				$pasien->insert($dtPas);
				$dataResponse = [
					"fail" => false,
					'errors' => "",
				];
				return $this->response->setJSON($dataResponse);			
			}
        }   
	}

	public function cetakKartu()
    {
		$id = $this->request->getVar('id');
		$pasien = new PasienModel();
		$data = $pasien->find($id);
		return view('pasien/kartu',compact('data'));	
    }

	public function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

}
