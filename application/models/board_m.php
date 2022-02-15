<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 게시판 모델
 *
 * @date 2018.3.1
 * @author b
 */
class Board_m extends Base_model{
	public function __construct(){
		parent::__construct();
	}


	//목록 가져오기
	public function getList($board_division){
		$result = "";
		$sql = "SELECT * FROM board
				WHERE
					board_division = '".$board_division."'
				AND board_use_yn = 'Y'
				ORDER BY board_id ASC
				";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			$result = $query->result_array();
			
		}

		return $result;
	}
}