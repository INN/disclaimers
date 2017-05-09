<?php
/**
 * Disclaimers.
 *
 * @since   1.0.0
 * @package Disclaimers
 */
class Disclaimers_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  1.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'Disclaimers') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  1.0.0
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'Disclaimers', disclaimers() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  1.0.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
