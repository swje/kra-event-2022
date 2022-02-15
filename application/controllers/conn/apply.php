<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 이벤트 신청 액션 컨트롤러
 * @date 2018.3.2
 * @author b
 */
class Apply extends Base_controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('board_m');
	}

	public function send(){
		$return_type = $this->input->post('return_type', true);
		if(empty($return_type)){
			$return_type = 'script';
		}

		$input = array(
						'evntNo'          => $this->input->post('evntNo', true),
						'cstNm'           => $this->input->post('cstNm', true),
						'infoPuseAgrDttm' => date("YmdHis"),
						'hp'              => $this->input->post('hp', true),
						'birdt'           => $this->input->post('birdt', true),
						'gen'             => $this->input->post('gen', true),
						'letsrunPark'     => $this->input->post('letsrunPark', true)
					);
		$url = "http://icrm.kra.co.kr/agreements/agreements.crm";
		
		$auth_info = $this->session->userdata('auth_info');
		if(empty($auth_info['CI'])){
			$this->response(array(  'result'     => 'fail',
									'msg' 		 => '본인인증 정보가 없습니다. 다시 본인인증을 진행해 주세요.',
									'return_url' => '/'),$return_type);
		}else{
			$input['prhsAutnVal'] = $auth_info['CI'];
		}

		$this->writeFileLog(__FUNCTION__.' / '.$this->request_number, 'post', $input, $type = 'input', 'apply_log');
		
		$result = $this->board_m->call($url,'POST',$input);
		
		$this->writeFileLog(__FUNCTION__.' / '.$this->request_number, $this->request->method, $result, $type = 'ouput', 'apply_log');
		
		
		 // $this->response(array(  'result'     => 'success',
		 // 							'msg' => '테스트 신청 완료 되었습니다.(실제 요청 X)',
		 // 							'return_url' => '/'),$return_type);
		
		if($result['code'] == 100){
			$this->response(array(  'result'     => 'success',
									'msg' => '신청 완료 되었습니다.',
									'return_url' => '/'),$return_type);
		}else{
			
			$msg = "기타오류";

			switch($result['code']){
				case 101:
					$msg = "성명 오류";
					break;
				case 102:
					$msg = "휴대폰번호 오류";
					break;
				case 103:
					$msg = "생년월일 오류";
					break;
				case 104:
					$msg = "성별 오류";
					break;
				case 105:
					$msg = "주소 오류";
					break;
				case 106:
					$msg = "동의일자 오류";
					break;
				case 107:
					$msg = "담당부서 오류";
					break;
				case 108:
					$msg = "담당자 아이디 오류";
					break;
				case 109:
					$msg = "이벤트번호 오류";
					break;
				case 110:
					$msg = "이메일 오류";
					break;
				case 111:
					$msg = "참여파크 오류";
					break;	
				case 999:
					$msg = "프로세스 예외 발생";
					break;																												
			}
			$this->response(array('result' => 'fail','msg' => '입력정보가 올바르지 않습니다.('.$msg.')'),$return_type);
		}
	}
}