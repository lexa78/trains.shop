<?php namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\ContactPage;
use App\Models\MainPage;
use App\Models\ProviderPage;
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
        $main = MainPage::find(1);
        if( ! $main) {
            abort(404);
        }
        return view('static.welcome', ['p'=>'main', 'text'=>$main->text,
                'l_p_text'=>$main->l_p_text, 'r_p_text'=>$main->r_p_text]);
	}

	public function about()
    {
        $about = AboutPage::find(1);
        if( ! $about) {
            abort(404);
        }
        return view('static.about', ['p'=>'about', 'text'=>$about->text]);
    }

	public function info()
    {
        $info = ProviderPage::find(1);
        if( ! $info) {
            abort(404);
        }
        return view('static.info', ['p'=>'info', 'text'=>$info->text]);
    }

	public function contacts()
    {
		$contacts = ContactPage::find(1);
        if( ! $contacts) {
            abort(404);
        }
        return view('static.contacts', ['p'=>'contacts', 'text'=>$contacts->text]);
    }

}
