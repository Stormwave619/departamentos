{{ content() }}
<div class="page-header">
	<h3>Administración de Usuarios</h3>
</div>
{{ form('login/authorize', 'role': 'form') }}
	<fieldset>
		<div class="form-group">
			<label for="username">Nombre de Usuario:</label>
			<div class="controls">
				{{ text_field('username', 'class': "form-control") }}
			</div>
		</div>
		<div class="form-group">
			<label for="password">Contraseña:</label>
			<div class="controls">
				{{ password_field('password', 'class': "form-control") }}
			</div>
		</div>
		<div class="form-group">
			{{ submit_button('Ingresar', 'class': 'btn btn-primary btn-large') }}
		</div>
	</fieldset>
{{  endform() }}