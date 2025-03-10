<?php
/**
 * Theme Name:       AfzaliWP Boilerplate Theme
 * Author:           Mohammad Afzali
 * Author URI:       https://afzaliwp.technology
 */

namespace AfzaliWP;

use AfzaliWP\BoilerPlate_Theme\Includes\Vite;
use AfzaliWP\BoilerPlate_Theme\Includes\WP_Hooks;

defined( 'ABSPATH' ) || die();

final class BoilerPlate_Theme {

	private static $instances = [];

	protected function __construct() {
		spl_autoload_register( function ( $class_name ) {
			if ( ! str_contains( $class_name, 'AfzaliWP\BoilerPlate_Theme' ) ) {
				return;
			}

			$file = str_replace(
				        [
					        '_',
					        strtolower(
						        str_replace(
							        '_',
							        '-',
							        'AfzaliWP\BoilerPlate_Theme'
						        )
					        ),
					        '\\',
				        ],
				        [
					        '-',
					        __DIR__,
					        DIRECTORY_SEPARATOR,
				        ],
				        strtolower( $class_name ) ) . '.php';

			require_once $file;
		} );

		$this->define_constants();
		$this->handle_vite();

		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles_and_scripts' ], 90 );
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_action( 'init', [ $this, 'init_hook' ] );
	}

	protected function __clone() {
	}

	public function __wakeup() {
		throw new \Exception( "Cannot unserialize a singleton." );
	}

	public static function get_instance() {
		$cls = BoilerPlate_Theme::class;

		if ( ! isset( self::$instances[ $cls ] ) ) {
			self::$instances[ $cls ] = new BoilerPlate_Theme();
		}

		return self::$instances[ $cls ];
	}

	public function theme_setup() {
		// Add theme support for various features
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );

		// Add theme support for WooCommerce
		add_theme_support( 'woocommerce' );

		// Add theme support for Elementor locations
		add_theme_support( 'elementor-theme-builder-locations', [
			'header' => [ 'hook' => 'get_header' ],
			'footer' => [ 'hook' => 'get_footer' ],
		] );

		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'automatic-feed-links' );
	}

	public function register_styles_and_scripts() {
		// wp_enqueue_style(
		// 	'afzaliwp-theme-tailwind-style',
		// 	AFZALIWP_THEME_ASSETS_URL . 'tailwind.min.css',
		// 	'',
		// 	AFZALIWP_THEME_ASSETS_VERSION
		// );

//		wp_enqueue_style(
//			'afzaliwp-theme-style',
//			AFZALIWP_THEME_ASSETS_URL . 'frontend.min.css',
//			'',
//			AFZALIWP_THEME_ASSETS_VERSION
//		);
//
//		wp_enqueue_script(
//			'afzaliwp-theme-script',
//			AFZALIWP_THEME_ASSETS_URL . 'frontend.min.js',
//			[ 'jquery' ],
//			AFZALIWP_THEME_ASSETS_VERSION,
//			''
//		);

		wp_localize_script(
			'afzaliwp-theme-script',
			'AfzaliWPThemeObj',
			[
				'homeUrl' => get_bloginfo( 'url' ),
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'afzaliwp-theme-nonce' ),
			]
		);
	}

	public function define_constants() {
		define( 'AFZALIWP_THEME_DIR', trailingslashit( get_template_directory() ) );
		define( 'AFZALIWP_THEME_URL', trailingslashit( get_template_directory_uri() ) );
		define( 'AFZALIWP_THEME_INC_DIR', trailingslashit( get_template_directory() ) . 'includes/' );
		define( 'AFZALIWP_THEME_ASSETS_URL', trailingslashit( AFZALIWP_THEME_URL . 'assets/dist' ) );
		define( 'AFZALIWP_THEME_IMAGES', trailingslashit( AFZALIWP_THEME_URL . 'assets/images' ) );

		if ( str_contains( get_bloginfo( 'wpurl' ), 'local' ) ) {
			define( 'AFZALIWP_THEME_IS_LOCAL', true );
			define( 'AFZALIWP_THEME_ASSETS_VERSION', time() );
		} else {
			define( 'AFZALIWP_THEME_IS_LOCAL', false );
			define( 'AFZALIWP_THEME_ASSETS_VERSION', '1.0.0' );
		}
	}

	public function init_hook() {
	}

	public function other() {
		new WP_Hooks();
	}

	private function handle_vite() {
		new Vite();
	}
}

BoilerPlate_Theme::get_instance();

