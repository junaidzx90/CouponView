<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    My_Coupons
 * @subpackage My_Coupons/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    My_Coupons
 * @subpackage My_Coupons/includes
 * @author     Md Junayed <admin@easeare.com>
 */
class My_Coupon_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {
		global $wpdb;
		$mycoupon_lists_v3 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}mycoupon_lists_v3 ( `ID` INT NOT NULL AUTO_INCREMENT,
		`title` VARCHAR(255) NOT NULL,
		`logo` VARCHAR(255) NOT NULL,
		`headline` VARCHAR(255) NOT NULL,
		`couponheadline` VARCHAR(255) NOT NULL,
		`subheadline` VARCHAR(255) NOT NULL,
		`coupon_code` VARCHAR(55) NOT NULL,
		`target_url` VARCHAR(255) NOT NULL,
		`reviews` INT NOT NULL,
		`votes` INT NOT NULL,
		`tandc_texts` VARCHAR(255) NOT NULL,
		`tandc_url` VARCHAR(255) NOT NULL,
		`styles` TEXT NOT NULL,
		PRIMARY KEY (`ID`)) ENGINE = InnoDB";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($mycoupon_lists_v3);
	}

}
