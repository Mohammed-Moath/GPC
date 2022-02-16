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