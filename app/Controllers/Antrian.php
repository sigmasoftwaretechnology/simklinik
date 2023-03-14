<?php

namespace App\Controllers;
use App\Libraries\Mongo;

class Antrian extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }

	public function index()
	{
		$profil = $this->mongo->getOne("profil");
		$dtAntrian = $this->mongo->get("antrian", ["aktif" => "yes"]);
		return view('antrian/display',compact('profil','dtAntrian'));
	}
}
