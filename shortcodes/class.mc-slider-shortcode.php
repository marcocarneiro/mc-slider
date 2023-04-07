<?php

if( ! class_exists( 'MC_Slider_Shortcode') ){  
    class MC_Slider_Shortcode{
        public function __construct()
        {
            add_shortcode( 'mc_slider', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){
            //all caracters must be lowercase
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
            extract(shortcode_atts(
                //array with all possible parameters for this shortcode
                array(
                    'id' => '',
                    'orderby' => 'date',
                ),
                $atts,
                $tag
            ));

            if( !empty( $id )){
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            //build HTML of shortcode on buffer and return
            ob_start();
            require( MC_SLIDER_PATH . 'views/mc-slider-shortcode.php' );
            return ob_get_clean();
        }

    }
}