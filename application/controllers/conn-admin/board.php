<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 게시판 액션 컨트롤러
 * @date 2015.12.03
 * @author DAONSNC b
 */
class Board extends Base_controller_admin {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/board_m');
	}
	
	public function write(){
		$admin = $this->session->userdata('admin');
	
		$input = array(
				'board_division' => $this->input->post('board_division', true),
				'board_title'    => htmlspecialchars($this->input->post('board_title', true),ENT_QUOTES),
				'board_content'  => addslashes($this->input->post('board_content')),
				'board_use_yn'   => $this->input->post('board_use_yn', true)
			);
		$this->board_m->insert($input);
		
	}

	public function modify(){
		$input = array(
				'board_id'       => $this->input->post('board_id', true),
				'board_division' => $this->input->post('board_division', true),
				'board_title'    => htmlspecialchars($this->input->post('board_title', true),ENT_QUOTES),
				'board_content'  => addslashes($this->input->post('board_content')),
				'board_use_yn'   => $this->input->post('board_use_yn', true),
			);
		$this->board_m->update($input);
	}

	public function checkDelete(){
		$input = array(
						'selected' => $this->input->post('selected', true)
					);
		$this->board_m->delete($input);
	}


	public function setUseYn(){
		$input = array(
						'board_id'     => $this->input->post('board_id',true),
						'board_use_yn' => $this->input->post('board_use_yn',true)
					);
		$this->board_m->setUseYn($input);
	}

}
/* End of file board.php */
/* Location: /application/controllers/conn-admin/board.php */