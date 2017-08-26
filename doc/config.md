# Config loader

### Performance

L'orsque vous charger une configuration celle-ci est stocké en cache si apc est disponible.

### Comment charger un fichier de configuration

Pour cela suffit de crée un fichier de configuration à charger.

Ce fichier peut être un .ini, .json, .php selon votre convenance.

Utiliser en suite ce code afin de le charger.

Le fichier paramètre est le nom du fichier sans l'extension (elle est détecter de facon automatique)

LE second paramètre est le dossier dans lequel est présent votre fichier de configuration
    
    <?php $config = lib\conf\conf_load_configuration_file('config', __DIR__); ?>