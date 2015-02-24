<?php
/*
Plugin Name: AffiliateWP Store Credit Autopay
Plugin URI: http://www.renegade-empire.com/
Version: 0.1
Author: Renegade Empire
Description: Autopay store credit when the order is marked as complete. Requires AffiliateWP http://goo.gl/N6DoZh and the Store Credit plugin http://goo.gl/wSAFbc 
*/

function AffiliateWP_Store_Credit_Autopay($order_id) {
	$new_get_affiliate = new Affiliate_WP_Referrals_DB;
	
	
	$array_aff = $new_get_affiliate->get_referrals(
		array(
			'number'       => 1,
			'offset'       => 0,
			'referrals_id' => 0,
			'affiliate_id' => 0,
			'reference'    => '',
			'context'      => '',
			'status'       => '',
			'orderby'      => 'referral_id',
			'order'        => 'DESC',
			'search'       => false
		));
	foreach($array_aff as $aff) {
		$ref = $aff->referral_id;
		$ref_status = $aff->status;
		if( $ref_status == "unpaid") {
			affwp_set_referral_status($ref,"paid");
		} 
	}
}

add_action('woocommerce_order_status_completed', 'AffiliateWP_Store_Credit_Autopay');

?>