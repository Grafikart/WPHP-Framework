WPHP Framework
==============

WPHP Framework est un framework qui permet d'automatiser certaines opérations récurentes de Wordpress 3 comme la création de panneau d'options ou de metadonnées personnalisées.

Installation
------------

- Pour installer ce framework il vous suffit de copier les fichiers dans un dossier framework dans le dossier de thèmes de Wordpress
- Ensuite dans le fichier functions.php de votre thème recopiez ces 2 lignes :
<pre>
    require_once (ABSPATH . 'wp-content/themes/framework/theme.php');
    $theme = new Theme();
</pre>
- Vous aurez alors un nouveau menu "Framework" dans le backoffice de Wordpress. Ce panneau vous guidera pour le reste des configurations.
