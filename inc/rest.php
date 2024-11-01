<?php if ( ! defined( 'ABSPATH' ) ) exit;

/******ETAPE 3 : PREPARER L'EXPORT******/

function mw_wae_rest_api_data( $response, $order, $request ) {
	global $woocommerce, $post;

if( empty( $response->data ) ) 
    return $response; 
	

  $order_id = $order->get_id();

//Chargement des commandes

	$order = wc_get_order($order_id);

		//On définit tous les comptes génériques
						  $book_code = get_option('mw_wae_book_code_order');
						  $account_cust = get_option('mw_wae_generic_cust_accounting_account');
						  $account_prod = get_option ('mw_wae_generic_prod_accounting_account');
						  $account_fdp = get_option ('mw_wae_generic_fdp_accounting_account');
						  $account_tax = get_option ('mw_wae_generic_tax_accounting_account');	
						  
						  //Données de date
						  $order->piecedate = $order->get_date_paid()->format ('Y-m-d');


						  //On définit tous les comptes détaillés
						  $order->number = $order->get_id();
						  $order->custid = $order->get_customer_id();
						  $order->lib = remove_accents (strtoupper($order->get_billing_company()) . ' ' . ucfirst($order->get_billing_last_name()) . ' ' . ucfirst($order->get_billing_first_name()));
						  $order->outcome = $order->get_total();
						  $order->income_tax = $order->get_total_tax();
						  $order->income_fdpht = $order->get_shipping_total();
						  $order->income_prodht = ( ($order->outcome) - ( ($order->income_tax) + ($order->income_fdpht) ) );
	
	/****Tricky Boy : à améliorer *****/
	// Entête
		$csv_journal = 'journal';
		$csv_date = 'date';
		$csv_number = 'number';
		$csv_code = 'acccode';
		$csv_label = 'label';
		$csv_outcome = 'outcome';
		$csv_income = 'income';		
		
$wbk_data = array();
				
						//On met en page l'export
$generic = array ($csv_journal => $book_code,
				  $csv_date => $order->piecedate,
				  $csv_number => $order->number,
				  $csv_label => $order->lib
				  );
				  
					if ($order->outcome != 0) {
$customer_line = array ( $csv_code => $account_cust,
				  		 $csv_outcome => round($order->outcome,2)
						 );
					 } else {
						$customer_line = "";
					}
					 
					if ($order->income_fdpht != 0) {
$shipping_line = array($csv_code => $account_fdp,
					   $csv_income => round($order->income_fdpht,2)
						);
					 } else {
						$shipping_line = "";
					}
					 
					if ($order->income_prodht != 0) {					
$products_line = array($csv_code => $account_prod,
					   $csv_income => round($order->income_prodht,2)
						);
					 } else {
						$products_line = "";
					}
					
					if ($order->income_tax != 0) {
$tax_line = array($csv_code => $account_tax,
				  $csv_income => round($order->income_tax,2)
				  );
					} else {
						$tax_line = "";
					}
					
	$get_in_line = array('generic' => $generic,
						 'customer' => $customer_line,
						 'shipping' => $shipping_line,
						 'products' => $products_line,
						 'tax' => $tax_line
						 );
	
	foreach ($get_in_line as $key => $line) {
		if ( !empty( $line ) ) {
	$response->data['$wbk_data'][$key] = $line;
		}
	}
		return $response;
		
			}
			
?>