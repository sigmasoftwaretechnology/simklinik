<?php

namespace App\Controllers;
use  App\Models\PendaftaranModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Keuangan extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }
	
	public function kasir()
    {
		$tanggal = $this->request->getVar('tanggal');
		$text = $this->request->getVar('text');
		if(is_null($tanggal)){
			$tanggal = date("d-m-Y");
		}
        if (isset($text)) {
			$text = strtolower($text);
			$options = ['sort' => ['tanggal_dibuat' => 1]];
			$dataRegis = $this->mongo->getLike("assessment","nama",$text,$options,["tanggal" => $tanggal]);

        }
        else{
			$dataRegis = $this->mongo->get("assessment", ["tanggal" => $tanggal]);
        }
		$data = [
			"reg" => $dataRegis
		];
        if ($this->request->isAJAX()) {
			return view('kasir/tabel', $data);
        } else {
			return view('kasir/list', $data);
        }
    }
	
	public function detailInvoice() {
		if ($this->request->getMethod() == "get") {
			$reg = $this->request->getVar('reg');
			$dataRegis = $this->mongo->getOne("assessment", ["no_reg" => $reg]);
			$data=['dataRegis' => $dataRegis];
            return view('kasir/detail',$data);
        }
	}

	public function simpanPembayaran(){
		$session = session();
		$data = $this->request->getVar();
		$pemeriksaan["no_reg"] =  $data["no_reg"];
		$pemeriksaan["total_bayar"] = $data["total_bayar"];
		$pemeriksaan["jumlah_bayar"] = $data["jumlah_bayar"];	
		$pemeriksaan["kembali"] = $data["kembali"];	
		$pemeriksaan["input_pembayaran"] = ucwords(strtolower($session->get('nama_user')));		
		if($data["kembali"] >= 0){
			$pemeriksaan["lunas"] = "lunas";
		}
		$result = $this->mongo->update("assessment",$pemeriksaan,["no_reg" => $pemeriksaan["no_reg"]]);
 		return $this->response->setJSON($result);
	}

	public function kwitansi() {
		if ($this->request->getMethod() == "get") {
			$reg = $this->request->getVar('reg');
			$dataRegis = $this->mongo->getOne("assessment", ["no_reg" => $reg]);
			$data=['dataRegis' => $dataRegis];
            return view('kasir/kwitansi',$data);
        }
	}
	
	public function laporanKeuangan()
    {
		$bulan = $this->request->getVar('bulan');
		$tahun = $this->request->getVar('tahun');
		if(is_null($bulan)){
			$bulan = date("m");
		}
		if(is_null($tahun)){
			$tahun = date("Y");
		}
		$options = ['sort' => ['tanggal' => 1]];
		$listAssessment = $this->mongo->getLike("assessment","tanggal",$bulan."-".$tahun,$options);
		$data = [
			"listAssessment" => $listAssessment
		];
        if ($this->request->isAJAX()) {
			return view('laporan-keuangan/tabel', $data);
        } else {
			return view('laporan-keuangan/list', $data);
        }
    }
	
	public function detailLaporanKeuangan()
    {
		$db     = \Config\Database::connect();
		$q = $this->request->getVar('q');
		$query 	= $db->query("select a.* from karyawan a where a.id = '$q'");
		$result 	= $query->getRow();
		$bulan = $this->request->getVar('bulan');
		$tahun = $this->request->getVar('tahun');
		if(is_null($bulan)){
			$bulan = date("m");
		}
		if(is_null($tahun)){
			$tahun = date("Y");
		}
		$options = ['sort' => ['tanggal' => 1]];
		$listAssessment = $this->mongo->getLike("assessment","tanggal",$bulan."-".$tahun,$options);
		$data = [
			"listAssessment" => $listAssessment
		];
		return view('laporan-keuangan/detail-list', $data);
    }

	public function laporanKeuanganExport()
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
		$listAssessment = $this->mongo->getLike("assessment","tanggal",$bulan."-".$tahun,$options);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Registrasi')
            ->setCellValue('C1', 'Dokter')
            ->setCellValue('D1', 'Perawat')
            ->setCellValue('E1', 'Input Resep')
            ->setCellValue('F1', 'Tindakan')
            ->setCellValue('G1', 'Obat')
            ->setCellValue('H1', 'Total Pendapatan');

        $column = 2;
        foreach ($listAssessment as $dtRes) {
			$dokter = "";
			if(isset($dtRes->dokter)){
				$dokter = $dtRes->dokter;
			}
			$perawat = "";
			if(isset($dtRes->perawat)){
				$perawat = $dtRes->perawat;
			}
			$input_resep_obat = "";
			if(isset($dtRes->input_resep_obat)){
				$input_resep_obat = $dtRes->input_resep_obat;
			}
			if(isset($dtRes->assessment->tindakan)){
				$totTindakan = 0;
				foreach($dtRes->assessment->tindakan as $dtTindakan){
					$totTindakan = $totTindakan + $dtTindakan->tarif_tindakan;										
				}
			}
			if(isset($dtRes->resep_obat)){
				$totObat = 0;
				foreach($dtRes->resep_obat as $dtObat){
					$gtObat = $dtObat->harga*$dtObat->jumlah;
					$totObat = $totObat + $gtObat;										
				}
			}
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $dtRes->tanggal)
                ->setCellValue('B' . $column, $dtRes->no_reg)
                ->setCellValue('C' . $column, $dokter)
                ->setCellValue('D' . $column, $perawat)
                ->setCellValue('E' . $column, $input_resep_obat)
                ->setCellValue('F' . $column, $totTindakan)
                ->setCellValue('G' . $column, $totObat)
                ->setCellValue('H' . $column, $totTindakan+$totObat);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-User';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    
	}

	public function laporanKeuangan2()
    {
		$bulan = date("m");
		$tahun = date("Y");
		$options = ['sort' => ['tanggal' => -1]];
		$listAssessment = $this->mongo->getBetween("assessment",$options);
		$i=1;
		foreach($listAssessment as $lst){
			echo $i." .".$lst->test;
			echo "<br/>";
			$i++;
		}
    }


}
