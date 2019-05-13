<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Student;
use App\Plan;
use App\Headquarters;
use App\Municipality;
use App\Departament;
use App\Team;
use App\Objective;
use App\Cohorte;
use App\Supervisor;
use App\SupervisorH;
use App\User;
use App\WorkingPlan;
use App\MatrixPlanning;
use App\MatrixParticipatory;
use DB;
use Auth;
use Session;
use Redirect;
use View;
use Response;
use Validator;

class WorkingPlanController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workspace()
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $username = \Auth::user()->fname.' '.\Auth::user()->lname;
        $squad = DB::table('students')
                  ->join('cohortes','students.cohorte','=','cohortes.id')
                  ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                  ->join('teams','headquarters.team','=','teams.id_team')
                  ->where('teams.id_team','=',$team->id_team)
                  ->where('cohortes.name', $cohort->name)
                  ->select('students.id_student as id','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                  ->orderBy('students.fsurname', 'asc')
                  ->get();

        $working_plan = WorkingPlan::where('team',$team->id_team)->where('cohort',$cohort->name)->first();

        if(is_null($working_plan)){
          $working_plan = WorkingPlan::create([
            'team'=>$team->id_team,
            'cohort'=>$cohort->name,
          ]);
        }else{
          $matrix_planning = MatrixPlanning::where('working_plan',$working_plan->id)->orderBy('index','asc')->get();
          $matrix_participatory = MatrixParticipatory::where('working_plan',$working_plan->id)->get();

          $last_level = MatrixPlanning::where('working_plan',$working_plan->id)->orderBy('index','desc')->first();
          $how_many_components = MatrixPlanning::where('working_plan',$working_plan->id)->where('index',2)->count();
          $how_many_activities = MatrixPlanning::where('working_plan',$working_plan->id)->where('index',3)->count();
        }

        return view("informs.working_plan_create",compact('working_plan','team','cohort','municipality','department','matrix_planning','matrix_participatory','squad','username','last_level','how_many_components','how_many_activities'));
    }

    /**
     * Store a new matrix planning level.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMatrixPlanningLevel(Request $request)
    {
        $rules = array(
            'index' => 'required',
            'level' => 'required',
            'narrative_summary' => 'required',
            'indicators' => 'required',
            'means_of_verification' => 'required',
            'assumptions' => 'required',
            'working_plan' => 'required',
            'user_create' => 'required',
            'user_update' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $level = new MatrixPlanning;
            $level->index = $request->index;
            $level->level = $request->level;
            $level->narrative_summary = $request->narrative_summary;
            $level->indicators = $request->indicators;
            $level->means_of_verification = $request->means_of_verification;
            $level->assumptions = $request->assumptions;
            $level->working_plan = $request->working_plan;
            $level->user_create = $request->user_create;
            $level->user_update = $request->user_update;
            $level->save();

            return Response::json( $level );
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
