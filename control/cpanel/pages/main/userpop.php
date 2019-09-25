	<div class="modal hide fade" id="editModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> School Profile</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/editprofile.php');?>

			</div>
		
			<div class="modal-footer">
			
			<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	<div class="modal hide fade" id="editName">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> Profile</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/editname.php');?>

			</div>
		
			<div class="modal-footer">
			
			<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
<div class="modal hide fade" id="editContact">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> Contact details</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/editcontact.php');?>

			</div>
		
			<div class="modal-footer">
			
			<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>

	<div class="modal hide fade" id="editphoto">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> Photos</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/editphoto.php');?>

			</div>
		
			<div class="modal-footer">
			
		<a href="" class="btn">Continue</a>	<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
	<div class="modal hide fade" id="editpassword">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> Portal detail</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/editpassword.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	<div class="modal hide fade" id="profileBarn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3>Edit <?php echo $std_fname;?> Barn</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/barn.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
		<div class="modal hide fade" id="profileDelete">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Delete</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/delete.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
		<div class="modal hide fade" id="profileWallet">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Wallet</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/wallet.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
		<div class="modal hide fade" id="profileSms">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> SMS</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/sms.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
	
	
		<div class="modal hide fade" id="profileEmail">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Email</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/email.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
	
		<div class="modal hide fade" id="profileParent">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Parent</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/parent.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
		<div class="modal hide fade" id="profilePromote">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Promote</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/promote.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
	
	
		<div class="modal hide fade" id="profileDemote">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Demote</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/demote.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
		<div class="modal hide fade" id="profileSuspend">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Suspend</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/suspend.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
	
		<div class="modal hide fade" id="profilePrint">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Print</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/print.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
	
	
		<div class="modal hide fade" id="profileExport">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Export</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/export.php');?>

			</div>
		
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	
	</div>
	
<div class="modal hide fade" id="profileSend">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">*</button>
				<h3><?php echo $std_fname;?> Send</h3>
			</div>
			<div class="modal-body"><!-- please use ajax to handle this -->
				<?php include_once('ajax/profile/send.php');?>

			</div>
			<div class="modal-footer">
			
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
	</div>
	
	
<script>
$(document).ready(function()
{
	  //$('#simple-msg').hide();

	
$("#simple-post").click(function()
{
	$("#ajaxform").submit(function(e)
	{
	//$('#simple-msg').show();
		$("#simple-msg").html("<img src='ajax/profile/ajax-loader.gif'/>");
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
		$("#name-msg").html("<img src='ajax/profile/ajax-loader.gif'/>");
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
		$("#name-msg").html("<img src='ajax/profile/ajax-loader.gif'/>");
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
		$("#multi-msg").html("<img src='ajax/profile/ajax-loader.gif'/>");

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