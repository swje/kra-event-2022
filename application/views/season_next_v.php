<?php if( ! empty($event_code)){ ?>
<div class="info_enter">
	<div class="title_icon">
		<h3>신청 정보입력</h3>
		<div style='padding:5px 0;letter-spacing:0;line-height:20px'><sup style='color:red'>*</sup> 항목은 필수항목입니다.<br>
			<div style="margin-left:11px">휴대폰 본인인증 후 <span style='color:blue'>성명, 휴대폰번호, 생년월일, 성별</span>은 자동입력됩니다.</div>
		</div>

    </div>
    <div class="table_style">
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
            <td><input type="text" id="cstNm" name="cstNm" value="<?php echo $user_name;?>" readonly></td>
        </tr>
        <tr>
            <th><span>*</span>휴대폰 번호</th>
            <td><input type="text" id="hp" name="hp" value="<?php echo $user_tel;?>" readonly></td>
        </tr>
        <tr>
            <th><span>*</span>생년월일</th>
            <td><input type="text" id="birdt" name="birdt" value="<?php echo $user_birthday;?>" readonly></td>
        </tr>
        <tr>
            <th><span>*</span>성별</th>
            <td>
            	<div class="radio_button">
                    <input type="radio" id="man" name="gen" value="M" <?php if($user_sex == 'M') echo "checked"; ?> ><label for="man" onclick="return false;">남자</label>
                    <input type="radio" id="woman" name="gen" value="F" <?php if($user_sex == 'F') echo "checked"; ?> ><label for="woman" onclick="return false;">여자</label>
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
    	<a href="#none" id="btn-submit"><img src="/static/image/btn_apply_3.png" alt="입장권 신청하기"></a>
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
            alert("'생년'월일을 입력하세요.");
            $("#birdt").focus();
            return false;
        }
        
        var input_birth = $("#birdt").val();
        if(parseInt(input_birth) > check_date){
            alert("생년월일을 확인하여 주십시요.\n만19세 이상만 신청하실 수 있습니다.");
            return false;
        }

        if($("#ex_chk").prop("checked") == false){
            alert("개인정보 수집 및 이용동의가 필요합니다.");
            return false;   
        }
        var gen = "M";
        if($("#woman").prop("checked")){
            gen = "F";
        }

        $.ajax({
          url: '/conn/apply/send',
            method: 'post',
            data: { 
                        'return_type' : 'json',
                        'letsrunPark' : '01',
                        'evntNo': $("#evntNo").val(),
                        'cstNm': $("#cstNm").val(),
                        'hp': $("#hp").val(),
                        'birdt' : $("#birdt").val(),
                        'gen' : gen
            },
            error: function(data,error){
            },
            success: function(d){
                    var result = $.parseJSON(d);
                    if(result.result == 'success'){
                        //location.reload();
                        layer_open('layer2');
                    }else{
                        alert(result.msg);
                        document.location.href = '/main/season';
                    }
            }
        });
    }
    function isNumeric(v){
        var reg = /^(\s|\d)+$/;
        return reg.test(v);
    }

    function layer_open(el){

        var temp = $('#' + el);
        var bg = temp.prev().hasClass('bg');    //dimmed 레이어를 감지하기 위한 boolean 변수

        if(bg){
            $('.layer').fadeIn();   //'bg' 클래스가 존재하면 레이어가 나타나고 배경은 dimmed 된다. 
        }else{
            temp.fadeIn();
        }

        // 화면의 중앙에 레이어를 띄운다.
        if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
        else temp.css('top', '0px');
        if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
        else temp.css('left', '0px');

        temp.find('a.cbtn').click(function(e){
            if(bg){
                $('.layer').fadeOut(); //'bg' 클래스가 존재하면 레이어를 사라지게 한다. 
            }else{
                temp.fadeOut();
            }
            e.preventDefault();
            location.reload();
        });

        $('.layer .bg').click(function(e){  //배경을 클릭하면 레이어를 사라지게 하는 이벤트 핸들러
            $('.layer').fadeOut();
            e.preventDefault();
            location.reload();
        });

    }       
</script>
<?php }?>