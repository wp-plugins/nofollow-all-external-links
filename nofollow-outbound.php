<?php
/*
Plugin Name: No Follow All External Links
Version: 1.0
Plugin URI: http://riseofweb.com
Description: No Follow all external links. The nofollow is added last thing before page load.  This effects all code (theme and content).
Author: Daniel Chase
Author URI: http://riseofweb.com
*/

function noFollowReplace($buffer){ // $buffer contains entire page
	$currentSite = site_url();
	$find = '/( href=")(?!(' . str_replace('/', '\/', $currentSite) . ')|\#|\/)/i';
	$replace = ' rel="nofollow" href="$2';
	$buffer = preg_replace($find, $replace, $buffer);
	return $buffer;
}

function noFollowAll(){
	ob_start();
	ob_start('noFollowReplace');
}
add_action('template_redirect', 'noFollowAll');
?>