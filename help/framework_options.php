<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>
    <h2>Les options</h2>
    <p>Construire un panneau d'option est souvent complexe est fastidieux. Avec le framework, construire un panneau d'option complexe ne prend que quelques minutes</p>
    <p>Dans un premier temps il faut définir les différentes pages de notre panneau d'option directement dans l'initialisation du theme (cf chapitre "Pour Commencer"). Dans l'argument page on va définir l'ensemble des pages accessible dans notre administration : </p>

    <blockquote>
        <pre>
        ....
        'name' => 'Grafikart',
        'slug' => 'theme',
        'icon' =>  'options/grafikart.png',
        'pages'=> array(
            'General' => 'general'
        )
        ...
        </pre>
    </blockquote>

    <p>Ce tableau correspond à un menu et l'options pages définit les sous menus qui le compose. Dans cet exemple le Menu <strong>Grafikart</strong> aura une sous page appellée <strong>General</strong> et qui mènera à la page <strong>theme_general</strong>.php dans le dossier /options du thème.</p>

    <p>Les fichiers appellées de cette manière contiennent des tableaux qui serviront à construire la page d'options.</p>

    <blockquote>
        <pre>
$options = array(
	"name" => 'General',
        "slug" => "general",
        "options" => array(
	array(
		"name" => 'General',
		"type" => "start"
	),
        array(
                "name" => "blablabla un label",
                "id" => "logo",
                "default" => "loool",
                "type" => "upload"
        ),
	array(
		"type" => "end"
	),
    ),
);
        </pre>
    </blockquote>

    <p><em><strong>$name</strong> (string)</em><br/> Titre de la page (utilisé en haut de la page avec des balises h2).</p>
    <p><em><strong>$slug</strong> (string)</em><br/>Identifiant de la page sert de "paquet" pour regrouper les variables comprises dans cette page. Une variable d'option pourra être récupéré avec la fonction theme_get_option(nom du paquet [slug], id de la variable).</p>
    <p><em><strong>$options</strong> (array)</em><br/>Tableau permettant de construire le panneau d'option.</p>

    <h2>Formats des options</h2>

    <p><em><strong>$name</strong> (string)</em><br/>Label du champ.</p>
    <p><em><strong>$id</strong> (string)</em><br/>Nom de l'option. Utilisé au moment de récupérer la variable avec theme_get_option.</p>
    <p><em><strong>$default</strong> (string)</em><br/>Valeur par défaut.</p>
    <p><em><strong>$type</strong> (string)</em><br/>Type de l'option (text,checkbox,select...). Le framework incluera le helper situé dans /framework/helpers/options/[type].php en lui passant les arguments du tableau sous forme de variable. Il est possible de créer de nouveau type si le besoin s'en fait sentir.</p>
    <p><em><strong>$options</strong> (array)</em><br/>Dans le cas d'un type "select" permet de définir la liste des options valables.</p>
</div>
