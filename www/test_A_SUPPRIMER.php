<?php

// Eléments d'authentification LDAP
$ldaprdn  = 'bpasek';     // DN ou RDN LDAP
$ldappass = '2812900245';  // Mot de passe associé

// Connexion au serveur LDAP
$ldapconn = ldap_connect("localhost")
    or die("Impossible de se connecter au serveur LDAP.");

if ($ldapconn) {

    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // Vérification de l'authentification
    if ($ldapbind) {
        echo "Connexion LDAP réussie...";
    } else {
        echo "Connexion LDAP échouée...";
    }

}

?>