<?php

use DAO\Area;
use DAO\Gravidade;
use DAO\Melhoria;
use DAO\Tendencia;
use DAO\Urgencia;

$id = $_GET['id'];
$melhoria = Melhoria::getInstance()->filtrarPorId($id);
$areas = Area::getInstance()->order('descricao')->getAll();
$urgencias = Urgencia::getInstance()->order('descricao')->getAll();
$gravidades = Gravidade::getInstance()->order('descricao')->getAll();
$tendencias = Tendencia::getInstance()->order('descricao')->getAll();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 m-3">
            <a href="?path=tarefas" class="btn btn-success btn-block mb-3">Voltar</a>
        </div>
        <div class="col-md-12">
            <h2>Editar Tarefa</h2>
        </div>
    </div>

    <form action="?path=tarefas-editar-post" method="post" name="formulario">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome">Nome da Tarefa</label>
                <input type="hidden" name="id" value="<?php echo $melhoria->id ?>">
                <input name="descricao" id="descricao" type="text"
                       value="<?php echo $melhoria->descricao ? $melhoria->descricao : '' ?>" class="form-control"
                       placeholder="Nome da tarefa">
            </div>
            <div class="form-group col-md-4">
                <label for="area">Área</label>
                <select id="area" name="area" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?php echo $area->id ?>" <?php echo $melhoria->area == $area->id ? 'selected' : '' ?>> <?php echo $area->descricao ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="prazo_acordado">Prazo Acordado</label>
                <input name="prazo_acordado" id="prazo_acordado"
                       value="<?php echo $melhoria->prazo_acordado ? date('d/m/Y', strtotime($melhoria->prazo_acordado)) : '' ?>"
                       type="text" class="add-datepicker  form-control" placeholder="Selecione a data">
            </div>
            <div class="form-group col-md-4">
                <label for="prazo_legal">Prazo Legal</label>
                <input name="prazo_legal" id="prazo_legal"
                       value="<?php echo $melhoria->prazo_legal ? date('d/m/Y', strtotime($melhoria->prazo_legal)) : '' ?>"
                       type="text" class="add-datepicker form-control" placeholder="Selecione a data">
            </div>
            <div class="form-group col-md-4">
                <label for="gravidade">Gravidade</label>
                <select id="gravidade" name="gravidade" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($gravidades as $gravidade): ?>
                        <option value="<?php echo $gravidade->id ?>" <?php echo $melhoria->gravidade == $gravidade->id ? 'selected' : '' ?>> <?php echo $gravidade->descricao ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="urgencia">Urgência</label>
                <select id="urgencia" name="urgencia" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($urgencias as $urgencia): ?>
                        <option value="<?php echo $urgencia->id ?>" <?php echo $melhoria->urgencia == $urgencia->id ? 'selected' : '' ?>> <?php echo $urgencia->descricao ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="tendencia">Tendência</label>
                <select id="tendencia" name="tendencia" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($tendencias as $tendencia): ?>
                        <option value="<?php echo $tendencia->id ?>" <?php echo $melhoria->tendencia == $tendencia->id ? 'selected' : '' ?>> <?php echo $tendencia->descricao ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <fieldset class="form-group col-md-4">
                <div class="row">
                    <legend class="col-form-label col-md-12 pt-0">Demanda Legal</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="demanda_legal" id="demanda_legal"
                                   value="true" <?php echo $melhoria->demanda_legal == true ? 'checked' : '' ?>>
                            <label class="form-check-label" for="demanda_legal">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="demanda_legal" id="demanda_legal"
                                   value="false" <?php echo $melhoria->demanda_legal == false ? 'checked' : '' ?>>
                            <label class="form-check-label" for="demanda_legal">
                                Não
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <input type="button" class="btn btn-success btn-info" onclick="validar()" value="Salvar">
    </form>
</div>

