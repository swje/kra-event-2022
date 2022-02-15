<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 배너관리 컨트롤러
 * @date 2018.2.26
 * @author b
 */
class Banner extends Base_controller_admin {
	public function __construct(){
		parent::__construct();

		$this->load->model('admin/banner_m');
	}


	public function lists( $banner_type = 'main', $page = 1 ){
		
		$banner_type = $this->security->xss_clean($banner_type);
		$page = $this->security->xss_clean($page);
		
		$max = 20;
		$input = array(
						'method'      => __METHOD__,
						'banner_type' => $banner_type,
						'page'        => $page,
						'max'         => $max,
						'search_text' => addslashes($this->input->post('search_text', true))
					);
		$this->saveAndSelectInput( $input );
		$data = $this->banner_m->getListWithPaging( $input );
		$contents = $this->load->view('/admin/banner_v',
										array( 
												'banner_type'     => $banner_type, 
												'banner_type_kor' => $this->banner_m->getBannerTypeKor($banner_type),
												'banner_size'     => $this->banner_m->getBannerSize($banner_type),
												'data'            => $data,
												'input'           => $input
											), true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function regist($banner_type){
		$contents = $this->load->view('/admin/banner_regist_v',
															array('banner_type'=> $banner_type, 
																'banner_type_kor' => $this->banner_m->getBannerTypeKor($banner_type),
																'banner_size'     => $this->banner_m->getBannerSize($banner_type)
															),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

	public function modify($id){
		$data = $this->banner_m->get($id);
		$contents = $this->load->view('/admin/banner_modify_v',
										array(
											'data' => $data,
											'banner_type'=> $data['banner_type'], 
											'banner_type_kor' => $this->banner_m->getBannerTypeKor($data['banner_type']),
											'banner_size'     => $this->banner_m->getBannerSize($data['banner_type'])
										),true);
		//call layout
		$this->load->view('/layout-admin/default_v',
							array(
								'layout'     => $this->getLayout(),
								'contents'   => $contents
							));
	}

}