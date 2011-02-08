<?php
//wp_deregister_script( 'jquery' );
wp_enqueue_style('admincss', FRAMEWORK_URL.'css/admin.css');
//wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
wp_enqueue_script('adminjs', FRAMEWORK_URL.'js/admin.js');
wp_enqueue_script('iphonecheck', FRAMEWORK_URL.'js/jquery.iphonecheck.js');
add_thickbox();
?>