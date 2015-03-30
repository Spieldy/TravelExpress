$(function() {
	var flashBags = $("#JsFlashBags");
	// if a revoir
    if (flashBags.text().length() > 0) {
    	swal("Good job!", flashBags.text(), "success"); }
});