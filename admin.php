<?php
class AdminTheme{

    function  __construct() {
	add_action('admin_menu', array(&$this,'menus'));
        
        include(THEME_FRAMEWORK.'functions/admin/head.php');
        include(THEME_FRAMEWORK.'functions/admin/filters.php');
    }

    function menus(){
        require(THEME_OPTIONS.'structure.php');
        foreach($menus as $m){
            $menu_slug = $m['slug'].'_'.current($m['pages']);
            add_menu_page($m['name'], $m['name'], 10, $menu_slug, array(&$this,'loadMenu'),$m['icon']);
            foreach($m['pages'] as $name=>$page){
                add_submenu_page($menu_slug,$name,$name,1,$m['slug'].'_'.$page,array(&$this,'loadMenu'));
            }
        }
    }

    function loadMenu(){
        require(THEME_FRAMEWORK.'helpers/optionsgenerator.php');
        new optionsGenerator($_GET['page']);
    }

}
?>