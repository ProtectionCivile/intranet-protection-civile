<?php

namespace lib\conf;

/**
 * Cette librairie est responsable du chargement d'une configuration depuis un fichier (json, ini, php)
 *
 * Elle à aussi la particularité de mettre en cache la configuration
 */

/**
 * Le cache apc est t-il supporté par la plateforme
 *
 * @return bool
 */
function conf_is_cache()
{
    static $apc;

    if($apc === null) $apc = (PHP_SAPI != 'cli' && extension_loaded('apc'));

    return $apc;
}

/**
 * Charge un fichier de conf depuis un répertoire données
 *
 * @param string $name
 * @param string $directory
 * @return array|mixed
 * @throws \Exception
 */
function conf_load_configuration_file($name, $directory)
{
    // On récupere le chemin vers le fichier
    $pathWithoutExtension = $directory.DIRECTORY_SEPARATOR.$name;

    // On génére une clé pour le stockage en cache
    $key = md5('framework_configuration_'.$directory.'_'.$name);

    // Si le cache n'est pas activé ou si la configuration n'est pas encore en cache
    if (!conf_is_cache() || !apc_exists($key)) {
        // Alors on charge la configuration depuis le fichier

        if (file_exists($pathWithoutExtension.'.ini')) {
            $vars = parse_ini_file($pathWithoutExtension.'.ini', true);
        } elseif (file_exists($pathWithoutExtension.'.json')) {
            $vars = json_decode(file_get_contents($pathWithoutExtension.'.json'), true);
        } elseif (file_exists($pathWithoutExtension.'.php')) {
            $vars = require_once($pathWithoutExtension.'.php');
        }

        // Si le fichier de configuration n'est pas disponible alors on remonte une erreur
        if (!isset($vars)) {
            throw new \Exception('configuration doesn\'t load $directory : $name !');
        }

        // Si le cache est disponible sur la plateforme
        if (conf_is_cache()) {
            // Alors on stocke la configuration dans le cache
            apc_store($key, $vars);
        }
    }

    // Si le cache est disponible et que la configuration est en cache alors on la charge depuis le cache
    if (conf_is_cache() && apc_exists($key)) {
        $vars = apc_fetch($key);
    }

    // Si une directive d'import est dans le fichier alors on fussionne les configuration
    if (array_key_exists('imports', $vars)) {
        $dataImporteds = array();

        foreach ($vars['imports'] as $file) {
            $dataImporteds = array_merge($dataImporteds, conf_load_configuration_file($file, $directory));
        }

        $vars = array_merge($dataImporteds, $vars);

        unset($vars['imports']);
    }

    // Puis on retourne la configuration sous forme de tableau
    return $vars;
}
