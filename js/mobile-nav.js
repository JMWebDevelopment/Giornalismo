jQuery(document).ready(function () {
	jQuery('.mobile-nav').hide();
	jQuery('a.hide-show-mobile-nav').click(function () {
		jQuery('.mobile-nav').slideToggle(400, "linear");
	});
});