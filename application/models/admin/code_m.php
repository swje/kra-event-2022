<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 코드관리 모델
 *
 * @date 2018.2.26
 * @author b
 */
class Code_m extends Base_model_admin{
	public function __construct(){
		parent::__construct();
	}


	//목록 with 페이징
	public function getListWithPaging( $input ){
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
		
		$where = "WHERE 1 = 1";
		
		$order_by = ' ORDER BY code_id ASC ';
		
		//total count
		$sql = "SELECT count(*) as total 
				FROM 
					code 
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
					code 
				$where
				$order_by 
				$limit";
		$query = $this->db->query($sql);
		$list = $query->result_array();
		
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

	//정보 가져오기
	public function get($id){
		$sql = "SELECT * 
				FROM code
				WHERE
					code_id = '".$id."'
				";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->row_array();
			
			return $result;
		}else{
			$this->response(array('result'=>'fail','msg'=>'존재하지 않는 데이터입니다.'));
		}
	}

	public function insert($input){
		$sql = "INSERT INTO code
				SET 
					code_name     = '".$input['code_name']."',
					code_type     = '".$input['code_type']."',
					code_value    = '".$input['code_value']."',
					code_use_yn   = '".$input['code_use_yn']."',
					code_regdate = NOW()
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/code/lists'));
		}else{
			$this->response(array('result'=>'fail',
											'msg'=>'DB입력에 실패하였습니다. 관리자에게 문의하세요.'));
		}
	}

	public function update($input){
		$sql = "UPDATE code
				SET 
					code_name     = '".$input['code_name']."',
					code_type     = '".$input['code_type']."',
					code_value    = '".$input['code_value']."',
					code_use_yn   = '".$input['code_use_yn']."',
					code_editdate = NOW()
				WHERE
					code_id = '".$input['code_id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/code/lists'));
		}else{
			$this->response(array('result'=>'fail',
											'msg'=>'DB입력에 실패하였습니다. 관리자에게 문의하세요.'));
		}
	}

	public function delete( $input ){
		if(! is_array($input['selected'])){
			$tmp = array();
			array_push($tmp, $input['selected']);
			$input['selected'] = $tmp;
		}
		if(! empty($input['selected'])){
			foreach($input['selected'] as $code_id):
				$sql = "DELETE FROM code 
						WHERE 
							code_id = ".$code_id.";";
				$this->db->query($sql);
			endforeach;
		
			$this->response(array('result' => 'success'), 'json');
		}
	}

	public function setUseYn( $input ){
		$sql = "UPDATE code 
				SET
					code_use_yn = '".$input['code_use_yn']."'
				WHERE 
					code_id = '".$input['code_id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'code_use_yn' => $input['code_use_yn']),'json');
		}else{
			$this->response(array('result' => 'fail', 'msg' => '수정 실패'),'json');
		}
	}

}