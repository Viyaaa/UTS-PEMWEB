$(document).ready(function() {
	$('.img1').hover(function() {
		$('.t2').css("opacity", "1");
		$('.t3').css("opacity", "0");
		$('.t4').css("opacity", "0");
	});
	$('.img2').hover(function() {
		$('.t2').css("opacity", "0");
		$('.t3').css("opacity", "1");
		$('.t4').css("opacity", "0");
	});
	$('.img3').hover(function() {
		$('.t2').css("opacity", "0");
		$('.t3').css("opacity", "0");
		$('.t4').css("opacity", "1");
	});
	
} );

