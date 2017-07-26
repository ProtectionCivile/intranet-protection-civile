<?php
/**
 * Supprimer les accents
 *
 * @param string $str chaîne de caractères avec caractères accentués
 * @param string $encoding encodage du texte (exemple : utf-8, ISO-8859-1 ...)
 */
function suppr_accents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);

    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);

    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

function isNullOrEmpty($str)
{
    return (!isset($str) || $str == "");
}

function formatDateFrToUs($str)
{
    if ($str == null) {
      return "";
    }
    return DateTime::createFromFormat('d-m-Y', $str)->format('Y-m-d');
}

function formatDateUsToFr($str)
{
  if ($str == null) {
    return "";
  }
  return DateTime::createFromFormat('Y-m-d', $str)->format('d-m-Y');
}

function formatTimeRemoveDoubleDot($str)
{
  if ($str == null) {
    return "";
  }
  return DateTime::createFromFormat('H:i', $str)->format('Hi');
}
?>
