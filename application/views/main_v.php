<?php if($is_end == false){ ?>
<div class="guid_text">
	<div class="guid_tilte">
    	<h3>렛츠런파크 입장권<br>무료증정안내</h3>
        <p>성인이라면 누구나!<span>신청가능</span></p>
    </div>
	<!--안내문구 이미지-->
	<div class="stand"><img src="<?php echo $apply_banner;?>" alt="입장권 안내문구"/></div>
	<p>
		<a href="/main/apply"><img src="/static/image/btn_apply.png" alt="입장권 신청하기"/></a>
		<a href="/main/faq"><img src="/static/image/btn_notice.png" alt="유의사항"/></a>
	</p>
</div>
<?php }else{?>
<div class="guid_text">
	<div class="guid_tilte">
    	<h3 class="close">렛츠런파크 무료입장권 <span>종료안내</span></h3>
    </div>
	<!--종료안내 이미지-->
	<div class="stand"><img src="<?php echo $end_banner;?>" alt="종료문구 안내"/></div>
</div>
<?php }?>



<div class="detail_view" style="background: url(<?php echo $detail_back;?>);">
	<div class="detail_inner">
		<div class="title">
			<h3>렛츠런파크 자세히 보기</h3>
			<p>서로 다른 매력으로 가득한<br> <span>렛츠런파크 서울, 부산경남, 제주</span><br> 미리 만나보세요~</p>
		</div>
		<ul>
			<li>
            	<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=24" target="_blank">
                    <img src="/static/image/park_1.png" alt="지역주민을 위한 가족공원렛츠런파크 서울 "/>
                    <span>렛츠런파크 서울 </span>
                </a>
			</li>
			<li>
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=25" target="_blank">            
                    <img src="/static/image/park_2.png" alt="언제라도 함께 즐거운 렛츠런파크 부산 경남 "/>
                    <span>렛츠런파크 부산경남</span>
                </a>
			</li>
			<li>
            	<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&from=postList&categoryNo=26" target="_blank">
                    <img src="/static/image/park_3.png" alt="자연과 어우러진 테마공원 렛츠런파크 제주"/>
                    <span>렛츠런파크 제주</span>
                </a>
			</li>
		</ul>
	</div>
</div>
