<style>
    .ok__name{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .ok__name img{
        width:70%;
    }
</style>
<div class="info_enter">
	<div class="title_icon">
		<h2>입장권 신청 정보입력
          
        </h2>
        <!--<ul>
            <li><a href="#"><img src="/static-m/image/icon_small_n.png" alt="네이버"><span>렛츠런파크 네이버블로그</span></a></li>
            <li><a href="#"><img src="/static-m/image/icon_small_f.png" alt="페이스북"><span>렛츠런파크 페이스북</span></a></li>
        </ul>-->	
	<div style='padding:5px 0;letter-spacing:0;line-height:20px'><sup style='color:red'>*</sup> 항목은 필수항목입니다.<br>
		<div style="margin-left:11px">휴대폰 본인인증 후 <span style='color:blue'>성명, 휴대폰번호, 생년월일, 성별</span>은 자동입력됩니다.</div>
	</div>
    </div>
    <div class="table_style">
        <div class="ok__name">
            <img src="/static-m/image/m_btn_phone2.png" alt="입장권 신청하기" onclick="jsSubmit();">
        </div>
        <div style="margin-bottom: 30px;line-height:1.4em">
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
        <tr>
            <th style="border-top:2px solid #333"><sup style='color:red'>*</sup> 성명</th>
            <td><input type="text" id="cstNm" name="cstNm" onclick="alert('본인인증을 진행해 주세요.');" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" placeholder="예) 01012345678" onclick="alert('본인인증을 진행해 주세요.');" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 생년월일</th>
            <td><input type="text" id="birthday" name="birthday" onclick="alert('본인인증을 진행해 주세요.');" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 성별</th>
            <td style="border-bottom:2px solid #333;padding-bottom:60px">
            	<div class="radio_list"> 
                    <label for="man" class="comm_radio_label width50" onclick="setuplabel();"><input type="radio" id="man" class="comm_radio" name="gen" value="M" checked>남자</label>
                    <label for="woman" class="comm_radio_label width50" onclick="setuplabel();"><input type="radio" id="woman" class="comm_radio" name="gen" value="F">여자</label>
                </div>
            </td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 입장권 신청 렛츠런파크</th>
            <td>
                <div class="radio_list">                
                    <label for="area_1" class="comm_radio_label" onclick="setuplabel();"><input type="radio" id="area_1" class="comm_radio" name="letsrunPark" value="01">서울</label>
                    <label for="area_2" class="comm_radio_label" onclick="setuplabel();"><input type="radio" id="area_2" class="comm_radio" name="letsrunPark" value="03">부산경남</label>
                    <label for="area_3" class="comm_radio_label" onclick="setuplabel();"><input type="radio" id="area_3" class="comm_radio" name="letsrunPark" value="02">제주</label>
                </div>
                <p style="font-size:0.8em;margin:10px 0">※ 방문하시고 싶은 렛츠런파크 지역을 꼭 선택해주세요.</p>
            </td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 개인정보 수집 및 이용 동의</th>
            <td><div class="checks"><input type="checkbox" id="ex_chk"><label for="ex_chk"> 동의 합니다.</label></div></td>
        </tr>
        </table>    	
        </form> 
    </div>
    <div class="privacy">
    	<h3>개인정보 수집 및 이용 동의서</h3>
        <p>한국마사회는 고객님의 개인정보 보호를 매우 중요시 여기며, 개인정보 보호에 관한 법률을 준수하고 있습니다.</p>
        <ul>
        	<li>수집항목 : 성명, 핸드폰번호, 생년월일, 성별</li>
            <li>수집 및 이용목적 : 렛츠런파크 축제·행사 정보알림, 고객관리 및 마케팅/광고 활용</li>
            <li>보유 및 이용기간 : 이벤트 홍보일로부터 2년</li>
            <li>개인정보 수집 및 이용 동의를 거부할 수 있으며, 마케팅 활용에 동의하지 않으실 경우 행사안내 및 경품제공이 되지 않음을 알려드립니다.</li>
        </ul>
    </div>
    <div class="btn_list">
    	<a href="#none" id="btn-submit" onclick="alert('본인인증을 진행해 주세요.');"><img src="/static-m/image/btn_apply_1.png" alt="입장권 신청하기"></a>
        <a href="/"><img src="/static-m/image/btn_cancel_1.png" alt="취소"></a>
        <a href="/main/faq"><img src="/static-m/image/btn_notice_2.png" alt="유의사항"></a>
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