<?php

	session_start();

	$autoLoadClass = function($class){
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoLoadClass);
	
	//Constantes para o Projecto
	define('INCLUDE_PATH_PERFOMANCE','http://localhost:8080/pacote_avaliacao/perfomance_comercial/');
	define('BASE_DIR_PERFOMANCE',__DIR__.'/perfomance_comercial/');
	define('NOME_PROJECTO','Perfomance Comercial');

	//Constantes para conectar com a Base de Dados
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','caol');


	//Funções do Sistema de Perfomance Comercial 
	function menuSeleccionado($par){
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}
	
	function recoverFormInformation($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}

	/*function clearFormInformation($post){
		return $_POST[$post] = '';
	}*/

?>