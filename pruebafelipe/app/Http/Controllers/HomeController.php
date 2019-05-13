<?php namespace App\Http\Controllers;

use App\Student;
use App\Status;
use Session;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	 /**
	  * Create a new controller instance.
	  *
	  * @return void
	  */
	 public function __construct()
	 {
	 	$this->middleware('auth');
		//$this->user =  \Auth::user();
	 }



	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
 		$student = null;

            if(\Auth::user()->rol=="Estudiante"){


            	$studentinfo = Student::where('email', \Auth::user()->email)
             			                ->first();
        		if($studentinfo ==null){
        			$student = null;
        		}
        		else{
        			$student = Student::where('email', \Auth::user()->email)->first();
        		}

            }

            return view("home",compact('student'));

		
	}

}
