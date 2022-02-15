<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 회원관리 모델
 *
 * @date 2018.2.26
 * @author b
 */
class User_m extends Base_model_admin{
	public function __construct(){
		parent::__construct();
	}


	//회원 목록 with 페이징
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
		
		$order_by = ' ORDER BY id ASC ';
		
		//total count
		$sql = "SELECT count(*) as total 
				FROM 
					user 
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
					user 
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

	//회원정보 가져오기
	public function get($id){
		$sql = "SELECT * 
				FROM user
				WHERE
					id = '".$id."'
				";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->row_array();
			
			return $result;
		}else{
			$this->response(array('result'=>'fail','msg'=>'존재하지 않는 데이터입니다.'));
		}
	}

	public function getUserById($id){
		$sql = "SELECT * 
				FROM user
				WHERE
					user_id = '".$id."'
				";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->row_array();
			
			return $result;
		}else{
			return NULL;
		}
	}


	public function loginProcess( $input ){
		$pass = $this->makePassword($input['pass']);

		// 로그인 성공처리
		$sql = "SELECT *
				FROM
					user
				WHERE 
					user_id = '".$input['id']."'
				AND user_pass = '".$pass."'
				";

		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0){	// 로그인 성공 처리
			$result = $query->row_array();
			
			$return_url = '/admin/member/lists';
			$this->session->set_userdata(array('admin' => $result));
			
			$this->response(array(
									'result'     => 'success',
									'return_url' => $return_url,
									'msg'        => 'empty'
							));
		} else {	// 로그인 실패 처리
			$this->response(array(
									'result' => 'fail',
									'msg'    => '계정 또는 패스워드가 틀립니다.'
							));
		}
		
	}

	public function insert($input){
		$sql = "SELECT * FROM user WHERE user_id = '".$input['user_id']."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$this->response(array('result'=>'fail',
											'msg'=>'이미 등록된 ID 입니다.'));
		}
		$sql = "INSERT INTO user
				SET 
					division = 'A',
					user_id = '".$input['user_id']."',
					user_nickname = '".$input['user_nickname']."',
					user_pass = '".$this->makePassword($input['user_pass'])."',
					reg_date = NOW(),
					status = 'O'
				";
				//exit($sql);
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/member/lists'));
		}else{
			$this->response(array('result'=>'fail',
											'msg'=>'DB입력에 실패하였습니다. 관리자에게 문의하세요.'));
		}
	}


	public function update($input){
		$pass_query = "";
		if(! empty($input['user_pass'])){
			$pass_query = " user_pass = '".$this->makePassword($input['user_pass'])."', ";
		}else{
			$this->response(array('result' => 'success', 'return_url' => '/admin/member/lists'));
		}

		$sql = "UPDATE user 
				SET 
					$pass_query
					edit_date = NOW()
				WHERE
					id = '".$input['id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/member/lists'));
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
			foreach($input['selected'] as $id):
				$sql = "DELETE FROM user 
						WHERE 
							id = ".$id.";";
				$this->db->query($sql);
			endforeach;
		
			$this->response(array('result' => 'success'), 'json');
		}
	}


}