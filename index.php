﻿<?php
// Anula��o dos erros//
error_reporting(0);
ini_set(“display_errors”, 0 );
?>


<?php
// Inclus�o da conex�o//
include "conexao.php";
//Declara��o das vari�veis, usu�rio, senha e email que capturam os valores enviados pelo formul�rio//
$usuario = $_POST['usuario'];
$senha  = $_POST['senha'];
$email = $_POST['email'];


// Caso o campo usu�rio n�o estiver preenchido ele retornar� um erro//
if(empty($usuario)){
		echo "<h1><b>"."Preencha todos os campos"."</b></h1>";	
		echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
	}elseif(empty($senha)){
		echo "<h1><b>"."Preencha todos os campos"."</b></h1>";	
		echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
	}
		elseif(empty($email)){

		echo "<h1><b>"."Preencha todos os campos"."</b></h1>";	
		echo "<meta http-equiv='refresh' content='2; URL=index.html'>";
	
			
	}
	else{

// Cria��o da vari�vel retorno que ir� selecionar o banco de dados com a condi��o: usu�rio deve possuir a mesmo valor que a vari�vel $usu�rio etc..//

$retorno  = @mysql_query("SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha' AND email='$email'");
// A vari�vel linha � construida para checar o total de linhas existentes na tabela. Deste modo poderemos ver quantos usu�rios est�o cadastrados no sistema//
$linha = @mysql_num_rows($retorno) ;




// Se linha maior que zero, ent�o o script vai ser executado, ou seja, se houver um usuario cadastrado o sistema ser� executado, sen�o voltar� um erro.//

if($linha > 0)
{
// Cria��o da vari�vel array que ira pegar as informa��es do banco de dados e armazenar todas em uma vari�vel//
$array  = @mysql_fetch_array($retorno) or die("Nenhum usuário correspodente");
      /* Para retirar as informa��es armazenadas no banco de dados basta criar uma vari�vel que ir� receber o valor e "sempre" especificar
         o nome da v�ri�vel que receber o valor do banco que no caso � a vari�vel "$array" que recebe os dados via mysql_fetch_array.
         Depois entre "[" e aspas simples ou dubplas colocar o campo que deseja ex: ['nome'], recebe-se a informa��o do campo nome*/

       $senhas = $array['senha'];
	   $usuarios = $array['usuario'];
	   $nivel = $array['nivel'];
	   
/* Se o n�vel for igual a 1 ent�o ele ir� redirecionar para pagina n�vel que significa que � a pagina do usu�rio. Detalhe quando 
       for  iniciar uma sess�o sempre dever� iniciar com o comando "session_start". A sess�o � uma estru��o que armazena certos valores at� que o
       servidor seja fechado. Nesse caso estamos armazenando o valor senha e usu�rio e valor do tempo de �nicio.*/
	   if($nivel == 1){
		header("Location:nivel1.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		//Fechamento da conex�o.//
		@mysql_close($conexão) or die("Conexão não foi encerrada");
	   }
    // A mesma situa��o citada acima, se for igual a 2 ser� enviada para p�gina de quem possui n�vel 2 no banco de dados//

elseif($nivel == 2){
	
	header("Location:nivel2.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		
		@mysql_close($conexão) or die("Conexão não foi encerrada");
	}
	// N�vel 3 mandar� quem tem n�vel 3 para uma p�gina restrita para esse grupo//
	elseif($nivel == 3){
			header("Location:nivel3.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		
		@mysql_close($conexão) or die("Conexão não foi encerrada");
		}
}
// Caso o script n�o possa ser executado ele ir� redirecionar para p�gina inicial para fazer o login//
else{
	echo "<h1><b>Dados incorretos!</b></h1>";
	echo "<meta http-equiv='refresh' content='1; URL=index.html'>";
	
	
	

	
	
	}
}

?>