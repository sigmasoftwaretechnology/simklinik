<?php namespace App\Controllers;

class Diagnosa extends BaseController
{
	public function getIcdx() {
		$q = $this->request->getVar('nama');
		$where = "";
        if (isset($q)) {
            $q = strtoupper($q);
            $select = "*";
            $where = "where nama like '%$q%'";
        }
        else{
            $select = "*";
        }
		$db     = \Config\Database::connect();
		$query 	= $db->query("select $select from icdx $where");
		$row 	= $query->getResult();
        $list = array();
        $key=0;   
        foreach($row as $dtIcdx){
            $list[$key]['id'] = $dtIcdx->id;
            $list[$key]['text'] = $dtIcdx->nama; 
            $key++;
        }
        echo json_encode($list);
	}
	
	public function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

}

