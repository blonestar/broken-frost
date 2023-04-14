<?php
/**
 * This file adds functions to the No Frost WordPress theme.
 *
 * @package No Frost
 * @author  WP Engine
 * @license GNU General Public License v2 or later
 * @link    https://frostwp.com/
 */

include "inc/inc.vite.php";


if ( ! function_exists( 'nofrost_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function nofrost_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'nofrost', get_template_directory() . '/languages' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./style.css',
			)
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'nofrost_setup' );

// Enqueue style sheet.
add_action( 'wp_enqueue_scripts', 'nofrost_enqueue_style_sheet' );
function nofrost_enqueue_style_sheet() {

	wp_enqueue_style( 'nofrost', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function nofrost_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'nofrost' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'nofrost' ),
		),
		'core/navigation-link' => array(
			'outline' => __( 'Outline', 'nofrost' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'nofrost' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'nofrost_register_block_styles' );
