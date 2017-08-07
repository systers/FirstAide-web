$(document).ready(function() {
    var speed = 100,
    	cardElements = $('.ui.multi.raised.cards'),
    	current = 0;

    $(".next-button").click(function() {
        if(current + 1 < cardElements.length) {
        	$('.ui.multi.raised.cards').eq(current).addClass('hide');
        	current += 1;
        	$('.ui.multi.raised.cards').eq(current).removeClass('hide');
        }
        $(".previous-button").show();
        if(current == cardElements.length - 1) {
        	$(".next-button").hide();
        }
    });


    $(".previous-button").click(function() {
        if(current - 1 >= 0) {
        	$('.ui.multi.raised.cards').eq(current).addClass('hide');
        	current -= 1;
        	$('.ui.multi.raised.cards').eq(current).removeClass('hide');
        }
        $(".next-button").show();
        if(current == 0) {
    	    $(".previous-button").hide();
    	}
    });

    $(".gallery li").click(function() {
        var first = $(this).parent().children(':first'),
            next = $(this).next();
            next = next.index() == -1 ? first : next;
        $(this).fadeOut(speed, function() {next.fadeIn(speed);});
    }); 
});