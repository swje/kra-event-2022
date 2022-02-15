<div class="pageheader">
	<h2><i class="fa fa-barcode"></i> 코드 목록 </h2>
	<div class="breadcrumb-wrapper">
	<span class="label">현재위치:</span>
	<ol class="breadcrumb">
		<li class="active">코드 목록</li>
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
							<th>사용여부</th>
							<th>구분</th>
							<th>코드명</th>
							<th>코드</th>
							<th>수정</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(! empty($data['data'])){
							foreach($data['data'] as $item): 
								if($item['code_type'] == 'ticket'){ 
									$code_type_kor = "입장권";
								}else{ 
									$code_type_kor = "시즌"; 
								}
						?>
						<tr>
							<td><input class="checkbox_item" name="checkbox_item" type="checkbox" data="<?php echo $item['code_id'];?>"></td>
							<td><button class="btn-use-yn btn btn-xs btn-width-90 <?php if($item['code_use_yn'] == 'Y'){ echo 'btn-lightblue';}else{ echo 'btn-maroon';}?>" 
									code_id="<?php echo $item['code_id'];?>" 
									data="<?php echo $item['code_use_yn'];?>"><?php if($item['code_use_yn'] == 'Y'){ echo ' 사용 ';}else{echo"사용안함";}?></button></td>
							<td><?php echo $code_type_kor;?></td>
							<td><?php echo $item['code_name'];?></td>
							<td><?php echo $item['code_value'];?></td>
							<td><a class="btn btn-primary" href="/admin/code/modify/<?php echo $item['code_id'];?>">수정</a></td>
						</tr>		
						<?php
							endforeach;
						}else{ ?>
						<tr>
							<td colspan=12>추가된 코드가 없습니다.</td>
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
			document.location.href = "/admin/code/regist";
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

	$('body').on({
		click: function(){
			if(in_progress == false){
				in_progress = true;
				var btn = $(this);
				var code_id = btn.attr('code_id');
				var use_yn   = btn.attr('data');
				if(use_yn == 'Y'){
					var use_yn = 'N';
				}else{
					var use_yn = 'Y';
				}
				$.ajax({
					url: "/conn-admin/code/setUseYn",
					method: 'post',
					data: { 'code_id': code_id,
							'code_use_yn' : use_yn },
					error: function(d, error){
						in_progress = false;
						alert(error);
					},
					success: function(d){
						var result = $.parseJSON(d);
						if(result.result == 'success'){
							if(use_yn == 'Y'){
								btn.removeClass('btn-maroon');
								btn.addClass('btn-lightblue');
								btn.attr('data','Y');
								btn.text('사용');
							}else{
								btn.removeClass('btn-lightblue');
								btn.addClass('btn-maroon');
								btn.attr('data','N');
								btn.text('사용안함');
							}
							in_progress = false;
						}
					}
				});
			}
		}
	}, '.btn-use-yn');

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
				url: '/conn-admin/code/checkDelete',
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