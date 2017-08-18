<?php
/**
 * groups-wc-completed-customer.php
 *
 * Copyright (c) 2017 "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author itthinx
 * @package groups-wc-completed-customer
 * @since 1.0.0
 *
 * Plugin Name: Groups WooCommerce Completed Customer
 * Plugin URI: http://www.itthinx.com/
 * Description: This plugin adds customers to the Customer group upon their first completed order.
 * Version: 1.0.0
 * Author: itthinx
 * Author URI: http://www.itthinx.com
 * Donate-Link: http://www.itthinx.com
 * License: GPLv3
 */

/**
 * Plugin class.
 */
class Groups_WC_Completed_Customer {

	/**
	 * Adds our action on plugins_loaded.
	 */
	public static function boot() {
		add_action( 'plugins_loaded', array(__CLASS__, 'plugins_loaded' ) );
	}

	/**
	 * Adds our action on completed order status if WooCommerce and Groups are present.
	 */
	public static function plugins_loaded() {
		if ( function_exists( 'wc_get_order' ) && class_exists( 'Groups_User_Group' ) ) {
			add_action( 'woocommerce_order_status_completed', array( __CLASS__, 'woocommerce_order_status_completed' ) );
		}
	}

	/**
	 * Adds the customer to the 'Customer' group (or another group as requested by the groups_wc_completed_customer_group_name filter).
	 * The group is created on the fly.
	 *
	 * @param int $order_id
	 */
	public static function woocommerce_order_status_completed( $order_id ) {
		if ( $order = wc_get_order( $order_id ) ) {
			if ( $user_id = $order->get_customer_id() ) {
				$name = apply_filters( 'groups_wc_completed_customer_group_name', 'Customer' );
				if ( $group = Groups_Group::read_by_name( $name ) ) {
					$group_id = $group->group_id;
				} else {
					$group_id = Groups_Group::create( array( 'name' => $name ) );
				}
				if ( $group_id ) {
					if ( !Groups_User_Group::read( $user_id, $group_id ) ) {
						Groups_User_Group::create( array( 'group_id' => $group_id, 'user_id' => $user_id ) );
					}
				}
			}
		}
	}
}
Groups_WC_Completed_Customer::boot();
