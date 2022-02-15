<?php if($is_end == false){ ?>
<div class="guid_text">
	<!--안내문구 이미지-->
    <h2>렛츠런파크 입장권 무료증정안내</h2>
    <p>성인이라면 누구나! 신청가능</p>
	<div class="stand"><img src="<?php echo $apply_banner;?>" alt="입장권 안내문구"/></div>
	<p>
		<a href="/main/apply"><img src="/static-m/image/btn_apply.png" alt="입장권 신청하기"/></a>
		<a href="/main/faq"><img src="/static-m/image/btn_notice.png" alt="유의사항"/></a>
	</p>
</div>
<?php }else{?>
<div class="guid_text">
    <h2>렛츠런파크 입장권 <span>종료안내</span></h2>
    <div class="close">
        <!--종료안내 이미지-->
        <div class="end"><img src="<?php echo $end_banner;?>" alt="입장권 종료문구"/></div>
    </div>
</div>
<?php }?>
<div class="detail_view">
	<div class="detail_inner">
		<div class="title">
			<h2>렛츠런파크 자세히 보기</h2>
			<p>서로 다른 매력으로 가득한 렛츠런파크 서울, 부산경남, 제주 미리 만나보세요~</p>
		</div>
		<ul>
			<li>
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=24" target="_blank"><img src="/static-m/image/park_1.png" alt="서울"/></a>
			</li>
			<li>
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=25" target="_blank"><img src="/static-m/image/park_2.png" alt="부산경남"/></a>
			<li>
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=26" target="_blank"><img src="/static-m/image/park_3.png" alt="제주"/></a>
			</li>
			<li>
				<a href="https://www.facebook.com/letsrunpark/" target="_blank"><img src="/static-m/image/park_4.png" alt="페이스북"/></a>
			</li>           
		</ul>
	</div>
</div>