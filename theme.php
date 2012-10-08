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
        'images' => array(),
        'sidebar' => array(),
        'images' => array(),
        'options' => array(),
        'widgets' => array(),
        'commentFields' => array(),
        'help' => true,
        'shortcodes' => array()
    );

    function __construct($options = array()){
        $this->options = $options + $this->options;
        $framework_path = str_replace('\\','/',__FILE__);
        $framework_path = str_replace('/theme.php','',$framework_path);
        $framework_path = str_replace('/theme.php','',$framework_path);
        $framework_path = str_replace(str_replace('\\','/',ABSPATH),'',$framework_path);
        $framework_path = WP_CONTENT_URL.str_replace('wp-content','',$framework_path).'/';

        define('THEME_NAME', $this->options['name']);
        define('THEME_SLUG', $this->options['slug']);
        define('THEME_DIR', get_template_directory());
        define('THEME_URL', get_template_directory_uri().'/');
        define('THEME_JS',THEME_URL.'js/');
        define('FRAMEWORK_URL',$framework_path);
        define('THEME_FRAMEWORK',str_replace('theme.php','',__FILE__));
        define('THEME_ADMIN',THEME_FRAMEWORK.'admin/');
        define('THEME_HELPERS',THEME_FRAMEWORK.'helpers/');
        define('THEME_OPTIONS',THEME_DIR.'/options/');
        define('THEME_TYPES',THEME_DIR.'/types/');
        $this->supports();
        $this->shortcodes();
        add_action('init',array(&$this, 'init'));
        add_action('widgets_init',array(&$this, 'widgets'));
        add_action( 'comment_post',array(&$this, 'commentMetas') );

    }

    function  init() {
        $this->language();
        $this->menus();
        $this->types();
        $this->admin();
        $this->images();
        $this->options();
        $this->sidebar();

        require(THEME_FRAMEWORK.'functions/functions.php');
    }

    /**
     * Stocke dans $theme_options l'ensemble des options des panneaux d'options
     * */
    function options(){
        global $theme_options;
        $theme_options = array();
        foreach($this->options['options'] as $o){
            foreach($o['pages'] as $name=>$page){
                require(THEME_DIR.'/options/'.$o['slug'].'_'.$page.'.php');
                $default = array();
                foreach($options['options'] as $suboptions){
                    if(isset($suboptions['default'])){
                        $default[$suboptions['id']] = $suboptions['default'];
                    }
                }
                $theme_options[$page] = (array)get_option(THEME_SLUG.'_'.$page) + $default;
            }
        }
    }

    /**
     * Enregistre la liste des menus
     * **/
    function menus(){
        add_theme_support('menus');
        register_nav_menus($this->options['menus']);
    }

    /**
     * Ajoute les custom post type et les infos associées
     * inclue les fichiers dans THEME/types/post-type.php (ne fait rien de plus)
     * **/
    function types(){
        require(THEME_FRAMEWORK.'helpers/metas.php');
        foreach($this->options['types'] as $v){
            require(THEME_TYPES.$v.'.php');
        }
    }

    /**
     * Ajoute le support de toutes les fonctionnalitées Wordpress possible
     * */
    function supports() {
        if (function_exists('add_theme_support')) {
            add_theme_support('custom-header');
            add_theme_support('custom-background');
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('editor-style');
        }
    }

    /**
     * Déclare toutes les sidebar définit dans le _construct
     * */
    function sidebar(){
        if ( isset($this->options['sidebar']) && function_exists('register_sidebar') ) {
            foreach($this->options['sidebar'] as $name => $args){
                $args['name'] = $name;
                register_sidebar($args);
            }
        }
    }

    /**
     * Charge l'objet qui s'occupe des interfaces coté backoffice
     * */
    function admin() {
        if (is_admin()) {
            require_once (THEME_FRAMEWORK . 'admin.php');
            $options = array(
                'menus' => $this->options['options'],
                'help' => $this->options['help']
            );
            $admin = new AdminTheme($options);
        }
    }

    /**
     * Permet la traduction des éléments du framework
     * */
    function language(){
        // Traduction non prévu pour le moment
        /*
        if (is_admin()) {
            load_theme_textdomain( 'graf', THEME_ADMIN . '/languages/admin' );
        }else{
            load_theme_textdomain( 'graf', THEME_ADMIN . '/languages' );
        }
        */
    }

    /**
     * Charge les objets Widgets personnalisés
     */
    function widgets(){
        foreach($this->options['widgets'] as $w){
            require(THEME_DIR.'/widgets/'.$w.'.php');
            register_widget($w.'_Widget');
        }
    }
    /**
     * Gestion des différents formats d'image
     * */
    function images(){
        foreach($this->options['images'] as $post_type=>$formats){
            if (
                (isset($_POST['action']) && $_POST['action'] == 'ajax_thumbnail_rebuild') ||
                (isset($_GET['page']) && $_GET['page'] == 'ajax-thumbnail-rebuild') ||
                (isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == $post_type) ||
                (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
            ) {
                foreach($formats as $f){
                    if($f[0]=='thumb'){
                        set_post_thumbnail_size( $f[1], $f[2], $f[3] );
                    }else{
                        add_image_size($f[0], $f[1], $f[2], $f[3]);
                    }
                }
            }
        }
    }

    /**
     * Gestion des shortcodes
     * */
    function shortcodes(){
        foreach($this->options['shortcodes'] as $k=>$v){
            add_shortcode($k, array(&$this,'shortcode') );
        }
    }

    function shortcode($atts, $content=null, $code=""){
        $code = $this->options['shortcodes'][$code];
        if(!is_array($code)){
            return do_shortcode(str_replace('%content%',$content,$this->options['shortcodes'][$code]));
        }else{
            $retour = $code[0];
            unset($code[0]);
            extract( shortcode_atts( $code, $atts ));
            foreach($code as $k=>$v){
                $retour = str_replace('%'.$k.'%',$$k,$retour);
            }
            return do_shortcode(str_replace('%content%',$content,$retour));
        }
    }

    function commentMetas($comment_id){
        foreach($this->options['commentFields'] as $v){
            add_comment_meta( $comment_id, $v, str_replace('@','',$_POST[$v]), true );
        }
    }

}