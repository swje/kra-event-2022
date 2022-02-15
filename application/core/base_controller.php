<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * 베이스 컨트롤러
 * @date 2014.12.03
 * @author b
 */
class Base_controller extends CI_Controller{

	public    $protocol;
	protected $ajax_request;
	protected $return_type;
	public $request;
	public $request_number;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url','array');
		$this->load->library('session');
		$this->detectRequestType();

		//session check
		//$this->sessionCheck();

		$this->request = new stdClass();
		$this->request->method = $this->detectMethod();

		$this->request_number = date('Ymd').'_'.rand(1000,9999);

		$this->output->set_header("Content-Type: text/html; charset=UTF-8;");
	}


	/**
	 * ajax 요청인지 검사
	 *
	 * @access protected
	 */
	protected function detectRequestType(){
		if( strtolower($this->input->server('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest' ){
			//it's ajax call
			$this->ajax_request = TRUE;
			$this->return_type = 'json';
		}else{
			$this->ajax_request = FALSE;
			$this->return_type = 'script';
		}
	}

	/**
	 * 세션 체크
	 * @access public
	 */
	public function sessionCheck(){
		switch (ENVIRONMENT){
			case 'development':
				break;
			case 'testing':
			case 'production':
				$host = $this->input->server('HTTP_HOST');
				if(substr_count($host, "www.") != 1){
					//redirect("http://www.domain");
				}
				break;
		}	

		$request = $this->uri->ruri_string();
		$uri_string = $this->uri->uri_string();
		$uri = explode('/', $uri_string);

		//세션없이 접근가능한 method
		$allow_array = array(
							"/main/index"
						);
		if(! in_array($request, $allow_array)){
			$user_info = $this->session->userdata('user');
			if(empty($user_info)){
				syslog(LOG_INFO,"redirect / ".$request);
				if($uri[0] == 'conn'){
					$this->response(array('result'=>'fail','msg'=>'로그인이 필요합니다.','return_url'=>'/main/index'),$this->return_type);
				}else{
					redirect('/main/index');
				}
			}
		}
	}

	/**
	 * IP check
	 * @access public
	 */
	public function ipCheck(){
		$check = FALSE;
		$ip = $this->input->server('REMOTE_ADDR');
		$allow_list = array(''
				);
		foreach($allow_list as $val):
			$result = $this->ipInRange( $ip, $val );
			if($result == TRUE){
				$check = TRUE;
			}
		endforeach;

		if($check != TRUE){
			show_404();
		}
	}

	/**
	 * Check if a given ip is in a network
	 * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
	 * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
	 * @return boolean true if the ip is in this range / false if not.
	 */
	public function ipInRange( $ip, $range ) {
		if ( strpos( $range, '/' ) == false ) {
			$range .= '/32';
		}
		// $range is in IP/CIDR format eg 127.0.0.1/24
		list( $range, $netmask ) = explode( '/', $range, 2 );
		$range_decimal = ip2long( $range );
		$ip_decimal = ip2long( $ip );
		$wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
		$netmask_decimal = ~ $wildcard_decimal;
		return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
	}

	
	/**
	 * 관리자 메뉴명 활성화 처리
	 * @param string $top_menu
	 * @param string $left_menu
	 * 
	 * @access public
	 * @return array
	 */
	public function getLayout($first='', $second=''){
		if( empty($first)){
			$first = $this->uri->segment(1);
		}
		if( empty($second)){
			$second = $this->uri->segment(2);
		}
		
	
		$user_data = $this->session->userdata('user');
		$menu_div = "U";
		$menu_templet = '/layout/left_menu_user_v';
		

		$date_list = array(
						'week' => array('from' => date('Y-m-d',strtotime('-8 day')),
										'to'   => date('Y-m-d',strtotime('-1 day'))
									),
						'week2' => array('from' => date('Y-m-d',strtotime('-15 day')),
										'to'   => date('Y-m-d',strtotime('-1 day'))
									),
						'month1' => array('from' => date('Y-m-d',strtotime('-1 month')),
										'to'   => date('Y-m-d',strtotime('-1 day'))
									),
						'month3' => array('from' => date('Y-m-d',strtotime('-3 month')),
										'to'   => date('Y-m-d',strtotime('-1 day'))
									),
						'month3' => array('from' => date('Y-m-d',strtotime('-6 month')),
										'to'   => date('Y-m-d',strtotime('-1 day'))
									),
						'thismonth' => array('from' => date('Y-m')."-1",
										'to'   => date('Y-m-d', strtotime('-1 day'))
									),
						'm1month' => array('from' => date('Y-m', strtotime('-1 month'))."-1",
										'to'   => date("Y-m-d", mktime(0, 0, 0, intval(date('m')), 0, intval(date('Y'))  ))
									)
					);

		$data = array(
						'is_mobile' => $this->isMobile(),
						'1depth'    => $first,
						'2depth'    => $second,
						'user_data' => $user_data,
						'menu_div'  => $menu_div,
						'date_list' => json_encode($date_list),
						'is_app_connect' => $this->session->userdata('is_app_connect')
					);
		
		return $data;
	}

	public function isMobile(){
		$is_mobile = false;
	
		//agent check
		$mobile_agent_list = array("/android/","/iphone/","/mobile/","/blackberry/","/windows ce/","/lg/","/samsung/","/sonyericsson/");
		foreach($mobile_agent_list as $key => $value):
			if(preg_match($value,strtolower($_SERVER["HTTP_USER_AGENT"]))){
				$is_mobile = true;
			}
		endforeach;
		
		return $is_mobile;
	}


	/**
	 * 숫자를 문자열로 변환
	 *
	 * @param array  &$data
	 *
	 * @access protected
	 * @return array
	 */
	protected function intToNumberFormat( &$data ){
		$not_change_list = array(
								'regdate',
								'date',
								'editdate',
								'userid'								
							);
		if(is_array($data)){
			foreach($data as $key => $val):
				if(is_numeric( $val ) && ! in_array(strtolower($key), $not_change_list)){
					$data[$key] = number_format($val);	
				}else if(is_array( $val )){
					//array인 경우 recusive call
					$data[$key] = $this->intToNumberFormat( $val );
				}			
			endforeach;
		}	
		return $data;
	}

	/**
	 * 결과 출력
	 * base_model에 있으나 컨트롤러에서 리턴하는 경우도 있음.
	 * @param $data
	 * @access protected
	 */
	protected function response( $data = array(), $type='script'){
		switch($type){
			case 'script':
				header("Content-Type: text/html; charset=UTF-8;");
				if($data['result'] != 'fail'){
					if(empty($data['msg'])){
						$data['msg'] = '정상처리 되었습니다.';
					}
				}
				$location_action = "";
				if(! empty($data['script'])){
					$location_action = $data['script'];
				}
				if(! empty($data['return_url'])){
					$location_action .= "location.href='".$data['return_url']."';";
				}else{
					$location_action .= "history.back();";
				}			
				if($data['msg'] == 'empty'){
					exit("<script>".$location_action."</script>");
				}else{
					exit("<script>alert('".$data['msg']."');".$location_action."</script>");
				}
			case 'json':
				header('Content-Type: text/html');
				header('HTTP/1.1: 200');
				header('Status: 200');
				if( empty( $data['result'] )){
					$result = array(
									'result' => 'success',
									'code'=>'200',
									'msg'=>'',
									'data'=>$data
							  );
				}else{
					$result = $data;
				}
				$result['responsedate'] = date('Y-m-d H:i:s');
				exit(json_encode($result));
		}
	}

	/**
	 * input 데이터 세션 저장
	 * @param array $input
	 * @access public
	 */
	public function saveAndSelectInput(& $input ){
		$stored_data = $this->session->userdata('input');
		if(! empty($stored_data)
			&& $stored_data['method'] == $input['method']
			&& ( $stored_data['page'] != $input['page'] //페이지가 변경되었는지
				|| $this->session->userdata('is_restore') == TRUE )){ //세션에 복원여부 설정되어있는지

			//페이지 변경
			$stored_data['page'] = $input['page'];
			
			$input = $stored_data;

			$this->session->set_userdata('is_restore',FALSE);
		}
		$this->session->set_userdata('input', $input);		
	}

	/**
	 * Detect method
	 * Detect which method (POST, PUT, GET, DELETE) is being used
	 * @return string
	 */
	protected function detectMethod(){
		$method = strtolower($this->input->server('REQUEST_METHOD'));

		if($this->config->item('enable_emulate_request')){
			if($this->input->post('_method')){
				$method = strtolower($this->input->post('_method'));
			}else if($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE')){
				$method = strtolower($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
			}
		}
		if(in_array( $method, array('get', 'delete', 'post', 'put') )){
			return $method;
		}
		return 'get';
	}

	/**
	 * API 요청 내역 파일 기록
	 * @param string $function_name
	 * @param string $method (GET,POST,PUT,DELETE)
	 * @param array  $data
	 * @param string $type ( input, output )
	 */
	protected function writeFileLog($function_name, $method, $data, $type = 'input', $file_name = 'api_log'){
		$year_month = date('Ym');
		$log_path = $_SERVER['DOCUMENT_ROOT'].'/_log/'.$year_month;
		if(! is_dir($log_path)){
			@mkdir($log_path);
			@chmod($log_path,0777);
		}
		if(is_dir($log_path)){
			$file = fopen($log_path.'/'.$file_name.'_'.date('Ymd').'.txt','a');

			$text = "-----------------------------------------------------------------------\r\n";
			$text .= "[".$function_name."] ".date('Y-m-d H:i:s')."\r\n";
			$text .= "* method : ".$method." / remote address : ".$_SERVER['REMOTE_ADDR']."\r\n";
			$text .= "* $type : ".print_r($data,true)."\r\n";

			fwrite($file,$text);
			fclose($file);
		}
	}

}

/* End of file base_controller.php */
/* Location: /application/controllers/base_controller.php */