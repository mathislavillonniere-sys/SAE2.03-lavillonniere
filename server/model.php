error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "lavillonniere7");
define("DBLOGIN", "lavillonniere7");
define("DBPWD", "lavillonniere7");


function getAllMovies(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT m.id, m.name, m.image, c.name AS category_name 
            FROM SAE203_Movie m 
            JOIN SAE203_Categorie c ON m.id_category = c.id";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function insertMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age){
    try {
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO SAE203_Movie
                (name, director, year, length, description, id_category, image, trailer, min_age)
                VALUES (:name, :director, :year, :length, :description, :id_category, :image, :trailer, :min_age)";

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':trailer', $trailer);
        $stmt->bindParam(':min_age', $min_age);

        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        return 'Erreur : ' . $e->getMessage();
    }
}

function getMovieDetail($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM SAE203_Movie WHERE id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function getAllCategories(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM SAE203_Categorie ORDER BY name";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}