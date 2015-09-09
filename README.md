
WPHP Framework (abandonné !)
=============

Par manque de temps je n'entretiendrais plus ce dépôt, un nouveau framework mieux maintenu et plus poussé est disponible [themosis](http://framework.themosis.com/)



WPHP Framework est un framework qui permet d'automatiser certaines opérations récurentes de Wordpress 3 comme la création de panneau d'options ou de metadonnées personnalisées.

Instalation
-------

Pour installer ce framework il vous suffit de copier les fichier dans un dossier framework dans le dossier de themes de Wordpress
Ensuite dans le fichier functions.php de votre thème recopiez ces 2 lignes
    require_once (ABSPATH . 'wp-content/themes/framework/theme.php');
    $theme = new Theme();
Vous aurez alors un nouveau menu "Framework" dans le backoffice de Wordpress. Ce panneau vous guidera pour le reste des configurations
