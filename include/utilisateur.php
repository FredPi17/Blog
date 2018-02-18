<?php
/**
 * Created by PhpStorm.
 * User: pinau
 * Date: 18/02/2018
 * Time: 11:13
 */
define("DB_SERVER", "fredericisroot.mysql.db");
define("DB_BASE", "fredericisroot");
define("DB_USER", "fredericisroot");
define("DB_PASSWORD", "Jmpfricpiud0");
define('DB_SALT', 'Les5G'); // C'est le grain de sel

try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_BASE, DB_USER, DB_PASSWORD, $pdo_options);
    $bdd->exec("Set character set utf8");
    echo "<script>console.dir('Connexion BDD OK !');</script>";
} catch (Exception $e) {
    echo "<script>console.dir('Connexion BDD PAS OK !');</script>";
    die('Erreur : ' . $e->getMessage());
}


/* -------------------- FONCTION EST CONNECTE() ------------------ */
function estConnecte()
    /**
     *\author Hugo Lausenaz-Pire
     *\verificator Joseph Tabailloux
     *\brief renvoit vrai si l'utilisateur est connecté sinon renvoit faux
     * elle n'a pas de paramètres
     *\test Pour tester regarder à partir de la ligne 24.
     *\return ou faux selon la condition.
     */
{
    if (isset($_SESSION['code'])) /* Si l'id de l'utilisateur existe,
                                  * il est connecté */ {
        return true; /* Je renvois vrai */
    } else  /* Si l'id n'existe pas, l'utilisateur n'est pas connecté */ {
        return false; /* Je renvois faux */
    }
}

/* -------------------- FONCTION EST ADMIN() ------------------ */

function estAdmin()
{
    if (isset($_SESSION['code'])) {

        if (($_SESSION['admin']) == '1') {
            return True;
        } else {
            return False;
        }
    } else {
        return False;
    }
}

