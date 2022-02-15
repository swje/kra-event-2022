<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 게시판관리 컨트롤러
 * @date 2018.2.26
 * @author b
 */
class Board extends Base_controller_admin {
	public function __construct(){
		parent::__construct();

		$this->load->model('admin/board_m');
	}


	public function lists( $board_division = 'faq', $page = 1 ){
		$board_division = $this->security->xss_clean($board_division);
		$page = $this->security->xss_clean($page);
		
		$max = 20;
		$input = array(
						'method'         => __METHOD__,
						'page'           => $page,
						'board_division' => $board_division,
						'max'            => $max
					);
		$this->saveAndSelectInput( $input );
		$data = $this->board_m->getList( $input );
		$contents = $this->load->view('/admin/board_v',
										array( 
												'board_division' => $board_division,
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
		$contents = $this->load->view('/admin/board_regist_v',array('user_data'   => $this->session->userdata('admin')),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function modify($id){
		$data = $this->board_m->get($id);
		$contents = $this->load->view('/admin/board_modify_v',
										array('data' => $data
										),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

}