<?php
/**
 * Plugin Name:     Hetas Block Search Navigation Bar
 * Description:     Holds all the template of building out the Search Naviation.
 * Version:         0.1.0
 * Author:          Elliott Richmond
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     create-block
 *
 * @package         create-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function create_block_hetas_block_search_navigation_bar_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/hetas-block-search-navigation-bar" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-hetas-block-search-navigation-bar-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'editor.css';
	wp_register_style(
		'create-block-hetas-block-search-navigation-bar-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'style.css';
	wp_register_style(
		'create-block-hetas-block-search-navigation-bar-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'create-block/hetas-block-search-navigation-bar', array(
		'editor_script' => 'create-block-hetas-block-search-navigation-bar-block-editor',
		'editor_style'  => 'create-block-hetas-block-search-navigation-bar-block-editor',
		'style'         => 'create-block-hetas-block-search-navigation-bar-block',
		'render_callback' => 'hetas_block_search_navigation_bar_block_callback'
	) );
}
add_action( 'init', 'create_block_hetas_block_search_navigation_bar_block_init' );

function hetas_block_search_navigation_bar_block_callback($attributes, $content) {
	$html = '<div class="search-area border">';
	$html .= '<div class="btn-group btn-group-justified" role="group" aria-label="Search">';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(27).'" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search find-fuels" aria-hidden="true"></span> Fuels</a>';
	$html .= '</div>';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(32).'" type="button" class="btn btn-orange"><span class="glyphicon glyphicon-search find-retailers" aria-hidden="true"></span> Retailer</a>';
	$html .= '</div>';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(36).'" type="button" class="btn btn-redorange"><span class="glyphicon glyphicon-search find-installers" aria-hidden="true"></span> Installer</a>';
	$html .= '</div>';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(234546).'" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search find-servicing" aria-hidden="true"></span> Servicing</a>';
	$html .= '</div>';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(39).'" type="button" class="btn btn-orange"><span class="glyphicon glyphicon-search find-chimney-sweep" aria-hidden="true"></span> Chimney Sweep</a>';
	$html .= '</div>';
	$html .= '<div class="btn-group" role="group">';
	$html .= '<a href="'.get_permalink(42).'" type="button" class="btn btn-redorange"><span class="glyphicon glyphicon-search find-product" aria-hidden="true"></span> Product</a>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	return $html;
}