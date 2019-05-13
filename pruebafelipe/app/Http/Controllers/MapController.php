<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Team;
use App\Student;
use App\Location;
use App\Headquarters;
use App\Departament;
use App\Cohorte;
use DB;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coordinates = Location::all();
        /*$coordinates = DB::table('locations')
                        ->join('teams', 'locations.team','=', 'teams.id_team')
                        ->select('locations.team', 'locations.longitude', 'locations.latitude')
                        ->get();*/

        $teams = Team::lists('name','id_team');

        $cohorts = Cohorte::lists('cohorte','id');

        $departaments = Departament::orderBy('departament','asc')->lists('departament','id_departament');

        $students = DB::table('students')
                        ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->join('teams','headquarters.team','=','teams.id_team')
                        ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->where('students.status','=',1)
                        ->select('students.id_student','teams.name as team','students.carne','students.academicu','students.carrer','students.name','students.fsurname','students.ssurname','supervisors.name as supervisor')
                        ->get();

        $cohort = "";
        $cohorts_tmp = array();

        foreach($cohorts as $val){
          $cohort = substr($val,0,14);
          $cohorts_tmp[] = $cohort;
        }

        $gcohorts = array_unique($cohorts_tmp);

        $stats_students = DB::table('students')
                  ->join('cohortes','students.cohorte','=','cohortes.id')
                  ->where('students.status','=','1')
                  //->where('cohortes.cohorte','like','%'.substr($cohort,2,14).'%')
                  //->where('cohortes.cohorte','like','%'.substr($gcohorts[2],2,14).'%')
                  ->count();//Student::where('cohorte','like','%'.$current_cohort.'%')->count();

        $stats_teams = Team::count();

        $stats_hqs = Headquarters::count();

        return view('map',compact('coordinates','teams', 'departaments','gcohorts','stats_students','stats_teams', 'stats_hqs', 'cohort'));
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
    public function filterTeams($departament)
    {
        //$departament = Input::get('option');

        /*$items = Team::join('municipality','teams.municipality','=','municipality.id_municipality')
                        ->where('teams.municipality', '=', $departament)
                        ->lists('name', 'id_team');*/

        //$items = Team::lists('name','id_team');


        $items = DB::table('teams')
                        ->join('municipality','teams.municipality','=','municipality.id_municipality')
                        ->where('municipality.id_departament','=',$departament)
                        ->orderBy('teams.name','asc')
                        ->lists('name', 'id_team');

        return json_encode($items);
    }


    public function getInfo($team, $cohort)
    {
      $cohort_str = substr($cohort,1,15);

      $studs = DB::table('students')
            ->join('cohortes','students.cohorte','=','cohortes.id')
            ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
            ->join('teams','headquarters.team','=','teams.id_team')
            ->where('teams.id_team','=',$team)
            ->where('cohortes.cohorte', 'like', '%'.$cohort_str.'%')
            ->select('students.id_student','students.carne','students.name','students.fsurname','students.ssurname','teams.name as team', 'headquarters.name as headquarter','students.academicu','students.carrer as career')
            ->get();

      return Response::json($studs);
    }


    public function getTeamProjects($team, $cohort)
    {
      $cohort_str = substr($cohort,1,15);

      $projects = DB::table('projects')
            ->where('team',$team)
            ->where('cohort',$cohort_str)
            ->orderBy('type','desc')
            ->get();

      return Response::json($projects);
    }

    public function getDetail($id)
    {
        $student = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->join('municipality','students.municipalityr','=','municipality.id_municipality')
              ->join('departament','municipality.id_departament','=','departament.id_departament')
              ->join('practices', 'students.practice','=', 'practices.id')
              ->join('financings','students.financing','=','financings.id_financings')
              ->where('students.id_student','=',$id)
              ->select('students.id_student','students.carne','students.name','students.fsurname','students.ssurname','departament.departament','municipality.municipality','students.carrer as career','students.academicu','practices.practice','cohortes.cohorte as cohort','teams.name as team', 'headquarters.name as headquarter','students.initd','endd','financings.name as financing')
              ->get();

        return Response::json($student);
    }

    public function getDetailProject($id)
    {
        $project = DB::table('projects')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->where('projects.id',$id)
              ->select('projects.name as pjname','projects.location as location','projects.objective as objective','projects.type as type','projects.budget as budget','projects.startdate as startdate','projects.deadline as deadline','projects.status as status','projects.stakeholders as stakeholders','interv_lines.name as linename','projects.edit_flag as edit_flag', 'interv_lines.area as area','interv_lines.policy as policy')
              ->first();

        return Response::json($project);
    }

    ///// pack to json //////////
    public function getInfot($team, $cohort)
    {
        $cohort_str = substr($cohort,1,15);

        $studs = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->where('teams.id_team','=',$team)
              ->where('cohortes.cohorte', 'like', '%'.$cohort_str.'%')
              ->select('students.id_student','students.carne','students.name','students.fsurname','students.ssurname','teams.name as team', 'headquarters.name as headquarter','students.academicu','students.carrer')
              ->get();

        return Response::json($studs);
    }
    /////////////////////////////

    public function getLocation($team)
    {
        $location = DB::table('teams')
              ->join('municipality','teams.municipality','=','municipality.id_municipality')
              ->join('departament','municipality.id_departament','=','departament.id_departament')
              ->where('teams.id_team','=',$team)
              ->lists('departament.departament',
                      'municipality.municipality');


        return json_encode($location);
    }

    public function getName($team)
    {
        $name = DB::table('teams')
              ->where('teams.id_team','=',$team)
              ->get();


        return json_encode($name);
    }

    public function getDxTeamDeprecated($team,$cohort){
        $dx = DB::table('diagnostics')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->join('dx_demography','diagnostics.id','=','dx_demography.dx')
              ->join('dx_economy','diagnostics.id','=','dx_economy.dx')
              ->join('dx_health','diagnostics.id','=','dx_health.dx')
              ->join('dx_education','diagnostics.id','=','dx_education.dx')
              ->join('dx_enviroment','diagnostics.id','=','dx_enviroment.dx')
              ->join('dx_municipal_management','diagnostics.id','=','dx_municipal_management.dx')
              ->where('dx.team',$team)
              ->where('dx.cohort',$cohort)
              ->select('diagnostics.introduction','diagnostics.objective','diagnostics.edit_flag','dx_territory.name','dx_territory.location','dx_territory.masl','dx_territory.surface','dx_demography.population_0_to_14','dx_demography.population_15_to_64','dx_demography.population_65_or_more','dx_demography.population_women','dx_demography.population_men','dx_demography.population_rural','dx_demography.population_urban','dx_demography.population_indigenous','dx_demography.population_garifuna','dx_demography.population_xinca','dx_economy.poverty','dx_economy.poverty_extreme','dx_economy.income_per_family','dx_economy.observations','dx_health.rate_access_primary_health_care','dx_health.rate_diseases_by_contaminated_water','dx_health.rate_chronic_malnutrition','dx_health.diseases','')
              ->get();

        if($dx != null){
          $dx_territory = DB::table('dx_territory')->where('dx',$dx->id)->first();
          $dx_demography = DB::table('dx_demography')->where('dx',$dx->id)->first();
          $dx_economy = DB::table('dx_economy')->where('dx',$dx->id)->first();
          $dx_health = DB::table('dx_health')->where('dx',$dx->id)->first();
          $dx_education = DB::table('dx_education')->where('dx',$dx->id)->first();
          $dx_enviroment = DB::table('$dx_enviroment')->where('dx',$dx->id)->first();
          $dx_municipal_management = DB::table('$dx_municipal_management')->where('dx',$dx->id)->first();
        }

    }

    public function getDxTeam($team,$cohort){

        /*$dx = DB::table('diagnostics')
              ->where('diagnostics.team',$team)
              ->where('diagnostics.cohort', 'like', '%'.$cohort.'%')
              //->select('diagnostics.introduction as introduction','diagnostics.objective as objective')
              ->get();*/

              $dx = DB::table('diagnostics')
                    ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
                    ->join('dx_demography','diagnostics.id','=','dx_demography.dx')
                    ->join('dx_economy','diagnostics.id','=','dx_economy.dx')
                    ->join('dx_health','diagnostics.id','=','dx_health.dx')
                    ->join('dx_education','diagnostics.id','=','dx_education.dx')
                    ->join('dx_enviroment','diagnostics.id','=','dx_enviroment.dx')
                    ->join('dx_municipal_management','diagnostics.id','=','dx_municipal_management.dx')
                    ->where('diagnostics.team',$team)
                    ->where('diagnostics.cohort', 'like', '%'.$cohort.'%')
                    ->get();

        /*$dx_territory = DB::table('dx_territory')
              ->where('dx_territory.dx',$dx->id)
              ->first();

        $dx_demography = DB::table('dx_demography')
              ->where('dx_demography.dx',$dx->id)
              ->first();

        $dx_economy = DB::table('dx_economy')
              ->where('dx_economy.dx',$dx->id)
              ->first();

        $dx_health = DB::table('dx_health')
              ->where('dx_health.dx',$dx->id)
              ->first();

        $dx_education = DB::table('dx_education')
              ->where('dx_education.dx',$dx->id)
              ->first();

        $dx_enviroment = DB::table('dx_enviroment')
              ->where('dx_enviroment.dx',$dx->id)
              ->first();

        $dx_municipal_management = DB::table('dx_municipal_management')
              ->where('dx_municipal_management.dx',$dx->id)
              ->first();*/

        return Response::json($dx);
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
