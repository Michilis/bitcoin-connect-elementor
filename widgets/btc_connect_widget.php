<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class BTC_Connect_Widget extends Widget_Base {

    public function get_name() {
        return 'btc_connect';
    }

    public function get_title() {
        return __( 'Bitcoin Connect', 'btc-connect-elementor' );
    }

    public function get_icon() {
        return 'eicon-cog';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Settings', 'btc-connect-elementor' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'btc-connect-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Connect Wallet', 'btc-connect-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button id="btc-connect-button" onclick="btcConnectInit();">' . esc_html( $settings['button_text'] ) . '</button>';
    }

    public function _content_template() {
        ?>
        <button id="btc-connect-button" onclick="btcConnectInit();">{{{ settings.button_text }}}</button>
        <?php
    }
}
