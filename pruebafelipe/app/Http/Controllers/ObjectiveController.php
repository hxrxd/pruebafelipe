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
use App\Headquarters;
use App\Municipality;
use App\Team;
use App\Cohorte;
use DB;
use Redirect;
use Response;
use Validator;

class ObjectiveController extends Controller
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
     * Returns a list of objectives for a plan.
     *
     * @param  int $plan_id
     * @return \Illuminate\Http\Response
     */
    public function listObjectives($plan_id)
    {
        //$objectives = Objective::where('plan',$plan_id)->get();
        $objectives = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$plan_id)
                  ->select('objectives.*')
                  ->get();

        return Response::json($objectives);
    }

    /**
     * Returns a list of objectives for a plan.
     *
     * @param  int $plan_id
     * @return \Illuminate\Http\Response
     */
    public function listSharedObjectives($plan_id)
    {
        $plan = Plan::find($plan_id);
        $student = Student::find($plan->student);
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);

        $objectives = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$plan_id)
                  ->select('objectives.*')
                  ->get();

        $ids_obj = [];
        foreach ($objectives as $obj) {
          array_push($ids_obj,$obj->id);
        }

        $shared_objectives = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->join('teams','plan.team','=','teams.id_team')
                  ->where('plan.team',$team->id_team)
                  ->where('plan.cohort',$cohort->name)
                  ->where('objectives.isGroup',1)
                  ->whereNotIn('objectives.id',$ids_obj)
                  ->select('objectives.*','plan.month as month')
                  ->groupBy('id')
                  ->orderBy('created_at','desc')
                  ->get();

        return Response::json($shared_objectives);
    }

    /**
     * Returns a list of objectives for a plan.
     *
     * @param  int $plan_id
     * @return \Illuminate\Http\Response
     */
    public function listFollowedObjectives($plan_id)
    {
        $plan = Plan::find($plan_id);
        $student = Student::find($plan->student);
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);

        $objectives_current_plan = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$plan_id)
                  ->select('objectives.*')
                  ->get();

        $ids_obj = [];
        foreach ($objectives_current_plan as $obj) {
          array_push($ids_obj,$obj->id);
        }

        $objectives = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.student',$student->id_student)
                  ->where('plan.id','!=',$plan_id)
                  ->whereNotIn('objectives.id',$ids_obj)
                  ->where('objectives.isGroup',0)
                  ->select('objectives.*','plan.month as month')
                  ->groupBy('id')
                  ->orderBy('created_at','desc')
                  ->get();

        return Response::json($objectives);
    }

    /**
     * Returns an objective by id.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getObjective($id)
    {
        $objective = Objective::find($id);

        return Response::json($objective);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addObjective(Request $request)
    {
        $rules = array(
            'objective' => 'required',
            'activities' => 'required',
            'isGroup' => 'required',
            'student' => 'required',
            //'plan' => 'required',
            'user_create' => 'required',
            'user_update' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $o = new Objective;
            $o->objective = $request->objective;
            $o->activities = $request->activities;
            $o->isGroup = $request->isGroup;
            $o->student = $request->student;
            //$o->plan = $request->plan;
            $o->user_create = $request->user_create;
            $o->user_update = $request->user_update;
            $o->save();

            return Response::json( $o );
        }
    }

    /**
     * Assign a objective to plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addObjectiveToPlan(Request $request)
    {
        $rules = array(
            'plan' => 'required',
            'objective' => 'required',
            'user_create' => 'required',
            'user_update' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $plan_objective = new ObjectiveForPlan;
            $plan_objective->plan = $request->plan;
            $plan_objective->objective = $request->objective;
            $plan_objective->user_create = $request->user_create;
            $plan_objective->user_update = $request->user_update;
            $plan_objective->save();

            return Response::json( $plan_objective );
        }
    }

    /**
     * Update correction for objective.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addObjectiveCorrection(Request $request)
    {
        $objective = Objective::find($request->id);
        $objective->objective_corrections = $request->corrections;
        $objective->updated_at = date('Y-m-d H:i:s');
        $objective->save();

        return Response::json($objective);
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
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req){
        Objective::find($req->id)->delete();
        return response()->json();
    }

    /**
     * Unassign the specified objective from the plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unassignObjective(Request $req){
        ObjectiveForPlan::where('plan',$req->plan)->where('objective',$req->objective)->delete();
        return response()->json();
    }


    /**
     * Returns the count of objectives finished for a plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finishedObjectivesCount($id){
        //$finished_count = Objective::where('plan',$id)->where('results','!=','')->count();
        $finished_count = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$id)
                  ->where('results','!=','')
                  ->select('objectives.*')
                  ->count();

        return Response::json($finished_count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $o = Objective::find($request->id);
        $o->objective = $request->objective;
        $o->activities = $request->activities;
        $o->results = $request->results;
        $o->results_ids = $request->results_ids;
        $o->hits = $request->hits;
        $o->failures = $request->failures;
        $o->isGroup = $request->isGroup;
        $o->student = $request->student;
        //$o->plan = $request->plan;
        //$o->user_create = $request->user_create;
        $o->user_update = $request->user_update;
        $o->save();

        return Response::json( $o );
    }

    /**
     * Update the results of specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateResults(Request $request)
    {
        $o = Objective::find($request->id);
        $o->results = $request->results;
        $o->user_update = $request->user_update;
        $o->save();

        return Response::json( $o );
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
