<?php
/**
 * Post Meta box functions for the Disclaimer widget's per-post disclaimer functionality.
 */
namespace INN\Disclaimers\Metaboxes;
use Disclaimers;


/**
 * Register our meta box
 *
 * @since 0.1.0
 */
function widgets_init () {
	// Use Largo's function to create the meta box
	add_meta_box(
		'largo_custom_disclaimer', // id
		__( 'Disclaimer', 'disclaimers' ), // title
		__NAMESPACE__ . '\largo_custom_disclaimer_meta_box_display', // callbacks
		'post', // screens
		'normal', // context
		'core' // priority
	);

}
add_action( 'add_meta_boxes', __NAMESPACE__ . '\widgets_init' );

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

	wp_nonce_field( 'disclaimer', 'disclaimer_nonce' );
	echo '<textarea name="disclaimer" style="width: 98%;">' . esc_textarea( $value ) . '</textarea>';
	printf(
		'<p>%1$s</p><blockquote>%2$s</blockquote>',
		esc_html__( 'The default disclaimer used on this site is:', 'disclaimers' ),
		wp_kses_post( get_option( Disclaimers::OPTION_KEY ) )
	);

}

// @todo: port the above to standard wordpress-y of doing things
// make sure it works with and without largo

/**
 * When the post is saved, save the disclaimer
 *
 * @since 0.1.0
 */
function save_post( $post_id ) {
error_log(var_export( 'well, pooop', true));
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['disclaimer_nonce'] ) || ! wp_verify_nonce( $_POST['disclaimer_nonce'], 'disclaimer' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}

	global $post;

	$value = wp_kses_post( $_POST['disclaimer'] );
	error_log(var_export( $value, true));

	if ( empty( $value ) ) {
		delete_post_meta( $post->ID, 'disclaimer' );
		error_log(var_export( 'delete', true));
	} else {
		if ( get_post_meta( $post->ID, 'disclaimer', FALSE ) ) {
			update_post_meta( $post->ID, 'disclaimer', $value );
			error_log(var_export( 'update', true));
		} else {
			add_post_meta( $post->ID, 'disclaimer', $value );
			error_log(var_export( 'add', true));
		}
	}
}
add_action( 'save_post', __NAMESPACE__ . '\save_post' );
