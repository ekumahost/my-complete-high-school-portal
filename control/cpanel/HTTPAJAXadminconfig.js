 $(document).ajaxStart(function(){
  //when we start the ajax call, lets show the loader
  document.getElementById("loading").innerHTML='<img src="dots.gif"> </img>';

});


$(document).ajaxSend(function(){
// when the request is sent, lets change the div to loading image
 document.getElementById("configchanger").innerHTML='<center>Loading Content.. Please Wait... <img src="gears-anim.gif"> </img></center>';// use big image

});



  $(document).ajaxSuccess(function(){

   // when sucess, lets hide the loader at the breadcrumb
   $('#loading').hide();
  }); 
  
  // what happens when he click this link
  $("#changeschoolname").click(function(){
    $("#configchanger").load("ajax/change_school_name");
  });
  
   // what happens when he click this link
  $("#barnedwords").click(function(){
    $("#configchanger").load("ajax/change_barned_words");
  });
  
  
  
  // what happens when he click this link
  $("#ownerprofile").click(function(){
    $("#configchanger").load("ajax/owner");
  });
 
 // what happens when he click this link
  $("#schoolyear").click(function(){
    $("#configchanger").load("ajax/school_year");
  });
 
 
   // what happens when he click this link
  $("#schoolterm").click(function(){
    $("#configchanger").load("ajax/school_term");
  });
 
    // what happens when he click this link
  $("#school_period").click(function(){
    $("#configchanger").load("ajax/school_period");
  });

   // what happens when he click this link
  $("#schoolbadge").click(function(){
    $("#configchanger").load("ajax/school_badge");
  });
 
 
   // what happens when he click this link
  $("#subjects").click(function(){
    $("#configchanger").load("ajax/subjects");
  });
 
 
   // what happens when he click this link
  $("#gradelevel").click(function(){
    $("#configchanger").load("ajax/grade_level");
  });
 
 
   // what happens when he click this link
  $("#classrooms").click(function(){
    $("#configchanger").load("ajax/rooms");
  });
 
 
   // what happens when he click this link
  $("#ethnicities").click(function(){
    $("#configchanger").load("ajax/ethnic");
  });
 
 
   // what happens when he click this link
  $("#attendance").click(function(){
    $("#configchanger").load("ajax/attendance");
  });


   // what happens when he click this link
  $("#banks").click(function(){
    $("#configchanger").load("ajax/banks");
  });


   // what happens when he click this link
  $("#infraction").click(function(){
    $("#configchanger").load("ajax/infraction");
  });
 
  // what happens when he click this link
  $("#generations").click(function(){
    $("#configchanger").load("ajax/generations");
  });
  
// what happens when he click this link
  $("#relationships").click(function(){
    $("#configchanger").load("ajax/relationships");
  });
  
   // what happens when he click this link
  $("#titles").click(function(){
    $("#configchanger").load("ajax/titles");
  });
  
   // what happens when he click this link
  $("#customfields").click(function(){
    $("#configchanger").load("ajax/customfield");
  });
  
   // what happens when he click this link
  $("#examtype").click(function(){
    $("#configchanger").load("ajax/exam_types");
  });
 
      // what happens when he click this link
  $("#welcomemessage").click(function(){
    $("#configchanger").load("ajax/welcome_message");
  });
  
     // what happens when he click this link
  $("#offices").click(function(){
    $("#configchanger").load("ajax/offices");
  });
 
    // what happens when he click this link
  $("#immunization").click(function(){
    $("#configchanger").load("ajax/immunization");
  });
    // what happens when he click this link
  $("#medication").click(function(){
    $("#configchanger").load("ajax/medication");
  });
    // what happens when he click this link
  $("#allergy").click(function(){
    $("#configchanger").load("ajax/allergy");
  });
