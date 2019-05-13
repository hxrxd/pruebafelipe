<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Project;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use App\Workplan;
use App\Log;
use DB;
use Auth;
use Session;
use Redirect;
use Response;
use Validator;

class WorkplanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.workplan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Workplan::create([
          'objective_what'=>$request['objective_what'],
          'objective_what_for'=>$request['objective_what_for'],
          'amount'=>$request['amount'],
          'goal'=>$request['goal'],
          'quality'=>$request['quality'],
          'project'=>$request['project'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addWorkplan(Request $request)
    {
        $rules = array(
            'objective_what'       => 'required',
            'objective_what_for'               => 'required',
            'amount'               => 'required',
            'goal'               => 'required',
            'project' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $wp = new Workplan;
            $wp->objective_what = $request->objective_what;
            $wp->objective_what_for = $request->objective_what_for;
            $wp->amount = $request->amount;
            $wp->goal = $request->goal;
            $wp->project = $request->project;
            $wp->save();

            Session::put('wp', $wp);

            return Response::json( $wp );
        }

    }

    public function editObjective(Request $req)
    {
        $obj = substr($req->objective_what,0,150).'...';
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        $log = [
            'desc'=>Auth::user()->fname.' modificó la información del objetivo: '.$obj.' RF:'.$ref,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $wp = Workplan::find($req->id);
        $wp->objective_what = $req->objective_what;
        $wp->objective_what_for = $req->objective_what_for;
        $wp->amount = $req->amount;
        $wp->goal = $req->goal;
        $wp->save();

        return Response::json($wp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
