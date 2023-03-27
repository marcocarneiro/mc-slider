<?php

if (!class_exists('Mc_Slider_Settings')) {
    class Mc_Slider_Settings
    {
        public static $options;

        public function __construct(){
            self::$options = get_option( 'mc_slider_options' );
            add_action( 'admin_init', array($this, 'admin_init') );
        }

        public function admin_init(){
            add_settings_section( 
                'mc_slider_main_section', //id
                'Ho does it work?', //title
                null, //callback
                'mc_slider_page1', //page
                null //args
            );

            add_settings_field( 
                'mc_slider_shortcode', //id
                'Shortcode', //title
                array( $this, 'mc_slider_shortcode_callback' ), //callback
                'mc_slider_page1', //page id
                'mc_slider_main_section', //id section
                null //args
            );
        }

        public function mc_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode [mc_slider] to display slider in any page/post/widget</span>
            <?php
        }
    }
}
