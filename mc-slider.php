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

if( ! class_exists( 'MC_Slider')){
    class MC_Slider{
        //função construtora
        function __construct(){
            $this->define_constants();
        }

        //Define as constantes utilizadas no plugin
        public function define_constants(){
            define( 'MC_SLIDER_PATH', plugin_dir_path(__FILE__) );
            define( 'MC_SLIDER_URL', plugin_dir_url(__FILE__) );
            define( 'MC_SLIDER_VERSION', '1.0.0' );
        }

        public function activate(){
            update_option( 'rewrite_rules', '');
        }

        public function deactivate(){
            flush_rewrite_rules();
        }

        public function uninstall(){

        }
    }
}

//Se a classe já existe, instancia a classe
if( class_exists( 'MC_Slider')){  
    
    register_activation_hook(__FILE__, 'MC_Slider', 'activate');
    register_deactivation_hook(__FILE__, 'MC_Slider', 'deactivate');
    register_uninstall_hook(__FILE__, 'MC_Slider', 'uninstall');

    $mc_slider = new MC_Slider();
}
