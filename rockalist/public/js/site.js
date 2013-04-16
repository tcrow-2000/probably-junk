var radio = document.getElementById('radio');
radio.src = 'public/audio/radio1.mp3';
var specialAudio = document.getElementById('special-audio');

$(document).ready(function() {
    
    if ($('#active-user').val()) {
        $('#selection-container').find('>:nth-child(2)').hide(200);
        $('#screen-login').remove();
    };
    /*
     * Tuner selection
     */
    $('.selection').click(function() {
        $('#inner-screen .subscreen').appendTo('#screen-cache');
        radio.play();
        var screen = $(this).data('screen');
        var p = $(this).position().left;
        $('#selection-box').animate({left: p}, 1000, function() {
           radio.pause();
           if (screen === 'screen-logout') {
               document.location = 'logout.php';
               return;
           }
           $('#' + screen).appendTo($('#inner-screen'));
        });
    });
    
    /*
     * Light buttons
     */
    function lightButtonSwitch(lb, mode) {
        var backLight = lb.find('>:first-child');
        var color = backLight.data(mode);
        backLight.css('backgroundColor', color); 
    };
    $('.light-button').each(function() {
        lightButtonSwitch($(this), 'off');
    });
    $('.light-button').click(function() {
        if ($(this).hasClass('on')) {
            $(this).removeClass('on');
            lightButtonSwitch($(this),'off');
            specialAudio.pause();
            return;
        }
        $(this).addClass('on');
        lightButtonSwitch($(this),'on');
        $(this).siblings().each(function() {
            $(this).removeClass('on');
            lightButtonSwitch($(this), 'off');
        });

        specialAudio.src = $(this).data('audio');
        console.log(specialAudio.src);
        specialAudio.play();
    });
    
    /*
     * Tests
     */
    $('#test').click(function() {
        $('#selection-container').find('>:nth-child(2)').hide(200);
    });
    $('#test2').click(function() {
        $('#selection-container').find('>:nth-child(2)').show(200);
    });
    
    /*
     * Subscreen actions
     */
    $('.selectable-action').click(function() {
       $(this).siblings().each(function() {
          $(this).removeClass('selected');
          $('#' + $(this).data('action')).hide();
       });
       $(this).addClass('selected');
       $('#' + $(this).data('action')).show();
    });
    
    /*
     * Login / register actions
     */
    $('#screen-login').appendTo($('#inner-screen'));
    $("[data-action='show-login']").click();

    $('.client-selection').click(function() {
        $('.client-selection .selected').removeClass('selected');
        $(this).find('.selection-inner').addClass('selected');
    });
    
    $('#login').click(function() {
        $.post( 'do/action.php',
            {'action':'loginUser', 'email':$('#email').val(), 'pass':$('#password').val()}, 
            function(data) {
                if (data.success) {
                    location.reload();
                } else {

                }
            },
            'json'
        );
    });
    
    $('#register').click(function() {
        $.post( 'do/action.php',
            {'action':'registerUser', 'email':$('#new-email').val(), 'pass':$('#new-password').val()}, 
            function(data) {
                if (data.success) {
                    $("[data-screen='screen-faq']").click();
                } else {

                }
            },
            'json'
        );
    });
    
    
    /*
     * F.A.Q actions
     */
    $('.faq-item').click(function() {
       $('.faq-item.selected').removeClass('selected');
       $(this).addClass('selected');
       var msg = $(this).data('message');
       $('.faq-message.active').removeClass('active');
       $('#' + msg).addClass('active');
    });
});