$(document).ready(function() {
	if ($('input#edit-name').val() == '') {
		$('input#edit-name').addClass("idleField");
	}
	if ($('input#edit-pass').val() == '') {
		$('input#edit-pass').addClass("idleField");
	}
	if ($('input#edit-name-1').val() == '') {
		$('input#edit-name-1').addClass("idleField");
	}
	if ($('input#edit-pass-1').val() == '') {
		$('input#edit-pass-1').addClass("idleField");
	}
});
$('#user-login-form input[type="text"]').focus(function() {
	$(this).removeClass("idleField").addClass("focusField");
	if (this.value == this.defaultValue){
		this.value = '';
	}
	if(this.value != this.defaultValue){
		this.select();
	}
});
$('#user-login-form input[type="text"]').blur(function() {
        if (this.value != '') {
                $(this).removeClass("focusField");
        } else {
                $(this).removeClass("focusField").addClass("idleField");
        }
        if ($.trim(this.value == '')){
		this.value = (this.defaultValue ? this.defaultValue : '');
	}
});
$('#user-login-form input[type="password"]').focus(function() {
	$(this).removeClass("idleField").addClass("focusField");
	if (this.value == this.defaultValue){
		this.value = '';
	}
	if(this.value != this.defaultValue){
		this.select();
	}
});
$('#user-login-form input[type="password"]').blur(function() {
        if (this.value != '') {
                $(this).removeClass("focusField");
        } else {
                $(this).removeClass("focusField").addClass("idleField");
        }
        if ($.trim(this.value == '')){
		this.value = (this.defaultValue ? this.defaultValue : '');
	}
});
