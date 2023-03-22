<?php

if( ! class_exists( 'MC_Slider_Post_Type')){
    class MC_Slider_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes') );
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
        }

        public function create_post_type(){
            register_post_type(
                'mc-slider',
                array(
                    'label' => 'Slider',
                    'description' => 'Descrição Sliders',
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

        public function add_meta_boxes(){
            add_meta_box( 
                'mc_slider_meta_box',
                'Link Options',
                array( $this, 'add_inner_meta_boxes'),
                'mc-slider',
                'normal',
                'high',
            );
        }

        public function add_inner_meta_boxes( $post ){
            //formulário HTML
            require_once( MC_SLIDER_PATH . 'views/mc-slider_metabox.php' );
        }

        public function save_post( $post_id ){
            if( isset( $_POST['action']) && $_POST['action'] == 'editpost'){
                $old_link_text = get_post_meta( $post_id, 'mc_slider_link_text', true );
                $new_link_text = $_POST['mc_slider_link_text'];
                $old_link_url  = get_post_meta( $post_id, 'mc_slider_link_url', true );
                $new_link_url = $_POST['mc_slider_link_url'];

                update_post_meta( $post_id, 'mc_slider_link_text', $new_link_text, $old_link_text);
                update_post_meta( $post_id, 'mc_slider_link_url', $new_link_url, $old_link_url);
            }
        }

    }
}
