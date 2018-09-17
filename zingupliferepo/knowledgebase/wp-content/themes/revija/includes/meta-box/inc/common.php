<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Common' ) )
{
	/**
	 * Common functions for the plugin
	 * Independent from meta box/field php
	 */
	class RWMB_Common
	{
		/**
		 * Do actions when class is loaded
		 *
		 * @return void
		 */
		static function on_load()
		{
			self::load_textdomain();
		}


		/**
		 * Load plugin translation
		 *
		 * @return void
		 */
		static function load_textdomain()
		{

		}
	}

	RWMB_Common::on_load();
}
