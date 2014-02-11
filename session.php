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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
      $("#datepicker").datepicker({ dateFormat: "yy-mm-dd"});
    });
  </script>
  </head>
  <body>

<form action="suppression.php" method="get">
<?php
$sql="SELECT nom,heure, date from participer where login=:user order by date, heure";
$stmt=$connexion->prepare($sql);
$stmt->bindParam(':user',$_SESSION['login']);
$stmt->execute();
$nb=$stmt->rowCount();

if($nb>0){
  foreach($stmt as $q){
    echo $q['nom'].' &agrave '.$q['heure'].'h le '.$q['date'];
    echo "<br/>";
  }
}
else 
  {
    echo "Pas d'activit&eacutes de pr&eacutevues.<br/>";
  }

?>

<input type="submit" value="supprimer"/>
</form>


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
<input type="text" name="date" id="datepicker">
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