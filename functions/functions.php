<?php
// Let's add some function to our theme :
global $theme_options;

function theme_get_option($page,$name){
    global $theme_options;
    if(isset($theme_options[$page][$name]) && !empty($theme_options[$page][$name])){
        return $theme_options[$page][$name];
    }else{
        return false;
    }
}
?>