

<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");


function readMoviesController(){
    $movies = getAllMovies();
    return $movies;
}


  function addMovieController(){
    $name = $_POST['titre'] ?? null;
    $director = $_POST['realisateur'] ?? null;
    $year = !empty($_POST['annee']) ? (int)$_POST['annee'] : null;
    $length = !empty($_POST['duree']) ? (int)$_POST['duree'] : null;
    $description = $_POST['description'] ?? null;
    $categoryName = $_POST['category'] ?? null;
    $image = $_POST['poster'] ?? null;
    $trailer = $_POST['trailer'] ?? null;
    $min_age = !empty($_POST['age']) ? (int)$_POST['age'] : null;

    if (!$name || !$director || !$year) {
        return "Champs obligatoires manquants";
    }

    $id_category = getOrCreateCategory($categoryName);


    $res = insertMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age);
    if ($res === 1) {
        return "Le film a été ajouté avec succès !";
    } else {
        return "Erreur : " . $res;
    }
}

function readMovieDetailController(){
    $id = $_GET['id'] ?? null;
    if (!$id) return false;
    return getMovieDetail($id);
}

function readCategoriesController(){
    return getAllCategories();
}