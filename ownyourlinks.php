<?php
/**
 * Plugin Name: #OwnYourLinks
 * Plugin URI: https://github.com/pfefferle/wordpress-ownyourlinks
 * Description: Extension for hum, the personal URL shortener for WordPress
 * Author: Matthias Pfefferle
 * Author URI: https://notiz.blog/
 * Version: 1.3.0
 * License: MIT
 * License URI: http://opensource.org/licenses/MIT
 * Text Domain: ownyourlinks
 */

namespace OwnYourLinks;

register_activation_hook( __FILE__, '\flush_rewrite_rules' );
register_deactivation_hook( __FILE__, '\flush_rewrite_rules' );

defined( 'OWNYOURLINKS_CODE_URL' ) || define( 'OWNYOURLINKS_CODE_URL', 'https://github.com/' );
defined( 'OWNYOURLINKS_MICROBLOGGING_URL' ) || define( 'OWNYOURLINKS_MICROBLOGGING_URL', null );

/**
 * Initialize the Plugin.
 *
 * @return void
 */
function init() {
	add_filter( 'hum_redirect_t', '\OwnYourLinks\redirect_request_t', 10, 2 );
	add_filter( 'hum_redirect_c', '\OwnYourLinks\redirect_request_c', 10, 2 );

	add_filter( 'hum_redirect_types', '\OwnYourLinks\redirect_types' );
}
add_action( 'init', '\OwnYourLinks\init', 9 );

/**
 * Add redirect types handled by this plugin.
 *
 * @param array $types list of current supported types
 *
 * @return array filtered list.
 */
function redirect_types( $types ) {
	$types[] = 'c';
	$types[] = 't';

	return $types;
}


/**
 * Handles /c/ URLs
 *
 * @param string $url the short URL.
 * @param string $path subpath of URL (after /c/).
 */
function redirect_request_c( $url, $path ) {
	return trailingslashit( OWNYOURLINKS_CODE_URL ) . $path;
}

/**
 * Handles /t/ URLs
 *
 * @param string $url the short URL.
 * @param string $path subpath of URL (after /t/).
 */
function redirect_request_t( $url, $path ) {
	// if URL is not empty it seems to be a local URL
	if ( ! empty( $url ) ) {
		return $url;
	}

	if ( ! $path ) {
		return OWNYOURLINKS_MICROBLOGGING_URL;
	}

	if ( false !== strpos( OWNYOURLINKS_MICROBLOGGING_URL, 'twitter.com' ) ) {
		$path = 'status/' . $path;
	}

	return trailingslashit( OWNYOURLINKS_MICROBLOGGING_URL ) . $path;
}
