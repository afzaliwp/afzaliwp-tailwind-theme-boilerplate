<?php

namespace AfzaliWP\BoilerPlate_Theme\Includes;

defined( 'ABSPATH' ) || die();

class Vite {
	const DIST_DEF = 'dist';
	const JS_DEPENDENCY = [];
	const JS_LOAD_IN_FOOTER = true;
	const VITE_SERVER = 'http://localhost:3000';

	public function __construct() {
		$this->define_constants();
		$this->setup_hooks();
	}

	private function define_constants() {
		define( 'DIST_URI', get_template_directory_uri() . '/' . self::DIST_DEF );
		define( 'DIST_PATH', get_template_directory() . '/' . self::DIST_DEF );
		define( 'VITE_ENTRY_POINT', str_replace( site_url(), '', get_template_directory_uri() ) . '/main.js' );
	}

	private function setup_hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'handle_assets' ] );
	}

	public function handle_assets() {
		if ( defined( 'AFZALIWP_THEME_IS_LOCAL' ) && AFZALIWP_THEME_IS_LOCAL === true ) {
			add_action( 'wp_head', [ $this, 'inject_vite_hmr' ] );
		} else {
			$this->load_production_assets();
		}
	}

	public function inject_vite_hmr() {
		echo '<script type="module" crossorigin src="' . self::VITE_SERVER . VITE_ENTRY_POINT . '"></script>';
	}

	private function load_production_assets() {
		$manifest = json_decode( file_get_contents( DIST_PATH . '/.vite/manifest.json' ), true );

		if ( is_array( $manifest ) && isset( $manifest[ 'main.js' ] ) ) {
			foreach ( $manifest[ 'main.js' ][ 'css' ] as $css_file ) {
				wp_enqueue_style( 'main', DIST_URI . '/' . $css_file );
			}

			$js_file = $manifest[ 'main.js' ][ 'file' ];
			if ( ! empty( $js_file ) ) {
				wp_enqueue_script(
					'main',
					DIST_URI . '/' . $js_file,
					self::JS_DEPENDENCY,
					'',
					self::JS_LOAD_IN_FOOTER
				);
			}
		}
	}
}