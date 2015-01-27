<?php 

class AuthController extends \BaseController {
	

	public function getLogin()
	{
		/* Run a authentication check to see if we are already logged in */
	    if (Auth::check())
	    {
	        /* Is this login via a 'Remember Me' method */
	        if (Auth::viaRemember())
	        {
	            /* If yes ,pass a variable to the 'admin' page */
	            return Redirect::to('admin')->with('rememberMe', 1);
	        }
	        else
	        {
	            return Redirect::to('admin');
	        }
	    }
	    else
	    {
	        return View::make('admin.login');
	    }
	}

	public function postLogin()
	{
		/* Get the login form data using the 'Input' class */
	    $userdata = array(
	        'username' => Input::get('username'),
	        'password' => Input::get('password')
	    );

	    /* Try to authenticate the credentials */
	    if(Auth::attempt($userdata, true))
	    {
	        // we are now logged in, go to admin
	        return Redirect::to('admin');
	    }
	    else
	    {
	        return Redirect::to('login');
	    }
	}

	public function logout()
	{
		Auth::logout();
    	return Redirect::to('login');
	}
}