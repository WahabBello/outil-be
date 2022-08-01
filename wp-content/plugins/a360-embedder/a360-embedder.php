<?php
/*
Plugin Name: a360-embedder
Plugin URI: http://wordpress.org/plugins/a360-embedder/
Description: Embed Autodesk BIM 360, Fusion 360, or A360 content | Sample Shortcode [a360 src="https://myhub.autodesk360.com/ue294cc65/shares/public/SHabee1QT1a327cf2b7ab82fe63a09f449dc"]
Version: 0.1
Author: Eric Boehlke - truevis.com
Author URI: http://truevis.com/a360-embedder-wordpress-plugin/
License: GPLv3
*/

define('a360-embedder_PLUGIN_VERSION', '0.1');

function truevisA360_func( $atts ) {
	$defaults = array(
		'src' => 'https://a360.autodesk.com',
        'width' => '1024' ,
        'height' => '768'
	);
	foreach ( $defaults as $default => $value ) { // add defaults
		if ( ! @array_key_exists( $default, $atts ) ) { // mute warning with "@" when no params at all
			$atts[$default] = $value;
		}
	}	
	$html .= '<iframe';
	foreach( $atts as $attr => $value ) {
				$html .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $value ) . '"';
	}
	$html .= ' allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" frameborder="0" class="iframe-class"></iframe><br><a href=';
    $html .= '"'. $atts["src"] . '"';
    $html .= ' target="_blank" title="View Separately"><img border="0" alt="View Separately" src="' . plugins_url( 'popout50.png', __FILE__ ) . '" width="35" height="35"></a>'."\n";
	
	return $html;
}

add_shortcode('a360', 'truevisA360_func');