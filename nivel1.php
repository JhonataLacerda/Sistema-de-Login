﻿<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
?>

<?php
// Inclui a conex�o//
include "conexao.php";
//Inicia uma sess�o//
session_start();
// Se o campo estiver vazio ent�o a �rea estar� restrita. Portanto � necess�rio que fa�a login primeiro. N�o h� como acessar sem fazer login.//

if(empty($_SESSION['usuario']) ){
echo "<h1><b>Acesso restrito</b></h1>";
  echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
  // Destroi a sess�o//
  session_destroy();

; 

}
//Sen�o ele inclui uma nova conex�o e pega o valor via get enviada do arquivo index.php e armazena numa vari�vel chamada "$usuario"//
else{
?>

<?php
include "conexao.php";
$usuario = $_GET['user'];

?>
// Iniciando a p�gina html//
<!doctype html>
<html>
<head>
// Denifindo o tipos de linguagens utilizar, no caso e o utf-8 a que aceitar v�rios caracteres//
<meta charset="utf-8">
<title>Nível 1</title>
</head>

<body>
<br>
// Pega o valor da vari�vel usu�rio declara logo acima e faz exibe na tela//
Bem vindo: <?php echo "<b>".$usuario.":"."</b>";?><br/>
// Vari�vel data, exibe  a data atual//
<?php echo 'Data: '.date('Y-m-d');?>
//Link para o sistema de logout//
<br><?php echo '<a href="logout.php">Logout</a>'?>

</body>
</html>
<?php
// Declara��o da sess�o, recebe tempo atual. Obs: A sess�o start foi iniciada no come�o do script//
$_SESSION['TP'] =time();
// A sess�o pega o valor da vari�vel time declarada no arquivo "index.php" anteriormente, ou seja, paga o tempo inicial que o usu�rio acessou//

$v = $_SESSION['time'];
// cria��o de uma nova vari�vel que recebe a diferen�a entre o tempo final e inicial, ou seja, final-inicial. Ex: 10:31-10:30.//

$gv = $_SESSION['TP']-$v;
//Se for maior que 60 segundo, ent�o a sess�o � destuida e o usu�rio deve logar novamente//
//Obs: Caso queira pode denifir uma novo valor para testar se esta funcionando//
if($gv > 60){

session_destroy();

}

}
?>