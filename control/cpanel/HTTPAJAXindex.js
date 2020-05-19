// the document.ready function is in index page
$(document).ajaxStart(function(){
  //when we start the ajax call, lets show the loader
  document.getElementById("loading").innerHTML='<img src="dots.gif"> </img>';

});


$(document).ajaxSend(function(){

   // when the request is sent, lets change the div to loading image
 document.getElementById("changer").innerHTML='<center>Loading Content.. Please Wait... <img src="gears-anim.gif"> </img></center>';// use big image

});



  $(document).ajaxSuccess(function(){

   // when sucess, lets hide the loader at the breadcrumb
   $('#loading').hide();
  }); 
  $("#SendSMSLink").click(function(){
    $("#changer").load("ajax/admin_send_sms");
  });
  
  
   $("#last").click(function(){
    $("#changer").load("ajax/admin_send_sms");
	 //$("#changer").load("ajax/school_config.php");

  });
  
  
  $("#summary_student, #summary_fees, #summary_message, #summary_staff").click(function(){
    $("#changer").load("ajax/summary");
  });
  
  
  $("#ajaxconfig").click(function(){
    $("#changer").load("ajax/school_config");
    //$("#changer").load("ajax/admin_send_sms.php");

  });