<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 코드관리 액션 컨트롤러
 * @date 2018.2.27
 * @author b
 */
class Banner extends Base_controller_admin {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/banner_m');
	}
	

	public function regist(){
		$input = array(
						'banner_type'   => $this->input->post('banner_type', true),
						'banner_name'   => $this->input->post('banner_name', true),
						'banner_use_yn' => $this->input->post('banner_use_yn', true)
				);
		$this->banner_m->insert($input);
	}

	public function modify(){
		$input = array(
						'banner_id'     => $this->input->post('banner_id', true),
						'banner_type'   => $this->input->post('banner_type', true),
						'banner_name'   => $this->input->post('banner_name', true),
						'banner_use_yn' => $this->input->post('banner_use_yn', true)
				);
		$this->banner_m->update($input);
	}

	public function checkDelete(){
		$input = array(
						'selected' => $this->input->post('selected', true)
					);
		$this->banner_m->delete($input);
	}

	public function setUseYn(){
		$input = array(
						'banner_id'     => $this->input->post('banner_id',true),
						'banner_use_yn' => $this->input->post('banner_use_yn',true)
					);
		$this->banner_m->setUseYn($input);
	}
}