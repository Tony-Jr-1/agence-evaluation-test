<?php
    //Efectuando o LogOut
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>

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
<base base="<?php echo INCLUDE_PATH_PERFOMANCE; ?>" />
    <header>
        <div class="center">
            <div class="btn-menu waves-effect waves-light">
                <i class="fa fa-bars"></i>
            </div><!--.btn-menu-->
            <div class="logo"></div><!--.logo-->
            <div class="clear"></div>
        </div><!--.center-->
    </header>

    <div class="menu">
        <div class="menu-wrapper">
            <div class="box-usuario">
                <?php
                    //Verificando se existe uma imagem do Usuario, se não, visualizamos a imagem Padrão que é o Avatar
                    if($_SESSION['foto'] == ''){
                ?>
                    <div class="avatar-usuario">
                        <i class="fa fa-user"></i>
                    </div><!--.avatar-usuario-->
                <?php }else{ ?>
                    <div class="imagem-usuario">
                        <img src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>img_usuario/<?php echo $_SESSION['foto']; ?>" alt="Foto do Usuário">
                    </div><!--.imagem-usuario-->
                <?php } ?>
                <div class="nome-usuario">
                    <p><?php echo $_SESSION['nome']; ?></p>
                    <p><?php 
                    
                        $sqlPer = MySql::conectar()->prepare("SELECT ds_tipo_usuario FROM `tipo_usuario` WHERE co_tipo_usuario = ?");
                        $sqlPer->execute(array($_SESSION['co_tipo_usuario']));
                        $ds_tipo_usuario = $sqlPer->fetch()['ds_tipo_usuario'];

                        echo $ds_tipo_usuario; 
                    
                    ?></p>
                </div><!--.nome-usuario-->
            </div><!--.box-usuario-->

            <div class="menu-items">
                
                <h2>Listagem por Consultor</h2>              
                <ul>
                    <li <?php menuSeleccionado('lista_consultores'); ?> class="waves-effect waves-light"><a href="<?php echo INCLUDE_PATH_PERFOMANCE ?>lista_consultores"><i class="fa fa-list"></i> Lista de Consultores</a></li>
                </ul>
                
                <h2>Listagem por Cliente</h2>              
                <ul>
                    <li <?php menuSeleccionado('lista_clientes'); ?> class="waves-effect waves-light"><a href="<?php echo INCLUDE_PATH_PERFOMANCE ?>lista_clientes"><i class="fa fa-list"></i> Lista de Clientes</a></li>
                </ul>
                
                <h2>Usuário Logado </h2> 
                <ul>
                    <li><a class="waves-effect waves-light" href="<?php echo INCLUDE_PATH_PERFOMANCE; ?>?logout"><i class="fa fa-unlock-alt" aria-hidden="true"></i> <span>Sair do Sistema</span></a></li>
                </ul>

            </div><!--.menu-items-->
        </div><!--.menu-wrapper-->
    </div><!--.menu-->

   <div class="painel-content">
        <div class="box-painel-content">
            <h2><i class="fa fa-assistive-listening-systems"></i> Sistema de <?php echo NOME_PROJECTO ?> da Agence - Consultoria e Desenvolvimento para Web, Ltda</h2>
        </div>
    
        <?php Painel::pageLoad(); ?>
        
    </div><!--.painel-content-->


    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/menu.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/tabs.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/materialize.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/aos.js"></script>
	<script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/aos-initialize.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/chart.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/barChartConsul.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFOMANCE; ?>js/barChartCostum.js"></script>
    <script>
        $(function(){
            $("#move-to-right-arrow").on("click",function(){
                var el = $("#select-box option:selected").clone(true);
                el.appendTo("#selected-option-box");
                $("#select-box option:selected").remove();
            });
            $("#move-to-left-arrow").on("click",function(){
                var el = $("#selected-option-box option:selected").clone(true);
                el.appendTo("#select-box");
                $("#selected-option-box option:selected").remove();
            });

            $('[format=date]').mask('99/99/9999', {placeholder: 'dd/mm/aaaa'});
        });
        
        /*
            var form_contact = $('form#period');
            form_contact.find('input[type=submit]').click(function(e){
                e.preventDefault();
            })*/

    </script>
    
</body>
</html>