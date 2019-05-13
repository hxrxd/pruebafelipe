<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

use App\Diagnostic;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use App\Municipality;
use App\Departament;
use App\Supervisor;
use DB;
use Auth;
use Session;
use Redirect;
use View;

class DxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $cohort_str = substr($cohort->cohorte,0,14);
        $username = $student->name . ' ' . $student->fsurname;

        $dx = Diagnostic::where('team',$team->id_team)->where('cohort',substr($cohort->cohorte,0,14))->first();
        Session::put('dx', $dx);
        Session::put('team', $team);
        Session::put('username', $username);

        $participants = DB::table('students')
                        ->join('cohortes','students.cohorte','=','cohortes.id')
                        ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->join('teams','headquarters.team','=','teams.id_team')
                        ->where('teams.id_team','=',$team->id_team)
                        ->where('cohortes.cohorte', 'like', '%'.$cohort_str.'%')
                        ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                        ->orderBy('students.fsurname', 'asc')
                        ->get();

        return view('dx.index', compact('student','hq','team','cohort','municipality','department','dx','participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $dx = Diagnostic::where('team',$team->id_team)->where('cohort',substr($cohort->cohorte,0,14))->first();

        if($dx == null){
          Session::put('team', $team);
          return view('dx.create');
        }else{
          return redirect('dx/index');
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
        $student = Student::where('email', \Auth::user()->email)
                    ->first();

        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $username = $student->name . ' ' . $student->fsurname;
        $location = $municipality->municipality . ', ' . $department->departament;

        $dx = Diagnostic::create([
            'introduction'=>$request['introduction'],
            'objective'=>$request['objective'],
            'team'=>$team->id_team,
            'cohort'=>substr($cohort->cohorte,0,14),
            'file_path'=>'',
            'user_create'=>$username,
            'user_update'=>$username,
            'edit_flag'=>0,
            'editing'=>1,
          ]);

        Session::put('dx', $dx);
        Session::put('place', $location);

        return redirect('dx/territory');
    }

    public function goToEdit($edit_flag){

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['editing'=>1]);

        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $dx = Diagnostic::where('team',$team->id_team)->where('cohort',substr($cohort->cohorte,0,14))->first();
        Session::put('dx', $dx);

        switch ($dx->edit_flag) {
          case 0:
              return  redirect('dx/territory');
              break;
          case 14:
              return redirect('dx/demography');
              break;
          case 28:
              return redirect('dx/economy');
              break;
          case 42:
              return redirect('dx/health');
              break;
          case 56:
              return redirect('dx/education');
              break;
          case 70:
              return redirect('dx/enviroment');
              break;
          case 84:
              return redirect('dx/municipalmanagement');
              break;
          default:
              return redirect('dx/territory');
      }
    }

    public function closeEdit(){
        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['editing'=>0]);

        return redirect('dx/');
    }

    public function editDx(){
        return view('dx.dx-edit',['dx'=>Session::get('dx')]);
    }

    public function getDxs(){
        $user = Auth::user();
        $supervisor = null;

        $cohort_tmp = Cohorte::orderBy('created_at','desc')->first();
        $cohort = substr($cohort_tmp->cohorte,0,14);
        $username = $user->fname . ' ' . $user->lname;

        $cohorts = Cohorte::lists('cohorte','id');
        $cohort = "";
        $cohorts_tmp = array();

        foreach($cohorts as $val){
          $cohort = substr($val,0,14);
          $cohorts_tmp[] = $cohort;
        }

        $gcohorts = array_unique($cohorts_tmp);

        Session::put('username', $username);

        if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin"){
          $dxs = DB::table('diagnostics')
                    ->join('teams','diagnostics.team','=','teams.id_team')
                    //->where('diagnostics.cohort','like', '%'.$cohort.'%')
                    ->select('teams.id_team as id_team','teams.name as team', 'diagnostics.user_create as user_create', 'diagnostics.user_update as user_update', 'diagnostics.edit_flag as edit_flag', 'diagnostics.editing as editing', 'diagnostics.created_at as created_at','diagnostics.file_path as path', 'diagnostics.updated_at as updated_at','diagnostics.cohort as cohort')
                    ->orderBy('diagnostics.edit_flag', 'desc')
                    ->get();

          $participants = DB::table('students')
                    ->join('cohortes','students.cohorte','=','cohortes.id')
                    ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                    ->join('teams','headquarters.team','=','teams.id_team')
                    ->where('cohortes.cohorte', 'like', '%'.$cohort.'%')
                    ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                    ->orderBy('students.fsurname', 'asc')
                    ->get();
        }else{
          $supervisor = Supervisor::where('iduser','=',$user->id)->first();
          $dxs = DB::table('diagnostics')
                    ->join('teams','diagnostics.team','=','teams.id_team')
                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                    //->where('diagnostics.cohort','like', '%'.$cohort.'%')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->select('teams.id_team as id_team','teams.name as team', 'diagnostics.user_create as user_create', 'diagnostics.user_update as user_update', 'diagnostics.edit_flag as edit_flag', 'diagnostics.editing as editing', 'diagnostics.created_at as created_at','diagnostics.file_path as path', 'diagnostics.updated_at as updated_at','diagnostics.cohort as cohort')
                    ->orderBy('diagnostics.edit_flag', 'desc')
                    ->get();

          $participants = DB::table('students')
                    ->join('cohortes','students.cohorte','=','cohortes.id')
                    ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                    ->join('teams','headquarters.team','=','teams.id_team')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->where('cohortes.cohorte', 'like', '%'.$cohort.'%')
                    ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                    ->orderBy('students.fsurname', 'asc')
                    ->get();
        }




        return view('dx.diagnostics', compact('gcohorts','supervisor','cohort','dxs','participants'));
    }

    public function getDxByCohort($current_cohort){
        //$id = Input::get('iddx');
        $user = Auth::user();
        $supervisor = Supervisor::where('iduser','=',$user->id)->first();

        /*$cohort_tmp = Cohorte::where('cohorte','like',$id)->first();
        $cohort = substr($cohort_tmp->cohorte,0,14);*/
        $username = $user->fname . ' ' . $user->lname;

        Session::put('username', $username);

        if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin"){
          $dxs = DB::table('diagnostics')
                    ->join('teams','diagnostics.team','=','teams.id_team')
                    ->where('diagnostics.cohort','like', '%'.$current_cohort.'%')
                    ->select('teams.id_team as team_id','teams.name as team', 'diagnostics.cohort as cohort','diagnostics.user_create as user_create', 'diagnostics.user_update as user_update', 'diagnostics.edit_flag as edit_flag', 'diagnostics.editing as editing', 'diagnostics.created_at as created_at','diagnostics.file_path as path', 'diagnostics.updated_at as updated_at')
                    ->orderBy('diagnostics.edit_flag', 'desc')
                    ->get();
        }else{
          $dxs = DB::table('diagnostics')
                    ->join('teams','diagnostics.team','=','teams.id_team')
                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                    ->where('diagnostics.cohort','like', '%'.$current_cohort.'%')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->select('teams.name as team', 'diagnostics.team as team_id', 'diagnostics.cohort as cohort','diagnostics.user_create as user_create', 'diagnostics.user_update as user_update', 'diagnostics.edit_flag as edit_flag', 'diagnostics.editing as editing', 'diagnostics.created_at as created_at', 'diagnostics.updated_at as updated_at')
                    ->orderBy('diagnostics.edit_flag', 'desc')
                    ->get();
        }



        return Response::json($dxs);
    }

    public function getDxDetail($team, $cohort){

        $cohortx = Cohorte::where('cohorte','like','%'.$cohort.'%')->first();
        $teamx = Team::where('name',$team)->first();
        $cohort_str = substr($cohortx->cohorte,0,14);
        $municipality = Municipality::find($teamx->municipality);
        $department = Departament::find($municipality->id_departament);

        $dx = Diagnostic::where('team',$teamx->id_team)->where('cohort','=',substr($cohortx->cohorte,0,14))->first();
        Session::put('dx', $dx);
        Session::put('team', $teamx);

        $participants = DB::table('students')
                        ->join('cohortes','students.cohorte','=','cohortes.id')
                        ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->join('teams','headquarters.team','=','teams.id_team')
                        ->where('teams.id_team','=',$teamx->id_team)
                        ->where('cohortes.cohorte', 'like', '%'.$cohort_str.'%')
                        ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                        ->orderBy('students.fsurname', 'asc')
                        ->get();

        return view('dx.dx-detail', compact('teamx','cohortx','municipality','department','dx','participants'));
    }

    public function getReport($team,$cohort){


        $cohort_str = $cohort;
        $tm = Team::where('id_team',$team)->first();
        $municipality = Municipality::find($tm->municipality);
        $department = Departament::find($municipality->id_departament);

        //$dxr = Diagnostic::where('diagnostics.team',$team)->where('diagnostics.cohort','like','%'.$cohort.'%')->first();

        $dxr = DB::table('diagnostics')
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

        $participants = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
              ->join('teams','headquarters.team','=','teams.id_team')
              ->where('teams.id_team','=',$team)
              ->where('cohortes.cohorte', 'like', '%'.$cohort.'%')
              ->select('students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
              ->orderBy('students.fsurname', 'asc')
              ->get();


        $pdf = \PDF::loadView('report.summary-dx', compact('dxr','tm','municipality','department','cohort_str','participants'));

        return $pdf->download('DX_'.$tm->name.'_'.$cohort_str.'.pdf');
        //return $pdf->stream();
    }


    public function changeEditDxStatus(Request $req)
    {

        $dxsts = Diagnostic::find($req->id);
        $dxsts->editing = 0;
        $dxsts->save();

        return Response::json($dxsts);
    }

    public function upload(Request $request){

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
        $dx = Diagnostic::find($id);
        $dx->fill($request->all());
        $dx->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        Session::flash('message','Información general actualizada correctamente');
        return redirect('dx/1/edit');
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

    public function getStats(){
      $total_population = DB::table('dx_demography')
              ->join('diagnostics','dx_demography.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("sum(dx_demography.population_men) as pm,sum(dx_demography.population_women) as pw,sum(dx_demography.population_rural) as pr,sum(dx_demography.population_urban) as pu,sum(dx_demography.population_indigenous) as pi"))
              ->get();

      $total_population_by_age = DB::table('dx_demography')
              ->join('diagnostics','dx_demography.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("sum(dx_demography.population_0_to_14) as p014,sum(dx_demography.population_15_to_64) as p1564,sum(dx_demography.population_65_or_more) as p65"))
              ->get();

      $total_economy = DB::table('dx_economy')
              ->join('diagnostics','dx_economy.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("count(dx_economy.id) as total,sum(dx_economy.poverty) as poverty,sum(dx_economy.poverty_extreme) as poverty_extreme,sum(dx_economy.income_per_family) as income"))
              ->get();

      $total_health = DB::table('dx_health')
              ->join('diagnostics','dx_health.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("count(dx_health.id) as total,sum(dx_health.rate_access_primary_health_care) as rph,sum(dx_health.rate_diseases_by_contaminated_water) as rdcw,sum(dx_health.rate_chronic_malnutrition) as rcm"))
              ->get();

      $total_education = DB::table('dx_education')
              ->join('diagnostics','dx_education.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("count(dx_education.id) as total,sum(dx_education.percentage_math_test_approval_primary) as mp,sum(dx_education.percentage_math_test_approval_secondary) as ms,sum(dx_education.percentage_math_test_approval_diversified) as md,sum(dx_education.percentage_reading_test_approval_primary) as rp,sum(dx_education.percentage_reading_test_approval_secondary) as rs,sum(dx_education.percentage_reading_test_approval_diversified) as rd"))
              ->get();

      $total_environment = DB::table('dx_enviroment')
              ->join('diagnostics','dx_enviroment.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select(DB::raw("count(dx_enviroment.id) as total,sum(dx_enviroment.forest_cover_rate) as fcr,sum(dx_enviroment.land_use_rate) as lur,sum(dx_enviroment.num_plans_integral_management_solid_waste) as npi"))
              ->get();

      $population = DB::table('dx_demography')
              ->join('diagnostics','dx_demography.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_demography.population_men as pm','dx_demography.population_women as pw','dx_demography.population_rural as pr','dx_demography.population_urban as pu','dx_demography.population_indigenous as pi')
              ->orderBy('territory','asc')
              ->get();

      $population_by_age = DB::table('dx_demography')
              ->join('diagnostics','dx_demography.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_demography.population_men as pm','dx_demography.population_women as pw','dx_demography.population_0_to_14 as p014','dx_demography.population_15_to_64 as p1564','dx_demography.population_65_or_more as p65')
              ->orderBy('territory','asc')
              ->get();

      $economy = DB::table('dx_economy')
              ->join('diagnostics','dx_economy.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_economy.poverty as poverty','dx_economy.poverty_extreme as poverty_extreme','dx_economy.income_per_family as income')
              ->orderBy('territory','asc')
              ->get();

      $health = DB::table('dx_health')
              ->join('diagnostics','dx_health.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_health.rate_access_primary_health_care as rph','dx_health.rate_diseases_by_contaminated_water as rdcw','dx_health.rate_chronic_malnutrition as rcm','dx_health.diseases as diseases')
              ->orderBy('territory','asc')
              ->get();

      $education = DB::table('dx_education')
              ->join('diagnostics','dx_education.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_education.percentage_math_test_approval_primary as mp','dx_education.percentage_math_test_approval_secondary as ms','dx_education.percentage_math_test_approval_diversified as md','dx_education.percentage_reading_test_approval_primary as rp','dx_education.percentage_reading_test_approval_secondary as rs','dx_education.percentage_reading_test_approval_diversified as rd')
              ->orderBy('territory','asc')
              ->get();

      $environment = DB::Table('dx_enviroment')
              ->join('diagnostics','dx_enviroment.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_enviroment.forest_cover_rate as fcr','dx_enviroment.land_use_rate as lur','dx_enviroment.num_plans_integral_management_solid_waste as npi')
              ->orderBy('territory','asc')
              ->get();

      $municipal_index = DB::table('dx_municipal_management')
              ->join('diagnostics','dx_municipal_management.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_municipal_management.municipal_management_index as mmi')
              ->orderBy('territory','asc')
              ->get();


      $territories = DB::table('dx_territory')
              ->join('diagnostics','dx_territory.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->orderBy('dx_territory.name','asc')
              ->get();

      return view('stats.diagnostics',compact('total_population','territories','population','population_by_age','total_population_by_age','total_economy','economy','total_health','health','total_education','education','total_environment','environment','municipal_index'));
    }

    public function chartMasl(){
      $territory_masl = DB::table('dx_territory')
              ->join('diagnostics','dx_territory.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->where('dx_territory.masl','>',100)
              ->select('dx_territory.name as name','dx_territory.masl as masl')
              ->get();

      $data = array();
      foreach ($territory_masl as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartMaslHigher(){
      $territory_masl_h = DB::table('dx_territory')
              ->join('diagnostics','dx_territory.dx','=','diagnostics.id')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->where('dx_territory.masl','>',100)
              ->select('dx_territory.name as name','dx_territory.masl as masl')
              ->orderBy('masl','desc')
              ->take(10)
              ->get();

      $data = array();
      foreach ($territory_masl_h as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartMaslLower(){
      $territory_masl_l = DB::table('dx_territory')
              ->where('dx_territory.masl','>',100)
              ->select('dx_territory.name as name','dx_territory.masl as masl')
              ->orderBy('masl','asc')
              ->take(10)
              ->get();

      $data = array();
      foreach ($territory_masl_l as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartPopulation($cat){
      $pop = DB::table('dx_demography')
              ->join('diagnostics','dx_demography.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->select('dx_territory.name as territory','dx_demography.population_men as pm','dx_demography.population_women as pw','dx_demography.population_rural as pr','dx_demography.population_urban as pu','dx_demography.population_indigenous as pi')
              ->orderBy($cat,'desc')
              ->take(15)
              ->get();

      $data = array();
      foreach ($pop as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartEconomy($cat,$order){
      $econ = DB::table('dx_economy')
              ->join('diagnostics','dx_economy.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->where('dx_economy.poverty','>',0)
              ->where('dx_economy.poverty','>',0)
              ->where('dx_economy.income_per_family','>',1)
              ->select('dx_territory.name as territory','dx_economy.poverty as poverty','dx_economy.poverty_extreme as poverty_extreme','dx_economy.income_per_family as income')
              ->orderBy($cat,$order)
              ->take(15)
              ->get();

      $data = array();
      foreach ($econ as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartHealth($cat,$order){
      $econ = DB::table('dx_health')
              ->join('diagnostics','dx_health.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->where('dx_health.rate_access_primary_health_care','>',1)
              ->where('dx_health.rate_diseases_by_contaminated_water','>',1)
              ->where('dx_health.rate_chronic_malnutrition','>',1)
              ->select('dx_territory.name as territory','dx_health.rate_access_primary_health_care as rph','dx_health.rate_diseases_by_contaminated_water as rdcw','dx_health.rate_chronic_malnutrition as rcm')
              ->orderBy($cat,$order)
              ->take(15)
              ->get();

      $data = array();
      foreach ($econ as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartMM($order){
      $econ = DB::table('dx_municipal_management')
              ->join('diagnostics','dx_municipal_management.dx','=','diagnostics.id')
              ->join('dx_territory','diagnostics.id','=','dx_territory.dx')
              ->where('diagnostics.cohort','1 Cohorte 2018')
              ->where('dx_municipal_management.municipal_management_index','>',0.1)
              ->select('dx_territory.name as territory','dx_municipal_management.municipal_management_index as mmi')
              ->orderBy('dx_municipal_management.municipal_management_index',$order)
              ->take(15)
              ->get();

      $data = array();
      foreach ($econ as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }


    /********* Dx controller for new UI ***********/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dxWorkspace()
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

        $dx = Diagnostic::where('team',$team->id_team)->where('cohort',$cohort->name)->first();

        if(is_null($dx)){
          $dx = Diagnostic::create([
            'team'=>$team->id_team,
            'cohort'=>$cohort->name,
            'user_create'=>$username,
            'user_update'=>$username,
          ]);
        }else{
          $dx_territory = DB::table('dx_territory')->where('dx',$dx->id)->first();
          $dx_demography = DB::table('dx_demography')->where('dx',$dx->id)->first();
          $dx_economy = DB::table('dx_economy')->where('dx',$dx->id)->first();
          $dx_health = DB::table('dx_health')->where('dx',$dx->id)->first();
          $dx_education = DB::table('dx_education')->where('dx',$dx->id)->first();
          $dx_environment = DB::table('dx_enviroment')->where('dx',$dx->id)->first();
          $dx_municipalm = DB::table('dx_municipal_management')->where('dx',$dx->id)->first();
          
        }

        return view("informs.dx_create",compact('dx','team','cohort','municipality','department','squad','username','dx_territory','dx_demography','dx_economy','dx_health','dx_education','dx_environment','dx_municipalm'));
    }

}
