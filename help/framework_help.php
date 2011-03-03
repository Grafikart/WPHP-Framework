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
            'widgets' => array('MyWidget'),
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
            ),
            'commentFields' => array('twitter')
        ));
    </pre>
</blockquote>

<div id="icon-edit" class="icon32"><br></div>
<h2>Paramètres</h2>
    <p><em><strong>$name</strong> (string)</em><br/>Nom du thème (inutile pour le moment)</p>
    
    
    <p><em><strong>$slug</strong> (string)</em><br/>Nom en minuscule sans espace de votre thème, Cette variable est utilisé pour stocker les configuration crée gràce au panneau d'option (slug_variable) pour éviter les mélanges entre les thèmes.</p>
    
    
    <p><em><strong>$menu</strong> (array)</em><br/>Permet de définir la liste des menus disponibles dans le thème.<br/>
    Le tableau contient en index l'id du menu (a utilisé pour l'argument <em>theme_location</em> de <a href="http://codex.wordpress.org/Function_Reference/wp_nav_menu">wp_nav_menu</a>) et en valeur le nom humain du menu pour l'administration</p>

    <p><em><strong>$widgets</strong> (array)</em><br/>Permet de définir la liste des widgets supplémentaires. Pour chaque widget définit ici il faut créer le fichier <strong><?php echo THEME_DIR; ?>/widgets/[WIDGET_NAME].php</strong>. <a href="#" onclick="jQuery('#widgetexemple').slideToggle(); return false;">Voir le code exemple d'un widget.</a></p>

    <textarea cols="70" rows="25" id="widgetexemple" tabindex="1" style="width:97%;display:none;" >
        &lt;?php
class Comments_Widget extends WP_Widget {

	function Comments_Widget() {
                $widget_ops = array( 'classname' => 'lastcoms', 'description' => 'Affiche les dernier commentaires avec Gravatar et contenu');
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'comments-widget' );
		$this->WP_Widget( 'comments-widget', 'Derniers commentaires', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $pluginURL;
		extract( $args );
		// Variables
		$title = apply_filters('widget_title', $instance['title'] );
		$limit = $instance['limit'];
                $comments = get_comments(array('number' => $limit));

                // HTML render
		echo $before_widget;
		if ( $title )   echo $before_title . $title . $after_title;
                foreach($comments as $c){
                    $time = round((time() - strtotime($c->comment_date))/60);
                    ?&gt;
                    <div class="comment">
                        <div class="avatar">&lt;?php echo get_avatar($c->comment_author_email,45); ?&gt;</div>
                        <div class="com">&lt;?php echo $c->comment_content; ?&gt;</div>
                        <div class="clear"></div>
                        <div class="meta"><strong>&lt;?php echo $c->comment_author; ?&gt;</strong>, Il y a &lt;?php echo $time < 60 ? $time.'min ' : round($time/60).' heures '; ?&gt; </div>
                    </div>
                    &lt;?php
                }
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['limit'] = $new_instance['limit'];
		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Derniers commentaires', "limit"=>5 );
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="&lt;?php echo $this->get_field_id( 'title' ); ?>">Titre :</label>
			<input id="&lt;?php echo $this->get_field_id( 'title' ); ?&gt;" name="&lt;?php echo $this->get_field_name( 'title' ); ?>" value="&lt;?php echo $instance['title']; ?&gt;" style="width:100%;" />
		</p>
		<p>
			<label for="&lt;?php echo $this->get_field_id( 'limit' ); ?&gt;">Les derniers commentaires :</label>
			<input id="&lt;?php echo $this->get_field_id( 'limit' ); ?&gt;" name="&lt;?php echo $this->get_field_name( 'limit' ); ?>" value="&lt;?php echo $instance['limit']; ?&gt;" style="width:2em;" />
		</p>
	&lt;?php
	}
}
        </textarea>

    <p><em><strong>$types</strong> (array)</em><br/>Permet de définir la liste des custom post_type présent pour ce thèmes. Pour chaque post_type définit ici il faut créer le fichier <strong><?php echo THEME_DIR; ?>/types/[POST_TYPE].php</strong></p>
    
    <p><em><strong>$sidebar</strong> (array)</em><br/>Permet de définir les sidebar disponible pour le thème. L'index étant le nom de la sidebar et la valeur est l'argument qui est envoyé à la fonction <a href="http://codex.wordpress.org/Function_Reference/register_sidebar">register_sidebar</a></strong>.</p>
    
    <p><em><strong>$options</strong> (array)</em><br/>Permet de créer un nouveau menu dans l'interface d'administration (similaire à celui ci). Les pages sont les les sous options.</p>
    
    <p><em><strong>$images</strong> (array)</em><br/>Permet de définir les différent format d'image par post_type. si le nom du format est thumb le format sera utilisé pour les thumbnails.</p>

    <p><em><strong>$commentFields</strong> (array)</em><br/>Permet d'ajouter des champs au formulaire de commentaire (il faut alors ajouter le champs dans le paramètre fields de comment_form).</p>
    
</div>