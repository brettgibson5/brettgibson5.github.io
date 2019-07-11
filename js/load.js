$(document).ready(function() {

	$('.dinosaur_toggle').toggle(
	function()
	{
	  $('#dinosaur').animate({
	  top: "-127px" 
	 }, 500);
	},
	function()
	{
	  $('#dinosaur').animate({
	  top: "50px" 
	  }, 500);     
	
	});

	// bind 'myForm' and provide a simple callback function 
	$('#contact_form').ajaxForm(function() { 
		$('.message_success').animate({"opacity": "1" }, 400 ).delay(5000).animate({"opacity": "0"}, 400 );
	}); 



	
    $('.tooltip').tooltipster();
	$(".fancybox").fancybox();
	$(".lettering").lettering();
	
	$(".btn_home").click(function() {$('html, body').animate({scrollTop: $("#home").offset().top}, 1000);});
	$(".btn_about").click(function() {$('html, body').animate({scrollTop: $("#about").offset().top}, 1000);});
	$(".btn_work").click(function() {$('html, body').animate({scrollTop: $("#work").offset().top}, 1000);});
	$(".btn_contact").click(function() {$('html, body').animate({scrollTop: $("#contact").offset().top}, 1000);});
 
});


