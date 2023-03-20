<?php namespace App\Libraries;
Class PCare
{
    private $cons_id;
    private $timestamp;
    private $signature;
    private $secret_key;
    private $user_key;
    private $base_url;

    public function __construct()
    {
       
        $this->cons_id = "24564";
        $this->secret_key = "1yI069E403";
        $this->user_key = "1d4db2fb363e4329e39b44fc4ab82d92";
        //$this->base_url = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev";
		$this->base_url = "http://127.0.0.1/pcare-dummy/";
        $this->setTimestamp()->setSignature();
    }

    protected function setTimestamp()
    {
        date_default_timezone_set('UTC');
        $this->timestamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $this;
    }

    protected function setSignature()
    {
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $this->cons_id."&".$tStamp, $this->secret_key, true);
        $this->signature = base64_encode($signature);
        return $this;
    }

    function getData($siteUrl,$headers){

        $mainHeaders = array(
            'X-cons-id: '.$this->cons_id,
            'X-timestamp: '.$this->timestamp,
            'X-signature: '.$this->signature,
            'user_key: '.$this->user_key
        );

        if(!empty($headers)){
            $mainHeaders = array_merge($mainHeaders,$headers);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url.$siteUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $mainHeaders);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        $err = curl_error($ch);
        $data = json_decode($content, true);
        $kunci = $this->cons_id.$this->secret_key.$this->timestamp;
        $data['response'] = json_decode($this->stringDecrypt($kunci, $data["response"]), true);
        return $data;
	}
	
    function getDataDummy($siteUrl){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url.$siteUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        $err = curl_error($ch);
        $data = json_decode($content, true);
        return $data;
	}

    function getSignature(){
        $consId = getenv('BPJS_CONSID');
        $secretKey = getenv('BPJS_SCREET_KEY');
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $consId."&".$tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $result = [
            "X-cons-id"=>$consId,
            "X-timestamp"=>$tStamp,
            "X-signature"=>$encodedSignature,
        ];
        return $result;
	}

    function stringDecrypt($key, $string){
		$encrypt_method = 'AES-256-CBC';
		$key_hash = hex2bin(hash('sha256', $key));
		$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
	}
    
}
