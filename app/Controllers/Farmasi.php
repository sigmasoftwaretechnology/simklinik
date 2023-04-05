<?php namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ObatModel;
use App\Models\DetailObatModel;
use App\Models\SupplierModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use MongoDB;

class Farmasi extends BaseController
{
    use ResponseTrait;
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }
	
	public function obat()
	{
		$nama = $this->request->getVar('nama');
		if ($nama !== "") {
			$and = ['tanggal_dihapus' => ""];
			$options = ['sort' => ['nama' => 1]];
			$dataObat = $this->mongo->getLike("obat","nama",$nama,$options,$and);
        }
        else{
			$dataObat = $this->mongo->get("obat", ['tanggal_dihapus' => ""]);
        }
		$data = [
			"obat" => $dataObat
		];
        if ($this->request->isAJAX()) {
			return view('obat/tabel', $data);
        } else {
			return view('obat/list', $data);
        }
	}

	public function tambahObat() {
		if ($this->request->getMethod() == "get") {
			$dataSupplier = $this->mongo->get("supplier", ['tanggal_dihapus' => ""]);
            return view('obat/form',compact('dataSupplier'));
        } else {
			$data = $this->request->getVar();
			$dataBatch = [];
			if(isset($data["batch"])){
				foreach($data["batch"] as $key => $dtBatch){
					$orig_date = strtotime($data["expired"][$key]);
					$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
					$dataBatch[] = [
						"batch"=> strtolower($dtBatch),
						"expired"=>$data["expired"][$key],
						"expired_date"=>$utcdatetime,
						"stok"=>$data["stok"][$key]
					];
				}
			}
			$dtPas = [
				"kode" => $data['kode'],
				"nama" => strtolower($data['nama']),
				"supplier" => $data['supplier'],
				"satuan" => $data['satuan'],
				"harga" => $data['harga'],
				"harga_pokok" => $data['harga_pokok'],
				"tanggal_dibuat" =>  date("Y-m-d"),
				"tanggal_dihapus" => "",
				"batch" => $dataBatch
			];
			$result = $this->mongo->insert("obat",$dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahObat() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$data = $this->mongo->getOneById("obat",$id);
			$dataSupplier = $this->mongo->get("supplier", ['tanggal_dihapus' => ""]);
            return view('obat/form',compact('data','dataSupplier'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$dataBatch = [];
			if(isset($data["batch"])){
				foreach($data["batch"] as $key => $dtBatch){
					$orig_date = strtotime($data["expired"][$key]);
					$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
					$dataBatch[] = [
						"batch"=> strtolower($dtBatch),
						"expired"=>$data["expired"][$key],
						"expired_date"=>$utcdatetime,
						"stok"=>$data["stok"][$key]
					];
				}
			}
			$dtPas = [
				"kode" => $data['kode'],
				"nama" => strtolower($data['nama']),
				"supplier" => $data['supplier'],
				"satuan" => $data['satuan'],
				"stok" => $data['stok'],
				"harga" => $data['harga'],
				"harga_pokok" => $data['harga_pokok'],
				"tanggal_dibuat" =>  date("Y-m-d"),
				"batch" => $dataBatch
			];
			$result = $this->mongo->updateById("obat",$dtPas,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}
	
	public function detailObat() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$detail = new DetailObatModel();
			$dtObat=  $detail->where('id_obat', $id)->findAll();
			$data=['row' => $dtObat,'id_obat' => $id];
            return view('obat/detail',$data);
        }
		else{
			$data = $this->request->getVar();
			$detailObat = new DetailObatModel();
			if($data["id_detail"] !== ""){
				$dtPas = [
					"batch" => $data['batch'],
					"kadaluarsa" => date("Y-m-d",strtotime($data['kadaluarsa'])),
					"stok" => $data['stok'],
					"satuan" => $data['satuan'],
					"harga" => $data['harga']
				];
				$detailObat->update($data["id_detail"], $dtPas);
			}
			else{
				$obat = new ObatModel();
				$dataObat = $obat->find($data['id_obat']);
				$dtPas = [
					"id_obat" => $data['id_obat'],
					"nama" => $dataObat["nama"],
					"batch" => $data['batch'],
					"kadaluarsa" => date("Y-m-d",strtotime($data['kadaluarsa'])),
					"stok" => $data['stok'],
					"satuan" => $data['satuan'],
					"harga" => $data['harga']
				];
				$detailObat->save($dtPas);
			}
			$dataResponse = [
				"fail" => false,
				'error' => "",
				"id" => $data['id_obat']
			];
			return $this->response->setJSON($dataResponse);
		}
	}

	public function hapusObat()
    {
		$id = $this->request->getVar('id');
		$dtInf = [
			"tanggal_dihapus" => date("Y-m-d H:i:s"),
		];
		$result = $this->mongo->updateById("obat",$dtInf,$id);
		$dataResponse = [
			"fail" => false,
			'errors' => "",
		];
		return $this->response->setJSON($dataResponse);			
    }

	public function exportObat() {
		$options = ['sort' => ['nama' => 1]];
		$dataObat = $this->mongo->get("obat", ['tanggal_dihapus' => ""],$options);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Satuan')
            ->setCellValue('C1', 'Supplier')
            ->setCellValue('D1', 'Harga Pokok')
            ->setCellValue('E1', 'Harga')
            ->setCellValue('F1', 'Total Stok');

        $column = 2;
        foreach ($dataObat as $dtRes) {
			if(isset($dtRes->batch)){
				$stok=0;
				foreach ($dtRes->batch as $dtBatch) {
					//echo $dtBatch->stok;
					$stok = $stok + (int)$dtBatch->stok;
				}
			}
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $dtRes->nama)
                ->setCellValue('B' . $column, $dtRes->satuan)
                ->setCellValue('C' . $column, $dtRes->supplier)
                ->setCellValue('D' . $column, $dtRes->harga_pokok)
                ->setCellValue('E' . $column, $dtRes->harga)
                ->setCellValue('F' . $column, $stok);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Obat';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    
		
	}

	public function getObat() {
		$q = $this->request->getVar('nama');
        if (isset($q)) {
            $q = strtoupper($q);
            $select = "*";
            $where = "where nama like '%$q%'";
        }
        else{
            $select = "*";
        }
		$db     = \Config\Database::connect();
		$query 	= $db->query("select $select from obat $where");
		$row 	= $query->getResult();
        $list = array();
        $key=0;   
        foreach($row as $dtTindakan){
            $list[$key]['id'] = $dtTindakan->id;
            $list[$key]['text'] = $dtTindakan->nama; 
            $key++;
        }
        echo json_encode($list);
	}

	public function Supplier()
	{
		$isi = $this->request->getVar('isi');
		$dataSupplier = $this->mongo->get("supplier", ['tanggal_dihapus' => ""]);
		$data = [
			"supplier" => $dataSupplier
		];
        if ($this->request->isAJAX()) {
			return view('supplier/tabel',$data);
        } else {
			return view('supplier/list',$data);
        }
	}

	public function tambahSupplier(){
		if ($this->request->getMethod() == "get") {
            return view('supplier/form');
        } else {
			$data = $this->request->getVar();
			$dtPas = [
				"nama" => $data['nama'],
				"alamat" => $data['alamat'],
				"telp" => $data['telp'],
				"tanggal_dibuat" => date("Y-m-d"),
				"tanggal_dihapus" => ""
			];
			$result = $this->mongo->insert("supplier",$dtPas);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function ubahSupplier() {
		if ($this->request->getMethod() == "get") {
			$id = $this->request->getVar('id');
			$data = $this->mongo->getOneById("supplier",$id);
            return view('supplier/form',compact('data'));
        } else {
			$id = $this->request->getVar('id');
			$data = $this->request->getVar();
			$dataPengguna = [
				"nama" => $data['nama'],
				"alamat" => $data['alamat'],
				"telp" => $data['telp'],
			];
			$result = $this->mongo->updateById("supplier",$dataPengguna,$id);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}
	
	public function hapusSupplier()
    {
		$id = $this->request->getVar('id');
		$tindakan = new SupplierModel();
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

	public function getSupplier() {
		$q = $this->request->getVar('nama');
        if (isset($q)) {
            $q = strtoupper($q);
            $select = "*";
            $where = "where nama like '%$q%'";
        }
        else{
            $select = "*";
        }
		$db     = \Config\Database::connect();
		$query 	= $db->query("select $select from supplier_obat $where");
		$row 	= $query->getResult();
        $list = array();
        $key=0;   
        foreach($row as $dtTindakan){
            $list[$key]['id'] = $dtTindakan->id;
            $list[$key]['text'] = $dtTindakan->nama; 
            $key++;
        }
        echo json_encode($list);
	}
	
	public function Resep()
	{
		$tanggal = $this->request->getVar('tanggal');
		if(is_null($tanggal)){
			$tanggal = date("d-m-Y");
		}
		$dataRegis = $this->mongo->get("assessment", ["tanggal" => $tanggal]);
		$data = [
			"reg" => $dataRegis
		];
        if ($this->request->isAJAX()) {
			return view('resep/tabel', $data);
        } else {
			return view('resep/list', $data);
        }
	}

	public function detailResep() {
		if ($this->request->getMethod() == "get") {
			$reg = $this->request->getVar('reg');
			$dataRegis = $this->mongo->getOne("assessment", ["no_reg" => $reg]);
			$data=['dataRegis' => $dataRegis];
            return view('resep/detail',$data);
        }
	}
	
	public function dataObat() {
		$q = $this->request->getVar('nama');
		$where = "";
        if (isset($q)) {
			$q = strtolower($q);
			$options = ['sort' => ['tanggal_dibuat' => 1]];
			$dataObat = $this->mongo->getLike("obat","nama",$q,$options, ['tanggal_dihapus' => ""]);

        }
        else{
			$dataObat = $this->mongo->get("obat", ['tanggal_dihapus' => ""]);
        }
        $list = array();
        $key=0;   
        foreach($dataObat as $dtObat){
			$stok = 0;
			foreach( $dtObat->batch as $dtBatch){
				$list[$key]['id'] =(string)$dtObat["_id"]."+".$dtBatch->batch;
				$list[$key]['text'] = $dtObat->nama." ".$dtBatch->batch." ".$dtBatch->expired; 
				$list[$key]['batch_obat'] = $dtBatch->batch; 
				$list[$key]['nama_obat'] = $dtObat->nama; 
				$list[$key]['stok'] = $dtBatch->stok; 
				$list[$key]['harga'] = $dtObat->harga; 
				$key++;
			}
        }
        echo json_encode($list);
	}

	public function dataObatPemeriksaan() {
		$q = $this->request->getVar('nama');
		$where = "";
        if (isset($q)) {
			$q = strtolower($q);
			$options = ['sort' => ['tanggal_dibuat' => 1]];
			$dataObat = $this->mongo->getLike("obat","nama",$q,$options, ['tanggal_dihapus' => ""]);

        }
        else{
			$dataObat = $this->mongo->get("obat", ['tanggal_dihapus' => ""]);
        }
        $list = array();
        $key=0;   
        foreach($dataObat as $dtObat){
			$stok = 0;
			$list[$key]['id'] =(string) $dtObat["_id"];
			$list[$key]['text'] = $dtObat->nama; 
			$list[$key]['nama_obat'] = $dtObat->nama; 
			$list[$key]['harga'] = $dtObat->harga; 
			$key++;
        }
        echo json_encode($list);
	}

	public function inputResep(){
		$session = session();
		$data = $this->request->getVar();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
		$resep = [];
		$dataAssessment = $this->mongo->get("assessment", ["no_reg" => $data["no_reg"]]);
		if(isset($dataAssessment[0]->resep_obat)){
			foreach ($dataAssessment[0]->resep_obat as $dtObatLama) {
				$this->resetStokObat($dtObatLama->id_obat,$dtObatLama->batch_obat,$dtObatLama->jumlah);
			}
		}
		if (!is_null($data["id_obat"])) {
			foreach ($data["id_obat"] as $keyObat => $dtObat) {
				$obt = explode("+",$dtObat);
				$trimmed_nama = ltrim($data['nama_obat'][$keyObat]);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$this->updateStokObat($obt[0],$data['batch_obat'][$keyObat],$data['jumlah_obat'][$keyObat]);
				$resep[]= [
						'id_obat'=>$obt[0],
						'nama_obat'=>$all_trimmed_nama,
						'batch_obat'=>$data['batch_obat'][$keyObat],
						'kali'=>$data['kali'][$keyObat],
						'waktu_minum'=>$data['waktu_minum'][$keyObat],
						'harga'=>$data['harga_obat'][$keyObat],
						'jumlah'=>$data['jumlah_obat'][$keyObat],
						];
			}
		}
		$pemeriksaan["input_resep_obat"] = ucwords(strtolower($session->get('nama_user')));		
		$pemeriksaan["resep_obat"] = $resep;		
		$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
 		return $this->response->setJSON($result);
	}

	public function resetStokObat($id,$batch,$jml){
		$result = $this->mongo->getOneById("obat",$id);
		$dataBatch = [];
		foreach($result->batch as $dtBatch){
			if($dtBatch->batch == $batch){
				$stokBaru = $dtBatch->stok + $jml;
				$dtBatch->stok = $stokBaru;
			}
			$dataBatch[] = [
				"batch"=> strtolower($dtBatch->batch),
				"expired"=>$dtBatch->expired,
				"stok"=>$dtBatch->stok
			];
		}
		$dtPas = [
				"batch" => $dataBatch
			];
		$return = $this->mongo->updateById("obat",$dtPas,$id);
	}

	public function updateStokObat($id,$batch,$jmlKeluar){
		$result = $this->mongo->getOneById("obat",$id);
		$dataBatch = [];
		foreach($result->batch as $dtBatch){
			if($dtBatch->batch == $batch){
				$stokBaru = $dtBatch->stok - $jmlKeluar;
				$dtBatch->stok = $stokBaru;
			}
			$dataBatch[] = [
				"batch"=> strtolower($dtBatch->batch),
				"expired"=>$dtBatch->expired,
				"stok"=>$dtBatch->stok
			];
		}
		$dtPas = [
				"batch" => $dataBatch
			];
		$return = $this->mongo->updateById("obat",$dtPas,$id);
	}

	public function cetakLabel() {
			$reg = $this->request->getVar('reg');
			$dataRegis = $this->mongo->getOne("assessment", ["no_reg" => $reg]);
			$data=['dataRegis' => $dataRegis];
            return view('resep/detail',$data);
	}

	public function resepBebas()
	{
		$tanggal = $this->request->getVar('tanggal');
		if(is_null($tanggal)){
			$tanggal = date("d-m-Y");
		}
		$dataRegis = $this->mongo->get("resep_bebas", ["tanggal" => $tanggal]);
		$data = [
			"reg" => $dataRegis
		];
        if ($this->request->isAJAX()) {
			return view('resep-bebas/tabel', $data);
        } else {
			return view('resep-bebas/list', $data);
        }
	}

	public function resepBebasTambah() {
		if ($this->request->getMethod() == "get") {
            return view('resep-bebas/penjualan');
        } else {
			$data = $this->request->getVar();
			$registrasi = new PendaftaranModel();
			$dtReg = [
				"no_reg" => $data['no_reg'],
				"tanggal" => date("Y-m-d h:i:s"),
				"no_rm" => $data['no_rm']
			];
			$registrasi->insert($dtReg);
			$dataResponse = [
				"fail" => false,
				'error' => "",
			];
			return $this->response->setJSON($dataResponse);
        }   
	}

	public function inputResepBebas(){
		$session = session();
		$data = $this->request->getVar();
		$resep = [];
		if (!is_null($data["id_obat"])) {
			foreach ($data["id_obat"] as $keyObat => $dtObat) {
				$trimmed_nama = ltrim($data['nama_obat'][$keyObat]);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$resep[]= [
						'id_obat'=>$dtObat,
						'nama_obat'=>$all_trimmed_nama,
						'kali'=>$data['kali'][$keyObat],
						'waktu_minum'=>$data['waktu_minum'][$keyObat],
						'harga'=>$data['harga_obat'][$keyObat],
						'jumlah'=>$data['jumlah_obat'][$keyObat],
						];
			}
		}
		$pemeriksaan["no_transaksi"] = 'TRX-'.time();		
		$pemeriksaan["tanggal"] = date("d-m-Y");		
		$pemeriksaan["total_bayar"] = $data["total_bayar"];		
		$pemeriksaan["jumlah_bayar"] = $data["jumlah_bayar"];		
		$pemeriksaan["input_resep_obat"] = ucwords(strtolower($session->get('nama_user')));		
		$pemeriksaan["resep_obat"] = $resep;		
		$result = $this->mongo->insert("resep_bebas",$pemeriksaan);
 		return $this->response->setJSON($result);
	}

	public function detailResepBebas() {
		if ($this->request->getMethod() == "get") {
			$reg = $this->request->getVar('reg');
			$dataRegis = $this->mongo->getOne("resep_bebas", ["no_transaksi" => $reg]);
			$data=['dataRegis' => $dataRegis];
            return view('resep-bebas/detail',$data);
        }
	}
	
	public function updateResepBebas(){
		$session = session();
		$data = $this->request->getVar();
		$resep = [];
		if (!is_null($data["id_obat"])) {
			foreach ($data["id_obat"] as $keyObat => $dtObat) {
				$trimmed_nama = ltrim($data['nama_obat'][$keyObat]);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$resep[]= [
						'id_obat'=>$dtObat,
						'nama_obat'=>$all_trimmed_nama,
						'kali'=>$data['kali'][$keyObat],
						'waktu_minum'=>$data['waktu_minum'][$keyObat],
						'harga'=>$data['harga_obat'][$keyObat],
						'jumlah'=>$data['jumlah_obat'][$keyObat],
						];
			}
		}
		$pemeriksaan["no_transaksi"] = $data["no_trx"];		
		$pemeriksaan["tanggal"] = date("d-m-Y");		
		$pemeriksaan["total_bayar"] = $data["total_bayar"];		
		$pemeriksaan["jumlah_bayar"] = $data["jumlah_bayar"];		
		$pemeriksaan["input_resep_obat"] = ucwords(strtolower($session->get('nama_user')));		
		$pemeriksaan["resep_obat"] = $resep;		
		$result = $this->mongo->update("resep_bebas",$pemeriksaan,["no_transaksi" => $data["no_trx"]]);
 		return $this->response->setJSON($result);
	}

	public function obatMasuk()
	{
		$tanggal = $this->request->getVar('tanggal');
		if(is_null($tanggal)){
			$tanggal = date("d-m-Y");
		}
		$dataRegis = $this->mongo->get("obat_masuk", ["tanggal" => $tanggal]);
		$data = [
			"reg" => $dataRegis
		];
        if ($this->request->isAJAX()) {
			return view('obat-masuk/tabel', $data);
        } else {
			return view('obat-masuk/list', $data);
        }
	}

	public function obatMasukTambah() {
		if ($this->request->getMethod() == "get") {
            return view('obat-masuk/transaksi');
        } else {
			$session = session();
			$data = $this->request->getVar();
			$resep = [];
			if (!is_null($data["id_obat"])) {
				foreach ($data["id_obat"] as $keyObat => $dtObat) {
					$trimmed_nama = ltrim($data['nama_obat'][$keyObat]);
					$all_trimmed_nama = rtrim($trimmed_nama);
					$resep[]= [
							'id_obat'=>$dtObat,
							'nama_obat'=>$all_trimmed_nama,
							'harga'=>$data['harga_obat'][$keyObat],
							'batch'=>$data['batch'][$keyObat],
							'expired'=>$data['expired'][$keyObat],
							'jumlah'=>$data['stok'][$keyObat],
							'total'=>$data['total_obat'][$keyObat],
							];
					$dtBatch = [
						"batch"=>$data['batch'][$keyObat],
						"expired"=>$data['expired'][$keyObat],
						"stok"=>$data['stok'][$keyObat]
					];
					$update = ["batch"=>$dtBatch];
					$result = $this->mongo->pushArrayById("obat",$update,$dtObat);
				}
			}
			$pemeriksaan["no_transaksi"] = 'TRO-'.time();		
			$pemeriksaan["tanggal"] = date("d-m-Y");		
			$pemeriksaan["input_obat_masuk"] = ucwords(strtolower($session->get('nama_user')));		
			$pemeriksaan["detail_obat"] = $resep;
			$pemeriksaan["total_bayar"] = $data["total_bayar"];		
			$pemeriksaan["jumlah_bayar"] = $data["jumlah_bayar"];					
			$pemeriksaan["kembali"] = $data["kembali"];			
			$pemeriksaan["tanggal_dibuat"] =  date("Y-m-d");			
			$result = $this->mongo->insert("obat_masuk",$pemeriksaan);
			return $this->response->setJSON($result);
		}   
	}

	public function obatMasukExport()
    {
		$bulan = $this->request->getVar('bulan');
		$tahun = $this->request->getVar('tahun');
		if($bulan == "-"){
			$bulan = date("m");
		}
		if($tahun  == "-"){
			$tahun = date("Y");
		}
		$options = ['sort' => ['tanggal' => 1]];
		$listAssessment = $this->mongo->getLike("obat_masuk","tanggal",$bulan."-".$tahun,$options);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No Trans')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Total')
            ->setCellValue('D1', 'Input By');

        $column = 2;
        foreach ($listAssessment as $dtRes) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $dtRes->no_transaksi)
                ->setCellValue('B' . $column, $dtRes->tanggal)
                ->setCellValue('C' . $column, $dtRes->total_bayar)
                ->setCellValue('D' . $column, $dtRes->input_obat_masuk);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-trans-obat-masuk';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    
	}

	public function obatKeluar()
	{
		$awal = date("Y-m-d", strtotime($this->request->getVar('awal')));
		$akhir = date("Y-m-d", strtotime($this->request->getVar('akhir')));
		if(!isset($awal)){
			$awal = date("Y-m-d");
		}
		if(!isset($akhir)){
			$akhir = date("Y-m-d");
		}
		$listAssessment = $this->mongo->getBetweenDate("assessment","tanggal_dibuat",$awal,$akhir);
		$obat=[];
		foreach ($listAssessment as $dtRes) {
			if(isset($dtRes->resep_obat)){
				foreach($dtRes->resep_obat as $dtObat){
					$dt = $this->mongo->getOneById("obat",$dtObat->id_obat);
					$obat[$dtRes->tanggal][] = [
						"nama"=> $dtObat->nama_obat,
						"supplier"=> $dt->supplier,
						"satuan"=> $dt->satuan,
						"harga_pokok"=> $dt->harga_pokok,
						"harga"=> $dt->harga,
						"jml"=> $dtObat->jumlah
					];
				}	
			}
        }
		$groups = array();
		foreach ($obat as $k => $val) {
			foreach ($val as $i => $item_val) {
				$key = $item_val['nama'];
				if (!array_key_exists($key, $groups)) {
					$groups[$key] = array(
						'jml' => $item_val['jml'],
						'supplier' => $item_val['supplier'],
						'satuan' => $item_val['satuan'],
						'harga' => $item_val['harga'],
						'harga_pokok' => $item_val['harga_pokok'],
						'tgl' => $k,
					);
				} else {
					$groups[$key]['jml'] = $groups[$key]['jml'] + $item_val['jml'];
				}
			}
		}
		$data = [
			"lstObat" => $groups
		];
        if ($this->request->isAJAX()) {
			return view('obat-keluar/tabel', $data);
        } else {
			return view('obat-keluar/list', $data);
        }
	}

	public function exportObatKeluar()
    {
		$awal = date("Y-m-d", strtotime($this->request->getVar('awal')));
		$akhir = date("Y-m-d", strtotime($this->request->getVar('akhir')));
		if(!isset($awal)){
			$awal = date("Y-m-d");
		}
		if(!isset($akhir)){
			$akhir = date("Y-m-d");
		}
		$listAssessment = $this->mongo->getBetweenDate("assessment","tanggal_dibuat",$awal,$akhir);
		$obat=[];
		foreach ($listAssessment as $dtRes) {
			if(isset($dtRes->resep_obat)){
				foreach($dtRes->resep_obat as $dtObat){
					$dt = $this->mongo->getOneById("obat",$dtObat->id_obat);
					$obat[$dtRes->tanggal][] = [
						"nama"=> $dtObat->nama_obat,
						"supplier"=> $dt->supplier,
						"satuan"=> $dt->satuan,
						"harga_pokok"=> $dt->harga_pokok,
						"harga"=> $dt->harga,
						"jml"=> $dtObat->jumlah
					];
				}	
			}
        }
		$groups = array();
		foreach ($obat as $k => $val) {
			foreach ($val as $i => $item_val) {
				$key = $item_val['nama'];
				if (!array_key_exists($key, $groups)) {
					$groups[$key] = array(
						'jml' => $item_val['jml'],
						'supplier' => $item_val['supplier'],
						'satuan' => $item_val['satuan'],
						'harga' => $item_val['harga'],
						'harga_pokok' => $item_val['harga_pokok'],
						'tgl' => $k,
					);
				} else {
					$groups[$key]['jml'] = $groups[$key]['jml'] + $item_val['jml'];
				}
			}
		}
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Nama Obat')
            ->setCellValue('D1', 'Satuan')
            ->setCellValue('E1', 'Supplier')
            ->setCellValue('F1', 'Harga Beli')
            ->setCellValue('G1', 'Harga Jual')
            ->setCellValue('H1', 'Jml. Keluar');

        $column = 2;
		$no=1;
        foreach ($groups as $k => $dtRes) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $column, $no++)
			->setCellValue('B' . $column, $dtRes['tgl'])
			->setCellValue('C' . $column, $k)
			->setCellValue('D' . $column, $dtRes['satuan'])
			->setCellValue('E' . $column, $dtRes['supplier'])
			->setCellValue('F' . $column, $dtRes['harga_pokok'])
			->setCellValue('G' . $column, $dtRes['harga'])
			->setCellValue('H' . $column, $dtRes['jml']);
			$column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-lap-obat-keluar';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    
	}

}
