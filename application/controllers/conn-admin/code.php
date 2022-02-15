<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 코드관리 액션 컨트롤러
 * @date 2018.2.27
 * @author b
 */
class Code extends Base_controller_admin {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/code_m');
	}
	

	public function regist(){
		$input = array(
						'code_name'   => $this->input->post('code_name', true),
						'code_type'   => $this->input->post('code_type', true),
						'code_value'  => $this->input->post('code_value', true),
						'code_use_yn' => $this->input->post('code_use_yn', true)
				);
		$this->code_m->insert($input);
	}

	public function modify(){
		$input = array(
						'code_id'     => $this->input->post('code_id', true),
						'code_type'   => $this->input->post('code_type', true),
						'code_name'   => $this->input->post('code_name', true),
						'code_value'  => $this->input->post('code_value', true),
						'code_use_yn' => $this->input->post('code_use_yn', true)
				);
		$this->code_m->update($input);
	}

	public function checkDelete(){
		$input = array(
						'selected' => $this->input->post('selected', true)
					);
		$this->code_m->delete($input);
	}

	public function setUseYn(){
		$input = array(
						'code_id'     => $this->input->post('code_id',true),
						'code_use_yn' => $this->input->post('code_use_yn',true)
					);
		$this->code_m->setUseYn($input);
	}
}