<?php
/**
 * Block themes render from theme.json and block stylesheets, and do not
 * enqueue the theme's own style.css the way a classic theme does - so without
 * this, style.css is parsed for its header metadata and its rules are ignored.
 *
 * @package ctg-games
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'ctg-games-style',
			get_stylesheet_uri(),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
);
