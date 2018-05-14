<?= $this->getContent() ?>
<div class="jumbotron">
    <h1>Usuario NO Autorizado</h1>
    <p>Su usuario no cuenta con los permisos suficiente para realizar esta operación</p>
    <p><?= $this->tag->linkTo(['usuarios', 'Regresar', 'class' => 'btn btn-primary']) ?></p>
</div>