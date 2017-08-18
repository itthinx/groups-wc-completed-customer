=== Groups WooCommerce Completed Customer ===
Contributors: itthinx
Donate link: http://www.itthinx.com/plugins/woocommerce-product-generator/
Tags: automatic, customer, customers, example, group, groups, order, orders, woocommerce
Requires at least: 4.0
Tested up to: 4.8.1
Stable tag: 1.0.0
License: GPLv3

This plugin adds customers to the Customer group upon their first completed order.

== Description ==

This plugin adds customers to the Customer group upon their first completed order.
The group is created on the fly (also if an alternative group as explained below is used).

An alternative group can be indicated by implementing the `groups_wc_completed_customer_group_name` filter.
Here is an example, which will add the customer with a completed order to the 'Example' group instead of the
'Customer' group. You can use the following code in your theme's `functions.php`:

	add_filter( 'groups_wc_completed_customer_group_name', 'my_groups_wc_completed_customer_group_name' );
	function my_groups_wc_completed_customer_group_name( $name ) {
		return 'Example';
	}

Upon plugin activation, the user-group assignment is done automatically when an order adopts the status 'completed'.

== Installation ==

Log in as an administrator and go to <strong>Plugins > Add New</strong>. Upload the plugin zip file and activate it.
The plugin does not provide any admin screens.

Also see [Manual Plugin Installation](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

== Screenshots ==

There are no relevant screenshots.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

Initial release.
