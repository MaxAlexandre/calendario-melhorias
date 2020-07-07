<?php


use DAO\Area;
use DAO\Gravidade;
use DAO\Melhoria;
use DAO\Tendencia;
use DAO\Urgencia;

$melhorias = Melhoria::getInstance()->order('id')->getAll();


?>

<?php
if (isset($_SESSION["mensagem"])):
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
endif;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Tarefas</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="?path=tarefas-criar" class="btn btn-info btn-block mb-3">Cadastrar Tarefa</a>
        </div>
        <div class="col-md-4">
            <a href="/" class="btn btn-success btn-block mb-3">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Prazo Acordado</th>
                    <th class="text-center">Prazo Legal</th>
                    <th class="text-center">Demanda Legal</th>
                    <th class="text-center">Gravidade</th>
                    <th class="text-center">Urgência</th>
                    <th class="text-center">Tendência</th>
                    <th class="text-center">Área</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($melhorias as $melhoria): ?>
                    <tr>
                        <td class="text-center"><?php echo $melhoria->id ?></td>
                        <td class="text-center"><?php echo $melhoria->descricao ?></td>
                        <td class="text-center"><?php echo $melhoria->prazo_acordado ? date('d/m/Y', strtotime($melhoria->prazo_acordado)) : '' ?></td>
                        <td class="text-center"><?php echo $melhoria->prazo_legal ? date('d/m/Y', strtotime($melhoria->prazo_legal)) : '' ?></td>
                        <td class="text-center"><?php echo $melhoria->demanda_legal ? 'Sim' : 'Não' ?></td>
                        <?php $gravidade = Gravidade::getInstance()->filtrarPorId($melhoria->gravidade) ?>
                        <td class="text-center"><?php echo $gravidade ? $gravidade->descricao : '' ?></td>
                        <?php $urgencia = Urgencia::getInstance()->filtrarPorId($melhoria->urgencia) ?>
                        <td class="text-center"><?php echo $urgencia ? $urgencia->descricao : '' ?></td>
                        <?php $tendencia = Tendencia::getInstance()->filtrarPorId($melhoria->tendencia) ?>
                        <td class="text-center"><?php echo $tendencia ? $tendencia->descricao : '' ?></td>
                        <?php $area = Area::getInstance()->filtrarPorId($melhoria->area) ?>
                        <td class="text-center"><?php echo $area ? $area->descricao : '' ?></td>
                        <td class="text-center">
                            <a href="?path=tarefas-editar&id=<?php echo $melhoria->id ?>"
                               class="btn btn-info">Editar</a>
                            <a href="?path=tarefas-excluir-post&id=<?php echo $melhoria->id ?>"
                               class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

