<?php
/**
 * Post Meta box functions for the Disclaimer widget's per-post disclaimer functionality.
 */

// Disclaimer
add_action( 'widgets_init', function() {
	// Use Largo's function to create the widget.
	largo_add_meta_box(
		'largo_custom_disclaimer',
		__( 'Disclaimer', 'largo' ),
		'largo_custom_disclaimer_meta_box_display', //could also be added with largo_add_meta_content('largo_custom_related_meta_box_display', 'largo_additional_options')
		'post',
		'normal',
		'core'
	);

	/**
	 * Disclaimer text area for the Additional Options metabox
	 *
	 * If the post's disclaimer field is empty, then the default disclaimer 
	 * is the option set in the theme options.
	 *
	 * @global $post
	 */
	function largo_custom_disclaimer_meta_box_display() {
		global $post;

		$value = get_post_meta( $post->ID, 'disclaimer', true );

		if ( empty( $value ) ) {
			$value = of_get_option( 'default_disclaimer' );
		}

		echo '<p><strong>' . __('Disclaimer', 'largo') . '</strong><br />';
		echo '<textarea name="disclaimer" style="width: 98%;">' . esc_textarea( $value ) . '</textarea>';

	}
	largo_register_meta_input( 'disclaimer', 'wp_filter_post_kses' );

} );
