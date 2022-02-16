// Start Checked User Type
function registration()
{
    var UserChecked , UserId ,lop;

    UserChecked=document.getElementsByName('usertype');
    lop = UserChecked.length;
    for(var i=0;i<lop;i++)
    {
        if(UserChecked[i].checked)
        {
            UserId = UserChecked[i].value;
            
        }
    }

    if(UserId == 3)
    {
        window.location.replace("StudentVerification");
    }
    else if(UserId == 4)
    {
       
        window.location.replace("TecherVerification");
    }
    else if(UserId == 5)
    {
        alert("Sorray you Can't Countec Whit us ^_^");
    }
    else 
    {
        alert("Select one item to continue");
    }
}
//  End  Checked User Type

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


/* ************************* */
/*$(document).ready(function()
{
    $("#my-tabs li").click(function()
    {
        var myID = $(this).attr("id");
        console.log(myID);

        $(this).removeClass("inactive").siblings().addClass("inactive");

        $(".my-container div").hide();

        $("#"+myID+"-content").fadeIn("1000");

    });
}); */
