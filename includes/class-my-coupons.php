<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    My_Coupons
 * @subpackage My_Coupons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, view-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    My_Coupons
 * @subpackage My_Coupons/includes
 * @author     Md Junayed <admin@easeare.com>
 */
class My_Coupons {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      My_Coupon_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the view area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MY_COUPON_VERSION' ) ) {
			$this->version = MY_COUPON_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'my-coupons';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_view_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - My_Coupon_Loader. Orchestrates the hooks of the plugin.
	 * - My_Coupon_i18n. Defines internationalization functionality.
	 * - My_Coupon_Admin. Defines all hooks for the admin area.
	 * - My_Coupon_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-coupons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-coupons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the view area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'view/class-my-coupons-view.php';

		$this->loader = new My_Coupon_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the My_Coupon_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new My_Coupon_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the view area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_view_hooks() {

		$plugin_view = new My_Coupon_view( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_view, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_view, 'public_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_view, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_view, 'mycoupon_menupage' );
		$this->loader->add_action("wp_ajax_c_reset_colors", $plugin_view,"c_reset_colors");
		$this->loader->add_action("wp_ajax_nopriv_c_reset_colors", $plugin_view,"c_reset_colors");

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    My_Coupon_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
