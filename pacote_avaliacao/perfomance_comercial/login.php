<!DOCTYPE html>
<html>
<head>
	<title>Perfomance Comercial</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;1,100;1,300&family=Roboto+Mono:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFOMANCE; ?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFOMANCE; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFOMANCE; ?>css/waves-effect.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFOMANCE; ?>css/aos.css">	
</head>
<body>

    <div class="box-login">
        <?php

            if(isset($_POST['accao'])){
                $user = trim($_POST['user']);
                $password = trim($_POST['password']);
                $sql = MySql::conectar()->prepare("SELECT * FROM `cao_usuario` WHERE co_usuario = ? AND ds_senha = ?");
                $sql->execute(array($user,$password));
                
                if($sql->rowCount() == 1){
                    $sqlPer = MySql::conectar()->prepare("SELECT * FROM `permissao_sistema` WHERE co_usuario = ? AND co_sistema = '1' AND in_ativo = 'S' AND (co_tipo_usuario = '0' OR co_tipo_usuario = '1' OR co_tipo_usuario = '2')");
                    $sqlPer->execute(array($user));
                    if($sqlPer->rowCount() == 1){
                        $usuario = $sql->fetch();
                        $permissaoUsuario = $sqlPer->fetch();

                        //Logado com Sucesso!
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $password;
                        $_SESSION['nome'] = $usuario['no_usuario'];
                        $_SESSION['numero_cpf'] = $usuario['nu_cpf'];
                        $_SESSION['foto'] = $usuario['url_foto'];

                        $_SESSION['co_sistema'] = $permissaoUsuario['co_sistema'];
                        $_SESSION['in_activo'] = $permissaoUsuario['in_ativo'];
                        $_SESSION['co_tipo_usuario'] = $permissaoUsuario['co_tipo_usuario'];

                        header('Location: '.INCLUDE_PATH_PERFOMANCE);
                        die();                        
                    }else{
                        //Usuário não permitido ao Sistema
                        Painel::alert('erro','O Usuário <b>'.$user.'</b> não tem Permissão para Logar no Sistema!');
                    }
                }else{
                    //Falhou ao Logar
                    Painel::alert('erro','Usuário ou Senha incorrectos!');
                }
            }
        ?>
       
        <h1><i class="fa fa-sign-in" aria-hidden="true"></i></h1>
        <h2>Sistema de Perfomance Comercial</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Usuário" required>
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="password" name="password" placeholder="Senha" required>
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <div class="form-login-group left">
                <input type="submit" name="accao" value="Logar" class="waves-effect waves-light">
            </div><!--.form-login-group-->
            <div class="clear"></div>
        </form>
    </div><!--.box-login-->

    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/materialize.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/aos.js"></script>
	<script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/aos-initialize.js"></script>
</body>
</html>