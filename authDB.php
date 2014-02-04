<?php
require_once('connect.php');
$dsn="mysql:dbname=".BASE.";host=".SERVER;

try{
  $connexion=new PDO($dsn,USER,PASSWD);
  }
catch(PDOException $e){
  printf("echec de la connexion : %s\n", $e->getMessage());
  exit();
}

$errorMessage='';

//test de l'envoi du formulaire
if(!empty($_POST))
  {
    //les id sont transmis ?
    if(!empty($_POST['login']) && !empty($_POST['password']))
      {
	//sont ils ceux attendus ?
	

	$sql="SELECT * from utilisateurs where USER=:login and PASSWD=:passwd";
	$stmt=$connexion->prepare($sql);
	$stmt->bindParam(':login',$_POST['login']);
	$stmt->bindParam(':passwd',md5($_POST['password']));
	$stmt->execute();
	$res=$stmt->rowCount();
	if($res!=1){
	  $errorMessage='Probleme d\'authentification';
	}
	else //tout va bien
	  {
	    //on ouvre la session
	    session_start();
	    //on enregistre le login de la sesion
	    $_SESSION['login']=$_POST['login'];
	    header('Location: session.php');
	  }
      }
    else{
      $errorMessage='Veuillez inscrire vos identifiants svp !';
    }
  }
      
      
?>
<!DOCTYPE HTML>
<html lang="fr">
  <head>
  <title>Formulaire d\'authentification</title>
  </head>
  <body>
  <?php
  if(!empty($errorMessage)){
    echo $errorMessage;
  }
?>


<form action="authDB.php" method="post">
  <fieldset>
  <legend>Identifiez vous</legend>
  <p>
  <label for="login">Login :</label>
  <input type="text" name="login" id="login" value=""/>
  </p>
  <label for="password">Password :</label>
  <input type="password" name="password" id="password" value=""/>
  <input type="submit" value="Se logger"/>
  </p>
  </fieldset>
  </form>
  </body>
  </html>
