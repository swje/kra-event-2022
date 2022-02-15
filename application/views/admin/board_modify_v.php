<div class="pageheader">
	<h2><i class="fa fa-question"></i> FAQ 수정</h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li>FAQ</li>
		<li class="active">FAQ 수정</li>
	</ol>
	</div>
</div>
	
<div class="contentpanel">
	<form id="basicForm" action="/conn-admin/board/modify" class="form-horizontal" method="POST" enctype="multipart/form-data" >
	<input type="hidden" name="board_division" value="faq"/>
	<input type="hidden" name="board_id" value="<?php echo $data['board_id'];?>"/>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">FAQ 정보 입력 양식</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Question <span class="asterisk">*</span></label>
				<div class="col-sm-10">
					<input type="text" name="board_title" class="form-control" value="<?php echo $data['board_title'];?>" placeholder="질문을 입력하세요." required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Answer <span class="asterisk">*</span></label>
				<div class="col-sm-10">
					<textarea type="text" id="editor_content" name="board_content" class="form-control"autocomplete="off" placeholder="답변을 입력하세요" required><?php echo $data['board_content'];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">사용여부</label>
				<div class="col-sm-5">
					<div class="rdio rdio-primary">
						<input type="radio" id="use_y" value="Y" name="board_use_yn" <?php if($data['board_use_yn'] == "Y") echo 'checked="checked"';?> />
						<label for="use_y">사용</label> 
					</div><!-- rdio -->
					<div class="rdio rdio-primary">
						<input type="radio" id="use_n" value="N" name="board_use_yn" <?php if($data['board_use_yn'] == "N") echo 'checked="checked"';?>/>
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
<script type="text/javascript" src="/static-admin/smart_editor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
// 추가 글꼴 목록
var aAdditionalFontSet = [["Nanum Gothic", "나눔 고딕"]];
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "editor_content",
	sSkinURI: "/static-admin/smart_editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});
jQuery(document).ready(function() {

	$('body').on({
		click: function(){
			oEditors.getById["editor_content"].exec("UPDATE_CONTENTS_FIELD", []);
			
			if($('#editor_content').val() == "<p>&nbsp;</p>"){
				alert("내용을 입력하세요.");
				return false;
			}

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