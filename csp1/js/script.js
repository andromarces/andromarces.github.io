/* offcanvas script */
$(function () {
	'use strict'

	$('[data-toggle="offcanvas"]').on('click', function () {
		$('.sidebar-offcanvas').toggleClass('active')
	})
})

$(function () {
	'use strict'

	$(document).on('click', function (event) {
		if(!$(event.target).closest('#sidebar').length) {
			if($('.sidebar-offcanvas').hasClass('active')){
				$('.sidebar-offcanvas').toggleClass('active')
			}
		}
	})
})