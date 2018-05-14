<?= $this->getContent() ?>
<div class="page-header">
	<h3>Administración de Usuarios</h3>
</div>
<?= $this->tag->form(['login/authorize', 'role' => 'form']) ?>
	<fieldset>
		<div class="form-group">
			<label for="username">Nombre de Usuario:</label>
			<div class="controls">
				<?= $this->tag->textField(['username', 'class' => 'form-control']) ?>
			</div>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<div class="controls">
				<?= $this->tag->passwordField(['password', 'class' => 'form-control']) ?>
			</div>
		</div>
		<div class="form-group">
			<?= $this->tag->submitButton(['Ingresar', 'class' => 'btn btn-primary btn-large']) ?>
		</div>
	</fieldset>
<?= $this->tag->endform() ?>