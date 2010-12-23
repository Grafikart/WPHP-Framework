<?php
wp_enqueue_style('admincss', THEME_URL.'framework/css/admin.css');
wp_enqueue_script('gjquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
wp_enqueue_script('adminjs', THEME_URL.'framework/js/admin.js');
add_thickbox();
?>