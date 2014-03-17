/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );
    $("#select").click(function() {
  alert( "Handler for .click() called." );
    });
});
function myFunction()
{
    // Ajax with jQuery...For info: https://api.jquery.com/jQuery.post/
    $.post( "xmlToJson.php")
            .done( function( data ) {
                    var data = jQuery.parseJSON( data ); //Parse into readable JSON
                    console.log(data);//for Testing
                    // createLineGraph( data ); //Then parse out values I need in function
            });//end .done
}

