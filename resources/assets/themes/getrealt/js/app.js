!function(n){n.fn.parallax=function(o){var e=n(window).height(),t=n.extend({speed:.15},o);return this.each(function(){var o=n(this);n(document).scroll(function(){var r=n(window).scrollTop(),a=o.offset().top,c=o.outerHeight();if(!(a+c<=r||a>=r+e)){var i=Math.round((a-r)*t.speed);o.css("background-position","center "+i+"px")}})})}}(jQuery),function(){var n=angular.module("app",[]),o=function(n){n.advancedSearch=!0};n.controller("home",["$scope",o])}();