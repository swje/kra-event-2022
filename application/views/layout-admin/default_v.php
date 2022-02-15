<!DOCTYPE html>
<html lang="ko">
<head>
	<META http-equiv="Expires" content="-1"> 
	<META http-equiv="Pragma" content="no-cache"> 
	<META http-equiv="Cache-Control" content="No-Cache"> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="theme-color" content="#ffffff">
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
	<title>LetsRun 관리자</title>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href="/static-admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static-admin/css/style.default.css" rel="stylesheet">
	<link href="/static-admin/css/jquery.datatables.css" rel="stylesheet">
	<link rel="stylesheet" href="/static-admin/css/bootstrap-fileupload.min.css" />
	<link rel="stylesheet" href="/static-admin/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" href="/static-admin/css/jquery.tagsinput.css" />
	<link rel="stylesheet" href="/static-admin/css/colorpicker.css" />
	<link rel="stylesheet" href="/static-admin/css/dropzone.css" />
	<link rel="stylesheet" href="/static-admin/css/prettyPhoto.css">
	<link href="/static-admin/css/custom.css" rel="stylesheet">
	<link href="/static-admin/js/chap-links-timeline/timeline.css" rel="stylesheet">
	<script src="/static-admin/js/jquery-1.10.2.min.js"></script>
	<script src="/static-admin/js/jquery-ui-1.10.3.min.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="/static-admin/js/html5shiv.js"></script>
	<script src="/static-admin/js/respond.min.js"></script>
	<![endif]-->
