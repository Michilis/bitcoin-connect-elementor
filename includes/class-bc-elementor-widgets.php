class-bc-elementor-widgets.php

<?php
class BC_Elementor_Bitcoin_Connect_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'bitcoin_connect';
    }

    public function get_title() {
        return __( 'Bitcoin Connect', 'btc-connect-elementor' );
    }

    public function get_icon() {
        return 'eicon-cog';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'btc-connect-elementor' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'btc-connect-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Connect Wallet', 'btc-connect-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button onclick="btcConnectInit()">' . esc_html( $settings['button_text'] ) . '</button>';
    }
}

class BC_Elementor_Zap_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'zap_mint';
    }

    public function get_title() {
        return __( 'Zap Mint', 'btc-connect-elementor' );
    }

    public function get_icon() {
        return 'eicon-flash';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'zap_content',
            [
                'label' => __( 'Zap Mint Options', 'btc-connect-elementor' ),
            ]
        );

        $this->add_control(
            'zap_button_text',
            [
                'label' => __( 'Zap Button Text', 'btc-connect-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '⚡️Zap Mint⚡️', 'btc-connect-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button>' . esc_html( $settings['zap_button_text'] ) . '</button>';
    }
}
