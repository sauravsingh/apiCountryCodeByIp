class ipinfo {
	
	private $host = 'http://ipinfo.io/';
	private $ip;
	private $curluri;
	
	public $response;
	
	public function __construct($ip = NULL) {
		$this->ip = $ip;
	}
	
	public function fetch() {
		$objIp = $this->ipCurl();
		//return (!isset($objIp->country)) ? 'US' : $objIp->country;
		print_r($objIp);
	}
	
	private function ipCurl() {
		$this->curluri = $this->host;
		$this->curluri .= (($this->ip == '') || (empty($this->ip))) ? 'json' : $this->ip.'/json';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->curluri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		$this->response = curl_exec($ch);
		curl_close($ch);
		
		$this->response = json_decode($this->response, TRUE);
		
 		if(!is_array($this->response)) {
			$this->response = array('error' => $this->response);
		} 
		
		return (object)$this->response;
	} 
}


$obj = new ipinfo();
print_r($obj->fetch());
