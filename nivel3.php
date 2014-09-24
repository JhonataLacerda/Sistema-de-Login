<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
?>

<?php
include "conexao.php";
session_start("AB");
if(empty($_SESSION['usuario']) ){
echo "<h1><b>Acesso restrito</b></h1>";
  echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
  session_destroy();

; 



}
else{
?>



<?php
include "conexao.php";
$usuario = $_GET['user'];




?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nível 3</title>
</head>

<body>
<br>
Bem vindo: <?php echo "<b>".$usuario.":"."</b>";?><br/>
<?php echo 'Data: '.date('Y-m-d');?>
<br><?php echo '<a href="logout.php">Logout</a>'?>


</body>
</html>


   
  

  


<?php

$_SESSION['TP'] =time();

$v = $_SESSION['time'];
$gv = $_SESSION['TP']-$v;



if($gv > 2){
session_destroy();

}

}
?>