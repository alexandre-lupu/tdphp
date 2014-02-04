<?php
session_start();

require_once('connect.php');
$dsn="mysql:dbname=".BASE.";host=".SERVER;

try{
  $connexion=new PDO($dsn,USER,PASSWD);
}
catch(PDOException $e){
  printf("echec de la connexion : %s\n", $e->getMessage());
  exit();
}

if(!empty($_SESSION['login'])){
  echo "<h1>Bienvenue ".$_SESSION['login']."</h1><br/>";
}
else header('Location: authDB.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
  <head>
  <title>Session</title>
  </head>
  <body>

<article>
<?php
$sql="SELECT nom,heure from participer where login=:user order by heure";
$stmt=$connexion->prepare($sql);
$stmt->bindParam(':user',$_SESSION['login']);
$stmt->execute();
$nb=$stmt->rowCount();

if($nb>0){
  foreach($stmt as $q){
    echo $q['nom'].' &agrave '.$q['heure'].'h';
    echo "<br/>";
  }
}
else 
  {
    echo "Pas d'activités de prévues.<br/>";
  }

?>
</article>


<form action="ajout.php" method="get">
  <p>
  <fieldset>
  <legend>Ajouter une activit&eacute</legend>

<select name="act">
<?php
$reponse = $connexion->query('SELECT * FROM Activites');
 
while ($donnees = $reponse->fetch())
{
?>
  <option value="<?php echo $donnees['nom']; ?>"> <?php echo $donnees['nom']; ?></option>
<?php
} 
$reponse->closeCursor();
?>
</select>
</p>
<p>
<input type="text" name="heure" placeholder="Heure..." required>h.
</p>
<p>
  <input type="submit" value="Ajouter"/>
</p>

</fieldset>
</p>
</form>



<article>
<p>

<form action="deconnect.php" method="POST">
  <input type="submit" value="deconnexion"/>
</form>

</p>
</article>
</body>
</html>