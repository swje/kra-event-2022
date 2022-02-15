<li<?php if ( ! empty($layout['1depth']) && ($layout['1depth'] == 'member' )) { echo ' class="active"'; }else{ echo ' class=""';}?>>
	<a href="/admin/member/lists"><i class="fa fa-user"></i> <span>관리자 목록</span></a>
</li>
<li<?php if ( ! empty($layout['1depth']) && ($layout['1depth'] == 'code' )) { echo ' class="active"'; }else{ echo ' class=""';}?>>
	<a href="/admin/code/lists"><i class="fa fa-barcode"></i> <span>코드관리</span></a>
</li>

<li<?php if ( ! empty($layout['1depth']) && ($layout['1depth'] == 'banner')) { echo ' class="nav-parent nav-active active"'; }else{ echo ' class="nav-parent"';}?>>
	<a href="#"><i class="fa fa-desktop"></i> <span>메인 관리</span></a>
	<ul class="children" <?php if($layout['1depth'] == 'banner') echo 'style="display: block;"';?> >
		<li <?php if ($layout['3depth'] == 'main' ) echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/main"><i class="fa fa-picture-o"></i> <span>메인 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'ing' ) echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/ing"><i class="fa fa-picture-o"></i> <span>이벤트 안내 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'end') echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/end"><i class="fa fa-picture-o"></i> <span>이벤트 종료 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'detail') echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/detail"><i class="fa fa-picture-o"></i> <span>자세히보기 배경 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'footer') echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/footer"><i class="fa fa-picture-o"></i> <span>푸터 배경 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'sns') echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/sns"><i class="fa fa-picture-o"></i> <span>SNS 홍보 이미지</span></a>
		</li>
		<li <?php if ($layout['3depth'] == 'season') echo 'class="active"'; ?>>
			<a href="/admin/banner/lists/season"><i class="fa fa-picture-o"></i> <span>시즌이벤트 메인 이미지</span></a>
		</li>
	</ul>
</li>
<li<?php if ( ! empty($layout['1depth']) && ($layout['1depth'] == 'board' )) { echo ' class="active"'; }else{ echo ' class=""';}?>>
	<a href="/admin/board/lists/faq"><i class="fa fa-question"></i> <span>FAQ</span></a>
</li>