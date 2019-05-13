<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Objective;
use App\ObjectiveForPlan;
use App\Plan;
use App\Student;
use App\LogTeam;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;
use Response;
use Validator;

class LogTeamsController extends Controller
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
     * Show the log for a objective.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecord($id)
    {
        $record = LogTeam::where('objective',$id)->get();

        return Response::json($record);
    }

    /**
     * Add a new log for plan activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addLog(Request $request)
    {
        $username = \Auth::user()->fname;
        $user = \Auth::user()->email;

        switch($request->type) {
          case 0:
            $activity = $username." redactó el objetivo";
            break;
          case 1:
            $activity = $username." agregó este objetivo a su plan de ".$request->month;
          break;
          case 2:
            $activity = $username." registró los resultados para este objetivo";
          break;
          case 3:
            $activity = $username." editó la información de este objetivo";
          break;
          case 4:
            $activity = $username." revisó e hizo observaciones para este objetivo";
          break;
          case 5:
            $activity = $username." hizo las correcciones indicadas por el supervisor";
          break;
          case 6:
            $activity = $username." desasignó este objetivo de su plan de ".$request->month;
          break;
          default:
            $activity = "";
        }

        $rules = array(
            'type' => 'required',
            'description' => 'required',
            'objective' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $log = new LogTeam;
            $log->type = $request->type;
            $log->activity = $activity;
            $log->description = $request->description;
            $log->user = $user;
            $log->objective = $request->objective;
            $log->save();

            return Response::json( $log );
        }
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
