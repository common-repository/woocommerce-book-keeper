<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Meow Woocommerce Book Keeper
Plugin URI: http://www.woocommerce-book-keeper.com
Text Domain: mw-wae-i18n
Description: The basic CSV Exporter from Woocommerce Orders to accounting softwares. Expert version with more options will be back soon.
Author: Ro_meow
Author URI: http://www.b-sider.fr
Version: 1.08
WC requires at least: 3.6.0
WC tested up to: 4.9
*/

/*  Copyright 2014  Roman CASSANAS  (email : contact@meow-com.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2 and later, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/*******ETAPE PRELIMINAIRE : VERIFICATIONS*******/

// Vérifier la présence de Woocommerce
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
//Create the admin pages links
function mw_wae_exporter_page() {
//translation
load_plugin_textdomain( 'mw-wae-i18n', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
//Admin links
add_submenu_page ('woocommerce', __( 'Export Book Keeping' , 'mw-wae-i18n' ), __( 'Export Book Keeping' , 'mw-wae-i18n' ), 'manage_options','mw_wae_exporter_export','mw_wae_exporter_export');
add_submenu_page ('options-general.php', __( 'Book Keeping Settings' , 'mw-wae-i18n' ), __( 'Book Keeping Settings' , 'mw-wae-i18n' ), 'manage_options', 'mw_wae_exporter_param', 'mw_wae_exporter_param');


}

//Créer les pages et tester les droits d'accès
function mw_wae_exporter_admin() {
	if (! current_user_can('manage_options'))  {
    wp_die( __('Droits insuffisants !!!') );
  }
require( dirname(__FILE__).'/admin/welcome-page.php');
}

function mw_wae_exporter_export() {
	if (! current_user_can('manage_options')) {
	wp_die ( __('Droits insuffisants !!!') );
}
require ( dirname(__FILE__).'/admin/export-page.php');
}

function mw_wae_exporter_param() {
	if (! current_user_can('manage_options')) {
	wp_die ( __('Droits insuffisants !!!') );
}
require ( dirname(__FILE__).'/admin/admin-page.php');
}


//Call for functions
function mw_wae_inc() {
			include( plugin_dir_path( __FILE__ ) . 'admin/settings.php' );
			include( plugin_dir_path( __FILE__ ) . 'inc/export.php' );
}

function mw_wae_rest_it() {
			include( plugin_dir_path( __FILE__ ) . 'inc/rest.php' );
}


//action for includes
add_action( 'admin_init', 'mw_wae_inc' );
add_action( 'init', 'mw_wae_rest_it' );

//Add the admin menu pages
add_action ('admin_menu', 'mw_wae_exporter_page');

//actions for settings function
add_action( 'admin_init', 'register_mw_wae_settings' );
add_action( 'admin_init', 'register_mw_wae_export_settings' );
add_action('update_option_mw_wae_columns_headers','mw_wae_columns_headers_add');

//actions for export
add_action('admin_post_mw_wae_export','mw_wae_export_data');
    
}

//Filter for rest

add_filter( 'woocommerce_rest_prepare_shop_order_object', 'mw_wae_rest_api_data', 10, 3 );

//actions for uninstall
function mw_wae_activate(){
    register_uninstall_hook( __FILE__, 'mw_wae_uninstall' );
}

register_activation_hook( __FILE__, 'mw_wae_activate' );
 
// And here goes the uninstallation function:
function mw_wae_uninstall(){
    //  Delete Settings on uninstall
	$douninstall = get_option ('mw_wae_uninstall');
	
	if ($douninstall == 'yes') {
		
		$todelete = array(
						  'mw_wae_generic_tax_accounting_account',
						  'mw_wae_generic_fdp_accounting_account',
						  'mw_wae_generic_cust_accounting_account',
						  'mw_wae_generic_prod_accounting_account',
						  'mw_wae_columns_headers',
						  'mw_wae_book_code_order',
						  'mw_wae_export_start_date',
						  'mw_wae_export_end_date',
						  'mw_wae_export_separator',
						  'mw_wae_uninstall'
						  );
		
		foreach ($todelete as $optend) {
			
			delete_option( $optend );
		
		}
	
	}
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'mw_wae_add_plugin_page_settings_link');
function mw_wae_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=mw_wae_exporter_param' ) .
		'">' . __('Settings', 'mw-wae-i18n' ) . '</a>';
	return $links;
}


?>