'use strict';

var listsApp = angular.module('listsApp', [
	'listsAppControllers'
	]);


/**
 * Header Shrink on Scroll
 * @type {*|jQuery|HTMLElement}
 */
var header = $('.header'),
	headerHeight = header.height();

$(window).on('scroll', $.debounce(100, false, function() {
	var distanceY = $(window).scrollTop();

	if(distanceY > (headerHeight/3)) {
		header.addClass('small');
	} else {
		header.removeClass('small');
	}
}));