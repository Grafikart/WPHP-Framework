<div class="wrap">
    <div id="icon-edit" class="icon32"><br></div>
    <h2>Les Custom Post Type</h2>
    <p>Les fichiers correspondants aux custom post type sont formaté de manière classique en utilisant les fonction <a href="http://codex.wordpress.org/Function_Reference/register_post_type">register_post_type()</a> et <a href="http://codex.wordpress.org/Function_Reference/register_taxonomy">register_taxonomy()</a>. Le framework permet seulement d'organiser les fichiers par custom post type.</p>
    <p>
        <strong>Exemple de code pour ajouter un custom post type et une taxonomy :</strong>
        <a href="#" onclick="jQuery('#posttypeexample').slideToggle(); return false;">Voir le code source</a>
    </p>
        <textarea cols="70" rows="25" id="posttypeexample" tabindex="1" style="width:97%;display:none;" >
        &lt;?php
                //&nbsp;Custom post_type
                $labels = array(
                  'name' => 'Portfolio',
                  'singular_name' => 'Réalisation',
                  'add_new' => 'Ajouter une Réalisation',
                  'add_new_item' => 'Ajouter une nouvelle Réalisation',
                  'edit_item' => 'Editer une réalisation',
                  'new_item' => 'Nouvelle réalisation',
                  'view_item' => 'Voir la réalisation',
                  'search_items' => 'Rechercher une réalisation',
                  'not_found' =>  'Aucune réalisation',
                  'not_found_in_trash' => 'Aucune réalisation dans la corbeille', 
                  'parent_item_colon' => '',
                  'menu_name' => 'Portfolio'
                );
                
                $args = array(
                  'labels' => $labels,
                  'public' => true,
                  'publicly_queryable' => true,
                  'show_ui' => true, 
                  'show_in_menu' => true, 
                  'query_var' => true,
                  'rewrite' => true,
                  'capability_type' => 'post',
                  'has_archive' => true, 
                  'hierarchical' => false,
                  'menu_position' => 5,
                  'supports' => array('title','editor','author','thumbnail')
                ); 
                register_post_type('portfolio',$args);
                
                // Custom taxonomy
                $labels = array(
                    'name' =>  'Types',
                    'singular_name' => 'Type',
                    'search_items' =>  'Rechercher un type',
                    'all_items' => 'Tous les types',
                    'parent_item' => 'Type parent',
                    'parent_item_colon' => 'Type parent,',
                    'edit_item' => 'Editer ce type', 
                    'update_item' => 'Mettre à jour ce type',
                    'add_new_item' => 'Ajouter un nouveau type',
                    'new_item_name' => 'Nouveau type',
                    'menu_name' => 'Types',
                ); 	
                
                register_taxonomy('type',array('portfolio'), array(
                    'hierarchical' => true,
                    'labels' => $labels,
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => 'type', 'with_front' => false)
                ));  
        </textarea>
        <br clear="all"/>
        
    <div id="icon-edit" class="icon32"><br></div>
    <h2>Les Metadonnées</h2>
    <p>Une opération souvent pénible et de rajouter des meta pour certains custom post type. Pour ajouter une série de méta il faut procéder de la manière suivante</p>
    <p><img src="<?php echo FRAMEWORK_URL; ?>/help/meta-example.jpg"/></p>
    <p>
        <strong>Exemple de code pour les metas :</strong>
        <a href="#" onclick="jQuery('#metaexample').slideToggle(); return false;">Voir le code source</a>
    </p>
        <textarea cols="70" rows="25" id="metaexample" tabindex="1" style="width:97%;display:none;">
        &lt;?php
new metas(
array(
	'id' => 'post',
	'title' => 'Titre de la boite',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
),
array(
	array(
		"name" => 'Un champ select',
		"id" => "_files",
		"default" => "",
		"type" => "select"
	),
	array(
		"name" => 'Un checkbox',
		"id" => "_gratuit",
		"default" => 0,
		"type" => "checkbox"
	),
	array(
		"name" => 'Un champ text',
		"id" => "_price",
		"default" => 0,
		"type" => "text"
	)
));
?&gt;
        </textarea></p>
    
        <p>L'objet meta permet de créer une ou plusieurs boite de meta personalisée qui sont associé à un type de post. </p>
        <p>Le premier argument permet de définir les option de la boite de meta et est utilisé pour la fonction <a href="http://codex.wordpress.org/Function_Reference/add_meta_box">add_meta_box()</a></p>
        <p>Le second argument est une liste des différent champs : </p>
        <p><em><strong>$name</strong> (string)</em><br/>Nom qui servira de label</p>
        <p><em><strong>$id</strong> (string)</em><br/>Id de la metadonnée servant pour la récupération de la metadonnée dans la boucle de récupération des posts </p>
        <p><em><strong>$default</strong> (string)</em><br/>Valeur par défaut de cette metadonnée</p>
        <p><em><strong>$type</strong> (string)</em><br/>Type de la métadonnée (text,checkbox,select...). Le framework incluera le helper situé dans /framework/helpers/metas/[type].php en lui passant les arguments du tableau sous forme de variable. Il est possible de créer de nouveau type si le besoin s'en fait sentir.</p>
        <p><em><strong>$options</strong> (array)</em><br/>Dans le cas d'un type "select" permet de définir la liste des options valables.</p>
</div>