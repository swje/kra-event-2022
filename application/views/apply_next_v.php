<div class="info_enter">
	<div class="title_icon" style='padding-bottom:10px'>
		<ul>
            <li><a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=letsrun2014&parentCategoryNo=29&skinType=&skinId=&from=menu&userSelectMenu=true" target="_blank"><img src="/static/image/icon_small_n.png" alt="네이버"></a><span>렛츠런파크<br>네이버블로그</span></li>
            <li><a href="https://www.facebook.com/letsrunpark/" target="_blank"><img src="/static/image/icon_small_f.png" alt="페이스북"></a><span>렛츠런파크<br>페이스북</span></li>
        </ul>
        <h3>입장권 신청 정보입력</h3>
    </div>
	<div style='padding:5px 0;letter-spacing:0;line-height:20px;margin-bottom:20px'><sup style='color:red'>*</sup> 항목은 필수항목입니다.<br>
	<div style="margin-left:11px">휴대폰 본인인증 후 <span style='color:blue'>성명, 휴대폰번호, 생년월일, 성별</span>은 자동입력됩니다.</div></div>

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
            <th class="first"><span>*</span>성명</th>
            <td class="first"><input type="text" id="cstNm" name="cstNm" value="<?php echo $user_name;?>" readonly></td>
        </tr>
        <tr>
            <th><span>*</span>휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" value="<?php echo $user_tel;?>" readonly > </td>
        </tr>
        <tr>
            <th><span>*</span>생년월일</th>
            <td><input type="text" id="birdt" name="birdt" value="<?php echo $user_birthday;?>" readonly> </td>  
        </tr>
        <tr>
            <th style='padding-bottom:25px;'><span>*</span>성별</th>
            <td style='padding-bottom:25px;'>
            	<div class="radio_button">
                    <input type="radio" id="man" name="gen" value="M" <?php if($user_sex == 'M') echo "checked"; ?> ><label for="man" onclick="return false;">남자</label>
                    <input type="radio" id="woman" name="gen" value="F" <?php if($user_sex == 'F') echo "checked"; ?> ><label for="woman" onclick="return false;">여자</label>
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
    	<a href="#none" id="btn-submit"><img src="/static/image/btn_apply_1.png" alt="입장권 신청하기"></a>
        <a href="/"><img src="/static/image/btn_cancel.png" alt="취소"></a>
        <a href="/main/faq"><img src="/static/image/btn_notice_1.png" alt="유의사항"></a>
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
            $("#hp").val("");
            return false;
        }
        if($("#hp").val().length > 12 || $("#hp").val().length < 10){
            alert("휴대폰 번호를 확인하여 주십시요.");
            $("#hp").val("");
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