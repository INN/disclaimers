<?php
/**
 * Disclaimers Fields.
 *
 * @since   1.0.0
 * @package Disclaimers
 */

/**
 * Disclaimers Fields.
 *
 * @since 1.0.0
 */
class D_Fields {
	/**
	 * Parent plugin class.
	 *
	 * @since 1.0.0
	 *
	 * @var   Disclaimers
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 *
	 * @param  Disclaimers $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  1.0.0
	 */
	public function hooks() {
		add_action( 'cmb2_admin_init', array( $this, 'cmb2_fields' ) );
		add_filter( 'admin_init' , array( $this, 'sitewide_fields' ) );
	}

	/**
	 * Add metabox for pages, posts, and terms.
	 */
	public function cmb2_fields() {

		// Start with an underscore to hide fields from custom fields list.
		$prefix = '_';

		/**
		 * Initiate the metabox
		 */
		$cmb = new_cmb2_box( array(
			'id'            => 'disclaimer',
			'title'         => __( 'Disclaimer', 'cmb2' ),
			'object_types'  => array( 'page', 'post', 'term' ), // Post type.
			'context'       => 'normal',
			'priority'      => 'low',
			'show_names'    => true, // Show field names on the left.
			'closed'        => true, // Keep the metabox closed by default.
		) );

		$cmb->add_field( array(
			'name'       => __( 'Disclaimer', 'cmb2' ),
			'desc'       => __( '', 'cmb2' ),
			'id'         => $prefix . 'disclaimer',
			'type'       => 'text',
			'sanitization_cb' => 'sanitize_text_field',
		) );

	}

	function sitewide_fields() {
		register_setting( 'general', 'site_disclaimer', 'esc_attr' );
		add_settings_field( 'site_disclaimer', '<label for="site_disclaimer">' . __( 'Site Disclaimer' , 'site_disclaimer' ) . '</label>' , array( $this, 'sitewide_fields_html' ) , 'general' );
	}
	function sitewide_fields_html() {
		$value = get_option( 'site_disclaimer', '' );
		echo '<textarea rows="5" id="site_disclaimer" class="regular-text code" name="site_disclaimer">' . $value . '</textarea>';
	}
}
