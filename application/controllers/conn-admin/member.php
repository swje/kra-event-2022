<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 계정 액션 컨트롤러
 * @date 2017.12.21
 * @author b
 */
class Member extends Base_controller_admin {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/user_m');
	}
	
	public function login(){
		$input = array(
				'id'    => $this->input->post('user_id', true),
				'pass'  => $this->input->post('user_pass', true)
			);
		$this->user_m->loginProcess($input);
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/admin');
	}

	public function regist(){
		$input = array(
						'user_id'       => $this->input->post('user_id', true),
						'user_nickname' => $this->input->post('user_nickname', true),
						'user_pass'     => $this->input->post('user_pass', true)
				);
		$this->user_m->insert($input);
	}

	public function modify(){
		$input = array(
						'id'         => $this->input->post('id', true),
						'user_pass'  => $this->input->post('user_pass', true)
				);
		$this->user_m->update($input);
	}

	public function checkDelete(){
		$input = array(
						'selected' => $this->input->post('selected', true)
					);
		$this->user_m->delete($input);
	}

}