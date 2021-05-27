<?php

/**
 * The view-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    My_Coupons
 * @subpackage My_Coupons/view
 */

/**
 * The view-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the view-specific stylesheet and JavaScript.
 *
 * @package    My_Coupons
 * @subpackage My_Coupons/view
 * @author     Md Junayed <admin@easeare.com>
 */
class My_Coupon_view {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		// Add short code for view coupons
		add_shortcode( 'mycoupon', [$this, 'mycoupons_front_views'] );
	}

	/**
	 * Register the stylesheets for the view area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-coupons-view.css', array(), microtime(), 'all' );
	}
	public function public_enqueue_styles() {
		wp_register_style( 'my-coupons-public', plugin_dir_url( __FILE__ ) . 'css/my-coupons-public.css', array(), microtime(), 'all' );
	}

	/**
	 * Register the JavaScript for the view area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-coupons-view.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'admin_ajax_action', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	/**
	 * Add wp menu page
	 */
	public function mycoupon_menupage(){
		// Register Menu
		add_menu_page( 'MYCoupons', 'MYCoupons', 'manage_options', 'my-coupons', [$this,'my_coupons_menupage_display'], 'dashicons-welcome-widgets-menus', 45 );
		add_submenu_page( 'my-coupons', 'All Coupons', 'All Coupons', 'manage_options', 'my-coupons', [$this,'my_coupons_menupage_display'] );
		add_submenu_page( 'my-coupons', 'Add Coupon', 'Add Coupon', 'manage_options', 'add-new-coupon', [$this,'add_new_coupon_menupage_display'] );
	}

	/**
	 * MYCoupon menupage view
	 */
	public function my_coupons_menupage_display(){
		require_once plugin_dir_path( __FILE__ )."partials/my-coupons-list-display.php";
	}
	/**
	 * MYCoupon add new view
	 */
	public function add_new_coupon_menupage_display(){
		require_once plugin_dir_path( __FILE__ )."partials/my-coupons-addnew-display.php";
	}

	// Reset colors
	function c_reset_colors(){
		global $wpdb;
		if(isset($_POST['data'])){
			$id = intval($_POST['data']);
			$tbl = $wpdb->prefix.'mycoupon_lists_v3';
			$wpdb->update($tbl,array('styles' => ''),array('ID' => $id),array('%s'),array('%d'));
			die;
		}
		die;
	}
	/**
	 * MYCoupons Front views
	 */
	public function mycoupons_front_views($atts){
		
		$atts = shortcode_atts(
			array(
				'mc' => '',
			), $atts, 'mycoupon'
		);
		

		if(!empty($atts['mc'])){
			ob_start();
			wp_enqueue_style(  'my-coupons-public' );
			global $wpdb;
			$mcid = intval($atts['mc']);
			$coupon = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}mycoupon_lists_v3 WHERE ID = $mcid");

			if($coupon){
				include plugin_dir_path( __FILE__ )."partials/my-coupons-css.php";
				include plugin_dir_path( __FILE__ )."partials/my-coupons-front.php";
			}
			
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
			exit;
		}
		
	}

}
