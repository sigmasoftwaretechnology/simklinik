<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use  App\Models\UnitModel;
use  App\Libraries\Pdo;
use App\Libraries\Mongo;

class Login extends BaseController
{
    /**
     * firebird
     *
     * @var mixed
     */
    public $firebird;
    public $mongo;
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->mongo = new Mongo();
    }

    public function index()
    {
        $profil = $this->mongo->getOne("profil");
        $poli = $this->mongo->get("poli");
        return view('login',compact('profil','poli'));
    }
 
    public function auth()
    {
        $session = session();
        $nik = $this->request->getVar('nik');
        $password = $this->request->getVar('password');
        $poli = $this->request->getVar('poli');
        $data = $this->mongo->getOne("pengguna", ["nama_pengguna" => $nik]);
        if ($data) {
            $pass = $data->password;
           // var_dump($pass);exit();
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {  
                $dataPengguna = $this->mongo->getOne("karyawan", ["nama" => $data->nama_karyawan]);
                $ses_data = [
                    'id_user'               => $dataPengguna->_id,
                    'nama_user'             => $dataPengguna->nama,
                    'kelompok'              => $dataPengguna->unit,
                    'gelar_depan'           => $dataPengguna->gelar_depan,
                    'gelar_belakang'        => $dataPengguna->gelar_belakang,
                    'poli'        			=> $poli,
                    'logged_in'             => true
                ];
                $session->set($ses_data);
                return redirect()->to(base_url().'/');
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to(base_url().'/login');
            }
        } else {
            $session->setFlashdata('msg', 'User tidak ditemukan');
            return redirect()->to(base_url().'/login');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url().'/login');
    }
}
