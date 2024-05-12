<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class BTC_Zap_Widget extends Widget_Base {

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
                'type' => Controls_Manager::TEXT,
                'default' => __( '⚡️Zap Mint⚡️', 'btc-connect-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button id="zap-button">' . esc_html( $settings['zap_button_text'] ) . '</button>';
    }

    public function _content_template() {
        ?>
        <button id="zap-button">{{{ settings.zap_button_text }}}</button>
        <?php
    }
}
