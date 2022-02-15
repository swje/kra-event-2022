<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 메인페이지 컨트롤러
 * @date 2018.2.26
 * @author b
 */
class Main extends Base_controller_admin {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('/admin/login_v');
	}
}