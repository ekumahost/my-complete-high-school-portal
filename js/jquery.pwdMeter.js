/**
@name jQuery pwdMeter 1.0.1
@author Shouvik Chatterjee (mailme@shouvik.net)
@date 31 Oct 2010
@modify 31 Dec 2010
@license Free for personal and commercial use as long as the author's name retains
*/
(function(jQuery){

jQuery.fn.pwdMeter = function(options){


	options = jQuery.extend({
	
		minLength: 5,
		displayGeneratePassword: false,
		generatePassText: '',
		generatePassClass: 'GeneratePasswordLink',
		randomPassLength: 13,
        passwordBox: this
	
	}, options);


	return this.each(function(index){
	
		$(this).keyup(function(){
			evaluateMeter();
		});
		
		
		function evaluateMeter(){

			var passwordStrength   = 0;
			var password = $(options.passwordBox).val();

			if ((password.length >0) && (password.length <=5)) passwordStrength=1;
		
			if (password.length >= options.minLength) passwordStrength++;

			if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/)) ) passwordStrength++;

			if (password.match(/\d+/)) passwordStrength++;

			if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))	passwordStrength++;

			if (password.length > 12) passwordStrength++;
		
			$('#pwdMeter').removeClass();
			$('#pwdMeter').addClass('neutral');
		
			switch(passwordStrength){
			case 1:
			  $('#pwdMeter').addClass('weak');
			  $('#pwdMeter').text('Weak');
			  break;
			case 2:
			  $('#pwdMeter').addClass('medium');
			  $('#pwdMeter').text('Medium');
			  break;
			case 3:
			  $('#pwdMeter').addClass('strong');
			  $('#pwdMeter').text('Strong');
			  break;
			case 4:
			  $('#pwdMeter').addClass('verystrong');
			  $('#pwdMeter').text('Very Strong');
			  break;		  		  		  
			default:
			  $('#pwdMeter').addClass('neutral');
			  $('#pwdMeter').text('Very Weak');
			}		
		
		}		
	
	});

}

})(jQuery)
