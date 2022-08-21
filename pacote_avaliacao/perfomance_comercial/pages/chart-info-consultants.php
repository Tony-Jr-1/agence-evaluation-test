<?php

    $pdo = new PDO('mysql:host=localhost;dbname=caol', 'root', '');
    $sql = $pdo->prepare("SELECT * FROM `cao_usuario` INNER JOIN `permissao_sistema` ON `cao_usuario`.`co_usuario` = `permissao_sistema`.`co_usuario` WHERE `co_sistema` = '1' AND `in_ativo` = 'S' AND (`co_tipo_usuario` = '0' OR `co_tipo_usuario` = '1' OR `co_tipo_usuario` = '2')");
    $sql->execute();
    $consultores = $sql->fetchAll();

    foreach ($consultores as $key => $value) {
        $pdo = new PDO('mysql:host=localhost;dbname=caol', 'root', '');
        $info = $pdo->prepare("SELECT * FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os`");
        $info->execute();
        $info = $info->fetchAll();

        die(json_encode($info));   
    }

    

?>