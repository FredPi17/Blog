<?php
/**
 * Created by PhpStorm.
 * User: pinau
 * Date: 18/02/2018
 * Time: 11:09
 */

$importLast = $bdd->prepare('SELECT * FROM `blogArticles` ORDER BY id DESC LIMIT 1');
$importLast->execute();
$importLastRow = $importLast->fetch();
   $image =  $importLastRow['imagePrincipale'];
   $titre = $importLastRow['titre'];
   $intro = $importLastRow['introduction'];
   $auteur = $importLastRow['auteur'];
   $description = $importLastRow['description'];
   $id = $importLastRow['id'];
