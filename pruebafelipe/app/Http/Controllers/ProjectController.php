<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Log;
use App\Project;
use App\Activity;
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
use Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $student;
    private $hq;
    private $team;
    private $cohort;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $cohort_str = substr($cohort->cohorte,0,14);
        $username = $student->name . ' ' . $student->fsurname;
        $idpj = 0;
        $lines = DB::table('interv_lines')->lists('name','id');

        switch ($type) {
          case 1:
            $idpj = 1;
            $ty = "Multidisciplinario";
            Session::put('idpj', $idpj);
            return view('projects.create', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
            break;
          case 2:
            $idpj = 2;
            $ty = "Monodisciplinario";
            Session::put('idpj', $idpj);
            return view('projects.create', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
            break;
          case 3:
            $idpj = 3;
            $ty = "Convivencia";
            Session::put('idpj', $idpj);
            return view('projects.create', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
            break;
        }


    }

    public function getIntervLines($id){
        $interv_lines = DB::table('interv_lines')->where('id',$id)->first();

        return Response::json($interv_lines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $cohort_str = substr($cohort->cohorte,0,14);

        $project = Project::create([
          'name'=>$request['name'],
          'location'=>$request['location'],
          'description'=>$request['description'],
          'justification'=>$request['justification'],
          'objective'=>$request['objective'],
          'line'=>$request['line'],
          'stakeholders'=>$request['stakeholders'],
          'startdate'=>$request['startdate'],
          'deadline'=>$request['deadline'],
          'budget'=>$request['budget'],
          'type'=>$request['type'],
          'student'=>$student->id_student,
          'team'=>$team->id_team,
          'cohort'=>$cohort_str,
        ]);

        Session::put('project', $project);

        return redirect('project/'.$project->id.'/workplan');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProject($type)
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $cohort_str = substr($cohort->cohorte,0,14);
        $username = $student->name . ' ' . $student->fsurname;
        $line = "none";
        $idpj = 0;
        $ty = "";
        $pj;


        switch ($type) {
          case 1:
            $idpj = 1;
            $ty = "Multidisciplinario";
            $pj = Project::where('team',$team->id_team)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Multidisciplinario')
                ->first();

            break;
          case 2:
            $idpj = 2;
            $ty = "Monodisciplinario";
            $pj = Project::where('student',$student->id_student)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Monodisciplinario')
                ->first();

            break;
          case 3:
            $idpj = 3;
            $ty = "Convivencia";
            $pj = Project::where('team',$team->id_team)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Convivencia')
                ->first();

            break;
        }

        if($pj != null){
          $cod = 'RF:'.$pj->id.''.$pj->team;
          $line = DB::table('interv_lines')->where('id',$pj->line)->first();
          $allActivities = DB::table('activities')
                  ->join('workplans','activities.workplan','=','workplans.id')
                  ->where('workplans.project','=',$pj->id)
                  ->where('activities.status',1)
                  ->select('activities.id as id','activities.activity as activity','activities.time as time','activities.startdate as startdate','activities.deadline as deadline','activities.status as status','workplans.objective_what as objective_what','workplans.objective_what_for as objective_what_for')
                  ->orderBy('activities.deadline','asc')
                  ->get();

          $allActivities2 = DB::table('activities')
                  ->join('workplans','activities.workplan','=','workplans.id')
                  ->where('workplans.project','=',$pj->id)
                  ->where('activities.status',0)
                  ->select('activities.id as id','activities.activity as activity','activities.time as time','activities.startdate as startdate','activities.deadline as deadline','activities.status as status','workplans.objective_what as objective_what','workplans.objective_what_for as objective_what_for')
                  ->orderBy('activities.startdate','asc')
                  ->get();

          $allWorkplans = DB::table('workplans')
                  ->where('workplans.project',$pj->id)
                  ->get();

          $logs = DB::table('logs')
                  ->join('users','logs.email','=','users.email')
                  ->where('desc','like','%'.$cod.'%')
                  ->select('logs.desc as desc','logs.created_at as created_at','users.fname as fname')
                  ->orderBy('logs.created_at','desc')
                  ->get();

          if($allActivities == null){
            DB::table('projects')
              ->where('id',$pj->id)
              ->update(['status'=>0]);
          }else{
            DB::table('projects')
              ->where('id',$pj->id)
              ->update(['status'=>1]);
          }
        }

        $participants = DB::table('students')
                  ->join('cohortes','students.cohorte','=','cohortes.id')
                  ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                  ->join('teams','headquarters.team','=','teams.id_team')
                  ->where('teams.id_team','=',$team->id_team)
                  ->where('cohortes.cohorte', 'like', '%'.$cohort_str.'%')
                  ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                  ->orderBy('students.fsurname', 'asc')
                  ->get();


        Session::put('pj',$pj);
        Session::put('idpj', $idpj);

        return view('projects.index', compact('hq','team','cohort','municipality','department','pj','ty','idpj','line','participants','allActivities','allActivities2','allWorkplans','logs'));
    }

    public function editProject(){
        $lines = DB::table('interv_lines')->lists('name','id');

        switch (Session::get('idpj')) {
          case 1:
            $ty = "Multidisciplinario";
            break;
          case 2:
            $ty = "Monodisciplinario";
            break;
          case 3:
            $ty = "Convivencia";
            break;
          default:
            $ty = "";
            break;
        }
        return view('projects.edit',['pj'=>Session::get('pj'),'ty'=>$ty,'lines'=>$lines]);
    }

    public function activityDone($id){
        $responsable = Student::where('email', \Auth::user()->email)->first();
        $activity = Activity::where('id',$id)->first();
        $act_str = $activity->activity;
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        if(strlen($act_str)>150)
          $act_str = substr($act_str,0,150).'...';

        $description = $responsable->name.' marcó como hecha la actividad: '.$act_str.' RF:'.$ref;

        $log = [
            'desc'=>$description,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $ac = DB::table('activities')
          ->where('id',$id)
          ->update(['status'=>0,'updated_at'=>date('Y-m-d H:i:s')]);

        //return response()->json($ac);
        return Response::json($ac);
    }

    public function activityUndone($id){
        $responsable = Student::where('email', \Auth::user()->email)->first();
        $activity = Activity::where('id',$id)->first();
        $act_str = $activity->activity;
        $ref = Session::get('pj')->id.''.Session::get('pj')->team;

        if(strlen($act_str)>150)
          $act_str = substr($act_str,0,150).'...';

        $description = $responsable->name.' desmarcó la actividad: '.$act_str.' RF:'.$ref;

        $log = [
            'desc'=>$description,
            'email'=>Auth::user()->email,
        ];


        Log::create($log);

        $ac = DB::table('activities')
          ->where('id',$id)
          ->update(['status'=>1,'updated_at'=>date('Y-m-d H:i:s')]);

        //return response()->json($ac);
        return Response::json($ac);
    }

    public function getAllProjects(){
      $user = Auth::user();
      $username = $user->fname . ' ' . $user->lname;
      Session::put('username', $username);


      if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin"){
        $pjs = DB::table('projects')
                  ->join('teams','projects.team','=','teams.id_team')
                  ->join('interv_lines','projects.line','=','interv_lines.id')
                  ->join('students','projects.student','=','students.id_student')
                  ->select('students.name as namestudent','students.fsurname as lastnamenamestudent','students.ssurname as slastnamenamestudent','projects.id as id','projects.name as name', 'projects.type as type','teams.name as team','teams.id_team as id_team','projects.cohort as cohort','interv_lines.name as line','projects.status as status')
                  ->orderBy('projects.name', 'asc')
                  ->get();
      }else{

        $supervisor = Supervisor::where('iduser','=',$user->id)->first();

        $pjs = DB::table('projects')
                  ->join('teams','projects.team','=','teams.id_team')
                  ->join('interv_lines','projects.line','=','interv_lines.id')
                  ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                  ->join('students','projects.student','=','students.id_student')
                  ->where('teams.supervisor','=',$supervisor->id_supervisors)
                  ->select('students.name as namestudent','students.fsurname as lastnamenamestudent','students.ssurname as slastnamenamestudent','projects.id as id','projects.name as name', 'projects.type as type','teams.name as team','teams.id_team as id_team','projects.cohort as cohort','interv_lines.name as line','projects.status as status')
                  ->orderBy('projects.name', 'asc')
                  ->get();
      }


      return view('projects.allprojects', compact('supervisor','pjs'));
    }

    public function showReport($id){
      $pj = Project::where('id',$id)->first();

      $final = DB::table('final_inform')
          ->where('project',$pj->id)
          ->first();

      $ty = $pj->type;
      if($final == null){
          //return view('informs.final_inform', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
      }else{
          $allWorkplans = DB::table('workplans')
                  ->where('workplans.project',$pj->id)
                  ->get();

          $line = DB::table('interv_lines')->where('id',$pj->line)->first();
          return view('informs.inform_from_detail', compact('pj','final','allWorkplans','line','ty'));
      }
    }


    public function getProjectDetail($id,$team,$cohort,$type)
    {
        $user = Auth::user();
        $participants = DB::table('students')
                  ->join('cohortes','students.cohorte','=','cohortes.id')
                  ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                  ->join('teams','headquarters.team','=','teams.id_team')
                  ->where('teams.id_team','=',$team)
                  ->where('cohortes.cohorte', 'like', '%'.$cohort.'%')
                  ->select('students.id_student as id','teams.name as team','students.carne as carne','students.academicu as academicu','students.carrer as career','students.name as name','students.fsurname as fsurname','students.ssurname as ssurname')
                  ->orderBy('students.fsurname', 'asc')
                  ->get();

        $team = Team::where('id_team',$team)->first();
        $cohort_str = $cohort;
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $username = $user->fname . ' ' . $user->lname;
        $line = "none";
        $idpj = 0;
        $ty = "";
        $pj;


        switch ($type) {
          case "Multidisciplinario":
            $idpj = 1;

            break;
          case "Monodisciplinario":
            $idpj = 2;

            break;
          case "Convivencia":
            $idpj = 3;

            break;
        }

        $pj = Project::where('id',$id)
            ->first();

        $ty = $type;

        $cod = 'RF:'.$pj->id.''.$pj->team;
        $line = DB::table('interv_lines')->where('id',$pj->line)->first();
        $allActivities = DB::table('activities')
                ->join('workplans','activities.workplan','=','workplans.id')
                ->where('workplans.project','=',$pj->id)
                ->where('activities.status',1)
                ->select('activities.id as id','activities.activity as activity','activities.time as time','activities.startdate as startdate','activities.deadline as deadline','activities.status as status','workplans.objective_what as objective_what','workplans.objective_what_for as objective_what_for')
                ->orderBy('activities.deadline','asc')
                ->get();

        $allActivities2 = DB::table('activities')
                ->join('workplans','activities.workplan','=','workplans.id')
                ->where('workplans.project','=',$pj->id)
                ->where('activities.status',0)
                ->select('activities.id as id','activities.activity as activity','activities.time as time','activities.startdate as startdate','activities.deadline as deadline','activities.status as status','workplans.objective_what as objective_what','workplans.objective_what_for as objective_what_for')
                ->orderBy('activities.startdate','asc')
                ->get();

        $allWorkplans = DB::table('workplans')
                ->where('workplans.project',$pj->id)
                ->get();

        $logs = DB::table('logs')
                ->join('users','logs.email','=','users.email')
                ->where('desc','like','%'.$cod.'%')
                ->select('logs.desc as desc','logs.created_at as created_at','users.fname as fname')
                ->orderBy('logs.created_at','desc')
                ->get();

        if($allActivities == null){
          DB::table('projects')
            ->where('id',$pj->id)
            ->update(['status'=>0]);
        }else{
          DB::table('projects')
            ->where('id',$pj->id)
            ->update(['status'=>1]);
        }

        Session::put('pj',$pj);
        Session::put('idpj', $idpj);
        Session::put('username', $username);

        return view('projects.project-detail', compact('team','cohort_str','municipality','department','pj','ty','idpj','line','participants','allActivities','allActivities2','allWorkplans','logs'));
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
        $pj = Project::find($id);
        $pj->fill($request->all());
        $pj->save();

        Session::flash('message','Información general actualizada correctamente');

        if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Supervisor" || Auth::user()->rol == "Admin"){

          return redirect('projects/all');

        }else{
          if(Session::get('idpj') == 1)
            return redirect('project/cat/1');
          else if(Session::get('idpj') == 2)
            return redirect('project/cat/2');
          else
            return redirect('project/cat/3');
        }


    }

    public function getGeneralReport(){
      $pjs = DB::table('projects')
              ->join('teams','projects.team','=','teams.id_team')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->select('projects.id as id','projects.name as name', 'projects.type as type','teams.name as team','teams.id_team as id_team','projects.cohort as cohort','interv_lines.name as line','projects.status as status', 'projects.budget as budget')
              ->orderBy('projects.name', 'asc')
              ->get();

      $total_pjs = Project::count();
      $total_mult = Project::where('type','Multidisciplinario')->count();
      $total_mono = Project::where('type','Monodisciplinario')->count();
      $total_conv = Project::where('type','Convivencia')->count();



      $mono_by_line = DB::table('projects')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->where('projects.type','Monodisciplinario')
              ->select('interv_lines.name as line',DB::raw("count(*) as numprojs"))
              ->groupBy('interv_lines.name')
              ->get();


      $total_line_1 = Project::where('line',1)->count();
      $total_line_2 = Project::where('line',2)->count();
      $total_line_3 = Project::where('line',3)->count();
      $total_line_4 = Project::where('line',4)->count();
      $total_line_5 = Project::where('line',5)->count();
      $total_line_6 = Project::where('line',6)->count();
      $total_line_7 = Project::where('line',7)->count();
      $total_line_8 = Project::where('line',8)->count();
      $total_line_9 = Project::where('line',9)->count();
      $total_line_10 = Project::where('line',10)->count();

      $budget_pjs = Project::sum('budget');
      $budget_mult = Project::where('type','Multidisciplinario')->sum('budget');
      $budget_mono = Project::where('type','Monodisciplinario')->sum('budget');
      $budget_conv = Project::where('type','Convivencia')->sum('budget');

      $budget_by_career = DB::table('projects')
              ->join('students','projects.student','=','students.id_student')
              ->where('projects.type','Monodisciplinario')
              ->select('students.carrer as career',DB::raw("SUM(projects.budget) as bud_career"))
              ->orderBy('bud_career','desc')
              ->groupBy('students.carrer')
              ->get();

      $total_direct_users = DB::table('final_inform')
              ->sum('direct_users');

      $total_indirect_users = DB::table('final_inform')
              ->sum('indirect_users');

      $users_by_ptype = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.type as type',DB::raw("sum(final_inform.direct_users) as directs"),DB::raw("sum(final_inform.indirect_users) as indirects"))
              ->orderBy('type','desc')
              ->groupBy('type')
              ->get();

      $budget_by_cohort_mult = DB::table('projects')
              ->where('projects.type','Multidisciplinario')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_mono = DB::table('projects')
              ->where('projects.type','Monodisciplinario')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_conv = DB::table('projects')
              ->where('projects.type','Convivencia')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_total = DB::table('projects')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $pjs_top = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.id as id','projects.name as name','projects.type as type','projects.team as team','projects.budget as budget','projects.cohort as cohort','final_inform.direct_users as du','final_inform.indirect_users as iu')
              ->orderBy('final_inform.direct_users','desc')
              ->take(10)
              ->get();

      $pjs_budget_top = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.id as id','projects.name as name','projects.type as type','projects.team as team','projects.budget as budget','projects.cohort as cohort','final_inform.direct_users as du','final_inform.indirect_users as iu')
              ->orderBy('projects.budget','desc')
              ->take(10)
              ->get();

        $pdf = \PDF::loadView('report.summary-projects', compact('pjs',
                'total_pjs','total_mult','total_mono','total_conv',
                'budget_pjs','budget_mult','budget_mono','budget_conv',
                'total_line_1','total_line_2','total_line_3','total_line_4','total_line_5','total_line_6','total_line_7','total_line_8','total_line_9','total_line_10',
                'budget_by_career','mono_by_line','total_direct_users','total_indirect_users','users_by_ptype',
                'budget_by_cohort_mult','budget_by_cohort_mono','budget_by_cohort_conv','budget_by_cohort_total','pjs_top','pjs_budget_top'));

        return $pdf->download('ReporteGeneralProyectos.pdf');
        //return $pdf->stream();
    }

    public function getStats(){
      $pjs = DB::table('projects')
              ->join('teams','projects.team','=','teams.id_team')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->select('projects.id as id','projects.name as name', 'projects.type as type','teams.name as team','teams.id_team as id_team','projects.cohort as cohort','interv_lines.name as line','projects.status as status', 'projects.budget as budget')
              ->orderBy('projects.name', 'asc')
              ->get();

      $total_pjs = Project::count();
      $total_mult = Project::where('type','Multidisciplinario')->count();
      $total_mono = Project::where('type','Monodisciplinario')->count();
      $total_conv = Project::where('type','Convivencia')->count();



      $mono_by_line = DB::table('projects')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->where('projects.type','Monodisciplinario')
              ->select('interv_lines.name as line',DB::raw("count(*) as numprojs"))
              ->groupBy('interv_lines.name')
              ->get();


      $total_line_1 = Project::where('line',1)->count();
      $total_line_2 = Project::where('line',2)->count();
      $total_line_3 = Project::where('line',3)->count();
      $total_line_4 = Project::where('line',4)->count();
      $total_line_5 = Project::where('line',5)->count();
      $total_line_6 = Project::where('line',6)->count();
      $total_line_7 = Project::where('line',7)->count();
      $total_line_8 = Project::where('line',8)->count();
      $total_line_9 = Project::where('line',9)->count();
      $total_line_10 = Project::where('line',10)->count();

      $budget_pjs = Project::sum('budget');
      $budget_mult = Project::where('type','Multidisciplinario')->sum('budget');
      $budget_mono = Project::where('type','Monodisciplinario')->sum('budget');
      $budget_conv = Project::where('type','Convivencia')->sum('budget');

      $budget_by_career = DB::table('projects')
              ->join('students','projects.student','=','students.id_student')
              ->where('projects.type','Monodisciplinario')
              ->select('students.carrer as career',DB::raw("SUM(projects.budget) as bud_career"),DB::raw("count(projects.id) as projs"))
              ->orderBy('bud_career','desc')
              ->groupBy('students.carrer')
              ->get();

      $budget_by_au = DB::table('projects')
              ->join('students','projects.student','=','students.id_student')
              ->select('students.academicu as au',DB::raw("SUM(projects.budget) as bud_au"),DB::raw("count(projects.id) as projs"))
              ->orderBy('bud_au','desc')
              ->groupBy('students.academicu')
              ->get();

      $budget_by_team = DB::table('projects')
              ->join('teams','projects.team','=','teams.id_team')
              ->select('teams.name as team',DB::raw("SUM(projects.budget) as bud_team"),DB::raw("count(projects.id) as projs"))
              ->orderBy('bud_team','desc')
              ->groupBy('teams.name')
              ->get();

      $total_direct_users = DB::table('final_inform')
              ->sum('direct_users');

      $total_indirect_users = DB::table('final_inform')
              ->sum('indirect_users');

      $users_by_ptype = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.type as type',DB::raw("sum(final_inform.direct_users) as directs"),DB::raw("sum(final_inform.indirect_users) as indirects"))
              ->orderBy('type','desc')
              ->groupBy('type')
              ->get();

      $budget_by_cohort_mult = DB::table('projects')
              ->where('projects.type','Multidisciplinario')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_mono = DB::table('projects')
              ->where('projects.type','Monodisciplinario')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_conv = DB::table('projects')
              ->where('projects.type','Convivencia')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $budget_by_cohort_total = DB::table('projects')
              ->select('projects.cohort as cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('cohort')
              ->get();

      $pjs_top = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.id as id','projects.name as name','projects.type as type','projects.team as team','projects.budget as budget','projects.cohort as cohort','final_inform.direct_users as du','final_inform.indirect_users as iu')
              ->orderBy('final_inform.direct_users','desc')
              ->take(10)
              ->get();

      $pjs_budget_top = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->select('projects.id as id','projects.name as name','projects.type as type','projects.team as team','projects.budget as budget','projects.cohort as cohort','final_inform.direct_users as du','final_inform.indirect_users as iu')
              ->orderBy('projects.budget','desc')
              ->take(10)
              ->get();

      return view('stats.projects', compact('pjs',
              'total_pjs','total_mult','total_mono','total_conv',
              'budget_pjs','budget_mult','budget_mono','budget_conv',
              'total_line_1','total_line_2','total_line_3','total_line_4','total_line_5','total_line_6','total_line_7','total_line_8','total_line_9','total_line_10',
              'budget_by_career','budget_by_au','mono_by_line','total_direct_users','total_indirect_users','users_by_ptype',
              'budget_by_cohort_mult','budget_by_cohort_mono','budget_by_cohort_conv','budget_by_cohort_total','pjs_top','pjs_budget_top','budget_by_team'));
    }


    public function chartsProjByLine($type){
      $proj_by_line = DB::table('projects')
              ->join('interv_lines','projects.line','=','interv_lines.id')
              ->where('projects.type',$type)
              ->select('interv_lines.name as line',DB::raw("count(*) as numprojs"))
              ->groupBy('interv_lines.name')
              ->get();


      $data = array();
      foreach ($proj_by_line as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartsBudgetByAU($type){
      $b_by_au = DB::table('projects')
              ->join('students','projects.student','=','students.id_student')
              ->where('projects.type',$type)
              ->select('students.academicu as au',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('students.academicu')
              ->get();


      $data = array();
      foreach ($b_by_au as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartBudgetByCohort(){
      $bud_by_cohort = DB::table('projects')
              ->select('projects.cohort',DB::raw("sum(projects.budget) as budget"))
              ->groupBy('projects.cohort')
              ->get();


      $data = array();
      foreach ($bud_by_cohort as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartBudgetByCareer(){
      $bud_by_career = DB::table('projects')
              ->join('students','projects.student','=','students.id_student')
              ->where('projects.type','Monodisciplinario')
              ->select('students.carrer as career',DB::raw("SUM(projects.budget) as bud_career"))
              ->orderBy('career','asc')
              ->groupBy('students.carrer')
              ->get();


      $data = array();
      foreach ($bud_by_career as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
    }

    public function chartProjectsTop($type){
      $pjs_top = DB::table('projects')
              ->join('final_inform','projects.id','=','final_inform.project')
              ->where('projects.type',$type)
              ->select('projects.id as id','projects.name as name','projects.type as type','projects.team as team','projects.cohort as cohort','final_inform.direct_users as du')
              ->orderBy('final_inform.direct_users','desc')
              ->take(5)
              ->get();


      $data = array();
      foreach ($pjs_top as $row) {
      	$data[] = $row;
      }

      return Response::json($data);
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
