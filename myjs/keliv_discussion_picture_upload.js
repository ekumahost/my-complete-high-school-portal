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

$("#form_ID").submit(function(e) {
//alert('we are good');
	$("#message_div").html("<center> Uploading Picture... <img src='../../../../img/ajax-loader_h.gif' /></center>").show();

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
				$("#message_div").html(data).show();
		    },
		  	error: function(jqXHR, textStatus, errorThrown) 
	    	{
				$("#message_div").html('<pre><code class="prettyprint">Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>').show();
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
			$("#message_div").html(data).show();
		});
	
	}

	});
});