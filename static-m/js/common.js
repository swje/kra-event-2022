
function setuplabel() {
	if ($('.comm_check_label input').length) {
		$('.comm_check_label').each(function(){ 
			$(this).removeClass('check_on');
		});
		$('.comm_check_label input:checked').each(function(){ 
			$(this).parent('label').addClass('check_on');
		});                
	};
	if ($('.comm_radio_label input').length) {
		$('.comm_radio_label').each(function(){ 
			$(this).removeClass('radio_on');
		});
		$('.comm_radio_label input:checked').each(function(){ 
			$(this).parent('label').addClass('radio_on');
		});
	};
};
$(document).ready(function(){
	$('.comm_check_label, .comm_radio_label').click(function(){
		setuplabel();
	});
	setuplabel(); 
});