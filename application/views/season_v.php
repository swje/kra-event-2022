<?php if( ! empty($event_code)){ ?>
<div class="info_enter">
	<div class="title_icon">
		<h3>신청 정보입력 <span>(<em>*</em>항목은 필수항목이며, 휴대폰 본인인증 후 성명, 휴대폰번호, 생년월일, 성별은 자동입력됩니다.)</span></h3>
    </div>
    <div class="table_style">
        <div class="btn_list" style="padding-bottom: 20px;">
            <img src="/static/image/btn_phone.png" style="cursor:pointer;"alt="휴대폰 본인인증" onclick="jsSubmit();">
        </div>
        <div style="margin: 30px;">
            <span>※ 정확한 신청정보 확인 및 고객님의 안전한 개인정보 보호를 위해 휴대폰 본인인증이 필요합니다.</span>
        </div>
        <form id="apply_form">
            <input type="hidden" name="evntNo" id="evntNo" value="<?php echo $event_code;?>" />
        <table summary="입장권 신청 정보입력">
        <colgroup>
        	<col style="width:213px">
            <col style="*">
        </colgroup>
        <caption>이벤트 신청 렛츠런파크,성명,휴대폰 번호,생년월일,성별,개인정보 수집 및 이용 동의</caption>
        <tr>
            <th class="first"><span>*</span>신청대상</th>
            <td class="first">
            	<div class="radio_button">
                    <input type="radio" id="area01" name="letsrunPark" value="01" checked><label for="area01">렛츠런파크</label>
                </div>
            </td>
        </tr>
        <tr>
            <th><span>*</span>성명</th>
            <td><input type="text" id="cstNm" name="cstNm" readonly onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th><span>*</span>휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" placeholder="예) 01012345678 (피처폰은 참여가 어렵습니다)" readonly onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th><span>*</span>생년월일</th>
            <td><input type="text" id="birdt" name="birdt" readonly onclick="alert('본인인증을 진행해 주세요.');"></td>
        </tr>
        <tr>
            <th><span>*</span>성별</th>
            <td>
            	<div class="radio_button">
                    <input type="radio" id="man" name="gen" value="M" checked><label for="man">남자</label>
                    <input type="radio" id="woman" name="gen" value="F"><label for="woman">여자</label>
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
    	<a href="#none" id="btn-submit" onclick="alert('본인인증을 진행해 주세요.');"><img src="/static/image/btn_apply_3.png" alt="입장권 신청하기"></a>
    </div>
</div>
<style type="text/css">
    .layer {display:none; position:fixed; _position:absolute; top:0; left:0; width:100%; height:100%; z-index:100;}
        .layer .bg {position:absolute; top:0; left:0; width:100%; height:100%; background:#000; opacity:.5; filter:alpha(opacity=50);}
        .layer .pop-layer {display:block;}

    .pop-layer {display:none; position: absolute; top: 50%; left: 50%; width: 410px; height:auto;  background-color:#fff; border: 5px solid #f97781; z-index: 10;}  
    .pop-layer .pop-container {padding: 20px 25px;}
    .pop-layer p.ctxt {color: #666; line-height: 25px;}
    .pop-layer .btn-r {width: 100%; margin:10px 0 0px; padding-top: 10px; border-top: 1px solid #DDD; text-align:center;}

    a.btn {font-size:16px;margin-right: 10px;display:inline-block; height:25px; padding:5px 14px; border:1px solid #f97781; background-color:#f97781; color:#fff; line-height:25px;} 
    a.btn:hover {border: 1px solid #091940; background-color:#f97781; color:#fff;}
</style>
<div class="layer">
    <div class="bg"></div>
    <div id="layer2" class="pop-layer">
        <div class="pop-container">
            <div class="pop-conts">
                <!--content //-->
                <h1 style="font-size:25px;font-weight: bold;text-align: center;">이벤트 신청이 완료되었습니다.</h1>
                <p class="ctxt mb20" style="font-size:16px;text-align: center;margin:5px;">
                    + 추가 혜택! 렛츠런파크 무료로 놀러가고 싶다면?
                </p>

                <div class="btn-r">
                    <a href="/" class="btn">YES! 무료입장권 신청하기</a>
                    <a href="#" class="btn cbtn">NO</a>
                </div>
                <!--// content-->
            </div>
        </div>
    </div>
</div>
<form name="form1" action="/okcert3/phone_popup2.php" method="post">
    <input type="hidden" name="SITE_NAME" maxlength="20" size="24" value="렛츠런파크">
</form>
<form name="kcbResultForm" method="post" action="/main/seasonNext">
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
<script type="text/javascript" src="https://s3.ap-northeast-2.amazonaws.com/adpick.co.kr/apis/apTracker.v3.js"></script>
<script>
    function jsSubmit(){
        window.open("", "auth_popup", "width=430,height=640,scrollbar=yes");
        var form1 = document.form1;
        form1.target = "auth_popup";
        form1.submit();
    }

    

</script>
<?php }?>