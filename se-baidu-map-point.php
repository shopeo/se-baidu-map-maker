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

use src\SEBaiduMapCore;

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

add_action( 'init', function () {
	load_plugin_textdomain( 'se-baidu-map-point', false, dirname( __FILE__ ) . '/languages' );
	if ( ! defined( 'SE_Baidu_Map_Core_Loaded' ) ) {
		new SEBaiduMapCore();
	}
} );

$plugin_version = get_plugin_data( SE_BAIDU_MAP_POINT_FILE )['Version'];

add_action( 'admin_enqueue_scripts', function () {

} );

add_action( 'wp_enqueue_scripts', function () {

} );
