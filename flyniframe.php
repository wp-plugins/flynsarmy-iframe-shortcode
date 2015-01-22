<?php
/*
Plugin Name: IFrame Shortcode
Plugin URI: http://www.flynsarmy.com
Description: Allows the insertion of code to display an external webpage within an iframe. The tag to insert the code is: <code>[iframe src="http://yoururl.com" width="400" height="600"]</code>
Version: 1.0.3
Author: Flyn San
Author URI: http://www.flynsarmy.com

1.0   - Initial release
1.0.2 - Style tweaks
1.0.3 - Tinymce button fix
*/

add_shortcode( 'iframe', function( $atts ) {

	// Use wp_parse_args rather than shortcode_atts so we can add
	// any and all HTML attribs
	$atts = wp_parse_args($atts, array(
		'src' => '',
		'width' => '500',
		'height' => '480',
		'frameborder' => 0,
	));

	$html = '<iframe ';
	foreach ( $atts as $name=>$val )
		$html .= $name . '="' . str_replace('"', "'", $val) . '" ';
	$html .= '></iframe>';

	return $html;
});

// Add TinyMCE button
add_action('admin_init', function() {
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') != 'true')
		return;

	add_filter("mce_external_plugins", function($plugin_array) {
		$plugin_array['flyniframe'] = admin_url('admin-ajax.php?action=flyniframe_tinymce_modal_js');
		return $plugin_array;
	});
	add_filter('mce_buttons', function($buttons) {
		array_push($buttons, "|", "flyniframe");
		return $buttons;
	});
});

add_action('wp_ajax_flyniframe_tinymce_modal_js', function() {
	header('Content-Type: application/javascript');

	require __DIR__.'/scripts/iframe.js.php';
	exit;
});

add_action('wp_ajax_flyniframe_tinymce_modal', function() {
	require __DIR__.'/partials/iframe.php';
	exit;
});
?>
