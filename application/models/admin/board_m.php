<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 게시판 모델
 *
 * @date 2018.2.26
 * @author b
 */
class Board_m extends Base_model_admin{
	
	public function __construct(){
		parent::__construct();
	}

	public function getList( $input ){
		$result = array();
		$list = array();
		$last_page = 1;

		//paging
		if(! empty($input['page'])){
			if(! is_numeric($input['page'])){
                $input['page'] = 1;   
            }
			$start = ( $input['page'] - 1 ) * $input['max'];
		}else{
			$start = 0;
		}
		$max = $input['max'];
		$limit = ' LIMIT '.$start.','.$max;

		//카테고리 선택
		$where = " WHERE 
						board_division = '" . $input['board_division'] . "' 
				";
		
		//total count
		$sql = "SELECT count(*) as total 
				FROM 
					board 
				$where
				";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$total = $result['total'];
		if($total > 0){
			$last_page = ceil($total / $max);
		}
		//datas
		$sql = "SELECT * 
				FROM 
					board 
				$where
				ORDER BY board_id ASC
				$limit";

		$query = $this->db->query($sql);
		$list = $query->result_array();
		if(! empty($list)){
			$index_no = $this->calculateItemNo($total, $input['page'], $max);
			foreach($list as $key => $val):
				//new mark
				//$list[$key]['is_new'] = $this->checkNewFlag($val);
				$list[$key]['index_no'] = $index_no;

				$index_no--;
				
			endforeach;
		}

		$pagination_html = $this->pagination(array(
													'total'      => $total,
													'page'       => $input['page'],
													'page_limit' => 5,
													'max'        => $max
											));
	
		$result = array('total'        => $total,
						'data'         => $list,
						'page'         => $input['page'],
						'max'          => $max,
						'last_page'    => $last_page,
						'pagination'   => $pagination_html
				);
		return $result;
	}

	public function get( $board_id ){
		$result = NULL;
		$sql = "SELECT * 
				FROM board 
				WHERE 
					board_id = '".$board_id."'
				";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}

	/**
	 * 게시물 추가
	 *
	 */
	public function insert( $input ){
		
		$sql = "INSERT INTO board
				SET 
					board_division   = '".$input['board_division']."',
					board_title      = '".$input['board_title']."',
					board_content    = '".$input['board_content']."',
					board_use_yn     = '".$input['board_use_yn']."',
					board_regdate    = NOW()					
				";
		if($this->db->query($sql)){
			$return_url = '/admin/board/lists/'.$input['board_division'];
			$this->response(array(  'result'     => 'success',
									'return_url' => $return_url));
		}else{
			return $this->response(array('result' => 'fail','msg' => '데이터 입력 실패'));
		}


	}

	public function update( $input ){
		
		$sql = "UPDATE board
				SET 
					board_title      = '".$input['board_title']."',
					board_content    = '".$input['board_content']."',
					board_use_yn     = '".$input['board_use_yn']."',
					board_editdate   = NOW()
				WHERE
					board_id = '".$input['board_id']."'
				";
		if($this->db->query($sql)){
			$return_url = '/admin/board/lists/'.$input['board_division'];
			$this->response(array(  'result'     => 'success',
									'return_url' => $return_url));	
		}else{
			return $this->response(array('result' => 'fail','msg' => '데이터 입력 실패'));
		}
	}

	public function delete( $input ){
		if(! is_array($input['selected'])){
			$tmp = array();
			array_push($tmp, $input['selected']);
			$input['selected'] = $tmp;
		}
		if(! empty($input['selected'])){
			foreach($input['selected'] as $board_id):
				$sql = "DELETE FROM board 
						WHERE 
							board_id = ".$board_id.";";
				$this->db->query($sql);
			endforeach;
		
			$this->response(array('result' => 'success'), 'json');
		}
	}

	public function setUseYn( $input ){
		$sql = "UPDATE board 
				SET
					board_use_yn = '".$input['board_use_yn']."'
				WHERE 
					board_id = '".$input['board_id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'board_use_yn' => $input['board_use_yn']),'json');
		}else{
			$this->response(array('result' => 'fail', 'msg' => '수정 실패'),'json');
		}
	}
}

/* End of file board_m.php */
/* Location: /application/models/admin/board_m.php */