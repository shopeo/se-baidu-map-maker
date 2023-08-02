<?php
/**
 * Plugin Name: SE Baidu Map Point
 * Plugin URI: https://wordpress.org/plugins/se-baidu-map-point
 * Description: SHOPEO Baidu Map Point
 * Author: Shopeo
 * Version: 0.0.1
 * Author URI: https://shopeo.cn
 * License: GPL2+
 * Text Domain: se-baidu-map-point
 * Domain Path: /languages
 * Requires at least: 5.9
 * Requires PHP: 5.6
 */

use Shopeo\SeBaiduMapPoint\SEBaiduMapCore;

require_once 'vendor/autoload.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'SE_BAIDU_MAP_POINT_FILE' ) ) {
	define( 'SE_BAIDU_MAP_POINT_FILE', __FILE__ );
}

if ( ! function_exists( 'se_baidu_map_point_activation' ) ) {
	function se_baidu_map_point_activation() {

	}
}

register_activation_hook( __FILE__, 'se_baidu_map_point_activation' );

if ( ! function_exists( 'se_baidu_map_point_deactivation' ) ) {
	function se_baidu_map_point_deactivation() {

	}
}

register_deactivation_hook( __FILE__, 'se_baidu_map_point_deactivation' );


//执行卸载挂钩
function your_prefix_activate(){
	register_uninstall_hook( __FILE__, 'your_prefix_uninstall' );
}
register_activation_hook( __FILE__, 'your_prefix_activate' );

// And here goes the uninstallation function:
function your_prefix_uninstall(){
	//	codes to perform during unistallation
}

require_once plugin_dir_path(__FILE__) . 'functions.php';

add_action( 'init', function () {
	load_plugin_textdomain( 'se-baidu-map-point', false, dirname( __FILE__ ) . '/languages' );
	if ( ! defined( 'SE_Baidu_Map_Core_Loaded' ) ) {
		new SEBaiduMapCore();
	}
	
	
} );




add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'se-baidu-map-point-style', plugins_url( '/assets/css/backend.css', SE_BAIDU_MAP_POINT_FILE ), array(), true );
	wp_style_add_data( 'se-baidu-map-point-style', 'rtl', 'replace' );
	wp_enqueue_script( 'se-baidu-map-point-script', plugins_url( 'assets/js/backend.js', SE_BAIDU_MAP_POINT_FILE ), array( 'jquery' ), true );
	wp_localize_script( 'se-baidu-map-point-script', 'se_baidu_map_point', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'se-baidu-map-point-frontend-style', plugins_url( '/assets/css/frontend.css', SE_BAIDU_MAP_POINT_FILE ), array(), true );
	wp_style_add_data( 'se-baidu-map-point-frontend-style', 'rtl', 'replace' );
	wp_enqueue_script( 'se-baidu-map-point-frontend-script', plugins_url( '/assets/css/frontend.js', SE_BAIDU_MAP_POINT_FILE ), array( 'jquery' ), true );
	wp_localize_script( 'se-baidu-map-point-frontend-script', 'se_baidu_map_point_frontend', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
} );


