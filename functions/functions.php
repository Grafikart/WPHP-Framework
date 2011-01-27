<?php
// Let's add some function to our theme :
global $theme_options;

function themeoption($page,$name){
    global $theme_options;
    if(isset($theme_options[$page][$name]) && !empty($theme_options[$page][$name])){
        return $theme_options[$page][$name];
    }else{
        return false;
    }
}


function home_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
