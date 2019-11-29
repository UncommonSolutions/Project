$(document).ready(function() {
	/**
	Displays the appropriate popup when clicked
	*/
	$(document.body).on("click", ".alert", function(e) {
		var target = $(e.target);
		
		target.closest(".alert").hide(100);
	});
});