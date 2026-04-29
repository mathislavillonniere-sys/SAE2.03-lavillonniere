
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

// define("HOST", "localhost");
// define("DBNAME", "SAE203");
// define("DBLOGIN", "Mathis");
// define("DBPWD", "Mathis792302025.");


function getAllMovies($age = 0){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    if ($age == 0) {
        // Profil tout public : affiche tous les films
        $sql = "SELECT m.id, m.name, m.image, c.name AS category_name 
                FROM SAE203_Movie m 
                JOIN SAE203_Categorie c ON m.id_category = c.id";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
    } else {
        // Profil avec restriction : affiche uniquement les films autorisés
        $sql = "SELECT m.id, m.name, m.image, c.name AS category_name 
                FROM SAE203_Movie m 
                JOIN SAE203_Categorie c ON m.id_category = c.id
                WHERE m.min_age <= :age";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->execute();
    }
    
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

function getOrCreateCategory($categoryName){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cherche si la catégorie existe déjà
    $sql = "SELECT id FROM SAE203_Categorie WHERE name = :name";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $categoryName);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if ($result) {
        // La catégorie existe, on retourne son id
        return $result->id;
    } else {
        // La catégorie n'existe pas, on la crée
        $sql = "INSERT INTO SAE203_Categorie (name) VALUES (:name)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $categoryName);
        $stmt->execute();
        // Retourne l'id de la nouvelle catégorie
        return $cnx->lastInsertId();
    }
}

function insertProfile($name, $avatar, $min_age){
    try {
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO SAE203_Profile (name, avatar, min_age) 
                VALUES (:name, :avatar, :min_age)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':min_age', $min_age);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        return 'Erreur : ' . $e->getMessage();
    }
}

function getAllProfiles(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM SAE203_Profile";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}