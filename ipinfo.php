<?php
class ipinfo {
	
	private $host;
	private $ip;
	private $curluri;
	
	public $response;
	
	public function __construct($ip = NULL) {
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->host = 'http://ip-api.com/batch';
	}
	
	public function fetch() {
		$objIp = $this->ipCurl();
		return $objIp;
	}
	
	private function ipCurl() {
		$ch = curl_init();
		$data = '[{"query": "'.$this->ip.'"}]';
		curl_setopt($ch, CURLOPT_URL, $this->host);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		print_r($data);
		$result = curl_exec($ch);
		print_r($result);
		$json = json_decode($result, true);
			if($json[0]['status'] == 'fail'){
			   return 'US';
			}
			else{
			   return $json[0]['countryCode'];
			   	}   
			

		curl_close($ch);
	} 
}


$obj = new ipinfo();
print_r($obj->fetch());
