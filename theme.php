<?php
/**
 * Used for the theme's initialization.
 */
class Theme {

    var $options = array(
        'name' => 'Theme',
        'slug' => 'theme',
        'types' => array(),
        'menus' => array(),
        'images' => array()
    );

    function  __construct($options) {
        $this->options = $options + $this->options;
        define('THEME_NAME', $this->options['name']);
        define('THEME_SLUG', $this->options['slug']);

        define('THEME_DIR', get_template_directory());
        define('THEME_URL', get_template_directory_uri().'/');
        define('THEME_JS',THEME_URL.'js/');
        define('FRAMEWORK_URL',WP_CONTENT_URL.'/themes//framework/');
        define('THEME_FRAMEWORK',ABSPATH . 'wp-content/themes/framework/');
        define('THEME_ADMIN',THEME_FRAMEWORK.'admin/');
        define('THEME_HELPERS',THEME_FRAMEWORK.'helpers/');
        define('THEME_OPTIONS',THEME_DIR.'/options/');
        define('THEME_TYPES',THEME_DIR.'/types/');
        
        add_action('after_setup_theme', array(&$this, 'supports'));
        add_action('init',array(&$this, 'language'));

        $this->supports();
        $this->menus();
        $this->types();
        $this->admin();
        $this->options();
        $this->images();

        require(THEME_FRAMEWORK.'functions/functions.php');
    }

    function options(){
        global $theme_options;
        require(THEME_OPTIONS.'structure.php');
        $theme_options = array();
        foreach($menus as $m){
            foreach($m['pages'] as $name=>$page){
                $theme_options[$page] = get_option(THEME_SLUG.'_'.$page);
            }
        }
    }

    function menus(){
        add_theme_support('menus');
        register_nav_menus($this->options['menus']);
    }

    function types(){
        require(THEME_FRAMEWORK.'helpers/metas.php');
        foreach($this->options['types'] as $v){
            require(THEME_TYPES.$v.'.php');
        }
    }

    function supports() {
        if (function_exists('add_theme_support')) {
            add_theme_support('custom-header');
            add_theme_support('custom-background');
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('editor-style');
        }
        if ( isset($this->options['sidebar']) && function_exists('register_sidebar') )  register_sidebar($this->options['sidebar']);
    }

    function admin() {
        if (is_admin()) {
            require_once (THEME_FRAMEWORK . 'admin.php');
            $admin = new AdminTheme();
        }
    }

    function language(){
        if (is_admin()) {
            load_theme_textdomain( 'graf', THEME_ADMIN . '/languages/admin' );
        }else{
            load_theme_textdomain( 'graf', THEME_ADMIN . '/languages' );
        }
    }
    
    function images(){
        foreach($this->options['images'] as $post_type=>$formats){
            if($post_type=='thumbnail'){
                set_post_thumbnail_size( $formats[0], $formats[1], $formats[2] ); 
            }else{
                
                if ((isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == $post_type) || (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')) {
                    foreach($formats as $f){
                        add_image_size($f[0], $f[1], $f[2], $f[3]);
                    }
                }
            }
        }
    }
    
}