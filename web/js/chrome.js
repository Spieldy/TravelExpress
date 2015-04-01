$(function() {
	var notices = $("#JsFlashBagsNotices").text().trim();
	var errors = $("#JsFlashBagsErrors").text().trim();
    
    if (notices.length > 0) {
    	swal("", notices, "success");
    }
    if (errors.length > 0) {
    	swal("", errors, "warning");
    }
});