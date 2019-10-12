$(document).ready(function(){
	

	
	var backgroundArr = ['green', 'blue', 'red'];
	
	/// email form handling
	
    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "contact.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    });	
	
	// jquery evt handlers
	
	$('.nav-button').click(function(){
		if($(this).attr('linkTo')){
			$('html,body').stop().animate({
				scrollTop: $($(this).attr('linkTo')).offset().top
			},500);
		}
	});
	
	$('#mobileNavbar').on('show.bs.collapse', function (e) {
		$('#navToggle').addClass('active');
	});
	
	$('#mobileNavbar').on('hide.bs.collapse', function (e) {
		$('#navToggle').removeClass('active');
	});
	
	/// on scroll
	function makeTheWorldGoRound() { // Correct way
		var a = document.getElementById("worldObject");
		// Get the SVG document inside the Object tag
		var svgDoc = a.contentDocument;
		// Get one of the SVG items by ID;
		var svgItem = svgDoc.getElementById("worldSvg");
		// Set the colour to something else
		var maxHeight = $(document).height() - $(window).height();
		var p1 = $(window).scrollTop()/maxHeight;
		var rotDeg = p1*360;
		svgItem.setAttribute("transform", "rotate("+rotDeg+", 286.1115, 286.1115)");
		
	}
	
	$( window ).scroll(function() {
		if($(window).width() <= 768)
			return;
		makeTheWorldGoRound()
		if($(window).innerHeight() - $(window).scrollTop() < -200 ){
		  var amountFromTop = $(window).innerHeight() - $('#svgContainer').height() - 100;
		  if(!($('#svgContainer').offset().top == amountFromTop)){
			  $('#svgContainer').stop().animate({
				  top: amountFromTop
			  },  400);
			  
		  }
		} else {
		  if(!($('#svgContainer').offset().top == 100)){
			  $('#svgContainer').stop().animate({
				  top: 150
			  }, 400);

		  }
		}
	});
	
	/// on load and resize
	
	function setGreetingContainer(){
		var windowHeight = $(window).height() - $('.navbar').height() + 20;
		$('#greetingContainer').height(windowHeight);
	}
	
	setGreetingContainer();
	
	$(window).on('resize', function(e) {
	  if(this.resizeTimer)
		clearTimeout(resizeTimer);
	  this.resizeTimer = setTimeout(function() {
		setGreetingContainer();		
	  }, 200);

	});
	
	$('#banner').animate({
		opacity: 1
	},700);
	
	$(function() {
		var backgroundNum = Math.floor(Math.random() * (backgroundArr.length - 0)) + 0;
		var classToAdd = backgroundArr[backgroundNum];
		$('.colorChange').addClass(classToAdd);
	});
	
});