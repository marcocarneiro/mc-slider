<?php
/**
* Plugin name: MC Slider
* Plugin URI: https://br.wordpress.org/
* Version: 1.0
* Requires at last: 5.6
* Author: Marco Carneiro
* Author URI: https://marco-carneiro.com.br
* Description: MC WordPress Slider Plugin.
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: mc-slider
* Domain Path: /languages
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Se o plugin for acessado diretamente, sai do sistema
if(! defined('ABSPATH')){
    exit;
}

//Se a classe não existe, executa a sua construção
if( ! class_exists( 'MC_Slider')){
    class MC_Slider{
        //função construtora
        function __construct(){
            $this->define_constants();

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( MC_SLIDER_PATH . 'post-types/class.mc-slider-cpt.php' );
            $mc_slider_cpt = new MC_Slider_Post_Type();

            require_once( MC_SLIDER_PATH . 'class.mc-slider-settings.php' );
            $Mc_Slider_Settings = new Mc_Slider_Settings();
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_SLIDER_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_SLIDER_URL', plugin_dir_url(__FILE__) );
            define( 'MC_SLIDER_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'mc-slider' );
        }

        public static function uninstall(){

        }

        public function add_menu(){
            add_menu_page(
                'MC Slider Options',
                'MC Slider',
                'manage_options',
                'mc_slider_admin',
                array( $this, 'mc_slider_settings_page' ),
                'dashicons-images-alt2',
            );

            add_submenu_page( 
                'mc_slider_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mc-slider',
                null,
                null
            );
        }


        public function mc_slider_settings_page(){
            if( ! current_user_can( 'manage_options' )){
                return;
            }
            if( isset( $_GET['settings-updated'] )){
                add_settings_error( 'mc_slider_options', 'mc_slider_message', 'Settings Saved', 'success');
            }
            settings_errors( 'mc_slider_options' );

            require( MC_SLIDER_PATH . 'views/settings-page.php' );
        }
    }
}

//Se a classe já existe, registra os hooks e instancia a classe
if( class_exists( 'MC_Slider')){  
    register_activation_hook( __FILE__, array('MC_Slider', 'activate') );
    register_deactivation_hook(__FILE__, array('MC_Slider', 'deactivate'));
    register_uninstall_hook(__FILE__, array('MC_Slider', 'uninstall')); 

    $mc_slider = new MC_Slider();
}
