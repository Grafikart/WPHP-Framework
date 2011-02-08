<?php
class optionsGenerator{

    var $options = array();
    var $name;
    var $slug;
    var $save_options; 

    function optionsGenerator($page){
        include(THEME_OPTIONS.$page.'.php');
        $this->options = $options['options'];
        $this->name = $options['name'];
        $this->slug = $options['slug'];
        $this->save();
        $this->render();
    }

    function save(){
        $options = get_option(THEME_SLUG.'_'.$this->slug);
        if(isset($_POST['theme_option'])){
            foreach($this->options as $option) {
                if(isset($option['id'])){
                    $data[$option['id']] = $_POST[$option['id']];
                }
            }
            update_option(THEME_SLUG.'_'.$this->slug,$data);
            $options = $data; 
            echo '<div id="message" class="updated fade"><p><strong>'.__('Theme upgraded successfully.').'</strong></p></div>';
        }
        $this->saved_options = $options;
    }

    function render(){
        echo '<div class="wrap theme-options-page">';
        echo '<h2>'.$this->name.'</h2>';
        echo '<form method="post" action="">';
        foreach($this->options as $v) {
            $v['default'] = isset($v['default']) ? $v['default'] : '';
            $v['value'] = isset($this->saved_options[$v['id']]) ? $this->saved_options[$v['id']] : $v['default'];
            $file = THEME_HELPERS.'options/'.$v['type'].'.php';
            extract($v); 
            include($file);
        }

        echo '</form>';
        echo '</div>';
    }
}