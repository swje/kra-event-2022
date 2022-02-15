<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 메인페이지 컨트롤러
 * @date 2017.12.20
 * @author b
 */
class Main extends Base_controller {

	private $templet_root = "";
	private $mobile = false;
	private $is_end = false;

	public function __construct(){
		parent::__construct();

		$this->load->model("banner_m");

		if($this->isMobile()){
			$this->templet_root = "/mobile";
			$this->mobile = true;
		}
		//for test
		//$this->templet_root = "/mobile";
		//$this->mobile = true;

		
		$test = $this->banner_m->get("end",$this->mobile);
		if(! empty($test)){
			$this->is_end = true;
		}
	}
	
	public function index(){
		$apply_banner = $this->banner_m->get("ing",$this->mobile);
		$end_banner = $this->banner_m->get("end",$this->mobile);
		

		$detail_back = $this->banner_m->get("detail",$this->mobile);

		$contents = $this->load->view($this->templet_root.'/main_v',
										array( 
												'apply_banner' => $apply_banner,
												'end_banner'   => $end_banner,
												'detail_back'  => $detail_back,
												'is_end'       => $this->is_end
											), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/default_v',
							array(
								'main_banner' => $this->banner_m->get("main",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents,
								'is_end'      => $this->is_end
							));
	
	}

	public function apply(){

		if($this->is_end){
			$this->response(array("result"=>"fail","msg"=>"입장권 신청 이벤트가 종료 되었습니다.","return_url"=>"/"));
		}
		$this->load->model('code_m');
		$event_code = $this->code_m->getEventCode('ticket');
		$contents = $this->load->view($this->templet_root.'/apply_v',
										array('event_code' => $event_code), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/default_v',
							array(
								'main_banner' => $this->banner_m->get("main",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents
							));
	}

	public function applyNext(){
		if($this->is_end){
			$this->response(array("result"=>"fail","msg"=>"입장권 신청 이벤트가 종료 되었습니다.","return_url"=>"/"));
		}

		$auth_info = array(
					'CP_CD'				=> $this->input->post("CP_CD",true),		// 회원사코드
					'TX_SEQ_NO'			=> $this->input->post("TX_SEQ_NO",true),	// 거래번호
					'RSLT_CD'			=> $this->input->post("RSLT_CD",true),	// 결과코드
					'RSLT_MSG'			=> $this->input->post("RSLT_MSG",true),	// 결과메세지
					'RSLT_NAME'			=> $this->input->post("RSLT_NAME",true),	// 성명
					'RSLT_BIRTHDAY'		=> $this->input->post("RSLT_BIRTHDAY",true),// 생년월일
					'RSLT_SEX_CD'		=> $this->input->post("RSLT_SEX_CD",true),// 성별
					'RSLT_NTV_FRNR_CD'	=> $this->input->post("RSLT_NTV_FRNR_CD",true), // 내외국인구분
					'DI'	            => $this->input->post("DI",true),			// DI
					'CI'	            => $this->input->post("CI",true),			// CI
					'CI_UPDATE'			=> $this->input->post("CI_UPDATE",true),	// CI 업데이트
					'TEL_COM_CD'		=> $this->input->post("TEL_COM_CD",true),	// 통신사코드
					'TEL_NO'            => $this->input->post("TEL_NO",true),		// 휴대폰번호
					'RETURN_MSG'		=> $this->input->post("RETURN_MSG",true)	// 리턴메시지

			);

		if(empty($auth_info['RSLT_NAME']) OR empty($auth_info['RSLT_BIRTHDAY']) OR empty($auth_info['TEL_NO'])){
			$this->response(array("result"=>"fail","msg"=>"본인인증을 진행해주세요..","return_url"=>"/main/apply"));
		}
		$this->session->set_userdata(array('auth_info' => $auth_info));

		$this->load->model('code_m');
		$event_code = $this->code_m->getEventCode('ticket');
		$contents = $this->load->view($this->templet_root.'/apply_next_v',
										array(  'event_code'    => $event_code,
												'user_name'     => $auth_info['RSLT_NAME'],
												'user_birthday' => $auth_info['RSLT_BIRTHDAY'],
												'user_sex'      => $auth_info['RSLT_SEX_CD'],
												'user_tel'      => $auth_info['TEL_NO']
											), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/default_v',
							array(
								'main_banner' => $this->banner_m->get("main",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents
							));
	}

	public function faq(){

		$this->load->model("board_m");
		$data = $this->board_m->getList('faq');
		$contents = $this->load->view($this->templet_root.'/faq_v',
										array( 
												'data'   => $data,
												'is_end' => $this->is_end
											), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/default_v',
							array(
								'main_banner' => $this->banner_m->get("main",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents,
								'is_end'      => $this->is_end
							));
	}

	public function season(){
		$this->load->model('code_m');
		$event_code = $this->code_m->getEventCode('season');
		$contents = $this->load->view($this->templet_root.'/season_v',
										array('event_code' => $event_code), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/simple_v',
							array(
								'main_banner' => $this->banner_m->get("season",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents
							));
	}

	public function seasonNext(){
		$this->load->model('code_m');
		$event_code = $this->code_m->getEventCode('season');

		$auth_info = array(
					'CP_CD'				=> $this->input->post("CP_CD",true),		// 회원사코드
					'TX_SEQ_NO'			=> $this->input->post("TX_SEQ_NO",true),	// 거래번호
					'RSLT_CD'			=> $this->input->post("RSLT_CD",true),	// 결과코드
					'RSLT_MSG'			=> $this->input->post("RSLT_MSG",true),	// 결과메세지
					'RSLT_NAME'			=> $this->input->post("RSLT_NAME",true),	// 성명
					'RSLT_BIRTHDAY'		=> $this->input->post("RSLT_BIRTHDAY",true),// 생년월일
					'RSLT_SEX_CD'		=> $this->input->post("RSLT_SEX_CD",true),// 성별
					'RSLT_NTV_FRNR_CD'	=> $this->input->post("RSLT_NTV_FRNR_CD",true),// 내외국인구분
					'DI'	            => $this->input->post("DI",true),			// DI
					'CI'	            => $this->input->post("CI",true),			// CI
					'CI_UPDATE'			=> $this->input->post("CI_UPDATE",true),	// CI 업데이트
					'TEL_COM_CD'		=> $this->input->post("TEL_COM_CD",true),	// 통신사코드
					'TEL_NO'            => $this->input->post("TEL_NO",true),		// 휴대폰번호
					'RETURN_MSG'		=> $this->input->post("RETURN_MSG",true)	// 리턴메시지

			);

		if(empty($auth_info['RSLT_NAME']) OR empty($auth_info['RSLT_BIRTHDAY']) OR empty($auth_info['TEL_NO'])){
			$this->response(array("result"=>"fail","msg"=>"본인인증을 진행해주세요..","return_url"=>"/main/apply"));
		}
		$this->session->set_userdata(array('auth_info' => $auth_info));

		$contents = $this->load->view($this->templet_root.'/season_next_v',
										array('event_code'      => $event_code,
												'user_name'     => $auth_info['RSLT_NAME'],
												'user_birthday' => $auth_info['RSLT_BIRTHDAY'],
												'user_sex'      => $auth_info['RSLT_SEX_CD'],
												'user_tel'      => $auth_info['TEL_NO']
											), true);
		//call layout
		$this->load->view($this->templet_root.'/layout/simple_v',
							array(
								'main_banner' => $this->banner_m->get("season",$this->mobile),
								'footer_back' => $this->banner_m->get("footer",$this->mobile),
								'sns_image'   => $this->banner_m->get("sns",$this->mobile),
								'layout'      => $this->getLayout(),
								'contents'    => $contents
							));
	}

}