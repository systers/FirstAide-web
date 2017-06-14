$(document).ready(function() {
    var speed = 100,
    	cardElements = $('.ui.grid.multi-segment'),
    	current = 0;

    $(".next-button").click(function() {
        console.log($('.ui.grid.multi-segment').eq(current));
        if(current + 1 < cardElements.length) {
        	$('.ui.grid.multi-segment').eq(current).addClass('hide');
        	current += 1;
        	$('.ui.grid.multi-segment').eq(current).removeClass('hide');
        }
        $(".previous-button").show();
        if(current == cardElements.length - 1) {
        	$(".next-button").hide();
        }
    });


    $(".previous-button").click(function() {
        if(current - 1 >= 0) {
        	$('.ui.grid.multi-segment').eq(current).addClass('hide');
        	current -= 1;
        	$('.ui.grid.multi-segment').eq(current).removeClass('hide');
        }
        $(".next-button").show();
        if(current == 0) {
    	    $(".previous-button").hide();
    	}
    });
});