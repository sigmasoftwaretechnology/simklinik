<?php namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\PasienModel;
use App\Models\PendaftaranModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;

class Pemeriksaan extends BaseController
{
    use ResponseTrait;
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }
	
	public function savePemeriksaanFisik()
    {
		$pendaftaran 	= new PendaftaranModel();
		$session = session();
        $data = $this->request->getVar();
		$pemeriksaan["no_reg"] 			=  $data["no_reg"];
        $pemeriksaan["no_rm"] 			=  $data["no_rm"];
		$pemeriksaan["nama"] 			=  $data["nama"];
		$pemeriksaan["umur"] 			=  $data["umur"];
        $pemeriksaan["alamat_pasien"] 	=  $data["alamat_pasien"];
        $pemeriksaan["tanggal"] 		=  $data["tanggal"];
		$pemeriksaan["jam"] 			=  date("H:i:s");
        $pemeriksaan["subject"] =  $data["subject"];
        $pemeriksaan["object"] = [
								"ku" 	=> $data["ku"],
								"t" 	=> $data["t"],
								"n" 	=> $data["n"],
								"s" 	=> $data["s"],
								"rr" 	=> $data["rr"],
								"bb" 	=> $data["bb"],
								"tb" 	=> $data["tb"],
								"gda" 	=> $data["gda"]
							];
		$icdx = [];
		if (isset($data["nama_icdx"])) {
			foreach ($data["nama_icdx"] as $keyIcdx => $dtIcdx) {
				$trimmed_nama = ltrim($dtIcdx);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$icdx[]= [
						'nama_icdx'=>$all_trimmed_nama
						];
			}
		}
		$tindakan = [];
		if (isset($data["nama_tindakan"])) {
			foreach ($data["nama_tindakan"] as $keyTindakan => $dtTindakan) {
				$trimmed_nama = ltrim($dtTindakan);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$tindakan[]= [
						"nama_tindakan"  =>$all_trimmed_nama,
						"tarif_tindakan" =>$data['tarif_tindakan'][$keyTindakan],
						"input_tindakan" => ucwords(strtolower($session->get('nama_user')))
						];
			}
		}
		$pemeriksaan["assessment"] =[
										"icdx" 		=> $icdx,
										"tindakan" 	=> $tindakan
									];
		$pemeriksaan["plant"] =[
									"resep" => str_replace("<p>","<p style='font-size:10pt;margin-bottom:3px;margin-top:3px'>",$data["resep"])
								];
		$pemeriksaan["pemeriksaan_penunjang"] = str_replace("<p>","<p style='font-size:10pt;margin-bottom:3px;margin-top:3px'>",$data["pemeriksaan_penunjang"]);
		$perawat = "";
		if($session->get('kelompok') == "Perawat"){
			$perawat = $session->get('nama_user');
			$pemeriksaan["perawat"] = $perawat;
			$dataReg = [
				'perawat' => $perawat,
			];
			$pendaftaran->where('no_reg', $data["no_reg"])->set($dataReg)->update();
		}
		$dokter = "";
		if($session->get('kelompok') == "Dokter"){
			$dokter = $session->get('nama_user');
			$pemeriksaan["dokter"] = $dokter;
			$dataReg = [
				'dokter' => $session->get('gelar_depan')." ".ucwords(strtolower($dokter))." ".$session->get('gelar_belakang'),
			];
			$pendaftaran->where('no_reg', $data["no_reg"])->set($dataReg)->update();
		}
		$pemeriksaan["lunas"] 			=  "";
		$pemeriksaan["tanggal_dibuat"] 	=  date("Y-m-d",strtotime($data["tanggal"]));
		$cekData = $this->mongo->get("assessment", ["no_reg" => $pemeriksaan["no_reg"]]);
		if(count($cekData) == 0){
			$result = $this->mongo->insert("assessment",$pemeriksaan);
		}
		else{
			$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
		}
        return $this->respondCreated($result, 201);

    }
	
	public function saveDokument()
    {
        $data = $this->request->getVar();
		$file = $this->request->getFile("file_pasien");
		$newName = $file->getRandomName();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
		$cekData = $this->mongo->get("dokument_penunjang", ["no_reg" => $pemeriksaan["no_reg"]]);
		if(count($cekData) == 0){
			$pemeriksaan["file_dokument"][] 	=  [
										"jns_dokument" => $data["jns_dokumen"],
										"nama_file" => $newName,
									];
			$result = $this->mongo->insert("dokument_penunjang",$pemeriksaan);
		}
		else{
			$dok = $cekData[0]->file_dokument;
			$isiDokument =  [
								"jns_dokument" => $data["jns_dokumen"],
								"nama_file" => $newName,
							];			
			$array = array();
			foreach($dok as $dtDokument){
				$array[] = $dtDokument;
			}
			array_push($array, $isiDokument);
			$pemeriksaan["file_dokument"] 	= $array ;
			$result = $this->mongo->update("dokument_penunjang",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
		}
		$file->move('uploads/file-px', $newName);
        return $this->respondCreated($result, 201);

    }


	public function index()
	{
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.id = '$id_reg'");
		$row 	= $query->getRow();
		return view('pemeriksaan/form-pemeriksaan',compact('row'));
	}
	
	public function data()
    {
		$no_reg = $this->request->getVar('no_reg');
		$data = $this->mongo->getOne("assessment", ["no_reg" => $no_reg]);
		$dataDokument = $this->mongo->getOne("dokument_penunjang", ["no_reg" => $no_reg]);
		$data = [
            'status' => 'success',
            'data' => $data,
            'dataDokument' => $dataDokument
        ];
        return $this->respondCreated($data, 200);

	}
	
	public function dataKunjungan()
    {
		$db     = \Config\Database::connect();
		$no_rm = $this->request->getVar('no_rm');
		$query 	= $db->query("select a.id,DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,a.no_reg,b.no_rm from pendaftaran a join pasien b on b.id = a.no_rm  where b.no_rm = '$no_rm'");
		$row 	= $query->getResult();
		$data = [
            'status' => 'success',
            'data' => $row
        ];
        return $this->respondCreated($data, 200);

	}
	
	public function saveDiagnosa()
    {
        $data = $this->request->getVar();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
        $pemeriksaan["no_rm"] =  $data["no_rm"];
        $pemeriksaan["nama"] =  $data["nama"];
		$pemeriksaan["umur"] =  $data["umur"];
        $pemeriksaan["alamat_pasien"] =  $data["alamat_pasien"];
        $pemeriksaan["tanggal"] =  $data["tanggal"];
		$pemeriksaan["jam"] =  date("H:i:s");
		$icdx = [];
		if (!is_null($data["nama_icdx"])) {
			foreach ($data["nama_icdx"] as $keyIcdx => $dtIcdx) {
				$trimmed_nama = ltrim($dtIcdx);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$icdx[]= [
						'nama_icdx'=>$all_trimmed_nama
						];
			}
		}
		$pemeriksaan["icdx"] = $icdx;		
		$cekData = $this->mongo->get("assessment", ["no_reg" => $pemeriksaan["no_reg"]]);
		if(count($cekData) == 0){
			$result = $this->mongo->insert("assessment",$pemeriksaan);
		}
		else{
			$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
		}
        return $this->respondCreated($result, 201);

    }

	public function saveTindakan()
    {
        $data = $this->request->getVar();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
        $pemeriksaan["no_rm"] =  $data["no_rm"];
        $pemeriksaan["nama"] =  $data["nama"];
		$pemeriksaan["umur"] =  $data["umur"];
        $pemeriksaan["alamat_pasien"] =  $data["alamat_pasien"];
        $pemeriksaan["tanggal"] =  $data["tanggal"];
		$pemeriksaan["jam"] =  date("H:i:s");
		$tindakan = [];
		if (!is_null($data["nama_tindakan"])) {
			foreach ($data["nama_tindakan"] as $keyTindakan => $dtTindakan) {
				$trimmed_nama = ltrim($dtTindakan);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$tindakan[]= [
						'nama_tindakan'=>$all_trimmed_nama,
						'tarif_tindakan'=>$data['tarif_tindakan'][$keyTindakan],
						];
			}
		}
		$pemeriksaan["tindakan"] = $tindakan;	
		$cekData = $this->mongo->get("assessment", ["no_reg" => $pemeriksaan["no_reg"]]);
		if(count($cekData) == 0){
			$result = $this->mongo->insert("assessment",$pemeriksaan);
		}
		else{
			$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
		}
        return $this->respondCreated($result, 201);
    }

	public function saveResep()
    {
        $data = $this->request->getVar();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
        $pemeriksaan["no_rm"] =  $data["no_rm"];
		$pemeriksaan["nama"] =  $data["nama"];
		$pemeriksaan["umur"] =  $data["umur"];
        $pemeriksaan["alamat_pasien"] =  $data["alamat_pasien"];
        $pemeriksaan["tanggal"] =  $data["tanggal"];
		$pemeriksaan["jam"] =  date("H:i:s");
		$resep = [];
		if (!is_null($data["id_obat"])) {
			foreach ($data["id_obat"] as $keyObat => $dtObat) {
				$trimmed_nama = ltrim($data['nama_obat'][$keyObat]);
				$all_trimmed_nama = rtrim($trimmed_nama);
				$resep[]= [
						'id_obat'=>$dtObat,
						'nama_obat'=>$all_trimmed_nama,
						'kali'=>$data['kali'][$keyObat],
						'waktu_minum'=>$data['waktu_minum'][$keyObat]
						];
			}
		}
		$pemeriksaan["resep"] = $resep;		
		$cekData = $this->mongo->get("assessment", ["no_reg" => $pemeriksaan["no_reg"]]);
		if(count($cekData) == 0){
			$result = $this->mongo->insert("assessment",$pemeriksaan);
		}
		else{
			$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
		}
        return $this->respondCreated($result, 201);
    }

    function rekamMedisPdf(){
		$filename = date('y-m-d-H-i-s'). '-qadr-labs-report';
        $dompdf = new Dompdf();
		$no_reg = $this->request->getVar('no_reg');
		$data = $this->mongo->get("assessment", ["no_reg" => $no_reg]);
		//var_dump($data[0]->no_reg);exit();
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.no_reg = '$no_reg'");
		$row 	= $query->getRow();

		return view('pemeriksaan/rekam-medis',compact('data','row'));

        $dompdf->loadHtml(view('pemeriksaan/rekam-medis',compact('data','row')));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename);    
	}
	
    function invoicePdf(){
		$filename = date('y-m-d-H-i-s'). '-invoice';
        $dompdf = new Dompdf();
		$no_reg = $this->request->getVar('no_reg');
		$data = $this->mongo->get("assessment", ["no_reg" => $no_reg]);
		//return view('pemeriksaan/invoice',compact('data'));

        $dompdf->loadHtml(view('pemeriksaan/invoice',compact('data')));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename);    
	}

}
