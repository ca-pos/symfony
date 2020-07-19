<?php

require_once 'vendor/autoload.php';
require 'AppTwigExtension.php';

use Cocur\Slugify\Slugify;
 

$loader = new \Twig\Loader\FilesystemLoader( __DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // __DIR__ . '/templates'kk
]);
$twig->addExtension(new AppTwigExtension());

// Routage

// la première fois ($_GET unset), on se rend à l'accueil
// ensuite, ($_GET set) pointe sur la page où aller (lien de la page accueil)
if(isset($_GET['p'])) {
    $page = $_GET['p'];
} 
else {
    $page='accueil';
}
// tableau associatif (key => value) contenant les pages disponibles, 
// organisées en 2 sections : "Pas à pas" et "Exemples"
//
// Les titres de section sont les keys
// Les values sont les intitulés sous forme de tableau des 
// pages de la section
//
// D'autres sections pourront être ajoutées de la même manière
$pages_h1 = [
    "Pas à pas" =>  [ //"Accueil",
     "Mise en place du projet",
     "Première page",
     "Autres pages simples",
     "Base de données et création de fausses données",
     "Suppression d'un attribut dans une table",
     "Formulaires",
     "Insérer getConfiguration dans une classe",
     "Validation de formulaire",
     "Unicité d'un élément",
     "Création de la table User",
     "Relation entre tables",
     "Créer les faux utilisateurs",
     "Encryptage des mots de passe",
     "Page de connexion",
     "Déconnexion",
     "Page d'inscription",
     "Barre de navigation adaptative",
     "Page de modification de profil",
     "Page de modification du mot de passe",
     "Ajouter une erreur à un champ",
	 "Gestion des utilisateurs",
        ],
     "Exemples de code" => [
         "getConfiguration",
        ],
    "Ligne de commande" => [
        "composer",
        "php bin/console",
        ],
    "Résumé du projet symBnB" => [
        "Controller",
        "Entities",
        "Forms",
        "Templates",
        ]
];


// Rendu de templates

// parcourt les titres de chapitre (for) des différentes sections (foreach)
// en détermine le slug et range ces slugs dans un tableau page_slug_list
// de même structure (mêmes keys) que le tableau d'origine
// une fois qu'une section est "slugifiée", le array_search cherche si la 
// page à atteindre est dans cette section
//
// QUAND LA LISTE SERA DÉFINITIVE, IL NE FAUDRA PLUS LE FAIRE À CHAQUE FOIS
// SI C'EST POSSIBLE !!!
$slug = new Slugify();
foreach ( $pages_h1 as $col => $page_tmp ) {
    for( $i = 0, $nb=count($page_tmp); $i < $nb; $i++) {
        $pages_slug_list[$col][$i] = $slug->slugify($page_tmp[$i]);
    }
}

foreach( $pages_h1 as $col => $page_tmp ) {
    $page_num[$col] = array_search($page, $pages_slug_list[$col]);
}
$keys = array_keys($page_num);
$nb = count($keys);
$val = -1;      // pour éviter un warning sur la page d'accueil où le if ci-dessous est sauté
for( $i = 0; $i < $nb; $i++) {
    if ( ($page_num[$keys[$i]]) !== false ) {
        $col = $keys[$i];
        $val =  $page_num[$keys[$i]];
    }
}

$twig->addGlobal('pages_h1', $pages_h1);
$twig->addGlobal('pages_slug', $pages_slug_list);

$ext = '.html.twig';
$pageToGo = $page . $ext;

echo $twig->render($pageToGo, [
    'slug' => $page,
    'section' => $col,
    'current' => $val,
    ]);

