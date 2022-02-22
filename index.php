<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>
     *   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.
    require 'connPDO.php';
    $pdo = new connPDO();
    $db = $pdo->conn();

    $stm = $db->prepare("SELECT MIN(age) as minimum FROM user");
    $stm->execute();
    $minAge = $stm->fetch();
    echo "age minimum : " . $minAge["minimum"] . "<br>";

    $stm = $db->prepare("SELECT MAX(age) as max FROM user");
    $stm->execute();
    $minAge = $stm->fetch();
    echo "age maximum : " . $minAge["max"] . "<br>";

    $stm = $db->prepare("SELECT count(*) as number FROM user");
    $stm->execute();
    if($stm->execute()){
        $count = $stm->fetch();
        echo "il y a " . $count['number'] . " d'utilisateurs" . "<br>";
    }

    $stm = $db->prepare("SELECT count(*) as number FROM user WHERE numero >= 5");
    $stm->execute();
    if($stm->execute()){
        $count = $stm->fetch();
        echo "il y a " . $count['number'] . " numéro de rue > ou = 5" . "<br>";
    }

    $stm = $db->prepare("SELECT AVG(age) as moy FROM user");
    if($stm->execute()){
        $nbr = $stm->fetch();
        echo "moyenne d'age : " . $nbr['moy'] . "<br>";
    }

    $stm = $db->prepare("SELECT SUM(numero) as numero FROM user");
    if($stm->execute()){
        $nbr = $stm->fetch();
        echo "somme des numéros : " . $nbr['numero'] . "<br>";
    }

    ?>
</body>
</html>

