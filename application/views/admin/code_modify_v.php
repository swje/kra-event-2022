<div class="pageheader">
	<h2><i class="fa fa-barcode"></i> 코드 수정</h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li>코드 관리</li>
		<li class="active">코드 수정</li>
	</ol>
	</div>
</div>
	
<div class="contentpanel">
	<form id="basicForm" action="/conn-admin/code/modify" class="form-horizontal" method="POST" enctype="multipart/form-data" >
		<input type="hidden" name="code_id" value="<?php echo $data['code_id'];?>"/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">코드 정보 입력 양식</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">구분</label>
				<div class="col-sm-5">
					<div class="rdio rdio-primary">
						<input type="radio" id="type_1" value="ticket" name="code_type" <?php if($data['code_type'] == 'ticket') echo 'checked="checked"';?>  />
						<label for="type_1">입장권</label> 
					</div><!-- rdio -->
					<div class="rdio rdio-primary">
						<input type="radio" id="type_2" value="season" name="code_type" <?php if($data['code_type'] == 'season') echo 'checked="checked"';?> />
						<label for="type_2">시즌</label>
					</div><!-- rdio -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">코드명 <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<input type="text" name="code_name" class="form-control" value="<?php echo $data['code_name'];?>" placeholder="코드명을 입력하세요." required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">코드 <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<input type="text" name="code_value" class="form-control" value="<?php echo $data['code_value'];?>" autocomplete="off" placeholder="코드값을 입력하세요" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">사용여부 </label>
				<div class="col-sm-5">
					<div class="rdio rdio-primary">
						<input type="radio" id="code_y" value="Y" name="code_use_yn" <?php if($data['code_use_yn'] == 'Y') echo 'checked="checked"';?> required/>
						<label for="code_y">사용</label> 
					</div><!-- rdio -->
					<div class="rdio rdio-primary">
						<input type="radio" id="code_n" value="N" name="code_use_yn" <?php if($data['code_use_yn'] == 'N') echo 'checked="checked"';?> required/>
						<label for="code_n">사용안함</label>
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

	});
</script>