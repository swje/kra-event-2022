<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 배너 모델
 *
 * @date 2018.3.1
 * @author b
 */
class Banner_m extends Base_model{
	public function __construct(){
		parent::__construct();
	}


	//배너 가져오기
	public function get($banner_type = "main", $mobile = false){
		$result = "";
		$sql = "SELECT * FROM banner
				WHERE
					banner_type = '".$banner_type."'
				AND banner_use_yn = 'Y'
				";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			$data = $query->row_array();
			if($mobile){
				$result = $data['banner_src_m'];
			}else{
				$result = $data['banner_src'];
			}
		}

		return $result;
	}
}