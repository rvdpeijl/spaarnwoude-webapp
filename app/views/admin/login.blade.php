<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>

	@if(Session::has('message'))
	    <p class="alert">{{ Session::get('message') }}</p>
	@endif


	{{ Form::open(array('url' => '/login', 'class' => 'box login')); }}
		<fieldset class="boxBody">
			<label>Username</label>
				<input type="text" tabindex="1" name="username" required>
			<label>
				<a href="#" class="rLink" tabindex="5">Forgot your password?</a>Password
			</label>
		  	<input type="password" name="password" tabindex="2" required>
		</fieldset>
		<footer>
			<label><input type="checkbox" name="persist" tabindex="3">Remember me</label>
			<input type="submit" class="btnLogin" value="Login" tabindex="4">
		</footer>
	</form>
	{{ Form::close() }}
</body>
</html>