</head>
<body style="overflow: auto;" <?php if($layout['left_menu_toggle'] == TRUE && $layout['is_mobile'] == FALSE) echo 'class="leftpanel-collapsed"';?>>
	<section>
		<div class="leftpanel">
			<div class="logopanel border-right">
				<img src="/static-admin/images/site_logo.gif"/>
			</div><!-- logopanel -->
			<div class="leftpanelinner">
				<h5 class="sidebartitle"></h5>
				<ul class="nav nav-pills nav-stacked nav-bracket">

				<?php echo $layout['left_menu'];?>
				
				</ul>
			</div><!-- leftpanelinner -->
		</div><!-- leftpanel -->
		<div class="mainpanel">
			<div class="headerbar">
				<a class="menutoggle"><i class="fa fa-bars"></i></a>
				<div class="main_top_title">
					
				</div>
				<div class="header-right">
					<ul class="headermenu">
						<li>
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<i class="glyphicon glyphicon-user icon_gap"></i>
								<?php echo $layout['user_data']['user_nickname'];?>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
								<?php if($layout['menu_div'] == 'U'){?>
								<li><a href="/conn/member/logout" class="btn-logout" style="cursor: pointer;"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
								<?php }else{ ?>
								<li><a href="/conn-admin/member/logout" class="btn-logout" style="cursor: pointer;"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
								<?php }?>
							</ul>
						</div>
						</li>
					</ul>
				</div><!-- header-right -->
			</div><!-- headerbar -->
			<?php echo $contents;?>
		</div><!-- mainpanel -->
		<!-- modal alert popup -->
		<div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog m-size">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-alert-header row" style="margin: 0px;">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-alert-body row text-center mg20-auto"></div>
						<div class="modal-alert-btn row text-center">
							<button type="button" class="btn btn-default btn-modal-cancel">닫기</button>&nbsp;&nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- modal alert popup -->
		<!-- modal confirm popup -->
		<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog m-size">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-confirm-header row">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-confirm-body row text-center mg20-auto"></div>
						<div class="modal-confirm-btn row text-center">
							<button type="button" class="btn btn-default btn-modal-cancel">취소</button>&nbsp;&nbsp;
							<button type="button" class="btn btn-primary btn-modal-submit">확인</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- modal confirm popup -->
	</section>
	<form id="form-heart-beat" action="/conn-admin/account/heartBeat" method="POST" target="iframe-default">
		<input type="hidden" name="IP" val="<?php echo $_SERVER['REMOTE_ADDR']?>">
	</form>
	<iframe name="iframe-default" width=0 height=0 style="display:none"></iframe>
	<script src="/static-admin/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="/static-admin/js/jquery-ui-1.10.3.min.js"></script>
	<script src="/static-admin/js/bootstrap.min.js"></script>
	<script src="/static-admin/js/modernizr.min.js"></script>
	<script src="/static-admin/js/jquery.sparkline.min.js"></script>
	<script src="/static-admin/js/toggles.min.js"></script>
	<script src="/static-admin/js/retina.min.js"></script>
	<script src="/static-admin/js/jquery.cookies.js"></script>
	<script src="/static-admin/js/jquery.autogrow-textarea.js"></script>
	<script src="/static-admin/js/bootstrap-fileupload.min.js"></script>
	<script src="/static-admin/js/bootstrap-timepicker.min.js"></script>
	<script src="/static-admin/js/jquery.maskedinput.min.js"></script>
	<script src="/static-admin/js/jquery.tagsinput.min.js"></script>
	<script src="/static-admin/js/jquery.mousewheel.js"></script>
	<script src="/static-admin/js/chosen.jquery.min.js"></script>
	<script src="/static-admin/js/dropzone.min.js"></script>
	<script src="/static-admin/js/colorpicker.js"></script>
	<script src="/static-admin/js/morris.min.js"></script>
	<script src="/static-admin/js/flot/flot.min.js"></script>
	<script src="/static-admin/js/flot/flot.resize.min.js"></script>
	<script src="/static-admin/js/flot/flot.time.min.js"></script>
	<script src="/static-admin/js/flot/flot.symbol.min.js"></script>
	<script src="/static-admin/js/flot/flot.crosshair.min.js"></script>
	<script src="/static-admin/js/flot/flot.categories.min.js"></script>
	<script src="/static-admin/js/flot/flot.pie.min.js"></script>
	<script src="/static-admin/js/raphael-2.1.0.min.js"></script>
	<script src="/static-admin/js/jquery.datatables.min.js"></script>
	<script src="/static-admin/js/custom.js"></script>
	<script src="/static-admin/js/jquery.prettyPhoto.js"></script>
	<script src="/static-admin/js/bootstrap-wizard.min.js"></script>
	<script src="/static-admin/js/jquery.validate.min.js"></script>
	<script>
		var in_progress = false;
		var date_list = <?php echo $layout['date_list'];?>;
		
		jQuery(document).ready(function(){
			
			// Chosen Select
			jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
  
			// Tags Input
			jQuery('#tags').tagsInput({width:'auto'});
   
			// Textarea Autogrow
			jQuery('#autoResizeTA').autogrow();
  
			// Color Picker
			if(jQuery('#colorpicker').length > 0) {
				jQuery('#colorSelector').ColorPicker({
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
						jQuery('#colorpicker').val('#'+hex);
					}
				});
			}
  
			// Color Picker Flat Mode
			jQuery('#colorpickerholder').ColorPicker({
				flat: true,
				onChange: function (hsb, hex, rgb) {
					jQuery('#colorpicker3').val('#'+hex);
				}
			});
   
			// Date Picker
			jQuery('#datepicker').datepicker({
				monthNames: ['1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
				showMonthAfterYear:true,
				defaultDate: "-1w",
				changeMonth: false,
				numberOfMonths: 1,
				showButtonPanel: false,
				onClose: function( selectedDate ) {
					$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				}
			});
			jQuery('#datepicker02').datepicker({
				monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
				showMonthAfterYear:true,
				changeMonth: false,
				numberOfMonths: 1,
				showButtonPanel: false,
				onClose: function( selectedDate ) {
					$( "#datepicker02" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				}
			});
			jQuery('#datepicker03').datepicker({
				monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
				showMonthAfterYear:true,
				changeMonth: true,
		        changeYear: true,
		        showButtonPanel: true,
		        dateFormat: 'yy-mm',
		        currentText : "이번달",
		        closeText : "선택",
		        onClose: function(dateText, inst) { 
		            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
		        }
			});
			jQuery('#datepicker-inline').datepicker();
  
			jQuery('#datepicker-multiple').datepicker({
				numberOfMonths: 3,
				showButtonPanel: true
			});
  
			// Spinner
			var spinner = jQuery('#spinner').spinner();
			spinner.spinner('value', 0);
  
			// Input Masks
			jQuery("#date").mask("9999-99-99");
			jQuery("#phone").mask("(999) 999-9999");
			jQuery("#cellphone").mask("999-9999-9999");
			jQuery("#ssn").mask("999-99-9999");
  
			// Time Picker
			jQuery('#timepicker').timepicker({defaultTIme: false});
			$('#timepicker2').timepicker({showMeridian: false});
			$('#timepicker3').timepicker({minuteStep: 15});

			//Replaces data-rel attribute to rel.
			//We use data-rel because of w3c validation issue
			jQuery('a[data-rel]').each(function() {
			  jQuery(this).attr('rel', jQuery(this).data('rel'));
			});
			
			jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools: ''});

			$('body').on({
				click: function(){
					$.get('/conn-admin/setting/leftMenuToggle');
				}
			}, '.menutoggle');		

		});

		function selectDate(str){
			switch(str){
				case '1week':
					$("#datepicker").val(date_list.week.from);
					$("#datepicker02").val(date_list.week.to);
					break;
				case '2week':
					$("#datepicker").val(date_list.week2.from);
					$("#datepicker02").val(date_list.week2.to);
					break;
				case '1month':
					$("#datepicker").val(date_list.month1.from);
					$("#datepicker02").val(date_list.month1.to);
					break;
				case '3month':
					$("#datepicker").val(date_list.month3.from);
					$("#datepicker02").val(date_list.month3.to);
					break;
				case '6month':
					$("#datepicker").val(date_list.month6.from);
					$("#datepicker02").val(date_list.month6.to);
					break;
				case 'thismonth':
					$("#datepicker").val(date_list.thismonth.from);
					$("#datepicker02").val(date_list.thismonth.to);
					break;
				case 'm1month':
					$("#datepicker").val(date_list.m1month.from);
					$("#datepicker02").val(date_list.m1month.to);
					break;
			}
		}
		
		function is_ie() {
			if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
			if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
			if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
			return false;
		}

		function copyToClipboard(str) {
			if( is_ie() ) {
				window.clipboardData.setData("Text", str);
				alert("복사되었습니다.");
				return;
			}
			prompt("Ctrl+C를 눌러 복사하세요.", str);
		}
		function openPopup(url, w, h){
			window.open(url,'','width='+w+',height='+h+',scrollbars=yes,menubar=no,status=no,toolbar=no');

		}


		// 숫자 타입에서 쓸 수 있도록 format() 함수 추가
		Number.prototype.format = function(){
		    if(this==0) return 0;
		 
		    var reg = /(^[+-]?\d+)(\d{3})/;
		    var n = (this + '');
		 
		    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');
		 
		    return n;
		};
		 
		// 문자열 타입에서 쓸 수 있도록 format() 함수 추가
		String.prototype.format = function(){
		    var num = parseFloat(this);
		    if( isNaN(num) ) return "0";
		 
		    return num.format();
		};

		String.prototype.filterInt = function(){
		  if(/^(\-|\+)?([0-9]+|Infinity)$/.test(this))
		    return Number(this);
		  return NaN;
		}

		function isNumeric(v){
			var reg = /^(\s|\d)+$/;
        	return reg.test(v);
		}
	 
	</script>
</body>
</html>