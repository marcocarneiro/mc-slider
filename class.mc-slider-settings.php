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
            register_setting( 
                'mc_slider_group', //option_group
                'mc_slider_options', //option_name
                //null //args
            );
            //Sections of plugin page
            add_settings_section( 
                'mc_slider_second_section', //id
                'Other plugin options', //title
                null, //callback
                'mc_slider_page2', //page
                null //args
            );
            add_settings_section( 
                'mc_slider_main_section', //id
                'How does it work?', //title
                null, //callback
                'mc_slider_page1', //page
                null //args
            );

            //fields to section settings
            add_settings_field( 
                'mc_slider_shortcode', //id
                'Shortcode', //title
                array( $this, 'mc_slider_shortcode_callback' ), //callback
                'mc_slider_page1', //page id
                'mc_slider_main_section', //id section
                null //args
            );
            add_settings_field( 
                'mc_slider_title', //id
                'Slider title', //title
                array( $this, 'mc_slider_title_callback' ), //callback
                'mc_slider_page2', //page id
                'mc_slider_second_section', //id section
                null //args
            );
            add_settings_field( 
                'mc_slider_bullets', //id
                'Display bullets', //title
                array( $this, 'mc_slider_bullets_callback' ), //callback
                'mc_slider_page2', //page id
                'mc_slider_second_section', //id section
                null //args
            );
            add_settings_field( 
                'mc_slider_style', //id
                'Slider style', //title
                array( $this, 'mc_slider_style_callback' ), //callback
                'mc_slider_page2', //page id
                'mc_slider_second_section', //id section
                null //args
            );
        }

        public function mc_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode [mc_slider] to display slider in any page/post/widget</span>
            <?php
        }

        public function mc_slider_title_callback(){
            ?>
                <input type="text" 
                name="mc_slider_options[mc_slider_title]" 
                id="mc_slider_title"
                value="<?php echo isset( self::$options['mc_slider_title'] ) ? esc_attr( self::$options['mc_slider_title'] ) : ''; ?>"
                >
            <?php
        }

        public function mc_slider_bullets_callback(){
            ?>
                <input type="checkbox" 
                name="mc_slider_options[mc_slider_bullets]" 
                id="mc_slider_bullets"
                value="1"
                <?php
                    if( isset( self::$options['mc_slider_bullets'] ) ){
                        checked( '1', self::$options['mc_slider_bullets'], true );
                    }                    
                ?>
                >
                <label for="mc_slider_bullets">Whether to display bullets or not</label>
            <?php
        }

        public function mc_slider_style_callback(){
            ?>
                <select 
                name="mc_slider_options[mc_slider_style]" 
                id="mc_slider_style">
                    <option value="style-1"
                    <?php isset( self::$options['mc_slider_style'] ) ? selected( 'style-1', self::$options['mc_slider_style'], true ) : ''; ?>
                    >                        
                        Style-1
                    </option>
                    <option value="style-2"
                    <?php isset( self::$options['mc_slider_style'] ) ? selected( 'style-2', self::$options['mc_slider_style'], true ) : ''; ?>
                    >                        
                        Style-2
                    </option>

                </select>
            <?php
        }


    }
}
