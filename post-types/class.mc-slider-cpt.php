<?php

if( ! class_exists( 'MC_Slider_Post_Type')){
    class MC_Slider_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
        }

        public function create_post_type(){
            register_post_type(
                'mc-slider',
                array(
                    'label' => 'Slider',
                    'description' => 'Descrição Slideers',
                    'labels' => array(
                        'name' => 'Sliders',
                        'singular_name' => 'Slider'
                    ),
                    'public' => true,
                    'supports' => array(
                        'title', 'editor', 'thumbnail'
                    ),
                    'hierarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 10,
                    'show_in_admin_bar' => true,
                    'can_export' => true,
                    'has_archive' => false,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2'
                )
            );
            
        }

    }
}
