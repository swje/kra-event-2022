<!DOCTYPE html>
<html lang="ko"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<title>렛츠런파크 이벤트</title>
<link rel="image_src" href="http://<?php echo $_SERVER['HTTP_HOST'].$sns_image;?>" />
<meta name="twitter:title" content="렛츠런파크 이벤트" />
<meta name="twitter:image" content="http://<?php echo $_SERVER['HTTP_HOST'].$sns_image;?>" />

<meta property="og:title" content="렛츠런파크 이벤트" />
<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'];?>" />
<meta property="og:description" content="렛츠런파크 이벤트 페이지" />
<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST'].$sns_image;?>" />

<script type="text/javascript" src="/static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/static/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/layout.css?v=1.2">
</head>
<body>
<div class="gnb">
	<div class="gnb_inner">
        <h1><a href="/"><img src="/static/image/logo.png" alt="즐거움이 달린다. LetsRun"></a></h1>
        <ul>
            <li <?php if($layout['2depth'] == "") echo 'class="hover"'; ?>><a href="/">렛츠런파크 무료입장권 이벤트</a></li>
            <li <?php if($layout['2depth'] == "apply") echo 'class="hover"'; ?>><a href="/main/apply">입장권 신청</a></li>
            <li <?php if($layout['2depth'] == "faq") echo 'class="hover"'; ?>><a href="/main/faq">유의사항</a></li>
        </ul>
    </div>
</div>
<div class="main_visual">
	<!--메인비주얼 이미지-->
	<h2><img src="<?php echo $main_banner;?>" alt="무료입장권 받고 렛츠런파크로 GO"/></h2>
</div>

<?php echo $contents;?>


<div class="footer" style="background: url(<?php echo $footer_back;?>);">
	<div class="footer_inner">
        <p>친구에게 공유하기<span>렛츠런파크 무료입장권 혜택</span></p>
        <div class="icon_list">
            <a href="javascript:toSNS('blog','렛츠런파크 이벤트','http://<?php echo $_SERVER['HTTP_HOST'];?>')"><img src="/static/image/icon_n.png" alt="네이버"/></a>
            <a href="javascript:sendKakaoTalk();"><img src="/static/image/icon_k.png" alt="카카오톡"/></a>
            <a href="javascript:toSNS('facebook','렛츠런파크 이벤트','http://<?php echo $_SERVER['HTTP_HOST'];?>')"><img src="/static/image/icon_f.png" alt="페이스북"/></a>
            <a href="javascript:toSNS('twitter','렛츠런파크 이벤트','http://<?php echo $_SERVER['HTTP_HOST'];?>')"><img src="/static/image/icon_t.png" alt="트위터"/></a>
        </div>
    </div>    
    <div class="address">COPYRIGHT 2018 KRA CORPORATION ALL RIGHTS RESERVED.</div>
</div>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="https://wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
    
    if(!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "139ac269a4b540";
    wcs_do();

     
    Kakao.init('482160c04b467520b7906b2c164b95df'); 

    // 카카오톡 공유하기 
    function sendKakaoTalk() 
    { 
        Kakao.Link.sendDefault({
            objectType: 'feed',
            content: {
                title: '렛츠런파크 이벤트',
                description: '#렛츠런파크 #이벤트',
                imageUrl: "https://<?php echo $_SERVER['HTTP_HOST'].$sns_image;?>",
                link: {
                  mobileWebUrl: 'https://<?php echo $_SERVER['HTTP_HOST'];?>',
                  webUrl: 'https://<?php echo $_SERVER['HTTP_HOST'];?>'
                }
              },
            buttons: [
              {
                title: '렛츠런파크 이벤트',
                link: {
                  mobileWebUrl: 'https://<?php echo $_SERVER['HTTP_HOST'];?>',
                  webUrl: 'https://<?php echo $_SERVER['HTTP_HOST'];?>'
                }
              }
            ]
          });
    }
  
    // send to SNS 
    function toSNS(sns, strTitle, strURL) { 
        var snsArray = new Array(); 
        var strMsg = strTitle + " " + strURL; 
        var image = "http://<?php echo $_SERVER['HTTP_HOST'].$sns_image;?>"; 
  
        snsArray['twitter'] = "http://twitter.com/share?text=" + encodeURIComponent(strTitle) + '&url=' + encodeURIComponent(strURL); 
        snsArray['facebook'] = "http://www.facebook.com/share.php?u=" + encodeURIComponent(strURL); 
        snsArray['blog'] = "http://blog.naver.com/openapi/share?url=" + encodeURIComponent(strURL) + "&title=" + encodeURIComponent(strTitle); 
        window.open(snsArray[sns]); 
    } 

</script>



<div class="mask"></div>
<div id="construct">
	<div class="in">
	<h2>안내 <span class="close" onclick="$('.mask').fadeOut();$('#construct').hide();$(document.body).css({'overflow':'auto'});">&times</span></h2>
	<div class="box_bd">
	죄송합니다.<br><br>

	지금은 서버 점검중입니다.<br><br>

	잠시 후에 다시 신청해주세요! <span class='errcode'></span>
	</div>
	</div>
</div>

<?php
if($_SERVER['REQUEST_URI'] == '/main/apply' || $_SERVER['REQUEST_URI'] == '') {

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"http://icrm.kra.co.kr/agreements/serverping.crm");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$result=curl_exec($cSession);
curl_close($cSession);
$code = explode('"code":"',$result);
$code = explode('"',$code[1]);
$code = $code[0];

if($code != 100) {

	echo "<script>
			$( 'html, body' ).animate( { scrollTop : 0 }, 100 );
			$('.mask').fadeIn();
			$('#construct').show();
			$(document.body).css({'overflow':'hidden'});
			$('.errcode').html('<br><br>err [".$code."]');
		</script>";

}
}
?>
</body>
</html>
