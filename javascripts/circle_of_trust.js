const validation = {
    isPhoneNumber:function(str) {
        const pattern = /^\d+$/;
        return pattern.test(str);
    }
}

function showError(ele, msg) {
    ele.addClass('error');
    ele.find('.ui.red.pointing').text(msg);
    ele.find('.ui.red.pointing').show();
    setTimeout(function() {ele.find('.ui.red').hide();}, 7000);
}
function hideError(ele) {
    ele.removeClass('error');
    ele.find('.ui.red.pointing').hide();
}

function showResponse(response) {
    if (!response.response) {
        $('.ui.modal').find('.header').text('Are you lost?');
    } else {
        $('.ui.modal').find('.header').text('Reloading');
    }
    $('.ui.modal').find('.content').text(response.message);
    $('.ui.modal').modal('show');
    setTimeout(function() {
        location.reload();
    }, 4000);
}

$(document).ready(function() {
    $('button').attr("disabled", false);
    //circle type - 1 whole, 0.5 half, 0.25 quarter
    var type = 1,
        //distance from center
        radius = '200%',
        //shift start from 0
        start = -90,
        $elements = $('li:not(:first-child)'),
        //For even distro of elements of comrades
        numberOfElements = (type === 1) ?  $elements.length : $elements.length - 1, 
        slice = 360 * type / numberOfElements;

    $elements.each(function(i) {
        var $self = $(this),
            rotate = slice * i + start,
            rotateReverse = rotate * -1;
        
        $self.css({
            'transform': 'rotate(' + rotate + 'deg) translate(' + radius + ') rotate(' + rotateReverse + 'deg)'
        });
    });

    var circleOfTrust = $('.circle-of-trust-page .circle-of-trust'),
        editComrades = $('.circle-of-trust-page .edit-comrades-section'),
        comradeAction = $('.circle-of-trust-page .comrade-action-section');


    circleOfTrust.fadeIn();
    $('.icon.angle.left').on('click', function() {
        editComrades.fadeOut('slow');
        comradeAction.fadeOut('slow');
        circleOfTrust.delay(500).fadeIn('slow');
    })
    $('.icon.edit').on('click', function() {
        comradeAction.fadeOut('slow');
        circleOfTrust.fadeOut('slow');
        editComrades.delay(500).fadeIn('slow');
    });
    $('.get-help-button').on('click', function() {
        circleOfTrust.fadeOut('slow');
        editComrades.fadeOut('slow');
        comradeAction.delay(500).fadeIn('slow');
    });
    $('.comrade-form .submit').on('click', function(e) {
        e.preventDefault();
        var comradesData = [],
            comradesDataElement = '.comrade-data',
            validData = true;
        $(comradesDataElement).each(function(i) {
            var ele = $(comradesDataElement)[i],
                eleId = '#' + ele.id,
                val = $(eleId).val().trim();

            if (val.length > 0) {
                if (validation.isPhoneNumber(val) && val.length > 5 && val.length < 12) {
                    comradesData.push(val);
                } else {
                    validData = false;
                    showError($(eleId).parent(), 'Please enter a valid number');
                }
            }
        });
        if (comradesData.length == 0) {
            validData = false;
            showError($('#' + $('.comrade-data')[0].id).parent(), 'Please enter atleast one valid number');
        }

        if (validData) {
            var postData = {
                type: 'update_circle_data',
                comrades_data: comradesData,
                csrf_token: CSRF_TOKEN
            }
            try {                                                                                                               
                $.ajax({
                    url: 'request/circle_of_trust.php',
                    type: "POST", 
                    dataType: 'json',
                    data: postData,
                    success: function(response) {
                        showResponse(response);
                    }
                });
            } catch (error) {
                return false;
            }
        }
    })
});
