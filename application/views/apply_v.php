<div class="info_enter">
	<div class="title_icon" style='padding-bottom:10px'>
		<ul>
            <li><a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&parentCategoryNo=29&skinType=&skinId=&from=menu&userSelectMenu=true" target="_blank"><img src="/static/image/icon_small_n.png" alt="네이버"></a><span>렛츠런파크<br>네이버블로그</span></li>
            <li><a href="https://www.facebook.com/letsrunpark/" target="_blank"><img src="/static/image/icon_small_f.png" alt="페이스북"></a><span>렛츠런파크<br>페이스북</span></li>
        </ul>	
        <h3>입장권 신청 정보입력</h3>
		
    </div>
	<div style='padding:5px 0;letter-spacing:0;line-height:20px'><sup style='color:red'>*</sup> 항목은 필수항목입니다.<br>
		<div style="margin-left:11px">휴대폰 본인인증 후 <span style='color:blue'>성명, 휴대폰번호, 생년월일, 성별</span>은 자동입력됩니다.</div>
	</div>
    <div class="table_style">
        <div class="btn_list" style="padding-bottom: 20px;">
            <img src="/static/image/btn_phone2.png" style="cursor:pointer;"alt="휴대폰 본인인증" onclick="jsSubmit();">
        </div>
        <div style="margin: 30px 10px;letter-spacing:0">
            <span>※ 정확한 신청정보 확인 및 고객님의 안전한 개인정보 보호를 위해 휴대폰 본인인증이 필요합니다.</span>
        </div>
        <form id="apply_form" action="/conn/apply/send" method="POST">
            <input type="hidden" name="evntNo" value="<?php echo $event_code;?>" />
        <table summary="입장권 신청 정보입력">
        <colgroup>
        	<col style="width:213px">
            <col style="*">
        </colgroup>
        <caption>입장권 신청 렛츠런파크,성명,휴대폰 번호,생년월일,성별,개인정보 수집 및 이용 동의</caption>
        <tr >
            <th class="first"><span>*</span>성명</th>
            <td class="first"><input type="text" id="cstNm" name="cstNm" readonly onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th><span>*</span>휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" placeholder="예) 01012345678 (피처폰은 참여가 어렵습니다)" readonly="true" onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th><span>*</span>생년월일</th>
            <td><input type="text" id="birth" name="birth" readonly onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th style='padding-bottom:25px'><span>*</span>성별</th>
            <td style='padding-bottom:25px'>
            	<div class="radio_button">
                    <input type="radio" id="man" name="gen" value="M"><label for="man">남자</label>
                    <input type="radio" id="woman" name="gen" value="F"><label for="woman">여자</label>
                </div>
            </td>
        </tr>
        <tr>
            <th class="first"><span>*</span>입장권 신청 렛츠런파크</th>
            <td class="first">
                <div class="radio_button">
                    <input type="radio" id="area01" name="letsrunPark" value="01"><label for="area01">서울</label>
                    <input type="radio" id="area02" name="letsrunPark" value="03"><label for="area02">부산경남</label>
                    <input type="radio" id="area03" name="letsrunPark" value="02"><label for="area03">제주</label>
                    <span style="font-size:13px;letter-spacing:0">※ 방문하시고 싶은 렛츠런파크 지역을 꼭 선택해주세요.</span>
                </div>
            </td>
        </tr>
        <tr>
            <th><span>*</span>개인정보 수집 및 이용 동의</th>
            <td><div class="checks"><input type="checkbox" id="ex_chk"><label for="ex_chk"> 동의 합니다.</label></div></td>
        </tr>
        </table>    
        </form>	
    </div>
    <div class="privacy">
    	<h4>개인정보 수집 및 이용 동의서</h4>
        <p>한국마사회는 고객님의 개인정보 보호를 매우 중요시 여기며, 개인정보 보호에 관한 법률을 준수하고 있습니다.</p>
        <ul>
        	<li><span>수집항목 :</span> 성명, 핸드폰번호, 생년월일, 성별</li>
            <li><span>수집 및 이용목적 :</span> 렛츠런파크 축제·행사 정보알림, 고객관리 및 마케팅/광고 활용</li>
            <li><span>보유 및 이용기간 :</span> 이벤트 홍보일로부터 2년</li>
            <li>개인정보 수집 및 이용 동의를 거부할 수 있으며, 마케팅 활용에 동의하지 않으실 경우 행사안내 및 경품제공이 되지 않음을 알려드립니다.</li>
        </ul>
    </div>
    <div class="btn_list">
    	<img src="/static/image/btn_apply_1.png" alt="입장권 신청하기" onclick="alert('본인인증을 진행해 주세요.');">
        <a href="/"><img src="/static/image/btn_cancel.png" alt="취소"></a>
        <a href="/main/faq"><img src="/static/image/btn_notice_1.png" alt="유의사항"></a>
    </div>
</div>
<form name="form1" action="/okcert3/phone_popup2.php" method="post">
    <input type="hidden" name="SITE_NAME" maxlength="20" size="24" value="렛츠런파크">
</form>
<!-- 휴대폰 본인확인 팝업 처리결과 정보 = phone_popup3 에서 값 입력 -->
<form name="kcbResultForm" method="post" action="/main/applyNext">
    <input type="hidden" name="CP_CD" />
    <input type="hidden" name="TX_SEQ_NO" />
    <input type="hidden" name="RSLT_CD" />
    <input type="hidden" name="RSLT_MSG" />
    
    <input type="hidden" name="RSLT_NAME" />
    <input type="hidden" name="RSLT_BIRTHDAY" />
    <input type="hidden" name="RSLT_SEX_CD" />
    <input type="hidden" name="RSLT_NTV_FRNR_CD" />
    
    <input type="hidden" name="DI" />
    <input type="hidden" name="CI" />
    <input type="hidden" name="CI2" />
    <input type="hidden" name="CI_UPDATE" />
    <input type="hidden" name="TEL_COM_CD" />
    <input type="hidden" name="TEL_NO" />
    
    <input type="hidden" name="RETURN_MSG" />
</form>
<script>
    function jsSubmit(){
        window.open("", "auth_popup", "width=430,height=640,scrollbar=yes");
        var form1 = document.form1;
        form1.target = "auth_popup";
        form1.submit();
    }

    

</script>