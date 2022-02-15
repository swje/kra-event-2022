<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 관리자 베이스 모델
 *
 * @date 2015.11.9
 * @author b
 */
class Base_model_admin extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}
	
	
	/**
	 * 결과 출력
	 * @param $data
	 * @access protected
	 */
	protected function response( $data = array(), $type='script'){
		switch($type){
			case 'script':
				header("Content-Type: text/html; charset=UTF-8;");
				if($data['result'] != 'fail'){
					if(empty($data['msg'])){
						$data['msg'] = '정상처리 되었습니다.';
					}
				}
				if(! empty($data['return_url'])){
					switch($data['return_url']){
						case 'document.referrer':
							$location_action = "location.href=document.referrer;";
							break;
						case 'RELOAD':
							$location_action = "location.reload(true);";
							break;
						default:
							$location_action = "location.href='".$data['return_url']."';";
							break;
					}		
				}else{
					$location_action = "history.back();";
				}
				if($data['msg'] == 'empty'){
					exit("<script>".$location_action."</script>");
				}else{
					exit("<script>alert('".$data['msg']."');".$location_action."</script>");
				}
			case 'json':
				header('Content-Type: text/html');
				header('HTTP/1.1: 200');
				header('Status: 200');
				if( empty( $data['result'] )){
					$result = array(
									'result' => 'success',
									'code'=>'200',
									'msg'=>'',
									'data'=>$data
							  );
				}else{
					$result = $data;
				}
				$result['responsedate'] = date('Y-m-d H:i:s');
				exit(json_encode($result));
		}
	}

	/**
	 * 파일 업로드 처리
	 * @param array $file
	 * @access public
	 */
	public function fileUpload($field_name, $type='image', $resize = FALSE, $width = 220, $height = 200){
		$year = date('Y');
		$month = date('m');
		$base_path = $this->input->server('DOCUMENT_ROOT').'/uploads/'.$type.'/'.$year.'/'.$month.'/';
		$web_path  = '/uploads/'.$type.'/'.$year.'/'.$month.'/';

		if(! is_dir($base_path)){
			mkdir( $base_path , 0700, true );
		}

		$config['upload_path'] = $base_path;
		$config['max_size'] = 25120;
		
		if( preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $_FILES[$field_name]['name']) ){
			$config['encrypt_name'] = true;
		}else{
			$config['encrypt_name'] = false;
		}
		$config['allowed_types'] = '';
		
		switch($type){
			case 'image':
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				break;
			case 'file':
				$config['allowed_types'] = 'zip|gif|png|jpeg|jpg|txt|hwp|doc|xlsx|xls|pptx|alz|7z';
				break;
			case 'compress':
				$config['allowed_types'] = 'zip|alz|7z';
				break;
			case 'excel':
				$config['allowed_types'] = 'xlsx|xls';
				break;
		}
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if( $this->upload->do_upload( $field_name )){

			$file = $this->upload->data();
			$file_path = $base_path . $file['file_name'];
			$file_url  = $web_path . $file['file_name'];

			switch($type){
				case 'excel':
					return $file_path;
				case 'image':
					if($resize == TRUE){
						$resized_name = $file['raw_name'].'_resized'.$file['file_ext'];
						$resized_file_url  = $web_path . $resized_name;
						$this->smartResizeImage( $base_path . $file['file_name'],
													$width,
													$height,
													$proportional       = false,
													$output             = $base_path.$resized_name,
													$delete_original    = false,
													$use_linux_commands = false,
													$fill_white         = true );
						
						return array(	'url'         => $file_url,
										'resized_url' => $resized_file_url,
										'name'        => $file['file_name']
									);
					}
					return array(	'url'  => $file_url,
									'name' => $file['file_name']
								);
				case 'file':
					return array(	'url'  => $file_url,
									'name' => $file['file_name']
								);
			}
		}else{
			$this->response(array(  'result' => 'fail', 
									'code'   => '201', 
									'msg'    => strip_tags($this->upload->display_errors())
							));
		}
	}

	/**
	 * make Pagination HTML
	 *
	 * @param array $input
	 *
	 * @access protected
	 * @return string HTML
	 */
	public function pagination($input){
		
		$total_count = $input['total'];
		$page_per_limit = $input['max'];
		$total_page = ceil($total_count / $page_per_limit);

		$current_page = (empty($input['page'])) ? 1 : $input['page'];
		$start_page   = (($current_page - 2) > 0) ? ($current_page - 2) : 1;
		$end_page	  = (($start_page + 4) <= $total_page) ? ($start_page + 4) : $total_page;
		
		$disp_count = $total_page - $start_page;
		switch($disp_count){
			case 2:
				$start_page = (($start_page - 2) > 0) ? ($start_page - 2) : $start_page;	
				break;
			case 3:
				$start_page = (($start_page - 1) > 0) ? ($start_page - 1) : $start_page;	
				break;
		}

		$html = '<div class="btn-toolbar pagination-centered" style="float:right;">';
		//이전페이지
		if ( $current_page > 1 ) {
			$html .= '<div class="btn-group">';
			if($current_page > 2){
				$html .= '<button class="btn btn-default btn-page-go" data="1"><i class="fa fa-angle-double-left"></i></button> ';
			}
			$html .= '<button class="btn btn-default btn-page-go" data="'.($current_page-1).'"><i class="fa fa-angle-left"></i></button>';
			$html .= '</div>';
			
		}
		$html .= '<div class="btn-group">';
		for( $i = $start_page; $i <= $end_page; $i++ ){
			if ( $i == $current_page ) {
				$html .= '<button type="button" class="btn btn-success">'.$i.'</button>';
			}else{
				$html .= '<button type="button" class="btn btn-default btn-page-go" data="'.$i.'">'.$i.'</button>';
			}
		}
		$html .= '</div>';
		//다음페이지
		if( $current_page < $total_page ){
			$html .= '<div class="btn-group">';
			$html .= '<button class="btn btn-default btn-page-go" data="'.($current_page+1).'"><i class="fa fa-angle-right"></i></button> ';
			if($total_page - $current_page > 1){
				$html .= '<button class="btn btn-default btn-page-go" data="'.$total_page.'" ><i class="fa fa-angle-double-right"></i></button>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '<div style="clear:both; "></div>';
		return $html;
	}

	/**
	 * 엑셀 파일 읽기
	 * @param string $file_src
	 *
	 * @access protected
	 * @return array
	 */
	protected function readExcel( $file_src ){
		// PHPExcel 라이브러리 로드
		$this->load->library('excel');
		// 엑셀 파일 읽기
		$objPHPExcel = PHPExcel_IOFactory::load($file_src);

		// 엑셀 내용을 배열로 바꾸기
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		return $sheetData;
	}

	/**
	 * 엑셀 파일 만들기
	 * @param array $input
	 *
	 * @access protected
	 * @return EXCEL FILE output
	 * <use>
	 * //key:value
	 *	$collumn = array(
	 *					'번호'       => 'rowid',
	 *					'출금신청일' => 'regdate',
	 *					'아이디'     => 'userID',
	 *					'총적립금'   => 'total_point',
	 *					'잔액'       => 'usable_point',
	 *					'출금신청액' => 'uWdraPri',
	 *					'은행명'     => 'bank_name',
	 *					'계좌번호'   => 'uAccNum',
	 *					'예금주'     => 'uAccount',
	 *					'상태'       => 'cState'
	 *				);
	 *	$data = array(); //출력할 데이터
	 *	$array = array(
	 *					'collumn'   => $collumn,
	 *					'list'      => $data,
	 *					'title'     => $title,
	 *					'file_name' => $file_name
	 *				);
	 *	$this->makeExcel( $array );
	 * </use>
	 */
	public function makeExcel( $input ){
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle( $input['title'] );
		
		//칼럼명 세팅
		if(! empty($input['collumn'])){
			$alphabet = 'A';
			foreach($input['collumn'] as $key => $val):
				$this->excel->getActiveSheet()->setCellValue( $alphabet.'1', $key );
				$this->excel->getActiveSheet()->getStyle( $alphabet.'1' )->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle( $alphabet.'1' )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$alphabet++;
			endforeach;
		}
		//데이터 입력
		if(! empty($input['list']['data'])){
			$number = 2;
			foreach($input['list']['data'] as $dt):
				$alphabet = 'A';
				foreach($input['collumn'] as $val):
					if(is_numeric($dt[$val])){
						$this->excel->getActiveSheet()->getCell($alphabet.$number)->setValueExplicit($dt[$val], PHPExcel_Cell_DataType::TYPE_NUMERIC);
					}else{
						$this->excel->getActiveSheet()->setCellValue( $alphabet.$number, $dt[$val] );
					}
					$alphabet++;
				endforeach;
				$number++;	
			endforeach;
			if(! empty($input['summary'])){
				
			}
		}
		//셀크기 맞춤
		if(! empty($input['collumn'])){
			$colum_code = array_keys($input['collumn']);
			$col_num = "A";
			foreach($colum_code as $cc):
				$this->excel->getActiveSheet()->getColumnDimension( $col_num )->setAutoSize(true);	
				$col_num++;
			endforeach;
		}
		$filename= $input['file_name'].'.xls'; // 엑셀 파일 이름
		header('Content-Type: application/vnd.ms-excel'); //mime 타입
		header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
		header('Cache-Control: max-age=0'); //no cache
		             
		// Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');
	}

	/**
	 * 커스텀 넘버포맷
	 * @param int $number
	 * @param int $dec_point
	 *
	 * @access public
	 * @return string
	 */
	public function myNumberFormat($number, $dec_point = 1){
		$out = number_format($number, $dec_point); 
		$tmp = explode('.', $out);
		if(isset($tmp[1]) && $dec_point == 1){
			//소숫점 첫자리가 0인경우 제거
			if($tmp[1] == '0'){
				$out = $tmp[0];
			}
		}
		return $out; 
	}

	/**
	 * Server curl call
	 * @param string $url
	 * @param string $method
	 * @param mixed  $data
	 * @param array  $headers
	 *
	 * @access public
	 * @return array
	 */
	public function call($url, $method, $data = NULL, $headers = NULL){
		$ch = curl_init();
		if( empty($headers)){
			$headers = array(
							'Accept: text/html'
						);
		}
		if(! empty($data) && is_array($data)){
			$params = $this->buildHttpQuery($data);
		}else{
			$params = $data;
		}

		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		switch($method){
			case 'FILE':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			case 'PUT':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			case 'DELETE':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				break;
			default:
				//GET is CURL default
				break;
		}
		//set URL
		curl_setopt($ch, CURLOPT_URL, $url);

		try{
			$return = curl_exec($ch);
			curl_close($ch);
			$return = $this->objectToArray(json_decode($return));
		}catch(Exception $e){
			$return = $e->getMessage();
		}
		return $return;
	}

	/**
	 * 비동기 call
	 * use fsocopen
	 * @param string $url
	 * @param string $method
	 * @param mixed  $data
	 * @param array  $headers
	 *
	 * @access public
	 */
	protected function callAsync($url, $method, $data = NULL, $headers = NULL) {
		if( empty($headers)){
			$headers = array(
							'Accept: text/html'
						);
		}
		if(! empty($data) && is_array($data)){
			$params = $this->buildHttpQuery($data);
		}else{
			$params = $data;
		}	
		
		$parts = parse_url ( $url );

		if(empty($parts ['scheme']))
			$parts ['scheme'] == 'http';
			
		if ($parts ['scheme'] == 'http') {
			$fp = fsockopen ( $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 80, $errno, $errstr, 30 );
		} else if ($parts ['scheme'] == 'https') {
			$fp = fsockopen ( "ssl://" . $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 443, $errno, $errstr, 30 );
		}
		
		// Data goes in the path for a GET request
		if ('GET' == $method)
			$parts ['path'] .= '?' . $params;
		$crlf = "\r\n";
		$out = "$method " . $parts ['path'] . " HTTP/1.1\r\n";
		$out .= "Host: " . $parts ['host'] . "\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "Content-Length: " . strlen ( $params ) . "\r\n";
		// Header write
		foreach($headers as $val):
        	$out .= $val . $crlf;
        endforeach;
        $out .= "Connection: Close\r\n\r\n";
		// Data goes in the request body for a POST request
		if ('POST' == $method && isset ( $params ))
			$out .= $params;

		fwrite ( $fp, $out );
		fclose ( $fp );
	}

	/**
     * Array를 QueryString으로 변환
     *
     * @param array $array          
     * @param string $urlencode         
     * @return string http query string
     */
	public function buildHttpQuery($array, $urlencode = 'Y') {
		$query_array = array();
		foreach ( $array as $key => $key_value ):
			if ($urlencode == 'Y') {
				$query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
			}else{
				$query_array[] = $key . '=' . $key_value;
			}
		endforeach;
		return implode ( '&', $query_array );
	}

	/**
     *
     * Convert an object to an array
     * Also converts objects within objects / arrays
     *
     * @param    object  $object The object to convert
     * @reeturn  array
     *
     */
    public function objectToArray($data){
		if(is_array($data) || is_object($data)){
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->objectToArray($value);
            }
            return $result;
		}
		return $data;
    }

    /**
     * 상태코드 문자 변환
     * @param string $div
     * @param string $code
     * @access public
     * @return string
     */
    public function codeToString( $div, $code ){
		if(empty($this->sp_code_list)){
			$sql = "SELECT * FROM sp_code";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$this->sp_code_list = $query->result_array();
			}	
		}
		if(! empty($this->sp_code_list)){
			foreach($this->sp_code_list as $item):
				if($item['division'] == $div
					&& $item['code'] == $code){
					return $item['value'];
				}
			endforeach;
		}else{
			return '알수없음';
		}
	}

	/**
	 * 날짜/시간계산함수
	 *
	 * @param string $StartDate
	 * @param string $EndDate
	 * @param string $option
	 *
	 * @access protected
	 * @return string | int | array
	 */
	protected function dateDiff($StartDate, $EndDate, $option = ''){
		$StartTime = strtotime($StartDate);
		$EndTime = strtotime($EndDate);

		if($StartTime > $EndTime){
			return false;
		}
		$DiffTime = $EndTime - $StartTime;

		if($option == 'minute'){
			$ReturnValue = sprintf("%02d", ($DiffTime/60));

			return $ReturnValue;

		}else if($option == 'day'){
			$ReturnValue = floor($DiffTime/60/60/24);

			return $ReturnValue;

		}else{
			$ReturnValue['d'] = floor($DiffTime/60/60/24);
			//$ReturnValue['d'] = $DiffTime/60/60/24;
			$ReturnValue['H'] = sprintf("%02d", ($DiffTime/60/60)%24);
			$ReturnValue['i'] = sprintf("%02d", ($DiffTime/60)%60);

			return $ReturnValue;
		}
	}

	/**
	 * 날짜 표시형식 변환
	 * 
	 * @param string $input_date
	 * @param string $option (short)
	 *
	 * @access protected
	 * @return string
	 */
	protected function changeDisplayDate($input_date, $option=NULL){
		$diff = $this->dateDiff($input_date,date('Y-m-d 23:59:59'),'day');
		switch($diff){
			case '0':
				if($option == 'short'){
					$display_date = '오늘';
				}else{
					$display_date = '오늘, '.date('g:i a',strtotime($input_date));
				}				
				break;
			case '1':
				if($option == 'short'){
					$display_date = '1일전';
				}else{
					$display_date = '어제, '.date('g:i a',strtotime($input_date));
				}
				break;
			default:
				if($option == 'short'){
					$display_date = date('Y.n.j',strtotime($input_date));
				}else{
					$display_date = date('Y-m-d',strtotime($input_date));
				}
				break;
		}
		return $display_date;
	}

	/**
	 * 숫자를 문자열로 변환
	 *
	 * @param array  &$data
	 *
	 * @access protected
	 * @return array
	 */
	protected function intToNumberFormat( &$data ){
		$not_change_list = array(
								'reg_date','date','editdate','userid','user_id','id','update_date'
							);
		if(is_array($data)){
			foreach($data as $key => $val):
				if(is_numeric( $val ) && ! in_array(strtolower($key), $not_change_list)){
					$data[$key] = number_format($val);	
				}else if(is_array( $val )){
					//array인 경우 recusive call
					$data[$key] = $this->intToNumberFormat( $val );
				}			
			endforeach;
		}	
		return $data;
	}

	/**
	 * image resize in CodeIgniter
	 *
	 * @param string $file
	 * @param number $width
	 * @param number $height
	 * @param string $proportional //비례
	 * @param string $output
	 * @param string $delete_original
	 * @param string $use_linux_commands
	 * @return boolean
	 *
	 * use sample
	 * $this->smartResizeImage($path_image.$data['image'],
	 *	 $width              = 450,
	 *	 $height             = 0,
	 *	 $proportional       = true,
	 *	 $output = base_url()."public/image/",
	 *	 $delete_original    = false,
	 *	 $use_linux_commands = false,
	 *   $fill_white         = false
	 * );
	 */
	public function smartResizeImage( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false, $fill_white = false){
		if ( $height <= 0 && $width <= 0 ) {
			return false;
		}
		$info = getimagesize($file);
		$image = '';

		$final_width = 0;
		$final_height = 0;
		list($width_old, $height_old) = $info;

		if ($proportional) {
			if ($width == 0) $factor = $height/$height_old;
			elseif ($height == 0) $factor = $width/$width_old;
			else $factor = min ( $width / $width_old, $height / $height_old);
			$final_width = round ($width_old * $factor);
			$final_height = round ($height_old * $factor);

		}
		else {
			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
		}

		switch ($info[2] ) {
			case IMAGETYPE_GIF:
				$image = imagecreatefromgif($file);
				break;
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($file);
				break;
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($file);
				break;
			default:
				return false;
		}
			
		$image_resized = imagecreatetruecolor( $width, $height );
			
		if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
			$trnprt_indx = imagecolortransparent($image);
			// If we have a specific transparent color
			if ($trnprt_indx >= 0) {
				// Get the original image's transparent color's RGB values
				$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
				// Allocate the same color in the new image resource
				$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $trnprt_indx);
				// Set the background color for new image to transparent
				imagecolortransparent($image_resized, $trnprt_indx);
			}
			// Always make a transparent background color for PNGs that don't have one allocated already
			elseif ($info[2] == IMAGETYPE_PNG) {
				// Turn off transparency blending (temporarily)
				imagealphablending($image_resized, false);
				// Create a new transparent color for image
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $color);

				// Restore transparency blending
				imagesavealpha($image_resized, true);
			}
		}
		/**
		 * 흰색 배경으로 채워서 리사이즈
		 */
		if($fill_white == true){
			$white = imagecolorallocate($image_resized, 255, 255, 255);
			imagefilledrectangle($image_resized, 0, 0, $width-1, $height-1, $white);	// 흰색 배경으로 채우기
			imagecopyresampled($image_resized, $image, ($width - $final_width)/2, ($height - $final_height)/2, 0, 0, $final_width, $final_height, $width_old, $height_old);
		}else{
			imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
		}
			
		if ( $delete_original ) {
			if ( $use_linux_commands )
				exec('rm '.$file);
			else
				@unlink($file);
		}
			
		switch ( strtolower($output) ) {
			case 'browser':
				$mime = image_type_to_mime_type($info[2]);
				header("Content-type: $mime");
				$output = NULL;
				break;
			case 'file':
				$output = $file;
				break;
			case 'return':
				return $image_resized;
				break;
			default:
				break;
		}

		switch ($info[2] ) {
			case IMAGETYPE_GIF:
				imagegif($image_resized, $output);
				break;
			case IMAGETYPE_JPEG:
				imagejpeg($image_resized, $output);
				break;
			case IMAGETYPE_PNG:
				imagepng($image_resized, $output);
				break;
			default:
				return false;
		}

		return true;
	}

	/**
	 * 리스트에 인덱스 번호 매기기
	 * @param Number $total
	 * @param Number $page
	 * @param Number $max
	 *
	 * @access protected
	 * @return Number
	 */
	protected function calculateItemNo( $total, $page, $max){
		return $total -(($page-1)*$max);
	}

	public function reArrayFiles($file_post) {

		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key):
				$file_ary[$i][$key] = $file_post[$key][$i];
			endforeach;
		}
		return $file_ary;
	}

	
	/**
	 * 비밀번호 생성
	 *
	 * @param string $pass
	 * @access protected
	 * @return string
	 */
	protected function makePassword( $pass ){
		return hash('sha256', $pass.$this->config->item('my_encryption_key'));
	}


	/**
	 * 지급예정일 구하기
	 * 익월 말일(주말인경우 금요일)
	 * @return string date
	 */
	public function getDueDate(){
		$next_month = date('Y-m',strtotime('+1 month'));
		$last_day = date('t',strtotime($next_month));

		$due_date = $next_month.'-'.$last_day;

		switch(date('w',strtotime($due_date))){
			case '0': //일요일 -> 금
				$due_date = $next_month.'-'.($last_day - 2);
				break;
			case '6': //토요일 -> 금
				$due_date = $next_month.'-'.($last_day - 1);
				break;
		}

		return $due_date;
	}
	
	// shortens a long string to a max length while inserting a string into the exact middle
	public function customMask($str, $insert = '/.../') {
		$maxlen = strpos($str, '@');

		if ($str && !is_array($str)) { // valid string
			if ($maxlen && is_numeric($maxlen) && $maxlen < strlen($str)) { // string needs shortening
				if ($insert && ($ilen = strlen($insert))) { // insert string and length
					if ($ilen >= $maxlen) { // insert string too long so use default insert
						$insert = '**'; // short default so works even when a very small $maxlen
						$ilen = 2;
					}
				}
				$chars = $maxlen - $ilen; // number of $str chars to keep
				$start = ceil($chars/2); // position to start cutting
				$end = floor($chars/2); // position from end to stop cutting
				return substr_replace($str, $insert, $start, $end); // first.insert.last
			} else { // string already short enough
				return $str; // return original string
			}
		}
	}

	/**
	 * 기본값 설정 처리
	 * @param  any $var
	 * @param  any $default
	 * @access public
	 */
	public function defaultValue($var, $default) {
		if (empty($var)) {
	        $var = $default;
	    }
	    return $var;
	}
}

/* End of file base_model_admin.php */
/* Location: /application/models/base_model_admin.php */