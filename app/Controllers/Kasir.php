<?php

namespace App\Controllers;
use  App\Models\PendaftaranModel;
use App\Libraries\Mongo;
use Dompdf\Dompdf;

class Kasir extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }
	
	public function cetakInvoice()
    {
		$filename = date('y-m-d-H-i-s'). 'invoice';
        $dompdf = new Dompdf();
		$no_reg = $this->request->getVar('reg');
		$data = $this->mongo->getOne("assessment", ["no_reg" => $no_reg]);		
		$db     = \Config\Database::connect();
		$id_reg = $this->request->getVar('q');
		$query 	= $db->query("select a.id,a.no_reg,b.no_rm,b.nama,b.no_bpjs,b.alamat,b.tgl_lahir from pendaftaran a join pasien b on b.id = a.no_rm  where a.no_reg = '$no_reg'");
		$row 	= $query->getRow();

		//return view('kasir/invoice',compact('data','row'));

        $dompdf->loadHtml(view('kasir/invoice',compact('data','row')));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename);    

    }
}
