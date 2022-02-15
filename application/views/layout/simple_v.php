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
<div class="main_visual">
	<!--메인비주얼 이미지-->
	<h2><img src="<?php echo $main_banner;?>" alt="렛츠런파크로 GO"/></h2>
</div>

<?php echo $contents;?>

<div class="footer">
    <div class="address">COPYRIGHT 2018 KRA CORPORATION ALL RIGHTS RESERVED.</div>
</div>
<script type="text/javascript" src="https://s3.ap-northeast-2.amazonaws.com/adpick.co.kr/apis/apTracker.v3.js"></script>
<script type="text/javascript" src="https://wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
    
    if(!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "139ac269a4b540";
    wcs_do();

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


if($_SERVER['REQUEST_URI'] == '/season') {

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
