<?php
class WPHP{

    static function widget($widget_name){
        add_action( 'widgets_init', create_function( '', 'register_widget( "' . $widget_name . '" );' ) );
    }

    static function meta($conf, $fields){
        return new wphp_meta($conf, $fields);
    }

}
require 'wphp_widget.php';
require 'wphp_meta.php';