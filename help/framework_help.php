<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Pour commencer</h2>
<p>Ce framework a pour but de vous aider à créer rapidement et facilement un theme Wordpress utilisant toutes les possibilités de Wordpress 3. Pour commencer il faut initialiser votre theme :</p>
<blockquote>
    <pre>
        $theme = new Theme(array(
            'name' => 'Lab',
            'slug' => 'lab',
            'menus'=> array(
                'nav' => 'Navigation'
            ),
            'types'=> array('portfolio','slideshow'),
            'sidebar' => array(
                'Principal' => array(
                    'before_widget' => '',
                    'after_widget' => '',
                    'before_title' => '',
                    'after_title' => ''
                )
            ),
            'options' => array(
                    array(
                        'name' => 'Grafikart.fr',
                        'slug' => 'theme',
                        'icon' =>  'options/grafikart.png',
                        'pages'=> array(
                            'General' => 'general'
                        )
                    )
            ),
            'images' => array(
                'post' => array(
                    array('thumb',150,150,true),
                    array('overlarge',1280,900,false),
                )
            )
        ));
    </pre>
</blockquote>

<div id="icon-edit" class="icon32"><br></div>
<h2>Paramètres</h2>
    <p><em><strong>$name</strong> (string)</em><br/>Nom du thème (inutile pour le moment)</p>
    
    
    <p><em><strong>$slug</strong> (string)</em><br/>Nom en minuscule sans espace de votre thème, Cette variable est utilisé pour stocker les configuration crée gràce au panneau d'option (slug_variable) pour éviter les mélanges entre les thèmes.</p>
    
    
    <p><em><strong>$menu</strong> (array)</em><br/>Permet de définir la liste des menus disponibles dans le thème.<br/>
    Le tableau contient en index l'id du menu (a utilisé pour l'argument <em>theme_location</em> de <a href="http://codex.wordpress.org/Function_Reference/wp_nav_menu">wp_nav_menu</a>) et en valeur le nom humain du menu pour l'administration</p>
    
    
    <p><em><strong>$types</strong> (array)</em><br/>Permet de définir la liste des custom post_type présent pour ce thèmes. Pour chaque post_type définit ici il faut créer le fichier<strong><?php echo THEME_DIR; ?>/types/[POST_TYPE].php</strong></p>
    
    <p><em><strong>$sidebar</strong> (array)</em><br/>Permet de définir les sidebar disponible pour le thème. L'index étant le nom de la sidebar et la valeur est l'argument qui est envoyé à la fonction <a href="http://codex.wordpress.org/Function_Reference/register_sidebar">register_sidebar</a></strong>.</p>
    
    <p><em><strong>$options</strong> (array)</em><br/>Permet de créer un nouveau menu dans l'interface d'administration (similaire à celui ci). Les pages sont les les sous options.</p>
    
    <p><em><strong>$images</strong> (array)</em><br/>Permet de définir les différent format d'image par post_type. si le nom du format est thumb le format sera utilisé pour les thumbnails.</p>
    
</div>