$(document).ready(function() {
	/**
	Displays the appropriate popup when clicked
	*/
	$(document.body).on("click", ".popup_link", function(e) {
		var target = $(e.target);
		var id = target.closest('.popup_link').attr('data-popup-id');
		
		$(".popup_overlay").show();
		$(".popup_panel[data-popup-id='" + id + "']").show();
	});

	/**
	Closes the appropriate popup when a close button is clicked
	*/
	$(document.body).on("click", ".popup_close", function(e) {
		var target = $(e.target);
		
		$(".popup_overlay").hide();
		target.closest(".popup_panel").hide();
	});

	/**
	Closes the appropriate popup when the overlay is clicked
	*/
	$(document.body).on("click", ".popup_overlay", function(e) {
		$(".popup_overlay").hide();
		$(".popup_panel").hide();
	});
});