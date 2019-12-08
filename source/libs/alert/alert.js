$(document).ready(function() {
	/**
	Displays the appropriate popup when clicked
	*/
	$(document.body).on("click", ".alert", function(e) {
		var target = $(e.target);
		
		target.closest(".alert").hide(100);
	});
});

function createAlert(type, mainMessage, subMessage) {
	return "<div class='wrapper alert " + type + "' title='Click to Dismiss'><div>" + 
	"<p class='main'>" + mainMessage + "</p>" + 
	"<p class='main'>" + subMessage + "</p>" + 
	"</div></div>";
}