 /* attach a submit handler to the form */
    $("#createpin").submit(function(event) {
alert('working');
      /* stop form from submitting normally */
      event.preventDefault();
	   document.getElementById("cc").innerHTML='&nbsp;&nbsp;&nbsp;Just chill, Innovation is loading...&nbsp;&nbsp;&nbsp;&nbsp;<img src="gears-anim.gif"> </img>';// use big image


      /* get some values from elements on the page: */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post */
      var posting = $.post( url, { name: $('#name').val(), name2: $('#name2').val() } );

      /* Put the results in a div */
      posting.done(function( data ) {
	  $('#cc2').hide();
        alert('success');
      });
    });