<?php namespace App\Http\Controllers;

use Auth;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('general');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('static.welcome', ['p'=>'main']);
	}

	public function about()
    {
        return view('static.about', ['p'=>'about']);
    }

	public function info()
    {
        return view('static.info', ['p'=>'info']);
    }

	public function contacts()
    {
        return view('static.contacts', ['p'=>'contacts']);
    }

}
