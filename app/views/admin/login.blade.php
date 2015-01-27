<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="/styles/css/main.css">
</head>
<body class="admin">
<br><br>
	<div class="outer-container">
		@if(Session::has('message'))
		    <p class="alert">{{ Session::get('message') }}</p>
		@endif


		{{ Form::open(array('url' => '/login', 'class' => 'box login')); }}
			<fieldset class="boxBody">
				<label>Gebruikersnaam</label>
					<input type="text" tabindex="1" name="username" required>
				<label>
					Wachtwoord
				</label>
			  	<input type="password" name="password" tabindex="2" required>
			  	<a style="font-size:11px" href="#" class="rLink" tabindex="5">Wacthwoord vergeten?</a>
			</fieldset>
			<footer>
				<!-- <label><input type="checkbox" name="persist" tabindex="3">Remember me</label> -->
				<input type="submit" class="btnLogin" value="Login" tabindex="4">
			</footer>
		</form>
		{{ Form::close() }}
	</div>
</body>
</html>