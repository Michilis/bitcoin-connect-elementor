<?php
/*
Plugin Name: Bitcoin Connect Elementor Widgets
Plugin URI:  https://yourwebsite.com
Description: Integrates Bitcoin Connect wallet functionality with Elementor, including user login and special action widgets.
Version:     1.0
Author:      Your Name
Author URI:  https://yourwebsite.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: btc-connect-elementor
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Autoload all classes
spl_autoload_register( function( $class_name ) {
    if ( false !== strpos( $class_name, 'BC_' ) ) {
        $class_file = plugin_dir_path( __FILE__ ) . 'includes/' . strtolower( $class_name ) . '.php';
        if ( file_exists( $class_file ) ) {
            require_once $class_file;
        }
    }
});

function bc_register_elementor_widgets() {
    if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BC_Elementor_Bitcoin_Connect_Widget() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BC_Elementor_Zap_Widget() );
    }
}
add_action( 'elementor/widgets/widgets_registered', 'bc_register_elementor_widgets' );

function bc_enqueue_scripts() {
    wp_enqueue_script('btc-connect', 'https://esm.sh/@getalby/bitcoin-connect@3.4.0', array(), '3.4.0', true);
    wp_enqueue_script('btc-connect-init', plugin_dir_url(__FILE__) . 'assets/js/btc-connect-init.js', array('btc-connect'), '1.0', true);
    wp_enqueue_style('btc-connect-css', plugin_dir_url(__FILE__) . 'assets/css/btc-connect-style.css');
}
add_action('wp_enqueue_scripts', 'bc_enqueue_scripts');

function bc_activate_plugin() {
    BC_Admin_Settings::add_admin_settings();
    flush_rewrite_rules(); // Ensure your init hooks get triggered on activation
}
register_activation_hook( __FILE__, 'bc_activate_plugin' );

function bc_deactivate_plugin() {
    flush_rewrite_rules(); // Clean up any rewrite rules added by the plugin on deactivation
}
register_deactivation_hook( __FILE__, 'bc_deactivate_plugin' );
