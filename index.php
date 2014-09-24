<?php
// Anulação dos erros//
error_reporting(0);
ini_set(â€œdisplay_errorsâ€, 0 );
?>


<?php
// Inclusão da conexão//
include "conexao.php";
//Declaração das variáveis, usuário, senha e email que capturam os valores enviados pelo formulário//
$usuario = $_POST['usuario'];
$senha  = $_POST['senha'];
$email = $_POST['email'];


// Caso o campo usuário não estiver preenchido ele retornará um erro//
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

// Criação da variável retorno que irá selecionar o banco de dados com a condição: usuário deve possuir a mesmo valor que a variável $usuário etc..//

$retorno  = @mysql_query("SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha' AND email='$email'");
// A variável linha é construida para checar o total de linhas existentes na tabela. Deste modo poderemos ver quantos usuários estão cadastrados no sistema//
$linha = @mysql_num_rows($retorno) ;




// Se linha maior que zero, então o script vai ser executado, ou seja, se houver um usuario cadastrado o sistema será executado, senão voltará um erro.//

if($linha > 0)
{
// Criação da variável array que ira pegar as informações do banco de dados e armazenar todas em uma variável//
$array  = @mysql_fetch_array($retorno) or die("Nenhum usuÃ¡rio correspodente");
      /* Para retirar as informações armazenadas no banco de dados basta criar uma variável que irá receber o valor e "sempre" especificar
         o nome da váriável que receber o valor do banco que no caso é a variável "$array" que recebe os dados via mysql_fetch_array.
         Depois entre "[" e aspas simples ou dubplas colocar o campo que deseja ex: ['nome'], recebe-se a informação do campo nome*/

       $senhas = $array['senha'];
	   $usuarios = $array['usuario'];
	   $nivel = $array['nivel'];
	   
/* Se o nível for igual a 1 então ele irá redirecionar para pagina nível que significa que é a pagina do usuário. Detalhe quando 
       for  iniciar uma sessão sempre deverá iniciar com o comando "session_start". A sessão é uma estrução que armazena certos valores até que o
       servidor seja fechado. Nesse caso estamos armazenando o valor senha e usuário e valor do tempo de ínicio.*/
	   if($nivel == 1){
		header("Location:nivel1.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		//Fechamento da conexão.//
		@mysql_close($conexÃ£o) or die("ConexÃ£o nÃ£o foi encerrada");
	   }
    // A mesma situação citada acima, se for igual a 2 será enviada para página de quem possui nível 2 no banco de dados//

elseif($nivel == 2){
	
	header("Location:nivel2.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		
		@mysql_close($conexÃ£o) or die("ConexÃ£o nÃ£o foi encerrada");
	}
	// Nível 3 mandará quem tem nível 3 para uma página restrita para esse grupo//
	elseif($nivel == 3){
			header("Location:nivel3.php?user=$usuario");
		session_start("AB");
		$_SESSION["usuario"] = $usuario;
		$_SESSION["senha"] =$senha;
		$_SESSION['time'] = time();
		
		
		
		@mysql_close($conexÃ£o) or die("ConexÃ£o nÃ£o foi encerrada");
		}
}
// Caso o script não possa ser executado ele irá redirecionar para página inicial para fazer o login//
else{
	echo "<h1><b>Dados incorretos!</b></h1>";
	echo "<meta http-equiv='refresh' content='1; URL=index.html'>";
	
	
	

	
	
	}
}

?>