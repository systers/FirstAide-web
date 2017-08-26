/**
 * showResponseModal() displays a modal on receiving response
 *
 * @response{dictionary} contains ajax call response
 * @pageReload{bool value} used to determine if the page needs to be loaded or not based on the response
 */
function showResponseModal(response, pageReload) {
    if (typeof response !== 'undefined') {
        if (typeof pageReload === 'undefined') { pageReload = true; }
        if (!response.response) {
            $('.ui.modal').find('.header').text('Are you lost?');
        } else {
            $('.ui.modal').find('.header').text('Reloading');
        }
        $('.ui.modal').find('.content').text(response.message);
        $('.ui.modal').modal('show');
        if (pageReload) {
            setTimeout(function() {
                location.reload();
            }, 4000);
        }
    }
}

/**
 * placeCircleOfTrustIcons() used to place all the comrade icons in a circle
 *
 */
function placeCircleOfTrustIcons() {
    //circle type - 1 whole, 0.5 half, 0.25 quarter
    var type = 1,
        //distance from center
        radius = '200%',
        //shift start from 0
        start = -90,
        $elements = $('.circle li:not(:first-child)'),
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
}

/**
 * toggleCircleOfTrustSections() used to toggle views between circle of trust section, edit comrades details section and get help via sms section
 *
 * @action{string} determines the action based on which the view is rendered
 */
function toggleCircleOfTrustSections(action) {
    var circleOfTrust = $('.circle-of-trust-page .circle-of-trust'),
        editComrades = $('.circle-of-trust-page .edit-comrades-section'),
        comradeAction = $('.circle-of-trust-page .comrade-action-section');


    if (action === 'back') {
        editComrades.fadeOut('slow');
        comradeAction.fadeOut('slow');
        circleOfTrust.delay(500).fadeIn('slow');
    } else if (action === 'edit') {
        comradeAction.fadeOut('slow');
        circleOfTrust.fadeOut('slow');
        editComrades.delay(500).fadeIn('slow');
    } else if (action === 'help') {
        circleOfTrust.fadeOut('slow');
        editComrades.fadeOut('slow');
        comradeAction.delay(500).fadeIn('slow');
    }
}


$(document).ready(function() {
    $('button').attr("disabled", false);

    placeCircleOfTrustIcons();
    $('.circle-of-trust-page .circle-of-trust').fadeIn();
    $('.icon.angle.left').on('click', function() {
        toggleCircleOfTrustSections('back');
    });

    $('.icon.edit').on('click', function() {
        toggleCircleOfTrustSections('edit');
    });

    $('.get-help-button').on('click', function() {
        toggleCircleOfTrustSections('help');
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
                if (validation.isPhoneNumber(val) && val.length > 5 && val.length < 16) {
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
                        showResponseModal(response);
                    }
                });
            } catch (error) {
                return false;
            }
        }
    });

    $('.comrade-action-button').on('click', function() {
        var postData = {
            type: 'send_sms_circle_of_trust',
            msg_type: $(this).attr('id')
        }
        try {
            $.ajax({
                url: 'request/send_notification.php',
                type: "POST",
                dataType: 'json',
                data: postData,
                success: function(response) {
                    showResponseModal(response, false);
                }
            });
        } catch (error) {
            return false;
        }
    });
});
