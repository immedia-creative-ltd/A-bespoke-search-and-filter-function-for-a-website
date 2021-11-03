// JavaScript Document
//send variables on change


$(document).ready ( function(){

function mySortby(){
	alert ("function mySortby running");		
}

$('#sortby').on('change', function() {
	mySortby();
});	

});	