<?php
class WPHP{

    static function widget($widget_name){
        add_action( 'widgets_init', create_function( '', 'register_widget( "' . $widget_name . '" );' ) );
    }

    static function meta($conf, $fields){
        return new wphp_meta($conf, $fields);
    }

}

function wphp_scripts($hook) {
    wp_enqueue_script('customadminjs', get_template_directory_uri() . '/wphp/js/admin.js');
}
add_action( 'admin_enqueue_scripts', 'wphp_scripts' );


require 'wphp_widget.php';
require 'wphp_meta.php';
