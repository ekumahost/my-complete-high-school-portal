 $(document).ajaxStart(function(){
  //when we start the ajax call, lets show the loader
  document.getElementById("loading").innerHTML='<img src="dots.gif"> </img>';

});


$(document).ajaxSend(function(){

   // when the request is sent, lets change the div to loading image
 document.getElementById("loadxt").innerHTML='&nbsp;&nbsp;&nbsp;Just chill, Innovation is loading...&nbsp;&nbsp;&nbsp;&nbsp;<img src="dots.gif"> </img>';// use big image

});



  $(document).ajaxSuccess(function(){

   // when sucess, lets hide the loader at the breadcrumb
   $('#loading').hide();

  }); 
  
  // what happens when he click this link
  $("#addsingle").click(function(){
    $("#loadxt").load("addform.html");
  });
  // what happens when he click this link
  $("#add_result_sheet").click(function(){
		//alert('You click me');								
										
    $("#loadxt").load("add_result_sheet.html");
  });
  
  
  
  
  // IT ENDS HERE HTTP REQUESTS
  