<?php

// On charges les librairies principales (logger, etc...)
include __DIR__.'/lib/logger.php';
include __DIR__.'/lib/conf.php';

// On active le logger
lib\logger\logger_register();

// Url demandé par le client
$uri = $_SERVER['REQUEST_URI'];

// On protège l'include contre les attaques par chemin relatifs
$uri = str_replace('..', '', $uri);

// On ne doit tenir compte uniquement de ce qu'il ya avant ?
list($uri) = explode('?', $uri);

// Si aucune page n'est demandé alors on appel la page index.php
if('/' === $uri) {
  $uri = '/index.php';
}

// On construit le chemin vers le fichier php
$pathPagePhp = __DIR__.'/'.$uri;

// Le page php existe
if (file_exists($pathPagePhp) && is_file($pathPagePhp)) {
    // Alors on l'affiche
    include $pathPagePhp;
}
else
{
    // Dans le cas contraire on affiche une page par défaut
    // TODO : Prévoir une page 404
    echo 'La page demandée n\'existe pas. Retour vers <a href="/index.php">accueil</a>.';

    header('HTTP/1.0 404 Not Found');
    exit();
}
