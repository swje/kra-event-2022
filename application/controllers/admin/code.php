<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 코드관리 컨트롤러
 * @date 2018.2.26
 * @author b
 */
class Code extends Base_controller_admin {
	public function __construct(){
		parent::__construct();

		$this->load->model('admin/code_m');
	}


	public function lists( $page = 1 ){
		if($this->uri->segment(4)){
			$page = $this->security->xss_clean($this->uri->segment(4));
		}

		$max = 20;
		$input = array(
						'method'      => __METHOD__,
						'page'        => $page,
						'max'         => $max,
						'search_text' => addslashes($this->input->post('search_text', true))
					);
		$this->saveAndSelectInput( $input );


		$data = $this->code_m->getListWithPaging( $input );
		$contents = $this->load->view('/admin/code_v',
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
		$contents = $this->load->view('/admin/code_regist_v',array(),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function modify($id){
		$data = $this->code_m->get($id);
		$contents = $this->load->view('/admin/code_modify_v',
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