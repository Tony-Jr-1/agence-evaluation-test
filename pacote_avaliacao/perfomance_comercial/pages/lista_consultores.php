<?php
   $sql = MySql::conectar()->prepare("SELECT * FROM `cao_usuario` INNER JOIN `permissao_sistema` ON `cao_usuario`.`co_usuario` = `permissao_sistema`.`co_usuario` WHERE `co_sistema` = '1' AND `in_ativo` = 'S' AND (`co_tipo_usuario` = '0' OR `co_tipo_usuario` = '1' OR `co_tipo_usuario` = '2') ORDER BY `no_usuario` ASC");
   $sql->execute();
   $consultores = $sql->fetchAll();
   $nrConsultores = $sql->rowCount();
?>

<div class="box-painel-content" data-aos="//fade-in" data-aos-duration="//1000">
    <h2><i class="fa fa-list-alt"></i> Lista de Consultores</h2>
    
    <div class="period">
        <p>Período:</p>
        <form method="post" id="period">
            <input format=date type="text" name="dataInicial" required>
            <p>a</p>
            <input format=date type="text" name="dataFinal" required>
            <input type="submit" name="buscar" value="Buscar">
        </form>
    </div><!--.period-->

    <div class="selection-boxs w100">
        <div class="select-box">
            <?php
                //echo $nrConsultores;
            ?>
            <select multiple="multiple" size="10" name="select-box" id="select-box">
                <?php 
                    foreach ($consultores as $key => $value) {
                ?>
                    <option value="<?php echo $value['co_usuario']; ?>"><?php echo $value['no_usuario']; ?></option>
                <?php } ?>
            </select>
        </div><!--.select-box-->

        
        <div class="arrows">
            <div class="move-to-right-arrow waves-effect waves-blue-dark-gray" id="move-to-right-arrow"><p style="font-size: 20px;">>></p></div>
            <div class="move-to-left-arrow waves-effect waves-blue-dark-gray" id="move-to-left-arrow"><p style="font-size: 20px;"><<</p></div>
        </div><!--.arrows-->

        <div class="selected-option-box">
            <select multiple="multiple" size="10" name="selected-option-box" id="selected-option-box">
                                
            </select>
        </div><!--.selected-option-box-->
    </div><!--.selection-boxs-->

    <div class="tab-container">
        <div class="tab-painel">
            <div class="wrapper-table">
                <h3>Relatório:</h3>
                <table>
                    <tr>
                        <td>Nome do Consultor</td>
                        <td>Período de Faturação</td>
                        <td>Receita Líquida</td>
                        <td>Custo Fixo</td>
                        <td>Comissão</td>
                        <td>Lucro</td>
                    </tr>

                    <?php
                    foreach ($consultores as $key => $value) {

                        if(isset($_POST['buscar'])){
                            $dataInicial = implode("-",array_reverse(explode("/",$_POST['dataInicial'])));
                            $dataFinal = implode("-",array_reverse(explode("/",$_POST['dataFinal'])));
                            
                            if($dataInicial == '' || $dataFinal == ''){
                                Painel::alert('erro','Por favor, preencha o período a Buscar!'); 
                                $consultor = '';
                                break;
                            }else{
                                $sql = MySql::conectar()->prepare("SELECT * FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_usuario` = ? AND (`data_emissao` BETWEEN ? AND ?) GROUP BY co_usuario");
                                $sql->execute(array($value['co_usuario'], $dataInicial, $dataFinal));
                                if($sql->rowCount() == 0){
                                    continue;
                                }else{
                                    $consultor = $sql->fetchAll();

                                    // $faturas = MySql::conectar()->prepare("SELECT COUNT(*) AS total_faturas FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_usuario` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    // $faturas->execute(array($value['co_usuario'], $dataInicial, $dataFinal));
                                    // $total_faturas = $faturas->fetch();
                                    //--------------------------------------- Cálculo da Receita Líquida -------------------------------------------------
                                    $valor = MySql::conectar()->prepare("SELECT SUM(valor) AS soma_faturas FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_usuario` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    $valor->execute(array($value['co_usuario'], $dataInicial, $dataFinal));
                                    $valor = $valor->fetch();

                                    $impostos = MySql::conectar()->prepare("SELECT SUM(total_imp_inc) AS total_impostos FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_usuario` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    $impostos->execute(array($value['co_usuario'], $dataInicial, $dataFinal));
                                    $impostos = $impostos->fetch();
                                
                                    $receita_liquida = $valor['soma_faturas'] - $impostos['total_impostos'];

                                    
                                    //--------------------------------------- Cálculo do Custo Fixo --------------------------------------------------------
                                    $custo_fixo = MySql::conectar()->prepare("SELECT brut_salario FROM `cao_salario` WHERE `co_usuario` = ? ");
                                    $custo_fixo->execute(array($value['co_usuario']));
                                    $custo_fixo = $custo_fixo->fetch()['brut_salario'];


                                    //--------------------------------------- Cálculo da Comissão ----------------------------------------------------------
                                    $valor_comissao = MySql::conectar()->prepare("SELECT comissao_cn FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_usuario` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    $valor_comissao->execute(array($value['co_usuario'], $dataInicial, $dataFinal));
                                    $valor_comissao = $valor_comissao->fetch()['comissao_cn'];

                                    $comissao = (($valor['soma_faturas'] - ($valor['soma_faturas'] * $impostos['total_impostos'])) * $valor_comissao);
                                    if($comissao < 0)
                                        $comissao = 0;

                                        
                                //--------------------------------------- Cálculo do Lucro -----------------------------------------------------------------
                                    $lucro = $receita_liquida - ($custo_fixo + $comissao);
                                    if($lucro < 0)
                                        $lucro = 0;
                                }
                            }
                        }else{
                            $consultor = '';
                        }    
                            
                        if($consultor !== '')
                            foreach ($consultor as $chave => $fatura){
                    ?>        
                            <tr>
                                <td><?php echo $value['no_usuario']; ?></td>
                                <td><?php echo implode("/",array_reverse(explode("-",$dataInicial))).' a '.implode("/",array_reverse(explode("-",$dataFinal))); ?></td>
                                <td><?php echo $receita_liquida; ?></td>
                                <td><?php echo $custo_fixo; ?></td>
                                <td><?php echo $comissao; ?></td>
                                <td><?php echo $lucro; ?></td>
                            </tr>

                        <?php } ?>
                    <?php } ?>
                </table>
            </div><!--.wrapper-table-->
        </div><!--tabPainel-->


        <div class="tab-painel">         
            <div class="wrapper-table">
                <h3>Gráfico:</h3>
                <div class="grafico-desempenho-consultor">
                    <canvas id="desempenho-consultor" width="400" height="400"></canvas>
                </div>
            </div><!--.wrapper-table-->    
        </div><!--tabPainel-->
        
        
        
        <div class="tab-painel">
            <div class="wrapper-table">
                <h3>Pizza:</h3>
                <div class="grafico-desempenho-consultor">
                    <canvas id="receita-liquida-consultor" width="400" height="400"></canvas>
                </div>
            </div><!--.wrapper-table-->        
        </div>
        <div class="clear"></div>
        
        <div class="button-tab-container">
            <button onclick="showPanel(0,'#4596b4')" class="waves-effect waves-light"><i class="fa fa-file-archive-o"></i> Relatório</button>
            <button onclick="showPanel(1,'#4596b4')" class="waves-effect waves-light"><i class="fa fa-bar-chart"></i> Gráfico</button>
            <button onclick="showPanel(2,'#4596b4')" class="waves-effect waves-light"><i class="fa fa-pie-chart"></i> Pizza</button>
        </div>
    </div><!--.tab-container-->

</div><!--.box-painel-content-->