/*--------------------- FONCTION CONNEXION ------------------------------------*/
function connexion()
{

    global $bdd;

    $p_requeteConnexion = $bdd->prepare('SELECT IDutilisateur, MDP, Mail, Nom, Prenom, Admin, image
                                          FROM utilisateur
                                          WHERE lower(Mail) = :mail');
    $p_requeteConnexion->execute(array(
        'mail' => $_POST['login']));

    if ($id = $p_requeteConnexion->fetch()) {
        if ($id['MDP'] == sha1($_POST['mdp'] . DB_SALT . strtolower($_POST['login']))) {
            $_SESSION['code'] = $id['IDutilisateur'];
            $_SESSION['name'] = $id['Prenom'];
            $_SESSION['firstName'] = $id['Nom'];
            $_SESSION['admin'] = $id['Admin'];
            $_SESSION['photo'] = $id['image'];
        }
    }
}

/*------------------------FONCTION DECONNEXION ----------------------------------- */
function Deconnexion()
{
    unset($_SESSION['code']);
    unset($_SESSION['name']);
    $_SESSION['admin'] = '0';
    header('Location: http://www.home.fredericpinaud.fr/login.php');
    die();
}

/*----------------------FONCTION menuConnexion*/
function menuDeconnexion()
{
    if (isset($_GET['deconnexion'])) {
        Deconnexion();
    }
    echo '
  <a class="button secondary" value="Deconnexion" href="http://www.home.fredericpinaud.fr/index.php?deconnexion=deconnexion">Deconnexion</a>';
}

function menuConnexion()
{
    if (isset($_POST['connecter'])) { // Si clic sur le bouton Connexion ...
        Connexion();
    } // ...Appel à la fonction de connexion
    if (isset($_POST['deconnexion'])) { // Si clic sur le bouton Déconnexion ...
        Deconnexion();
    }
    if (empty($_SESSION['code'])) {
        $_SESSION['droits'] = '0';
        echo '
    <nav>
      <form method="post" >
        <label for="login">E-mail
          <input type="text" name="login" id="login"><br />
        </label>
        <label for="mdp">Mot de passe
          <input type="password" name="mdp" id="mdp"><br />
        </label>
          <input type="submit" name="connecter" value="Login" id="Submit_connexion">
      </form>
    </nav>';
    }
    if (isset($_SESSION['code'])) {
        echo '<div id="connexion">';
        echo "Vous etes connecté en tant que " . $_SESSION['name'];
        echo '<form method="post">';
        echo '<tr><input type="submit" name="deconnexion" value="deconnecter"></tr>';
        echo '</form>';
        echo '</div>';
    }

}

function menu()
{
    $id = "<div class='off-canvas position-left reveal-for-large' id='my-info' data-off-canvas data-position='left'><div class='row column'><br><img class='thumbnail' id='perso' src='";
    $id .= $_SESSION['photo'];
    $id .= " width='80px' height='80px'><h5>";
    $id .= $_SESSION['name'] . ' ' . $_SESSION['firstName'];
    $id .= "</h5>";
    $id .= menuDeconnexion();
    $id .= "</div>
  </div>
  <div class='off-canvas-content' data-off-canvas-content>
    <div class='title-bar hide-for-large'>
      <div class='title-bar-left'>
        <button class='menu-icon' type='button' data-open='my-info'></button>
        <span class='title-bar-title'>";
    $id .= $_SESSION['name'] . ' ' . $_SESSION['firstName'];
    $id .= "</span>
      </div>
    </div>";
    return $id;
}

//Nouvelle recette
function nouvelleRecette()
{
    echo '
    <form method="get" action="../cuisine/add.php" enctype="multipart/form-data">
    <div id="nouveau">
      <div class="form-group">
      <label for="nom">Titre:</label>
      <input type="text" class="form-control" id="nom" name="nom">
      <label for="resume">Description:</label>
      <textarea name="resume" class="form-control" rows="5" id="resume"></textarea>
    </div>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <button type="submit" name="nouveau" value="nouveau" class="btn btn-default">Valider</button>
    </div>';
}

/* -------------------- FONCTION AFFICHE FORM INSCRIPTION() ------------------ */
function afficheFormInscription()
    /**
     *\author Hugo Lausenaz-Pire
     *\verificator Joseph Tabailloux & Frédéric Pinaud
     *\brief affecte une valeur à un formulaire d'inscription avec un titre h1 et un sous titre h3s
     * Pas de paramètre
     *\return return le formulaire sous forme de string
     *\Test Regarder à la fin de la fonction
     */
{
    $echo = '
    <div class="container-full">
      <div class="row">
        <div class="col-lg-12 text-center v-center">
          <form method="get" class="col-lg-12">
            <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">

              <h1>Inscription</h1>
              <h3>Tous les champs sont obligatoire !</h3>
              <label for="mail">Mail
              <input type="text" name="mail" id="mail" class="form-control">
              </label>

              <label for="mdp">Mot de passe
                <input type="password" name="mdp" id="mdp" class="form-control"></br>
              </label>

              <label for="mdpC">Confirmation du mot de passe
              <input type="password" name="mdpC" id="mdpC" class="form-control"></br>
              </label>

              <label for="prenom">Prénom
              <input type="text" name="prenom" id="prenom" class="form-control">
              </label>

              <label for="nom">Nom
              <input type="text" name="nom" id="nom" class="form-control">
              </label>
              <span class="input-control input-lg">
                <input type="submit" class="btn btn-lg btn-primary" name="inscription" value="inscription" id="Submit_connexion">
              </span>
              <span class="input-control input-lg">
                <input type="submit" class="btn btn-lg btn-primary" name="retour" value="Retour" id="Submit_retour">
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    ';
    return $echo;
}

function afficheFormNouveau()
    /**
     *\author Hugo Lausenaz-Pire
     *\verificator Joseph Tabailloux & Frédéric Pinaud
     *\brief affecte une valeur à un formulaire d'inscription avec un titre h1 et un sous titre h3s
     * Pas de paramètre
     *\return return le formulaire sous forme de string
     *\Test Regarder à la fin de la fonction
     */
{
    $echo = '
      <div class="container-full">
        <div class="row">
          <div class="col-lg-12 text-center v-center">
            <form method="get" class="col-lg-12">
              <div class="input-group" style="width:340px;margin:0 auto;">
                <h1>Nouvel utilisateur</h1>
                <h3>Tous les champs sont obligatoire !</h3>

                <label for="prenom">Prénom
                <input type="text" name="prenom" id="prenom" class="form-control">
                </label>

                <label for="nom">Nom
                <input type="text" name="nom" id="nom" class="form-control">
                </label>


                <label for="mail">Mail
                <input type="text" name="mail" id="mail" class="form-control">
                </label>

                <label for="mdp">Mot de passe
                  <input type="password" name="mdp" id="mdp" class="form-control"></br>
                </label>

                <label for="mdpC">Confirmation du mot de passe
                <input type="password" name="mdpC" id="mdpC" class="form-control"></br>
                </label>


                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="nouveau" value="Nouveau" id="Submit_connexion">
                </span>
                <span class="input-control input-lg">
                  <input type="submit" class="btn btn-lg btn-primary" name="retour" value="Annuler" id="Submit_retour">
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      ';
    return $echo;
}

/* POUR TESTER LA FONCTION
echo afficheFormInscription();
*/

/* -------------------- FONCTION CONTROLE FORM INSCRIPTION() ------------------ */
function controleFormInscription($tab)
    /**
     *\author Hugo Lausenaz-Pire
     *\verificator Joseph Tabailloux
     *\brief affecte une valeur à un formulaire de connexion avec un titre h1
     * Pas de paramètre
     *\return return le formulaire sous forme de string
     *\Test Regarder à la fin de la fonction
     */
{
    session_start();
    if (strlen($tab['Nom'] < 3)) {
        $_SESSION['msgErreur'] .= "Nom absent ou trop court <br>";
    }
    if (strlen($tab['Prenom'] < 3)) {
        $_SESSION['msgErreur'] .= "Prénom absent ou trop court <br>";
    }
    if (!filter_var($tab['Mail'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msgErreur'] .= "Mail invalide <br>";
    }
    if (strlen($tab['MDP'] < 7)) {
        $_SESSION['msgErreur'] .= "Mail absent ou trop court (8 caractères minimum) <br>";
    }
    if ($tab['MDP'] != $tab['confirmation']) {
        $_SESSION['msgErreur'] .= "Les deux mots de passse sont différents <br>";
    }
}

/* -------------------- FONCTION AJOUTE UTILISATEUR() ------------------ */
function ajouteUtilisateur($tab)
{
    /**
     *\author Hugo Lausenaz-Pire
     *\verificator Joseph Tabailloux
     *\brief C'est un requete INSERT
     * Tableau du post inscription
     *\return l'identifiant de l'utilisateur
     *\Test Regarder le inscription.php
     */
    global $bdd;
    $NewPassword = sha1($tab['mdp'] . DB_SALT . strtolower($tab['mail']));
    $p_requeteInsert = $bdd->prepare('INSERT INTO utilisateur (MDP, Mail, Nom, Prenom, Admin) VALUES ( :mdp, :Mail, :nom, :prenom, :admin )'
    );
    $p_requeteInsert->execute(array(
        'Mail' => $tab['mail'],
        'mdp' => $NewPassword,
        'prenom' => $tab['prenom'],
        'nom' => $tab['nom'],
        'admin' => False
    ));
    $ID = $bdd->lastInsertId();
    return $ID;
}

?>
