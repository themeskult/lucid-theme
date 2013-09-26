jQuery(document).ready(function($) {

	$('.main-post').flexslider({
		animation: "slide",
		selector: ".slides > article",
		directionNav: false
	});

	$('pre').addClass('prettyprint');

	// $('body.single .snap-content').css('height', $('#main').innerHeight());

	// $('article.post').readingTime();

	var snapper = new Snap({
	    element: document.getElementById('snap-content'),
	    disable: 'right',
	    touchToDrag: false,
	    hyperextensible: false
	});

	var myToggleButton =  document.getElementById('myToggleButton');

	if (jQuery("#myToggleButton").length>0) {

	    myToggleButton.addEventListener('click', function(e){
	    	e.preventDefault();

	        if( snapper.state().state=="left" ){
	            snapper.close();
	        } else {
	            snapper.open('left');
	        }

	    });

	};
});
