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
                array( $this, 'mc_slider_validate' ) //validation callback
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
                array(                    
                    'label_for' => 'mc_slider_title'
                )
            );
            add_settings_field( 
                'mc_slider_bullets', //id
                'Display bullets', //title
                array( $this, 'mc_slider_bullets_callback' ), //callback
                'mc_slider_page2', //page id
                'mc_slider_second_section', //id section
                array(                    
                    'label_for' => 'mc_slider_bullets'
                )
            );
            add_settings_field( 
                'mc_slider_style', //id
                'Slider style', //title
                array( $this, 'mc_slider_style_callback' ), //callback
                'mc_slider_page2', //page id
                'mc_slider_second_section', //id section
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'mc_slider_style'
                )
            );
        }

        //validate method for all fields
        public function mc_slider_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                switch( $key ){
                    case 'mc_slider_title':
                        if( empty( $value )){
                            $value = 'Please, type some text';
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    case 'mc_slider_url':
                        $new_input[$key] = esc_url( $value );
                    break;
                    case 'mc_slider_int':
                        $new_input[$key] = absint( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }                
            }
            return $new_input;
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

        public function mc_slider_style_callback( $args ){
            ?>
                <select 
                name="mc_slider_options[mc_slider_style]" 
                id="mc_slider_style">
                    <?php
                        foreach( $args['items'] as $item):
                    ?>
                        <option value="<?php echo esc_attr( $item );?>" 
                        <?php isset( self::$options['mc_slider_style'] ) ? selected( $item, self::$options['mc_slider_style'], true ): ''; ?>     
                        >
                        <?php echo esc_html( ucfirst( $item )); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php
        }


    }
}
