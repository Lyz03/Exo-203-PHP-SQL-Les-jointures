<?php

$db = new PDO('mysql:host=localhost;dbname=exo_203;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $db->prepare("
    SELECT eleve.id, eleve.prenom, eleve.nom, eleve.login, 
           eleve_information.rue, eleve_information.ville, eleve_information.cp, eleve_information.pays
    FROM eleve
    INNER JOIN eleve_information ON eleve.information_id = eleve_information.id  
");

if($stmt->execute()) {
    foreach ($stmt->fetchAll() as $value) {
        foreach ($value as $key => $item) {
            echo $key . ' : ' . $item . '<br>';
        }
        echo '<br><br>';
    }
}


$stmt = $db->prepare("
    SELECT eleve_competence.niveau, eleve.nom, eleve.prenom, competence.titre, competence.description
    FROM eleve_competence
    INNER JOIN eleve ON eleve_competence.eleve_id = eleve.id
    INNER JOIN competence ON eleve_competence.competence_id = competence.id
");

if($stmt->execute()) {
    var_dump($stmt->fetchAll());
}

