<?php
/**
 * Created by Sigit.
 * Date: 09/07/21
 * Time: 10:13 AM
 */
namespace App\Libraries;
require 'vendor/autoload.php';
use MongoDB;

class Mongo{
	
	public $connection;
	
	function __construct() {
		$host = "localhost";
		$port = "27017";
		$username = "";
		$password = "";
		$database = "simklinik";			
		try {
			$client = new MongoDB\Client("mongodb://".$host.":".$port);
			$this->connection  = $client->$database;
			
		} catch(MongoDB\Driver\Exception\MongoConnectionException $ex) {
			show_error('Couldn\'t connect to mongodb: ' . $ex->getMessage(), 500);
		}
	}
		
	function get($collectionName,$where = null) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->find();
		if($where !== null){
			if(isset($where["tanggal_dibuat"])){
				$orig_date =strtotime($where["tanggal_dibuat"]);
				$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
				$where["tanggal_dibuat"] = $utcdatetime;
			}
			$cursor = $collection->find($where);
		}
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;
	}
	
	function getOne($collectionName,$where = null,$options=null) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->findOne();
		if($where !== null){
			if(isset($where["tanggal_dibuat"])){
				$orig_date = strtotime($where["tanggal_dibuat"]);
				$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
				$where["tanggal_dibuat"] = $utcdatetime;
			}
			if($options !== null){
				$cursor = $collection->findOne($where,$options);
			}
			else{
				$cursor = $collection->findOne($where);
			}
		}
        return $cursor;
	}

	function getOneById($collectionName,$id = null) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->findOne();
		if($id !== null){
			$cursor = $collection->findOne(array('_id' => new \MongoDB\BSON\ObjectID($id)));
		}
        return $cursor;
	}

	function getLike($collectionName,$field = null,$data = null,$options=null,$and = null) {
		$collection = $this->connection->$collectionName;
		if($and == null){
			$where = [
				$field => new MongoDB\BSON\Regex($data),
			];
		}
		else{
			$krit1 = [$field => new MongoDB\BSON\Regex($data)];
			$krit2 = $and;
			$where = array_merge($krit1,$krit2);
		}
		$cursor = $collection->find($where,$options);
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;
	}

	function getBetweenDate($collectionName,$field,$awal,$akhir) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->find();
		$where = [ "$field" => array('$gte' => new MongoDB\BSON\UTCDateTime(strtotime("$awal")* 1000), '$lte' => new MongoDB\BSON\UTCDateTime(strtotime("$akhir")* 1000))];
		$cursor = $collection->find($where);
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;
	}

	function getBetween($collectionName,$options) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->aggregate(
			array(
				array(
					'$project' =>array(
						'test' => array(
							'$toDate' => '$tanggal'
						)
					)
				),
				array(
					'$match' =>array(
						'test' => ['$eq' => '1665014400000']
					)
				) 
			)		
		);
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;

	}

	function getAggregate($collectionName) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->aggregate(
			array(
				array(
					'$group' => array(
						'_id' => '$tanggal',
						'no_reg' => array(
							'$push' => '$no_reg'
						)
					)
				)   
			)		
		);
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;
	}

	function getGroup($collectionName,$where = null) {
		$collection = $this->connection->$collectionName;
		$cursor = $collection->aggregate(
		array(
				array(
					'$group' => array(
						'_id' => '$tanggal',
					)
				)   
			)
		);
		$resultingDocuments = array();
        foreach ($cursor as $key => $value) {
            $resultingDocuments[$key] = $value;
        }
        return $resultingDocuments;
	}

    public function insert($collectionName,$dataArray=NULL){
		$collection = $this->connection->$collectionName;
		//jika ada object tanggal di buat
		if(isset($dataArray["tanggal_dibuat"])){
			$orig_date =strtotime($dataArray["tanggal_dibuat"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dibuat"] = $utcdatetime;
		}
		$insertOneResult = $collection->insertOne($dataArray);
        if ($insertOneResult){
            return $insertOneResult->getInsertedId();
        }else{
            return false;
        }
    }
	
	public function update($collectionName,$dataArray=NULL,$key){
		$collection = $this->connection->$collectionName;
		//jika ada object tanggal di buat
		if(isset($dataArray["tanggal_dibuat"])){
			$orig_date =strtotime($dataArray["tanggal_dibuat"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dibuat"] = $utcdatetime;
		}
		$updateResult = $collection->updateOne(
			$key,
			['$set' => $dataArray]
		);
        if ($updateResult){
            return $updateResult->getModifiedCount();
        }else{
            return false;
        }
    }

	public function updateById($collectionName,$dataArray=NULL,$_id){
		$collection = $this->connection->$collectionName;
		//jika ada object tanggal di buat
		if(isset($dataArray["tanggal_dibuat"])){
			$orig_date =strtotime($dataArray["tanggal_dibuat"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dibuat"] = $utcdatetime;
		}
		if(isset($dataArray["tanggal_dihapus"])){
			$orig_date =strtotime($dataArray["tanggal_dihapus"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dihapus"] = $utcdatetime;
		}
		$updateResult = $collection->updateOne(
			['_id' => new \MongoDB\BSON\ObjectID($_id)],
			['$set' => $dataArray]
		);
        if ($updateResult){
            return $updateResult->getModifiedCount();
        }else{
            return false;
        }
    }

	public function pushArrayById($collectionName,$dataArray=NULL,$_id){
		$collection = $this->connection->$collectionName;
		//jika ada object tanggal di buat
		if(isset($dataArray["tanggal_dibuat"])){
			$orig_date =strtotime($dataArray["tanggal_dibuat"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dibuat"] = $utcdatetime;
		}
		if(isset($dataArray["tanggal_dihapus"])){
			$orig_date =strtotime($dataArray["tanggal_dihapus"]);
			$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);
			$dataArray["tanggal_dihapus"] = $utcdatetime;
		}
		$updateResult = $collection->updateOne(
			['_id' => new \MongoDB\BSON\ObjectID($_id)],
			['$push' => $dataArray]
		);
        if ($updateResult){
            return $updateResult->getModifiedCount();
        }else{
            return false;
        }
    }

}