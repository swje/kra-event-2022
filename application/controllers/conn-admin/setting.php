<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * 액션 컨트롤러
 *
 * @date 2018.2.5
 * @author DAONSNC b
 */
class Setting extends Base_controller{

	public function __construct(){
		parent::__construct();
	
	}

	public function leftMenuToggle(){
		$left_menu_toggle = $this->session->userdata('left_menu_toggle');
		
		if($left_menu_toggle == TRUE){
			$left_menu_toggle = FALSE;
		}else{
			$left_menu_toggle = TRUE;
		}

		$this->session->set_userdata('left_menu_toggle', $left_menu_toggle);
	}
}

/* End of file setting.php */
/* Location: /application/controllers/conn/setting.php */