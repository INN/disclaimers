<?php
/**
 * The Disclaimer widget output
 */

/**
 * The Disclaimer widget
 *
 * The classname here is 'largo_disclaimer_widget' for backwards compatibility
 * with versions of the Largo theme v0.5.5.4 and before, which included this
 * widget and associated functionality in the theme.
 *
 * @link https://github.com/INN/largo/issues/1500
 */
class largo_disclaimer_widget extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'largo-disclaimer',
			'description' => __( 'Show the article disclaimer', 'largo' ),
		);
		parent::__construct( 'largo-disclaimer-widget', __( 'Disclaimer', 'largo' ), $widget_ops );
	}

	/**
	 * The widget output
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		if ( ! is_single() ) {
			return;
		}

		echo wp_kses_post( $args['before_widget'] );

		$disclaimer = wp_kses_post( get_post_meta( get_the_ID(), 'disclaimer', true  ) );
		$sitewide = wp_kses_post(  get_option( Disclaimers::OPTION_KEY ) );

		if ( ! empty( $disclaimer ) ) {
			echo $disclaimer;
		} elseif ( ! empty( $sitewide ) ) {
			echo $sitewide;
		}

		echo wp_kses_post( $args['after_widget'] );
	}

	/*
	 * This widget does not override WP_Widget::form() or WP_Widget::update()
	 * because there's nothing to configure. This widget does not even display
	 * a title, as noted in https://github.com/INN/largo/issues/1201
	 */
}

/**
 * Register this widget
 *
 * @since 0.1.0
 */
function largo_register_disclaimer_widget() {
	register_widget( 'largo_disclaimer_widget' );
}
add_action( 'widgets_init', 'largo_register_disclaimer_widget' );
