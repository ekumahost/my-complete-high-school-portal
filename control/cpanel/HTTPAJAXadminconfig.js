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
    $("#configchanger").load("ajax/change_school_name.php");
  });
  
   // what happens when he click this link
  $("#barnedwords").click(function(){
    $("#configchanger").load("ajax/change_barned_words.php");
  });
  
  
  
  // what happens when he click this link
  $("#ownerprofile").click(function(){
    $("#configchanger").load("ajax/owner.php");
  });
 
 // what happens when he click this link
  $("#schoolyear").click(function(){
    $("#configchanger").load("ajax/school_year.php");
  });
 
 
   // what happens when he click this link
  $("#schoolterm").click(function(){
    $("#configchanger").load("ajax/school_term.php");
  });
 
    // what happens when he click this link
  $("#school_period").click(function(){
    $("#configchanger").load("ajax/school_period.php");
  });

   // what happens when he click this link
  $("#schoolbadge").click(function(){
    $("#configchanger").load("ajax/school_badge.php");
  });
 
 
   // what happens when he click this link
  $("#subjects").click(function(){
    $("#configchanger").load("ajax/subjects.php");
  });
 
 
   // what happens when he click this link
  $("#gradelevel").click(function(){
    $("#configchanger").load("ajax/grade_level.php");
  });
 
 
   // what happens when he click this link
  $("#classrooms").click(function(){
    $("#configchanger").load("ajax/rooms.php");
  });
 
 
   // what happens when he click this link
  $("#ethnicities").click(function(){
    $("#configchanger").load("ajax/ethnic.php");
  });
 
 
   // what happens when he click this link
  $("#attendance").click(function(){
    $("#configchanger").load("ajax/attendance.php");
  });


   // what happens when he click this link
  $("#banks").click(function(){
    $("#configchanger").load("ajax/banks.php");
  });


   // what happens when he click this link
  $("#infraction").click(function(){
    $("#configchanger").load("ajax/infraction.php");
  });
 
  // what happens when he click this link
  $("#generations").click(function(){
    $("#configchanger").load("ajax/generations.php");
  });
  
// what happens when he click this link
  $("#relationships").click(function(){
    $("#configchanger").load("ajax/relationships.php");
  });
  
   // what happens when he click this link
  $("#titles").click(function(){
    $("#configchanger").load("ajax/titles.php");
  });
  
   // what happens when he click this link
  $("#customfields").click(function(){
    $("#configchanger").load("ajax/customfield.php");
  });
  
   // what happens when he click this link
  $("#examtype").click(function(){
    $("#configchanger").load("ajax/exam_types.php");
  });
 
      // what happens when he click this link
  $("#welcomemessage").click(function(){
    $("#configchanger").load("ajax/welcome_message.php");
  });
  
     // what happens when he click this link
  $("#offices").click(function(){
    $("#configchanger").load("ajax/offices.php");
  });
 
    // what happens when he click this link
  $("#immunization").click(function(){
    $("#configchanger").load("ajax/immunization.php");
  });
    // what happens when he click this link
  $("#medication").click(function(){
    $("#configchanger").load("ajax/medication.php");
  });
    // what happens when he click this link
  $("#allergy").click(function(){
    $("#configchanger").load("ajax/allergy.php");
  });
