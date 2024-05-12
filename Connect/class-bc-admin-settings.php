<?php
class BC_Admin_Settings {
    public static function add_admin_settings() {
        // Register a new setting for our "wporg" page
        register_setting( 'btc-connect', 'btc_options' );

        // Register a new section in the "wporg" page
        add_settings_section(
            'btc_settings_section',
            __( 'Bitcoin Connect Settings', 'btc-connect-elementor' ),
            null,
            'btc-connect'
        );

        // Register a new field in the "wporg_section_developers" section, inside the "wporg" page
        add_settings_field(
            'btc_post_types', // As of WP 4.6 this value is used only internally
            __( 'Post Types', 'btc-connect-elementor' ),
            null,
            'btc-connect',
            'btc_settings_section'
        );
    }
}
