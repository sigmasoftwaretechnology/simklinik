<?php

namespace App\Controllers;
use App\Libraries\Mongo;

class Error extends BaseController
{
	public $mongo;

    public function __construct(){
		$this->mongo = new Mongo();
    }

	public function aksesError()
	{
		return view('error/akses-error');
	}
}
