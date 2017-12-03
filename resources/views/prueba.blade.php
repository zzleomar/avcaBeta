<!DOCTYPE html>
<html>
<head>
	<title>afasd</title>
</head>
<body>
	<form action="/p" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
		
		<h1>SUCURSAL</h1>
		<div class="form-group">
			<label  class="">Nombre</label>
            
				<input type="text" name="nombre" class="form-control" placeholder="Nombre completo" value="" required>
			</div>

		<div class="form-group">
			<label  class="">Dirección</label>
            
				<textarea name="direccions" class="form-control" placeholder="sfds" value="" required></textarea>
			</div>
		<h1>PERSONAL</h1>
			<div class="form-group">
			<label  class="">Nombre</label>
            
				<input type="text" name="nombres" class="form-control" placeholder="Nombre completo" value="" required>
			</div>
			<div class="form-group">
			<label  class="">Apellidos</label>
            
				<input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="" required>
			</div>
			<div class="form-group">
			<label  class="">Cédula</label>
            
				<input type="text" name="cedula" class="form-control" placeholder="CI" value="" required>
			</div>
			<div class="form-group">
			<label  class="">Tlf Movil</label>
            
				<input type="text" name="tlf_movil" class="form-control" placeholder="" value="" required>
			</div>
			<div class="form-group">
			<label  class="">Tlf Casa</label>
            
				<input type="text" name="tlf_casa" class="form-control" placeholder="" value="" required>
			</div>

		<div class="form-group">
			<label  class="">Dirección</label>
            
				<textarea name="direccion" class="form-control" placeholder="sfds" value="" required></textarea>
			</div>
		<h1>ADMINTRATIVO</h1>

		<div class="form-group">
			<label  class="">Cargo</label>
            
				<input type="text" name="cargo" class="form-control" placeholder="sfds" value="" required>
			</div>
		<h1>USUARIO</h1>

		<div class="form-group">
			<label  class="">Username</label>
            
				<input type="text" name="username" class="form-control" placeholder="sfds" value="" required>
			</div>

		<div class="form-group">
			<label  class="">Tipo</label>
            <select name="tipo">
            	<option value="Gerente General">Gerente General</option>
            	<option value="Gerente de Sucursales">Gerente de Sucursales</option>
            	<option value="Subgerente de Sucursal">Subgerente de Sucursal</option>
            	<option value="Operador">Operador</option>
            </select>
			</div>
		
		<div class="form-group">
			<label  class="">Email</label>
				<textarea name="email" class="form-control" placeholder="sfds" value="" required></textarea>
			</div>
		<div class="form-group">
			<label  class="">Password</label>
				<input name="password" class="form-control" placeholder="sfds" value="" required>
			</div>
		<input type="submit" name="Guardar">
	</form>

</body>
</html>