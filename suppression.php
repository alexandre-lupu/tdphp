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

$s1="select * from participer where login=:l and heure=:h and Date=:d";
$t1=$connexion->prepare($s1);
$t1->bindParam(':l',$_SESSION['login']);
$t1->bindParam(':h',$_GET['heure']);
$t1->bindParam(':d',$_GET['date']);
$t1->execute();

if($t1->rowCount()!=0){
  $sql="DELETE FROM participer where login=:log, nom=:name, heure=:hour, Date=:Date";
  $stmt=$connexion->prepare($sql);
  $stmt->bindParam(':log',$_SESSION['login']);
  $stmt->bindParam(':name',$_GET['act']);
  $stmt->bindParam(':hour',$_GET['heure']);
  $stmt->bindParam(':Date',$_GET['Date']);
}
$stmt->execute();


header('Location: session.php');

?>