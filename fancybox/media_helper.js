if ($(document).innerWidth() > 500) {
	
	$(document).ready(function() {
			/*	 *  Simple image gallery. Uses default settings	 */
		$('.fancybox').fancybox();
			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,	openEffect : 'elastic',	openSpeed  : 50,	closeEffect : 'elastic', closeSpeed  : 50,
				closeClick : true,	helpers : {	overlay : null	}
			});

			$('.fancybox-buttons').fancybox({ openEffect  : 'none',	closeEffect : 'none',	prevEffect : 'none',
				nextEffect : 'none',	closeBtn  : false,	helpers : {	title : {	type : 'inside'
					},	buttons	: {}	},
				afterLoad : function() {this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}		});

			/*	 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked	 */

			$('.fancybox-thumbs').fancybox({	prevEffect : 'none',	nextEffect : 'none',
				closeBtn  : false,	arrows    : false,	nextClick : true,	helpers : {
					thumbs : { width  : 80, height : 80	}	}	});
			/*	 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.	*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')	.fancybox({		openEffect : 'none',		closeEffect : 'none',
					prevEffect : 'none',		nextEffect : 'none', arrows : false,
					helpers : {		media : {},	buttons : {} }	});

			/* *  Open manually	 */

			$("#fancybox-manual-a").click(function() {	$.fancybox.open('1_b.jpg');	});

			$("#fancybox-manual-b").click(function() {	$.fancybox.open({	href : 'iframe.html',	type : 'iframe',
					padding : 5	});	});
		});
}