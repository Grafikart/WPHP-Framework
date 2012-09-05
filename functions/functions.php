<?php
// Let's add some function to our theme :
global $theme_options;

/**
* Return a specific theme option
**/
function get_theme_option($page,$name){
    global $theme_options;
    if(isset($theme_options[$page][$name]) && !empty($theme_options[$page][$name])){
        return $theme_options[$page][$name];
    }else{
        return false;
    }
}

/**
* Get all attachments (use it inside a loop)
**/
function get_attachments(){
    global $post;
    $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' =>  $post->ID , 'orderby' => 'menu_order','order' => 'ASC'); 
    $attachments =  get_posts($args);
    return $attachments;  
}

?>