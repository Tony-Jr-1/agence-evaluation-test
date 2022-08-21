<?php

    class Painel 
    {
        //Atributo estático/static
        public static $tipo_usuario = [
            '0' => 'Administracao',
            '1' => 'Consulta',
            '2' => 'Apoio'
        ];

        public static function logado(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function logout(){
            setcookie('remember',true,time()-1,'/');
            session_destroy();
            header('Location: '.INCLUDE_PATH_PERFOMANCE);
        }
        
        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        public static function pageLoad(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    Painel::redirect(INCLUDE_PATH_PERFOMANCE);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function alert($tipo,$mensagem) {
            if($tipo == 'sucesso'){
                echo '<div class="alert-box sucesso" data-aos="fade-in" data-aos-duration="1500"><i class="fa fa-check-circle" style="font-size: 19px; color: #226435;"></i> '.$mensagem.'</div>';
            }else if($tipo == 'erro'){
                echo '<div class="alert-box erro" data-aos="fade-in" data-aos-duration="1500"><i class="fa fa-times-circle" style="font-size: 19px; color: #8b302f;"></i> '.$mensagem.'</div>';
            }else if($tipo =='erroSemAos'){
                echo '<div class="alert-box erro"><i class="fa fa-times-circle" style="font-size: 19px; color: #8b302f;"></i> '.$mensagem.'</div>';
            }
        }

    }

?>