<?php
// This file would be included where the settings form is rendered
// Typically, this content would be included in a settings callback

echo '<div class="wrap">';
echo '<h1>' . esc_html__( 'Bitcoin Connect Settings', 'btc-connect-elementor' ) . '</h1>';
echo '<form method="post" action="options.php">';
settings_fields( 'btc-connect' );
do_settings_sections( 'btc-connect' );
submit_button();
echo '</form>';
echo '</div>';
