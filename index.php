<?php

require_once 'vendor/autoload.php';

// Routage

$page = 'home';
if(isset($_GET['p'])) {
    $page = $_GET['p'];
}


// Rendu de templates

$loader = new \Twig\Loader\FilesystemLoader( __DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // __DIR__ . '/templates'kk
]);


switch($page) {
    case 'home':
        echo $twig->render('home.html.twig', ['page' => 'home']);
        break;
    case 'mise_en_place':
        echo $twig->render('mise-en-place-du-projet.html.twig');
        break;
    default:
        $header('HTTP/1.0 404 Not found');
        echo $twig->render('404.twig');
        break;             
}