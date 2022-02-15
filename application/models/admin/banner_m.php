<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 배너관리 모델
 *
 * @date 2018.2.26
 * @author b
 */
class Banner_m extends Base_model_admin{
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
		
		$where = "WHERE banner_type = '".$input['banner_type']."'";
		
		$order_by = ' ORDER BY banner_id ASC ';
		
		//total count
		$sql = "SELECT count(*) as total 
				FROM 
					banner 
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
					banner 
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
				FROM banner
				WHERE
					banner_id = '".$id."'
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
		$banner_src = "";
		$banner_src_m = "";
		if(! empty($_FILES['banner_img']['name'])){
			$upload_result = $this->fileUpload('banner_img', 'image');
			$banner_src = $upload_result['url'];
		}
		if(! empty($_FILES['banner_img_m']['name'])){
			$upload_result = $this->fileUpload('banner_img_m', 'image');
			$banner_src_m = $upload_result['url'];
		}

		$sql = "INSERT INTO banner
				SET 
					banner_type     = '".$input['banner_type']."',
					banner_name     = '".$input['banner_name']."',
					banner_src      = '".$banner_src."',
					banner_src_m    = '".$banner_src_m."',
					banner_use_yn   = '".$input['banner_use_yn']."',
					banner_regdate = NOW()
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/banner/lists/'.$input['banner_type']));
		}else{
			$this->response(array('result'=>'fail',
											'msg'=>'DB입력에 실패하였습니다. 관리자에게 문의하세요.'));
		}
	}

	public function update($input){
		$banner_query = "";
		$banner_m_query = "";
		if(! empty($_FILES['banner_img']['name'])){
			$upload_result = $this->fileUpload('banner_img', 'image');
			$banner_query = " banner_src = '".$upload_result['url']."' ,";
		}
		if(! empty($_FILES['banner_img_m']['name'])){
			$upload_result = $this->fileUpload('banner_img_m', 'image');
			$banner_m_query = " banner_src_m = '".$upload_result['url']."' ,";
		}
		$sql = "UPDATE banner
				SET 
					banner_name     = '".$input['banner_name']."',
					$banner_query
					$banner_m_query
					banner_use_yn   = '".$input['banner_use_yn']."',
					banner_editdate = NOW()
				WHERE
					banner_id = '".$input['banner_id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'return_url' => '/admin/banner/lists/'.$input['banner_type']));
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
			foreach($input['selected'] as $banner_id):
				$sql = "DELETE FROM banner 
						WHERE 
							banner_id = ".$banner_id.";";
				$this->db->query($sql);
			endforeach;
		
			$this->response(array('result' => 'success'), 'json');
		}
	}

	public function setUseYn( $input ){
		$sql = "UPDATE banner 
				SET
					banner_use_yn = '".$input['banner_use_yn']."'
				WHERE 
					banner_id = '".$input['banner_id']."'
				";
		if($this->db->query($sql)){
			$this->response(array('result' => 'success', 'banner_use_yn' => $input['banner_use_yn']),'json');
		}else{
			$this->response(array('result' => 'fail', 'msg' => '수정 실패'),'json');
		}
	}

	public function getBannerTypeKor($banner_type){
		$banner_type_kor = "";
		switch($banner_type){
			case 'main':
				$banner_type_kor = "메인 이미지";
				break;
			case 'ing':
				$banner_type_kor = "이벤트 안내 이미지";
				break;
			case 'end':
				$banner_type_kor = "이벤트 종료 이미지";
				break;
			case 'detail':
				$banner_type_kor = "자세히보기 배경 이미지";
				break;
			case 'footer':
				$banner_type_kor = "푸터 배경 이미지";
				break;
			case 'sns':
				$banner_type_kor = "SNS 홍보 이미지";
				break;
			case 'season':
				$banner_type_kor = "시즌 이벤트 메인 이미지";
		}

		return $banner_type_kor;

	}

	public function getBannerSize($banner_type){
		$size = array();
		switch($banner_type){
			case 'main':
			case 'season':
				$size['pc'] = "(1920 x 770)";
				$size['mobile'] = "(720 x 711)";
				break;
			case 'ing':
				$size['pc'] = "(980 x 283)";
				$size['mobile'] = "(640 x 673)";
				break;
			case 'end':
				$size['pc'] = "(903 x 183)";
				$size['mobile'] = "(720 x 330)";
				break;
			case 'detail':
				$size['pc'] = "(1920 x 657)";
				$size['mobile'] = "(722 x 1251)";
				break;
			case 'footer':
				$size['pc'] = "(1920 x 196)";
				$size['mobile'] = "(722 x 1251)";
				break;
			case 'sns':
				$size['pc'] = "(1200 X 630)";
				$size['mobile'] = "(1200 X 630)";
				break;
		}

		return $size;
	}

}