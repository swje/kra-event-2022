<div class="pageheader">
	<h2><i class="fa fa-user"></i> 관리자 목록 </h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li class="active">관리자 목록</li>
	</ol>
	</div>
</div>
<div class="contentpanel">
	<div class="panel panel-default">
		<div class="panel-body">
			<p class="mb30">
				<button class="btn btn-primary btn-regist">추가</button>
				<a href="javascript:checkDelete();"><button class="btn btn-default">삭제</button></a>
			</p>
			<div class="table-responsive">
				<table class="table table-hover" id="table">
					<thead>
						<tr>
							<th><input type="checkbox" id="check_all"/></th>
							<th>가입날짜</th>
							<th>아이디</th>
							<th>닉네임</th>
							<th>정보변경</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(! empty($data['data'])){
							foreach($data['data'] as $item): 
						?>
						<tr>
							<td><?php if($item['id'] != 1){ ?>
								<input class="checkbox_item" name="checkbox_item" type="checkbox" data="<?php echo $item['id'];?>">
								<?php }?>
							</td>
							<td><?php echo $item['reg_date'];?></td>
							<td><?php echo $item['user_id'];?></td>
							<td><?php echo $item['user_nickname'];?></td>
							<td><a class="btn btn-primary" href="/admin/member/modify/<?php echo $item['id'];?>">수정</a></td>
						</tr>		
						<?php
							endforeach;
						}else{ ?>
						<tr>
							<td colspan=12>추가된 회원이 없습니다.</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<?php echo $data['pagination'];?>
			</div><!-- table-responsive -->
		</div><!-- panel-body -->
	</div><!-- panel -->		
</div><!-- contentpanel -->
<script>
jQuery(document).ready(function() {
	$('body').on({
		click: function(){
			document.location.href = "/admin/member/regist";
		}
	},'.btn-regist');
	$('body').on({
		click: function(){
			var page = $(this).attr('data');
			location.href="/admin/member/lists/" + page;
		}
	}, '.btn-page-go');

	$("#check_all").click(function(){ 
		var chk = $(this).is(":checked");
		if(chk){
			$(".checkbox_item").prop('checked', true);
		}else{
			$(".checkbox_item").prop('checked', false);
		}
	});

});

function checkDelete(){
	if(in_progress == false){
		selected = [];
		$("input[name=checkbox_item]:checked").each(function() {
			selected.push($(this).attr('data'));
		});
		if(selected.length < 1){
			alert('삭제할 대상을 선택하세요.');
			return;
		}
		var check = confirm("삭제 하시겠습니까?");
		if(check){
			in_progress = true;
			$.ajax({
				url: '/conn-admin/member/checkDelete',
				method: 'post',
				data: { 
					'selected': selected
				},
				error: function(data,error){
					in_progress = false;
				},
				success: function(d){
					var result = $.parseJSON(d);
					if(result.result == 'success'){
						location.reload();
					}else{
						alert(result.msg);
					}
					in_progress = false;
				}
			});
		}
	}
}


</script>