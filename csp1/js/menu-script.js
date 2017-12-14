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

/* back to top script */
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
		document.getElementById("topBtn").style.display = "inline-block";
	} else {
		document.getElementById("topBtn").style.display = "none";
	}
}

$(function () {
	'use strict'

	$('[data-toggle="top"]').on('click', function () {
		document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
})
})

/* show tab based on url hash */
if (location.hash) {
	$('a[href=\'' + location.hash + '\']').tab('show');
}
var activeTab = localStorage.getItem('activeTab');
if (location.hash) { $('a[href=\'' + location.hash + '\']').tab('show');
} else if (activeTab) { $('a[href="' + activeTab + '"]').tab('show');
}

$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
	e.preventDefault()
	var tab_name = this.getAttribute('href')
	if (history.pushState) {
		history.pushState(null, null, tab_name)
	}
	else {
		location.hash = tab_name
	}
	localStorage.setItem('activeTab', tab_name)

	$(this).tab('show');
	return false;
});
$(window).on('popstate', function () {
	var anchor = location.hash ||
	$('a[data-toggle=\'tab\']').first().attr('href');
	$('a[href=\'' + anchor + '\']').tab('show');
});

