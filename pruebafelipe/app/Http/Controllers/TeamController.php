<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Financing;
use App\Departament;
use App\Municipality;
use App\Team;
use App\Supervisor;
use App\Log;

use Auth;
use DB;
use Session;
use Redirect;
use Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->rol == "Supervisor") {
            $usuario = Auth::user()->id;
            $supervisor = Supervisor::where('iduser','=',$usuario)->get()->first();
            $teams = DB::table('teams')
                        ->join('financings','teams.financing','=','financings.id_financings')
                        ->join('municipality','teams.municipality','=','municipality.id_municipality')
                        ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                        ->where('teams.supervisor','=',$supervisor->id_supervisors)
                        ->select('teams.id_team','teams.name','financings.name as financing','municipality.municipality','supervisors.name as supervisor')
                        ->get();
        return view('team.index',compact('teams'));
            # code...
        }
        else{
            $teams = DB::table('teams')
                        ->join('financings','teams.financing','=','financings.id_financings')
                        ->join('municipality','teams.municipality','=','municipality.id_municipality')
                        ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                        ->select('teams.id_team','teams.name','financings.name as financing','municipality.municipality','supervisors.name as supervisor')
                        ->get();
        return view('team.index',compact('teams'));

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $financing =  Financing::lists('name','id_financings');
        $departaments =  Departament::lists('departament','id_departament');
        $municipality = Municipality::lists('municipality','id_municipality');
        $supervisor = Supervisor::lists('name','id_supervisors');
        return view('team.create',['financing'=>$financing,'departaments'=>$departaments,'supervisor'=>$supervisor,'municipality'=>$municipality]);
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
        $log = [
            'desc'=>'Creación de Equipo :'.$request['name'],
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Team::create([
            'name'=>$request['name'],
            'financing'=>$request['financing'],
            'municipality'=>$request['municipality'],
            'supervisor'=>$request['supervisor'],
            'status'=>1,
            ]);
        Session::flash('message','Equipo creado exitosamente');
        return Redirect::to('/teams');
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

        $team = Team::find($id);

        $log = [
            'desc'=>'Edición de Equipo :'.$team['name'],
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        $financing =  Financing::lists('name','id_financings');
        $departaments =  Departament::lists('departament','id_departament');
        $municipality = Municipality::lists('municipality','id_municipality');
        $supervisor = Supervisor::lists('name','id_supervisors');
        $departamentselect = Municipality::find($team->municipality);
        return view('team.edit',['team'=>$team,'financing'=>$financing,'departaments'=>$departaments,'supervisor'=>$supervisor,'municipality'=>$municipality,'departamentselect'=>$departamentselect->id_departament]);

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
        $team = Team::find($id);
        $all = $request->all();
        $all['status'] = ($request->get('status') === 'on');
        $team->fill($all);
        $team->save();

        Session::flash('message','Equipo Actualizado exitosamente');
        return Redirect::to('/teams');
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


    // FOR STATS

    public function getStats(){

      $cohorts = DB::table('cohortes')
              ->select('cohortes.id as id','cohortes.name as cohort')
              ->orderBy('id','asc')
              ->groupBy('cohortes.name')->get();

      $departments = DB::table('departament')
              ->select('departament.id_departament as id','departament.departament as department')
              ->orderBy('departament.departament','asc')
              ->get();

      $teams = DB::table('teams')
              ->select('teams.id_team as id','teams.name as team')
              ->orderBy('teams.name','asc')
              ->get();

      $total_teams = Team::count();
      $total_members = DB::table('students')->count();
      $total_pjs = DB::table('projects')->count();
      $total_budget = DB::table('projects')->sum('budget');

      $total_members_2c2107 = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('cohortes.name','2 Cohorte 2017')
              ->count();

      $total_members_1c2108 = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('cohortes.name','1 Cohorte 2018')
              ->count();

      $total_members_2c2108 = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('cohortes.name','2 Cohorte 2018')
              ->count();

      $total_budgets = DB::table('projects')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $teams_by_cohort = DB::table('students')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->join('municipality','teams.municipality','=','municipality.id_municipality')
              ->join('departament','municipality.id_departament','=','departament.id_departament')
              ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('teams.id_team as tid','teams.name as team','departament.departament as dep','municipality.municipality as mun','supervisors.name as sup','cohortes.name as cohort',DB::raw("count(students.id_student) as members,(select sum(projects.budget) from projects where projects.team = tid and projects.cohort = cohort) as contrib"))
              ->orderBy('team','asc')
              ->groupBy('team')
              ->get();

        $teams_b_c = DB::table('students')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->select('teams.id_team as tid','teams.name as team',DB::raw("(select count(students.id_student) from students,headquarters,cohortes where students.headquarter = headquarters.id_headquarters and headquarters.team = tid and students.cohorte = cohortes.id and cohortes.name = '2 Cohorte 2017') as members2c2017,(select count(students.id_student) from students,headquarters,cohortes where students.headquarter = headquarters.id_headquarters and headquarters.team = tid and students.cohorte = cohortes.id and cohortes.name = '1 Cohorte 2018') as members1c2018,(select sum(projects.budget) from projects where projects.team = tid and projects.cohort = '1 Cohorte 2018') as contrib1c2018,(select count(students.id_student) from students,headquarters,cohortes where students.headquarter = headquarters.id_headquarters and headquarters.team = tid and students.cohorte = cohortes.id and cohortes.name = '2 Cohorte 2018') as members2c2018,(select sum(projects.budget) from projects where projects.team = tid and projects.cohort = '2 Cohorte 2017') as contrib2c2017,(select sum(projects.budget) from projects where projects.team = tid and projects.cohort = '2 Cohorte 2018') as contrib2c2018"))
              ->orderBy('team','asc')
              ->groupBy('team')
              ->get();

      return view('stats.teams', compact('cohorts','total_teams','departments','teams','total_members','total_pjs','total_budget','teams_by_cohort','teams_b_c','total_members_2c2107','total_members_1c2108','total_members_2c2108','total_budgets'));
    }

    public function findTeamsByCohort($cohort){
      $tbc = DB::table('students')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->join('municipality','teams.municipality','=','municipality.id_municipality')
              ->join('departament','municipality.id_departament','=','departament.id_departament')
              ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
              ->select('teams.id_team as tid','teams.name as team','departament.departament as dep','municipality.municipality as mun','supervisors.name as sup',DB::raw("count(students.id_student) as members,(select sum(projects.budget) from projects,cohortes where projects.team = tid and projects.cohort = cohortes.name) as contrib"))
              ->orderBy('team','asc')
              ->groupBy('team')
              ->get();

      return Response::json($tbc);
    }

    public function chartTeamGeneral(){
      $general = DB::table('students')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('teams.id_team as tid','teams.name as team','cohortes.name as cohort',DB::raw("count(students.id_student) as members"))
              ->orderBy('members','desc')
              ->groupBy('team')
              ->take(15)
              ->get();

      $data = array();
      foreach ($general as $row) {
        $data[] = $row;
      }

      return Response::json($data);

    }
}
