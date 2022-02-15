<div class="info_enter">
	<div class="title_icon">
		<h2>입장권 신청 정보입력</h2>
        <!--<ul>
            <li><a href="#"><img src="/static-m/image/icon_small_n.png" alt="네이버"><span>렛츠런파크 네이버블로그</span></a></li>
            <li><a href="#"><img src="/static-m/image/icon_small_f.png" alt="페이스북"><span>렛츠런파크 페이스북</span></a></li>
        </ul>-->	
	<div style='padding:5px 0;letter-spacing:0;line-height:20px'><sup style='color:red'>*</sup> 항목은 필수항목입니다.<br>
		<div style="margin-left:11px">휴대폰 본인인증 후 <span style='color:blue'>성명, 휴대폰번호, 생년월일, 성별</span>은 자동입력됩니다.</div>
	</div>

	</div>

    <div class="table_style">
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
            <td><input type="text" id="cstNm" name="cstNm" value="<?php echo $user_name;?>" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" value="<?php echo $user_tel;?>" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 생년월일</th>
            <td><input type="text" id="birdt" name="birdt" value="<?php echo $user_birthday;?>" readonly></td>
        </tr>
        <tr>
            <th><sup style='color:red'>*</sup> 성별</th>
            <td style="border-bottom:2px solid #333;padding-bottom:60px">
            	<div class="radio_list"> 
                    <label for="man" class="comm_radio_label width50" onclick="return false;"><input type="radio" id="man" class="comm_radio" name="gen" value="M" <?php if($user_sex == 'M') echo "checked"; ?> >남자</label>
                    <label for="woman" class="comm_radio_label width50" onclick="return false;"><input type="radio" id="woman" class="comm_radio" name="gen" value="F" <?php if($user_sex == 'F') echo "checked"; ?> >여자</label>
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
    	<a href="#none" id="btn-submit"><img src="/static-m/image/btn_apply_1.png" alt="입장권 신청하기"></a>
        <a href="/"><img src="/static-m/image/btn_cancel_1.png" alt="취소"></a>
        <a href="/main/faq"><img src="/static-m/image/btn_notice_2.png" alt="유의사항"></a>
    </div>
</div>
<script>
    var checkUnload = true;
    $(document).ready(function(){
        $("#btn-submit").click(function(){
            checkUnload = false;
            submitForm();
        });
    });

    $(window).on("beforeunload", function(){
        if(checkUnload) return "이 페이지를 벗어나시겠습니까?";
    });

    function submitForm(){
        var check_date = <?php echo date('Y',strtotime('-19year')).date('md');?>;
        var frm = $("#apply_form");
        if($("#cstNm").val() == ''){
            alert("이름을 입력하세요.");
            $("#cstNm").focus();
            return false;
        }
        if(! $('input:radio[name=letsrunPark]').is(':checked')){
            alert("지역을 선택하세요.");
            return false;
        }
        if($("#hp").val() == ''){
            alert("연락처를 입력하세요.");
            $("#hp").focus();
            return false;
        }
        if(! isNumeric($("#hp").val())){
            alert("숫자로 입력하세요");
            return false;
        }
        if($("#hp").val().length > 12 || $("#hp").val().length < 10){
            alert("휴대폰 번호를 입력하세요");
            return false;   
        }
        if($("#birdt").val() == ''){
            alert("생년월일을 입력하세요.");
            $("#birdt").focus();
            return false;
        }
        
        var input_birth = $("#birdt").val();
        if(parseInt(input_birth) > check_date){
            alert("만19세 이상만 신청하실 수 있습니다.");
            return false;
        }
        if($("#ex_chk").prop("checked") == false){
            alert("개인정보 수집 및 이용동의가 필요합니다.");
            return false;   
        }
        frm.submit();
    }

    function isNumeric(v){
        var reg = /^(\s|\d)+$/;
        return reg.test(v);
    }
</script>