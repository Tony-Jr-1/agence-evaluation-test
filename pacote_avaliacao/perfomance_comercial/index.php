<?php
    include('configurations.php');

    if(Painel::logado() == false){
        include('login.php');
    }else {
        include('main.php');
    }
?>