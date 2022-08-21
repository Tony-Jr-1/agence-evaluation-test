<?php

    
        $pdo = new PDO('mysql:host=localhost;dbname=caol', 'root', '');
        $info = $pdo->prepare("SELECT * FROM `cao_cliente` INNER JOIN `cao_fatura` ON `cao_cliente`.`co_cliente` = `cao_fatura`.`co_cliente` WHERE `tp_cliente` = 'A'");
        $info->execute();
        $clientes = $info->fetchAll();

        foreach ($clientes as $key => $value) {
            $pdo = new PDO('mysql:host=localhost;dbname=caol', 'root', '');
            $info = $pdo->prepare("SELECT * FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os`");
            $info->execute();
            $info = $info->fetchAll();
    
            die(json_encode($info));   
        }

?>