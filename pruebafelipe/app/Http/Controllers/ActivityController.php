<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Log;
use App\Project;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use App\Workplan;
use App\Activity;
use DB;
use Auth;
use Session;
use Redirect;
use Response;
use Validator;


class ActivityController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addActivity(Request $request)
    {
        $responsable = Student::where('email', \Auth::user()->email)->first();
        $act_str = $request->activity;
        $ref = Session::get('project')->id.''.Session::get('project')->team;

        if(strlen($act_str)>150)
          $act_str = substr($act_str,0,150).'...';

        $description = $responsable->name.' agregó la actividad: '.$act_str.' RF:'.$ref;

        $log = [
            'desc'=>$description,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $rules = array(
            'activity' => 'required',
            'startdate' => 'required',
            'deadline' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $activity = new Activity;
            $activity->activity = $request->activity;
            $activity->startdate = $request->startdate;
            $activity->deadline = $request->deadline;
            $activity->workplan = Session::get('wp')->id;
            $activity->save();

            return Response::json( $activity );
        }

    }

    public function addActivityFromProject(Request $request)
    {
        $responsable = Student::where('email', \Auth::user()->email)->first();
        $act_str = $request->activity;
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        if(strlen($act_str)>150)
          $act_str = substr($act_str,0,150).'...';

        $description = $responsable->name.' agregó la actividad: '.$act_str.' RF:'.$ref;

        $log = [
            'desc'=>$description,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $rules = array(
            'activity' => 'required',
            'startdate' => 'required',
            'deadline' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $activity = new Activity;
            $activity->activity = $request->activity;
            $activity->startdate = $request->startdate;
            $activity->deadline = $request->deadline;
            $activity->workplan = $request->workplan;
            $activity->save();

            return Response::json( $activity );
        }

    }

    public function editItem(Request $req)
    {
        $act = substr($req->activity,0,150).'...';
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        $log = [
            'desc'=>Auth::user()->fname.' modificó la información de la actividad: '.$act.' RF:'.$ref,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $activity = Activity::find($req->id);
        $activity->activity = $req->activity;
        $activity->startdate = $req->startdate;
        $activity->deadline = $req->deadline;
        $activity->save();

        return Response::json($activity);
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req){
        $act = substr($req->activity,0,150).'...';
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        $log = [
            'desc'=>Auth::user()->fname.' eliminó la actividad: '.$act.' RF:'.$ref,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        Activity::find($req->id)->delete();
        return response()->json();
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
