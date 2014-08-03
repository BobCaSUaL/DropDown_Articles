<?php
/*
  Plugin Name: Drop-Down Articles
  Plugin URI: https://github.com/BobCaSUaL/DropDown_Articles/
  Description: Make cools drop-down text with ShortCode.
  Version: 0.1
  Author: BobCaSUaL<casual4free(at)gmail.com>
  Author URI: https://github.com/BobCaSUaL
  License: GNU General Public License v3 or later
  License URI: http://www.gnu.org/copyleft/gpl.html
 */

// Use jQuery
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery' );
} );

// The shortcode
add_shortcode( 'drop-down_article', function ($atts, $content = null) {

	//extract the arguments setting its defaults values
	extract( shortcode_atts( array(
		'title'	=> 'noTitle',
		'wrapperTag' => 'section',
		'titleTag' => 'h3',
		'contentTag' => 'p',
		'wrapperStyle' => '',
		'titleStyle' => '',
		'contentStyle' => '',
		'effect' => 'no',
		'hidden' => 'yes',
	), $atts ) );
	
	//should the content be hidden by default?
	$contentStyle .= ($hidden === "yes" || $hidden === "true") ? ' display: none;' : '';
	
	//set the chosen effect
	switch( $effect ) {
		case 'slide':
			$effect = 'slideToggle';
			break;
		case 'fade':
			$effect = 'fadeToggle';
			break;
		default:
			$effect = 'toggle';
	}
			
	//the click function for the title
	$onTitleClick = "jQuery(this).next().$effect()";
	
	//the result of the shortcode
	return 
<<<HTML
  <{$wrapperTag} style="{$wrapperStyle}">
	<{$titleTag} onclick="{$onTitleClick}" style="{$titleStyle}"><a href="#">{$title}</a></{$titleTag}>
	<{$contentTag} style="{$contentStyle}">
	  {$content}
    </{$contentTag}>
  </{$wrapperTag}>
HTML;
} );
