<?php
/**
 * 에러 전송 클래스
 * @author b
 * @date 2014.3.14 
 */
class Error_sender{
	
	private $url;

	public function __construct(){
		$this->url = "http://www.daonsnc.com/api_v1/collector/regist";
	}

	public function sendError( $error_data ){
		if($error_data['type'] == 'db'){
			$div = 'database';
			$error_data['file'] = $_SERVER['SCRIPT_FILENAME'];
		}else{
			$div = $this->convertErrorCodeToConstant( $error_data['type'] );
			$error_data['code'] = $error_data['type'];
			$error_data['message'] = $error_data['message'].'(line : '.$error_data['line'].')';
		}
		if(isset($_SESSION['sc_id'])){
			$user_id = $_SESSION['sc_id'];
		}else{
			$user_id = '';
		}
		if($div == 'notice'){
			//notice 수가 너무 많아서 수집 안함.
			return TRUE;
		}
		$referer_uri = '';
		if(isset($_SERVER['HTTP_REFERER'])){
			$referer_uri = $_SERVER['HTTP_REFERER'];
		}
		if($this->is_cli_request()){
			$_SERVER['SERVER_ADDR'] = "127.0.0.1";
			$_SERVER['HTTP_HOST'] = "CLI REQUEST";
			$_SERVER['REQUEST_URI'] = "";
			$_SERVER['REMOTE_ADDR'] = "127.0.0.1";
		}
		$input = array(
						'error_div' => $div,
						'server_ip' => $_SERVER['SERVER_ADDR'],
						'site_domain' => $_SERVER['HTTP_HOST'],
						'request_uri' => $_SERVER['REQUEST_URI'],
						'referer_uri' => $referer_uri,
						'file_path' => $error_data['file'],
						'error_code' => $error_data['code'],
						'error_msg' => $error_data['message'],
						'remote_ip' => $_SERVER['REMOTE_ADDR'],
						'user_id' => $user_id
						);
		$this->requestAsync($this->url,'POST', $input);
		//$result = $this->call($this->url,'POST', $input);
		//syslog(LOG_INFO,'result : '.print_r($result,true));
		return TRUE;
	}
	/**
	 * Server curl call
	 * @param string $url
	 * @param string $method
	 * @param mixed  $data
	 * @param array  $headers
	 *
	 * @access public
	 * @return array
	 */
	public function call($url, $method, $data = NULL, $headers = NULL){
		$ch = curl_init();
		if( empty($headers)){
			$headers = array(
							'Accept: text/html'
						);
		}
		if(! empty($data) && is_array($data)){
			$params = $this->buildHttpQuery($data);
		}else{
			$params = $data;
		}

		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		switch($method){
			case 'FILE':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			case 'PUT':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			case 'DELETE':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			default:
				//GET is CURL default
				break;
		}
		//set URL
		curl_setopt($ch, CURLOPT_URL, $url);

		try{
			$return = curl_exec($ch);
			curl_close($ch);
			syslog(LOG_INFO,'result 1: '.print_r($return,true));
			$return = $this->objectToArray(json_decode($return));
		}catch(Exception $e){
			$return = $e->getMessage();
		}
		return $return;
	}
	/**
     * Array를 QueryString으로 변환
     *
     * @param array $array          
     * @param string $urlencode         
     * @return string http query string
     */
	public function buildHttpQuery($array, $urlencode = 'Y') {
		$query_array = array();
		foreach ( $array as $key => $key_value ):
			if ($urlencode == 'Y') {
				$query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
			}else{
				$query_array[] = $key . '=' . $key_value;
			}
		endforeach;
		return implode ( '&', $query_array );
	}

	/**
     *
     * Convert an object to an array
     * Also converts objects within objects / arrays
     *
     * @param    object  $object The object to convert
     * @reeturn  array
     *
     */
    public function objectToArray($data){
		if(is_array($data) || is_object($data)){
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->objectToArray($value);
            }
            return $result;
		}
		return $data;
    }
	/**
	 * 소켓을 이용한 비동기식 call
	 * @param $url 
	 * @param $params
	 * @param $type
	 */
	public function requestAsync($url, $type = 'POST', $params) {
		foreach ( $params as $key => &$val ) {
			if (is_array ( $val ))
				$val = implode ( ',', $val );
			$post_params [] = $key . '=' . urlencode ( $val );
		}
		$post_string = implode ( '&', $post_params );
		
		$parts = parse_url ( $url );

		if(empty($parts ['scheme']))
			$parts ['scheme'] == 'http';
			
		if ($parts ['scheme'] == 'http') {
			$fp = fsockopen ( $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 80, $errno, $errstr, 30 );
		} else if ($parts ['scheme'] == 'https') {
			$fp = fsockopen ( "ssl://" . $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 443, $errno, $errstr, 30 );
		}
		
		// Data goes in the path for a GET request
		if ('GET' == $type)
			$parts ['path'] .= '?' . $post_string;
		
		$out = "$type " . $parts ['path'] . " HTTP/1.1\r\n";
		$out .= "Host: " . $parts ['host'] . "\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "Content-Length: " . strlen ( $post_string ) . "\r\n";
		$out .= "Connection: Close\r\n\r\n";
		// Data goes in the request body for a POST request
		if ('POST' == $type && isset ( $post_string ))
			$out .= $post_string;
		
		fwrite ( $fp, $out );
		fclose ( $fp );
	}
	
	/**
	 * PHP오류 코드 문자로 변환
	 * @param $code
	 */
	private function convertErrorCodeToConstant( $code ){
		$constant = '';

		switch( $code ){
				case '1':
					$constant = 'fatal';
					break;
				case '2':
					$constant = 'warning';
					break;
				case '8':
					$constant = 'notice';
					break;
				case '64':
					$constant = 'fatal';
					break;
				case '256':
					$constant = 'user_error';
					break;
				case '512':
					$constant = 'user_warning';
					break;
				case '1024':
					$constant = 'user_notice';
					break;
				case '4096':
					$constant = 'recoverable_error';
					break;
				case '8191':
					$constant = 'all';
					break;
				default:
					$constant = 'unknown';
					break;
			}
		return $constant;
	}

	public function is_cli_request(){
		return (php_sapi_name() === 'cli' OR defined('STDIN'));
	}
}