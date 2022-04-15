<script src="../js/jquery-1.7.2.min.js"></script>

<?php 
// config
include_once "../../includes/configuration.php";// custom config to get variables
include_once('../../../php.files/classes/kas-framework.php');// custom config to get variables
//Include global functions
include_once "../../includes/common.php";
//Include paging class
include_once "../../includes/ez_results.php";

$mybadge = $kas_framework->getValue('school_badge_path', 'tbl_config', 'id', '1'); 
$mylogo = $kas_framework->getValue('school_logo_path', 'tbl_config', 'id', '1'); 

$title ="Upload badge";

// load contents we need
// this php script gets its data from pages/main/view_users.php
//if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}
?>
<div class="col-sm-6 col-sm-offset-3">

<br />	
<div style="margin:0 auto">
<center><table width="100%" border="0" style="box-shadow:10px 10px 60px #999">
  <tr>
    <th scope="col" align="left">&nbsp;&nbsp;&nbsp;Current Badge</th>
    <th scope="col" align="right">Current Logo &nbsp;&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <td><img id="badge" title="Badge" alt="Badge" src="../../../files/images/<?php echo $mybadge;?>" width="180px" /></td>
    <td><img id="logo" align="right" title="Logo" alt="Logo"  src="../../../files/images/<?php echo $mylogo;?>" width="180px" /></td>
  </tr>
</table></center>

</div>
	<table width="80%" border="0">
  <tr>
    <th scope="col"><div align="left"><form name="multiform" id="multiform" action="school_badge_upload.php" method="post" enctype="multipart/form-data">
  <p>
  <input type="hidden" name="mytype" value="badge" />
    <input type="hidden" name="changePicture" value="yes" />
 <br />
  Update  <select name="kind" style="padding:4px 10px"> 
   <option></option>
 <option>Badge</option>
 <option>Logo</option>
  </select> </p>

  <p>
    <input type="file" name="myphoto"  />
    
  </p>
</form>
					
<input type="button"  id="multi-post" class="btn btn-default btn-sm" value="Upload & Replace" /></div>
</th>
    <th scope="col"><div align="right" id="multi-msg"></div></th>
  </tr>
</table>
	
<script>
$(document).ready(function(){
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

$("#multiform").submit(function(e) {
//alert('we are good');
		$("#multi-msg").html("<img src='../bigajax.png'/>");

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
					$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
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
	
	
	
