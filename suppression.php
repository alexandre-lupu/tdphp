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

$rep=$_GET['choix'];
$h="";
$d="";
$n="";
$cpt=0;
$i=0;

for($i; $rep[$i]!="/"; $i++){
  $n=$n.$rep[$i];
}
//echo $n;
$i=$i+1;
for($i; $rep[$i]!="/"; $i++){
  $h=$h.$rep[$i];
}
//echo $h;
$i=$i+1;
for($i; $rep[$i]!="/"; $i++){
  $d=$d.$rep[$i];
}
// echo $d;


$s1="select * from participer where login=:l and heure=:h and Date=:d";
$t1=$connexion->prepare($s1);
$t1->bindParam(':l',$_SESSION['login']);
$t1->bindParam(':h',$h);
$t1->bindParam(':d',$d);
$t1->execute();

echo $t1->rowCount();

if($t1->rowCount()==1){
  $sql="DELETE FROM participer where login=:log and nom=:name and heure=:hour and Date=:date";
  $stmt=$connexion->prepare($sql);
  $stmt->bindParam(':log',$_SESSION['login']);
  $stmt->bindParam(':name',$n);
  $stmt->bindParam(':hour',$h);
  $stmt->bindParam(':date',$d);

  $stmt->execute();

}


header('Location: session.php');

?>