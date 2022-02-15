<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 회원관리 컨트롤러
 * @date 2018.2.26
 * @author b
 */
class Member extends Base_controller_admin {
	public function __construct(){
		parent::__construct();

		$this->load->model('admin/user_m');
	}

	//회원 리스트
	public function lists( $page = 1 ){
		if($this->uri->segment(4)){
			$page = $this->security->xss_clean($this->uri->segment(4));
		}

		$max = 20;
		$input = array(
						'method'      => __METHOD__,
						'user_data'   => $this->session->userdata('admin'),
						'page'        => $page,
						'max'         => $max,
						'search_text' => addslashes($this->input->post('search_text', true))
					);
		$this->saveAndSelectInput( $input );
		$data = $this->user_m->getListWithPaging( $input );
		$contents = $this->load->view('/admin/member_v',
										array( 
												'data'  => $data,
												'input' => $input
											), true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function regist(){
		$contents = $this->load->view('/admin/member_regist_v',array(),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function modify($id){
		$data = $this->user_m->get($id);
		$contents = $this->load->view('/admin/member_modify_v',
										array('data' => $data),
										true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}
}