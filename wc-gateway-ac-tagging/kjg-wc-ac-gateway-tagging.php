<?php 
/**
 * Plugin Name: KJG-WC-AC Gateway Tagging
 * Plugin URI: https://kidzplay.co.za/
 * Description: Integrates WooCommerce payment gateways with ActiveCampaign by adding or updating a contact on ActiveCampaign with specified tags, when an order is created.
 * Version: 1.4.2
 * Author: Matthew Treherne, Bradley Schmidt
 * Author URI: https://kidzplay.co.za/
 * Text Domain: kjg-wc-ac-hook
 * Requires at least: 4.1.1
 * Requires PHP: 5.3
 * WC tested up to: 7.9.0
 * License: GPL2
*/

/*	Copyright 2015  Matthew Treherne  (email : matt@sendmail.me.uk)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!defined('ABSPATH')) exit();

$GLOBALS['KJG_WC_AC_Hook_basename'] = plugin_basename(__FILE__);

function KJG_WC_AC_Hook_deactivate() { deactivate_plugins( $GLOBALS['KJG_WC_AC_Hook_basename'] ); }
function KJG_WC_AC_Hook_show_deactivation_notice() {
	$class = 'notice notice-error';
	$message = __( '"KJG-WC-AC Hook" requires PHP 5.3 or newer.', 'kjg-wc-ac-hook' );
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
  add_action( 'admin_init', 'KJG_WC_AC_Hook_deactivate' );
  add_action( 'admin_notices', 'KJG_WC_AC_Hook_show_deactivation_notice' );
  return;
}

add_action('before_woocommerce_init', function() { if (class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true); });

include_once 'includes/main-class.php';

?>