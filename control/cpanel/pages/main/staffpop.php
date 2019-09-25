<div class="modal hide fade" id="staff-portal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Bank Detail</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editportal.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->
	

	<div class="modal hide fade" id="staff-bank">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Bank Detail</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editbank.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->

<div class="modal hide fade" id="staff-kin">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Next of Kin</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editkin.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->

<div class="modal hide fade" id="staffcontactee">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Contact Detail</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editcontact.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->


					<div class="modal hide fade" id="staffprofilesee">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> School Profile</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editprofile.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->
		
		
		
		<div class="modal hide fade" id="staffnameses">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Profile</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editname.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->

	<div class="modal hide fade" id="editphoto">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">*</button>
			<h3>Edit <?php echo $fname;?> Photos</h3>
		</div>
		<div class="modal-body"><!-- please use ajax to handle this -->
			<?php include('ajax/staff/editphoto.php');?>

		</div>
	
		<div class="modal-footer">
		
	<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>

</div>

<!-- we have a break -->



<script>
$(document).ready(function()
{
  //$('#simple-msg').hide();


$("#simple-post").click(function()
{
$("#ajaxform").submit(function(e)
{
//$('#simple-msg').show();
	$("#simple-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#simple-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#simple-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#ajaxform").submit(); //SUBMIT FORM
});








// name post

$("#name-post").click(function()
{
$("#nameform").submit(function(e)
{
//$('#simple-msg').show();
	$("#name-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#name-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#name-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#nameform").submit(); //SUBMIT FORM
});



// CONTACT FORM
$("#contact-post").click(function()
{
$("#contactform").submit(function(e)
{
//$('#simple-msg').show();
	$("#name-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#contact-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#contact-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#contactform").submit(); //SUBMIT FORM
});









// Stafff contact
$("#staff-contact").click(function()
{
$("#staffcontact").submit(function(e)
{
//$('#simple-msg').show();
	$("#staff-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#staff-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#staff-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#staffcontact").submit(); //SUBMIT FORM
});



// Stafff kin
$("#staff-kin-post").click(function()
{
$("#staffkin").submit(function(e)
{
//$('#simple-msg').show();
	$("#staff-kin-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#staff-kin-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#staff-kin-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#staffkin").submit(); //SUBMIT FORM
});

// staff bank
$("#bank-post").click(function()
{
$("#bankform").submit(function(e)
{
//$('#simple-msg').show();
	$("#bank-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
			$("#bank-msg").html('<div class="alert alert-success"><pre><code class="prettyprint">'+data+'</code></pre></div>');

		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#bank-msg").html('<div class="alert alert-error"><pre><code class="prettyprint">Request Failed, try again later<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre></div>');
		}
	});
	e.preventDefault();	//STOP default action
	e.unbind();
});
	
$("#bankform").submit(); //SUBMIT FORM
});
// photo upload

function getDoc(frame) {
 var doc = null;
 
 // IE8 cascading access check
 try {
	 if (frame.contentWindow) {
		 doc = frame.contentWindow.document;
	 }
 } catch(err) {
 }

 if (doc) { // successful getting content
	 return doc;
 }

 try { // simply checking may throw in ie8 under ssl or mismatched protocol
	 doc = frame.contentDocument ? frame.contentDocument : frame.document;
 } catch(err) {
	 // last attempt
	 doc = frame.document;
 }
 return doc;
}

$("#multiform").submit(function(e)
{
	$("#multi-msg").html("<img src='ajax/staff/ajax-loader.gif'/>");

var formObj = $(this);
var formURL = formObj.attr("action");

if(window.FormData !== undefined)  // for HTML5 browsers
//	if(false)
{

	var formData = new FormData(this);
	$.ajax({
		url: formURL,
		type: 'POST',
		data:  formData,
		mimeType:"multipart/form-data",
		contentType: false,
		cache: false,
		processData:false,
		success: function(data, textStatus, jqXHR)
		{
				$("#multi-msg").html(data);
		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			$("#multi-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
		} 	        
   });
	e.preventDefault();
	e.unbind();
}
else  //for olden browsers
{
	//generate a random id
	var  iframeId = 'unique' + (new Date().getTime());

	//create an empty iframe
	var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

	//hide it
	iframe.hide();

	//set form target to iframe
	formObj.attr('target',iframeId);

	//Add iframe to body
	iframe.appendTo('body');
	iframe.load(function(e)
	{
		var doc = getDoc(iframe[0]);
		var docRoot = doc.body ? doc.body : doc.documentElement;
		var data = docRoot.innerHTML;
		$("#multi-msg").html(data);
	});

}

});


$("#multi-post").click(function()
{
	
$("#multiform").submit();

});

});
</script>