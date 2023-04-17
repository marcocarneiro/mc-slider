<?php

if( ! function_exists( 'mc_slider_options')){
    function mc_slider_options(){
        $show_bullets = isset( Mc_Slider_Settings::$options['mc_slider_bullets']) && Mc_Slider_Settings::$options['mc_slider_bullets']  == 1 ; true : false;

        //Inclui dinamicamente uma propriedade dentro de um arquivo JS sem precisar incluit código PHP
        wp_enqueue_script( 'mc-slider-options-js', MC_SLIDER_URL . 'vendor/flexslider/flexslider.js', array('jquery'), MC_SLIDER_VERSION, true );
        wp_localize_script( 'mc-slider-options-js', 'SLIDER_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}
