<?php
error_reporting(0);
ini_set(â€œdisplay_errorsâ€, 0 );
?>

<?php
// Inclui a conexão//
include "conexao.php";
//Inicia uma sessão//
session_start();
// Se o campo estiver vazio então a área estará restrita. Portanto é necessário que faça login primeiro. Não há como acessar sem fazer login.//

if(empty($_SESSION['usuario']) ){
echo "<h1><b>Acesso restrito</b></h1>";
  echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
  // Destroi a sessão//
  session_destroy();

; 

}
//Senão ele inclui uma nova conexão e pega o valor via get enviada do arquivo index.php e armazena numa variável chamada "$usuario"//
else{
?>

<?php
include "conexao.php";
$usuario = $_GET['user'];

?>
// Iniciando a página html//
<!doctype html>
<html>
<head>
// Denifindo o tipos de linguagens utilizar, no caso e o utf-8 a que aceitar vários caracteres//
<meta charset="utf-8">
<title>NÃ­vel 1</title>
</head>

<body>
<br>
// Pega o valor da variável usuário declara logo acima e faz exibe na tela//
Bem vindo: <?php echo "<b>".$usuario.":"."</b>";?><br/>
// Variável data, exibe  a data atual//
<?php echo 'Data: '.date('Y-m-d');?>
//Link para o sistema de logout//
<br><?php echo '<a href="logout.php">Logout</a>'?>

</body>
</html>
<?php
// Declaração da sessão, recebe tempo atual. Obs: A sessão start foi iniciada no começo do script//
$_SESSION['TP'] =time();
// A sessão pega o valor da variável time declarada no arquivo "index.php" anteriormente, ou seja, paga o tempo inicial que o usuário acessou//

$v = $_SESSION['time'];
// criação de uma nova variável que recebe a diferença entre o tempo final e inicial, ou seja, final-inicial. Ex: 10:31-10:30.//

$gv = $_SESSION['TP']-$v;
//Se for maior que 60 segundo, então a sessão é destuida e o usuário deve logar novamente//
//Obs: Caso queira pode denifir uma novo valor para testar se esta funcionando//
if($gv > 60){

session_destroy();

}

}
?>