<div class="pageheader">
	<h2><i class="fa fa-user"></i> 관리자 추가</h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li>관리자 관리</li>
		<li class="active">관리자 추가</li>
	</ol>
	</div>
</div>
	
<div class="contentpanel">
	<form id="basicForm" action="/conn-admin/member/regist" class="form-horizontal" method="POST" enctype="multipart/form-data" >
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">관리자 정보 입력 양식</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">id <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<input type="text" name="user_id" class="form-control" value="" autocomplete="off"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">닉네임 <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<input type="text" name="user_nickname" class="form-control" value="" autocomplete="off"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">비밀번호 </label>
				<div class="col-sm-5">
					<input type="password" name="user_pass" id="password" class="form-control" autocomplete="off" placeholder="비밀번호"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">비밀번호 확인</label>
				<div class="col-sm-5">
					<input type="password" name="pass_check" id="confirm_password" class="form-control" autocomplete="off" placeholder="한번 더 입력하세요"/>
				</div>
			</div>	

		</div><!-- panel-body -->
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-primary btn-regist">추가</button>
					<button class="btn btn-default btn-cancel">취소</button>
				</div>
			</div>
		</div>
	</div><!-- panel -->
	</form>
</div><!-- contentpanel -->

<script>

	jQuery(document).ready(function() {

		$('body').on({
			click: function(){
				if($('#password').val() != $('#confirm_password').val()){
					alert('비밀번호 확인 값이 다릅니다.');
					return false;
				}
				var check = confirm("추가 하시겠습니까?");
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