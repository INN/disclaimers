<?php
/**
 * Options page for this plugin
 */

namespace INN\Disclaimers\Settings;
use Disclaimers;
	// add_option( Disclaimers::OPTION_KEY, '');

/**
 * Create options page
 * @since 0.1.0
 */
function register_options_page() {
	add_options_page(
		__( 'Disclaimers', 'disclaimers' ), // title of page
		__( 'Disclaimers', 'disclaimers' ), // menu text
		'manage_options',                   // capability required
		'disclaimers',                      // menu slug
		__NAMESPACE__ . '\options_page_callback' // callback for options page display
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\register_options_page' );

/**
 * Options page display callback
 *
 * @since 0.1.0
 * @link https://developer.wordpress.org/plugins/settings/custom-settings-page/
 */
function options_page_callback() {
	// check capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access the Disclaimers plugin\'s settings.', 'disclaimers' ) );
		return;
	}

	settings_errors( 'disclaimers_messages' );

	printf(
		'<h1>%1$s</h1>',
		esc_html( get_admin_page_title() )
	);
	?>
		<form action="options.php" method="post">
			<?php
				settings_fields( Disclaimers::OPTION_GROUP );
				do_settings_sections( 'disclaimers' );
				submit_button( esc_html__( 'Save settings', 'disclaimers' ) );
			?>
		</form>
	<?php
}


/**
 * Register our settings
 */
function init() {
	register_setting(
		Disclaimers::OPTION_GROUP, // option group
		Disclaimers::OPTION_KEY,   // option name
		array(
			'sanitize_callback' => __NAMESPACE__ . '\sanitize_callback', // sanitization callback
		)
	);

	add_settings_section(
		'disclaimers',
		__( 'Settings', 'disclaimers' ),
		__NAMESPACE__ . '\disclaimers_settings_section_callback',
		'disclaimers'
	);

	add_settings_field(
		Disclaimers::OPTION_KEY,
		__( 'Default Disclaimer', 'disclaimers' ),
		__NAMESPACE__ . '\default_disclaimer_field',
		'disclaimers',
		'disclaimers',
		array(
			'label_for' => Disclaimers::OPTION_KEY,
			'class' => null,
		)
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\init' );

/**
 * Sanitization callback for the option key
 *
 * @since 0.1.0
 */
function sanitize_callback( $value ) {
	// check capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access the Disclaimers plugin\'s settings.', 'disclaimers' ) );
		return;
	}

	$sanitized = wp_kses_post( $value );

	return wp_kses_post( $value );
}

/**
 * The settings section callback
 */
function disclaimers_settings_section_callback( $args ) {
	return;
	// actually does nothing because there's only one settings section on this page
	
	printf( 
		'<h2 id="%2$s">%1$s</h2>',
		esc_html__( 'Disclaimers Plugin Settings', 'disclaimers' ),
		esc_attr( $args['id'] )
	);
}


/**
 * The default disclaimer setting
 */
function default_disclaimer_field( $args ) {
	$setting = get_option( Disclaimers::OPTION_KEY );

	printf(
		'<textarea name="%1$s" style="width:20em;max-width:100%;">%2$s</textarea>',
		esc_attr( Disclaimers::OPTION_KEY ),
		wp_kses_post( $setting )
	);
	printf(
		'<p>%1$s</p>',
		esc_html__( 'This disclaimer is displayed in the Disclaimers widget. You can override it on a per-post basis.', 'disclaimers' )
	);
}

