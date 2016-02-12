(function($) {

	'use strict';

	GFL.subscribe('edge.create', function(url) {
		ga('send', 'social', 'facebook', 'like', url);
	});


	GFL.subscribe('edge.remove', function(url) {
		ga('send', 'social', 'facebook', 'unlike', url);
	});


	GFL.subscribe('comment.create', function(url) {
		ga('send', 'social', 'facebook', 'comment', url);
	});


	GFL.subscribe('comment.remove', function(url) {
		ga('send', 'social', 'facebook', 'remove comment', url);
	});

})(jQuery);