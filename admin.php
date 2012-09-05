<?php
/**
 * Initialise les différent composants pour l'administration
 * 	1 - Panneau d'options
 **/
class AdminTheme{

    var $options = array(
	'menus' => array(),
	'help'=>true,
    );

    function  __construct($options) {
	$this->options = $options + $this->options; 
	
	add_action('admin_menu', array(&$this,'menus'));
	
        if($this->options['help']==true){
	    add_action('admin_menu', array(&$this,'helpMenus'));
	}
        include(THEME_FRAMEWORK.'functions/admin/head.php');
        include(THEME_FRAMEWORK.'functions/admin/filters.php');
    }
    
    //  Construit le menu en fonction de la structure définit dans le fichier options/structure.php du theme
    function menus(){
        foreach($this->options['menus'] as $k=>$m){
            $menu_slug = $m['slug'].'_'.current($m['pages']);
            add_menu_page($m['name'], $m['name'], 10, $menu_slug, array(&$this,'loadOptionPanel'),isset($m['icon']) ? THEME_URL.$m['icon'] : false,isset($m['position']) ? $m['position'] : (1000+$k));
            foreach($m['pages'] as $name=>$page){
                add_submenu_page($menu_slug,$name,$name,1,$m['slug'].'_'.$page,array(&$this,'loadOptionPanel'));
            }
        }
    }
    
    // Charge une page dans le panneau d'option
    function loadOptionPanel(){
        require(THEME_FRAMEWORK.'helpers/optionsgenerator.php');
        new optionsGenerator($_GET['page']);
    }

    // Ajoute un menu pour la doc du framework
    function helpMenus(){
    	add_menu_page('Framework','Framework','read','framework_intro',array(&$this,'loadHelpPanel'));
    	$helpPages = array(
    	    'Introduction' => 'intro',
    	    'Pour commencer' => 'help',
    	    'Les Post type' =>'posttype',
    	    'Les Options' =>'options',
                'Les fonctions' =>'functions'
    	);
    	foreach($helpPages as $name=>$page){
    	    add_submenu_page('framework_intro',$name,$name,'read','framework_'.$page,array(&$this,'loadHelpPanel'));
    	}
    }
    
    // Charge une page d'aide
    function loadHelpPanel(){
	require THEME_FRAMEWORK.'help/'.$_GET['page'].'.php';
    }

}
?>