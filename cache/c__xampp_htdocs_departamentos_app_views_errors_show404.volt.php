<?= $this->getContent() ?>
<div class="jumbotron">
    <h1>Página NO Encontrada</h1>
    <p>La página que intenta acceder ha sido eliminada o movida del sitio</p>
    <p><?= $this->tag->linkTo(['usuarios', 'Regresar', 'class' => 'btn btn-primary']) ?></p>
</div>