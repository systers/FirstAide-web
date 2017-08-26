/**
 * nextSegment() shows the next page containing more cards
 * and hides the current segment
 */
function nextSegment(current) {
    if (typeof current === 'undefined') { current = 0; }

    if(current + 1 < $('.ui.grid.multi-segment').length) {
        $('.ui.grid.multi-segment').eq(current).addClass('hide');
        current += 1;
        $('.ui.grid.multi-segment').eq(current).removeClass('hide');
    }
    $(".previous-button").show();
    if(current == $('.ui.grid.multi-segment').length - 1) {
        $(".next-button").hide();
    }
    return current;
}

/**
 * previousSegment() shows the previous page containing more cards
 * and hides the current segment
 */
function previousSegment(current) {
    if (typeof current === 'undefined') { current = 0; }

    if(current - 1 >= 0) {
        $('.ui.grid.multi-segment').eq(current).addClass('hide');
        current -= 1;
        $('.ui.grid.multi-segment').eq(current).removeClass('hide');
    }
    $(".next-button").show();
    if(current == 0) {
        $(".previous-button").hide();
    }
    return current;
}

$(document).ready(function() {
    window.current = (typeof window.current !== 'undefined') ? window.current : 0;

    $(".next-button").click(function() {
        window.current = nextSegment(window.current);
    });

    $(".previous-button").click(function() {
        window.current = previousSegment(window.current);
    });
});