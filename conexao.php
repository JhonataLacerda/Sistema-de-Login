<?php

//Conex�o com o banco de dados//

$conexao = mysql_connect("localhost","root","") or die("Não foi possível conectar-se!");
//Selecionando a tabela do banco de dados//
@mysql_select_db("utilizador") or die("Utilizador inexistente");?>