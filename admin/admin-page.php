<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="wrap">
<h2><?php _e( 'Meow Woocommerce Book Keeper' , 'mw-wae-i18n'); ?></h2>
<h3><?php _e( 'Settings' , 'mw-wae-i18n' ); ?></h3>
<p> <?php _e( 'Please enter the following data:' , 'mw-wae-i18n' ); ?></p>
<p><i><?php _e( 'This version of the plugin only allows to use generic accounts.' , 'mw-wae-i18n' ); ?></i></p>
<form method="post" action="options.php">

<!-- Ajoute 2 champs cachés pour savoir comment rediriger l'utilisateur -->
<?php settings_fields( 'mw-wae-settings-group' );?>
<table width="90%">
<tr>
<td width="200">
<h3><?php _e( 'Products' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<!--Compte pour les nouveaux produits-->
<tr valign="middle">
<th width="150" scope="row"><label for="mw_wae_generic_prod_accounting_account"><?php _e( 'Account code - Product' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_generic_prod_accounting_account" id="mw_wae_generic_prod_accounting_account" placeholder="ex : 707" value="<?php echo esc_attr(get_option('mw_wae_generic_prod_accounting_account')); ?>" /><br/><span class="description"></span>
</td>

</tr>
<tr>
<td width="200">
<h3><?php _e( 'Customers' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<!--Compte pour les nouveaux clients-->
<tr valign="middle">
<th width="150" scope="row"><label for="mw_wae_generic_cust_accounting_account"><?php _e( 'Account code - Customer' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_generic_cust_accounting_account" id="mw_wae_generic_cust_accounting_account" placeholder="ex : 411COM" value="<?php echo esc_attr(get_option('mw_wae_generic_cust_accounting_account')); ?>" /><br/>
</td>

</tr>
<tr valign="middle">
<tr>
<td width="200">
<h3><?php _e( 'Taxes and delivery options' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<!--Comptes de Taxe et Frais de Port-->
<th width="150" scope="row"><label for="mw_wae_generic_tax_accounting_account"><?php _e( 'Account code - Tax' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_generic_tax_accounting_account" id="mw_wae_generic_tax_accounting_account" placeholder="ex : 445" value="<?php echo esc_attr(get_option('mw_wae_generic_tax_accounting_account')); ?>" />
</td>

<th width="150" scope="row"><label for="mw_wae_generic_fdp_accounting_account"><?php _e( 'Account code - Delivery options' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_generic_fdp_accounting_account" id="mw_wae_generic_fdp_accounting_account" placeholder="ex : 708" value="<?php echo esc_attr(get_option('mw_wae_generic_fdp_accounting_account')); ?>" />
</td>
</tr>

<tr>
<td width="200">
<h3><?php _e( 'Journal reference number' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<!--Code Journal-->
<th width="150" scope="row"><label for="mw_wae_book_code_order"><?php _e( 'Sales journal reference number' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_book_code_order" id="mw_wae_book_code_order" placeholder="ex : VT" value="<?php echo esc_attr(get_option('mw_wae_book_code_order')); ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"></th>
<td width="50">
</td>
</tr>
<!--Headers de colonnes-->	
<td width="200">
<h3><?php _e( 'CSV Columns Headers' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<!--Code Journal-->
<?php $headers = get_option('mw_wae_columns_headers');?>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_journal"><?php _e( 'Sales Journal' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_journal" id="mw_wae_columns_headers_journal" placeholder="ex : Sales Journal" value="<?php if (isset($headers['journal'])) { echo esc_attr($headers['journal']); } ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_date"><?php _e( 'Date' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_date" id="mw_wae_columns_headers_date" placeholder="ex : Date" value="<?php if (isset($headers['date'])) { echo esc_attr($headers['date']); } ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_number"><?php _e( 'Invoice Number' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_number" id="mw_wae_columns_headers_number" placeholder="ex : Invoice Number" value="<?php if (isset($headers['number'])) { echo esc_attr($headers['number']); } ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_code"><?php _e( 'Accounting Code' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_code" id="mw_wae_columns_headers_code" placeholder="ex : Accounting Code" value="<?php if (isset($headers['code'])) { echo esc_attr($headers['code']);} ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_label"><?php _e( 'Label' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_label" id="mw_wae_columns_headers_label" placeholder="ex : Label" value="<?php if (isset($headers['label'])) { echo esc_attr($headers['label']);} ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_outcome"><?php _e( 'Outcome' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_outcome" id="mw_wae_columns_headers_outcome" placeholder="ex : Outcome" value="<?php if (isset($headers['outcome'])) { echo esc_attr($headers['outcome']);} ?>" />
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_columns_headers_income"><?php _e( 'Income' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<input type="text" name="mw_wae_columns_headers_income" id="mw_wae_columns_headers_income" placeholder="ex : Income" value="<?php if (isset($headers['income'])) { echo esc_attr($headers['income']);} ?>" />
</td>
</tr>
<tr valign="middle">
<tr>
<td width="200">
<h3><?php _e( 'Uninstall Process' , 'mw-wae-i18n' ); ?></h3>
</td>
</tr>
<tr valign="top">
<th width="150" scope="row"><label for="mw_wae_uninstall"><?php _e( 'Delete everything from database when deleted ?' , 'mw-wae-i18n' ); ?></label></th>
<td width="50">
<?php
$uninstall = get_option ('mw_wae_uninstall');
?>
<input type="checkbox" name="mw_wae_uninstall" id="mw_wae_uninstall" value="yes" <?php if ($uninstall == 'yes') { echo 'checked' ;}?>/>
</td>
</tr>

<th width="150" scope="row"></th>
<td width="50">
</td>
</tr>
</table>
<!-- Bouton de sauvegarde -->
<p>
<?php submit_button( __( 'Save' , 'mw-wae-i18n' ) ); ?>
</p>

</form>

</div>