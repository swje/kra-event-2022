<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 코드 모델
 *
 * @date 2018.3.1
 * @author b
 */
class Code_m extends Base_model{
	public function __construct(){
		parent::__construct();
	}

	public function getEventCode($type = 'ticket'){
		$result = "";
		$sql = "SELECT * FROM code
				WHERE
					code_use_yn = 'Y'
				AND code_type = '".$type."'
				";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			$data = $query->row_array();
			
			$result = $data['code_value'];
			
		}

		return $result;
	}
}
