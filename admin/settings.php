<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function register_mw_wae_settings() {
//register our settings
$waesettings = array(
				 'mw_wae_generic_tax_accounting_account' => '',
				 'mw_wae_generic_fdp_accounting_account' => '',
				 'mw_wae_generic_cust_accounting_account' => '',
				 'mw_wae_generic_prod_accounting_account' => '',
				 'mw_wae_columns_headers' => array(),
				 'mw_wae_book_code_order' => '',
				 'mw_wae_uninstall' => 'no'
				 );

	foreach ($waesettings as $option => $value) {
		add_option($option,$value);
		
		if (!is_array($value)) {
			register_setting( 'mw-wae-settings-group', $option, 'sanitize_text_field' );
		} else {
			foreach ($value as $key => $data) {
			sanitize_text_field($data);
			}
			register_setting( 'mw-wae-settings-group', $option);
		}
	}
}

function register_mw_wae_export_settings() {
//register our export settings
//add_option( 'mw_wae_export_start_date');
//add_option( 'mw_wae_export_end_date');
//add_option( 'mw_wae_export_separator');
register_setting( 'mw-wae-export-settings-group', 'mw_wae_export_start_date','sanitize_text_field' );
register_setting( 'mw-wae-export-settings-group', 'mw_wae_export_end_date','sanitize_text_field' );
register_setting( 'mw-wae-export-settings-group', 'mw_wae_export_separator','sanitize_text_field' );
//enqueue Jquery

wp_enqueue_script('jquery-ui-datepicker');
wp_register_style('jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
wp_enqueue_style('jquery-ui-css');
}

function mw_wae_columns_headers_add (){
		
	
	$columns = array();
	
	$journal = sanitize_text_field($_POST['mw_wae_columns_headers_journal']);
	$date = sanitize_text_field($_POST['mw_wae_columns_headers_date']);
	$number = sanitize_text_field($_POST['mw_wae_columns_headers_number']);
	$code = sanitize_text_field($_POST['mw_wae_columns_headers_code']);
	$label = sanitize_text_field($_POST['mw_wae_columns_headers_label']);
	$outcome = sanitize_text_field($_POST['mw_wae_columns_headers_outcome']);
	$income = sanitize_text_field($_POST['mw_wae_columns_headers_income']);
	$center = sanitize_text_field($_POST['mw_wae_columns_headers_center']);
	
	$columns = array (
	'journal' => $journal,
	'date' => $date,
	'number' => $number,
	'code' => $code,
	'label' => $label,
	'outcome' => $outcome,
	'income' => $income
	);

update_option( 'mw_wae_columns_headers', $columns );	
	
}

?>