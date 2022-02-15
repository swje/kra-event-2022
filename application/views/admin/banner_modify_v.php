<div class="pageheader">
	<h2><i class="fa fa-picture-o"></i> <?php echo $banner_type_kor;?> 수정</h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li>메인 관리</li>
		<li class="active"><?php echo $banner_type_kor;?> 수정</li>
	</ol>
	</div>
</div>
	
<div class="contentpanel">
	<form id="basicForm" action="/conn-admin/banner/modify" class="form-horizontal" method="POST" enctype="multipart/form-data" >
		<input type="hidden" name="banner_type" value="<?php echo $banner_type;?>" />
		<input type="hidden" name="banner_id" value="<?php echo $data['banner_id'];?>" />
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?php echo $banner_type_kor;?> 입력 양식</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php if($banner_type=="main") echo "계절"; else echo "제목"; ?> <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<input type="text" name="banner_name" class="form-control" value="<?php echo $data['banner_name'];?>" placeholder="" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">PC 이미지 <span class="asterisk">*</span> <br/><?php echo $banner_size['pc']?></label>
				<div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="input-append">
							<div class="uneditable-input">
								<i class="glyphicon glyphicon-file fileupload-exists"></i>
								<span class="fileupload-preview"></span>
							</div>
							<span class="btn btn-default btn-file">
								<span class="fileupload-new">파일선택</span>
								<span class="fileupload-exists">변경</span>
								<input type="file" id="uploadFile" name="banner_img"/>
							</span>
							<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
						</div>
					</div>
					<div class="imagePreview on mt10" id="imagePreview" style="background-image: url(<?php echo $data['banner_src'];?>);"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">모바일 이미지 <span class="asterisk">*</span> <br/><?php echo $banner_size['mobile']?></label>
				<div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="input-append">
							<div class="uneditable-input">
								<i class="glyphicon glyphicon-file fileupload-exists"></i>
								<span class="fileupload-preview"></span>
							</div>
							<span class="btn btn-default btn-file">
								<span class="fileupload-new">파일선택</span>
								<span class="fileupload-exists">변경</span>
								<input type="file" id="uploadFile-M" name="banner_img_m"/>
							</span>
							<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
						</div>
					</div>
					<div class="imagePreview on mt10" id="imagePreview-M" style="background-image: url(<?php echo $data['banner_src_m'];?>);"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">사용여부</label>
				<div class="col-sm-5">
					<div class="rdio rdio-primary">
						<input type="radio" id="use_y" value="Y" name="banner_use_yn" <?php if($data['banner_use_yn'] == "Y") echo 'checked="checked"';?> />
						<label for="use_y">사용</label> 
					</div><!-- rdio -->
					<div class="rdio rdio-primary">
						<input type="radio" id="use_n" value="N" name="banner_use_yn" <?php if($data['banner_use_yn'] == "N") echo 'checked="checked"';?>/>
						<label for="use_n">사용안함</label>
					</div><!-- rdio -->
				</div>
			</div>

		</div><!-- panel-body -->
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-primary btn-regist">수정</button>
					<button class="btn btn-default btn-cancel">취소</button>
				</div>
			</div>
		</div>
	</div><!-- panel -->
</div><!-- contentpanel -->
<script>
	jQuery(document).ready(function() {

		$('body').on({
			click: function(){
				var check = confirm("수정 하시겠습니까?");
				if(!check){
					return false;
				}
			}
		},'.btn-regist');

		$('body').on({
			click: function(){
				var check = confirm("취소 하시겠습니까?");
				if(check){
					history.back(-1);
				}
				return false;
			}
		},'.btn-cancel');

		$("#uploadFile").on("change", function()
	    {    
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview").css("background-image", "url("+this.result+")");
	                $("#imagePreview").css("display","inline-block");
	            }
	        }
	    });

	    $("#uploadFile-M").on("change", function()
	    {    
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview-M").css("background-image", "url("+this.result+")");
	                $("#imagePreview-M").css("display","inline-block");
	            }
	        }
	    });
	});
</script>