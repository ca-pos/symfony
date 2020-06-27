<?php

require_once 'vendor/autoload.php';

use Cocur\Slugify\Slugify;

// Routage

$page = 'accueil';

if(isset($_GET['p'])) {
    $page = $_GET['p'];
}


// Rendu de templates

$loader = new \Twig\Loader\FilesystemLoader( __DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // __DIR__ . '/templates'kk
]);

$ext = '.html.twig';
$pages_h1 = [
    "Accueil",
    "Mise en place du projet",
    "Première page",
    "Autres pages simples",
    "Base de données et création de fausses données",
    "Suppression d'un attribut dans une table",
    "Formulaires",
    "Insérer getConfiguration dans une classe",
];

$slug = new Slugify();
$pages_slug_list = [];

foreach ( $pages_h1 as $page_tmp ) {
    $pages_slug_list[] = $slug->slugify( $page_tmp );
}

$page_num = array_search($page, $pages_slug_list);

$twig->addGlobal('pages_list', $pages_slug_list);
$twig->addGlobal('pages_h1', $pages_h1);
$twig->addGlobal('page_number', $page_num);

echo $twig->render($pages_slug_list[$page_num].$ext, [
                'page' => $page,
            ]);


//$slug = new Slugify();
//echo $slug->slugify("Mise en place du projet");

//$twig->addGlobal('current_page', $page);