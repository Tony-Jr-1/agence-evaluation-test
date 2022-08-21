<?php
   $sql = MySql::conectar()->prepare("SELECT * FROM `cao_cliente` WHERE `tp_cliente` = 'A' ORDER BY co_cliente ASC");
   $sql->execute();
   $clientes = $sql->fetchAll();
?>

<div class="box-painel-content" data-aos="fade-in" data-aos-duration="1000">
    <h2><i class="fa fa-list-alt"></i> Lista de clientes</h2>
    
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
                //echo $consultsNumbers;
            ?>
            <select multiple="multiple" size="10" name="select-box" id="select-box">
                <?php 
                    foreach ($clientes as $key => $value) {
                ?>
                    <option value="<?php echo $value['co_cliente']; ?>"><?php echo $value['no_razao']; ?></option>
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
                        <td style="width: 40%;">Nome do Consutor</td>
                        <td>Período de Faturação</td>
                        <td>Receita Líquida</td>
                    </tr>

                    <?php
                    foreach ($clientes as $key => $value) {

                        if(isset($_POST['buscar'])){
                            $dataInicial = implode("-",array_reverse(explode("/",$_POST['dataInicial'])));
                            $dataFinal = implode("-",array_reverse(explode("/",$_POST['dataFinal'])));
                            
                            if($dataInicial == '' || $dataFinal == ''){
                                Painel::alert('erro','Por favor, preencha o período a Buscar!'); 
                                $cliente = '';
                                break;
                            }else{
                                $sql = MySql::conectar()->prepare("SELECT * FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_cliente` = ? AND (`data_emissao` BETWEEN ? AND ?) GROUP BY co_cliente ");
                                $sql->execute(array($value['co_cliente'], $dataInicial, $dataFinal));
                                if($sql->rowCount() == 0){
                                    continue;
                                }else{
                                    $cliente = $sql->fetchAll();

                                    //--------------------------------------- Cálculo da Receita Líquida -------------------------------------------------
                                    $valor = MySql::conectar()->prepare("SELECT SUM(valor) AS soma_faturas FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_cliente` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    $valor->execute(array($value['co_cliente'], $dataInicial, $dataFinal));
                                    $valor = $valor->fetch();

                                    $impostos = MySql::conectar()->prepare("SELECT SUM(total_imp_inc) AS total_impostos FROM `cao_fatura` INNER JOIN `cao_os` ON `cao_fatura`.`co_os` = `cao_os`.`co_os` WHERE `co_cliente` = ? AND (`data_emissao` BETWEEN ? AND ?)");
                                    $impostos->execute(array($value['co_cliente'], $dataInicial, $dataFinal));
                                    $impostos = $impostos->fetch();
                                
                                    $receita_liquida = $valor['soma_faturas'] - $impostos['total_impostos'];
                                }
                            }
                        }else{
                            $cliente = '';
                        }    
                            
                        if($cliente !== '')
                            foreach ($cliente as $chave => $fatura){
                    ?>        
                            <tr>
                                <td><?php echo $value['no_razao']; ?></td>
                                <td><?php echo implode("/",array_reverse(explode("-",$dataInicial))).' a '.implode("/",array_reverse(explode("-",$dataFinal))); ?></td>
                                <td><?php echo $receita_liquida; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div><!--.wrapper-table-->
        </div><!--tabPainel-->


        <div class="tab-painel">         
            <div class="wrapper-table">
                <h3>Gráfico:</h3>
                <div class="grafico-desempenho-cliente">
                    <canvas id="desempenho-cliente" width="400" height="400"></canvas>
                </div>
            </div><!--.wrapper-table-->    
        </div><!--tabPainel-->
        
        
        
        <div class="tab-painel">
            <div class="wrapper-table">
                <h3>Pizza:</h3>
                <div class="grafico-desempenho-cliente">
                    <canvas id="receita-liquida-cliente" width="400" height="400"></canvas>
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

