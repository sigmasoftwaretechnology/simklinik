<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\Mongo;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }
		$this->session = \Config\Services::session();
		$nama_karyawan = $this->session->get('nama_user');
		$mongo = new Mongo();
		$pengguna = $mongo->getOne("pengguna", ["nama_karyawan" => $nama_karyawan]);
		$uri = current_url(true);
		if($uri->getSegment(3) !== ""){
			if($uri->getSegment(4) !== ""){
				$url = $uri->getSegment(3)."/".$uri->getSegment(4);
			}
			else{
				$url = $uri->getSegment(3);
			}	
			$dtMenu = [];
			foreach($pengguna->role as $menu){
				$dtMenu[]=$menu;
			}
			if (!in_array($url, $dtMenu))
			{
				return redirect()->to(base_url().'/error/akses-error');
			}	
		}
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}