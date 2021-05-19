<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           My_Coupons
 *
 * @wordpress-plugin
 * Plugin Name:       MYCoupons
 * Plugin URI:        https://github.com/junaidzx90/my-coupons
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Junayed
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-coupons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MY_COUPON_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-my-coupons-activator.php
 */
function activate_my_coupon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-coupons-activator.php';
	My_Coupon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-my-coupons-deactivator.php
 */
function deactivate_my_coupon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-coupons-deactivator.php';
	My_Coupon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_coupon' );
register_deactivation_hook( __FILE__, 'deactivate_my_coupon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-my-coupons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_my_coupon() {

	$plugin = new My_Coupons();
	$plugin->run();

}
run_my_coupon();
