// Start Placeholder hide on form focus
$(function () {

    'use strict';

    // Hide Placeholder on Form Focus

    $('[placeholder]').focus(function(){

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder','');

    }).blur(function () {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });
    
});
// End Placeholder hide on form focus

// Start show detelis group from GPCO Users
$(document).ready(function() {
    $('[id^=detail-]').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    });
});

// End show detelis group from GPCO Users





