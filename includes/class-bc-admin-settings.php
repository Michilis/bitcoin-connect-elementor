<?php
/**
 * Admin settings functionality for the Bitcoin Connect Elementor plugin.
 */

class BC_Admin_Settings {

    /**
     * Constructor to initialize the settings.
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Adds a settings page under the "Settings" menu of WordPress.
     */
    public function add_plugin_page() {
        add_options_page(
            'Bitcoin Connect Settings',   // Page title
            'Bitcoin Connect',            // Menu title
            'manage_options',             // Capability
            'bitcoin-connect',            // Menu slug
            array($this, 'create_admin_page')  // Callback function
        );
    }

    /**
     * Options page callback function
     */
    public function create_admin_page() {
        ?>
        <div class="wrap">
            <h1>Bitcoin Connect Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('btc_option_group');
                do_settings_sections('bitcoin-connect-admin');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
            'btc_option_group', // Option group
            'btc_options', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Settings', // Title
            array($this, 'print_section_info'), // Callback
            'bitcoin-connect-admin' // Page
        );  

        add_settings_field(
            'post_types', // ID
            'Post Types', // Title 
            array($this, 'post_types_callback'), // Callback
            'bitcoin-connect-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'redirect_after_login', 
            'Redirect After Login', 
            array($this, 'redirect_login_callback'), 
            'bitcoin-connect-admin', 
            'setting_section_id'
        );

        add_settings_field(
            'redirect_after_logout', 
            'Redirect After Logout', 
            array($this, 'redirect_logout_callback'), 
            'bitcoin-connect-admin', 
            'setting_section_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input) {
        $new_input = array();
        if(isset($input['post_types']))
            $new_input['post_types'] = sanitize_text_field($input['post_types']);

        if(isset($input['redirect_after_login']))
            $new_input['redirect_after_login'] = sanitize_text_field($input['redirect_after_login']);

        if(isset($input['redirect_after_logout']))
            $new_input['redirect_after_logout'] = sanitize_text_field($input['redirect_after_logout']);

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function post_types_callback() {
        printf(
            '<input type="text" id="post_types" name="btc_options[post_types]" value="%s" />',
            isset($this->options['post_types']) ? esc_attr($this->options['post_types']) : ''
        );
    }

    public function redirect_login_callback() {
        printf(
            '<input type="text" id="redirect_after_login" name="btc_options[redirect_after_login]" value="%s" />',
            isset($this->options['redirect_after_login']) ? esc_attr($this->options['redirect_after_login']) : ''
        );
    }

    public function redirect_logout_callback() {
        printf(
            '<input type="text" id="redirect_after_logout" name="btc_options[redirect_after_logout]" value="%s" />',
            isset($this->options['redirect_after_logout']) ? esc_attr($this->options['redirect_after_logout']) : ''
        );
    }
}

// Instantiate the admin settings class to hook everything in place.
new BC_Admin_Settings();
