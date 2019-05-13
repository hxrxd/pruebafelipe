<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
use DB;
use Auth;
use Session;
use Redirect;
use View;
use Response;
use Validator;

class PlanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('email', \Auth::user()->email)->first();
        $plans = Plan::where('student',$student->id_student)->get();
        $months = array(0=>'enero',1=>'febrero',2=>'marzo',3=>'abril',4=>'mayo',5=>'junio',6=>'julio',7=>'agosto',8=>'septiembre',9=>'octubre',10=>'noviembre',11=>'diciembre');
        $current_month = date('m');
        $first_day = date("d",strtotime($student->initd));
        $from_month = date("n",strtotime($student->initd));
        $how_many_plans = ((int)$first_day === 1)?$student->length-1:$student->length;
        //$how_many_plans_go = Plan::where('student',$student->id_student)->count();
        //$how_many_plans_should_go = abs($current_month-$student->length);
        $wich_months_missing = [];

        for($i = 0; $i < $how_many_plans; $i++){
          //array_push($wich_months_missing,$months[$from_month-1]);
          $wich_months_missing[$from_month] = $months[$from_month-1];
          ($from_month > 11)?$from_month=1:$from_month+=1;
        }

        if(!is_null($plans)){
          foreach ($plans as $plan) {
            unset($wich_months_missing[$plan->nmonth]);
          }
        }

        return view("informs.monthly_plan_index",compact('months','student','plans','current_month','from_month','how_many_plans','wich_months_missing'));
    }

    /**
     * Display a listing of the resource by filtering.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPlans()
    {
        $user = Auth::user();
        $supervisor = null;

        $username = $user->fname . ' ' . $user->lname;

        $teams = DB::table('teams')
                ->select('teams.id_team as id','teams.name as team')
                ->orderBy('teams.name','asc')
                ->get();



        if(Auth::user()->rol == "Coordinador" || Auth::user()->rol == "Admin"){
          // to do
        }else{
          $supervisor = Supervisor::where('iduser','=',$user->id)->first();

          $not_reviewed = DB::table('plan')
                    ->join('students','plan.student','=','students.id_student')
                    ->join('teams','plan.team','=','teams.id_team')
                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->where('plan.status',1)
                    ->select('plan.id as id','students.name as name','students.fsurname as fsurname','students.ssurname as lsurname','teams.name as team','plan.month as month',DB::raw("date_format(plan.updated_at,'%d/%m/%Y') as updated"),'plan.status as status')
                    ->orderBy('plan.updated_at', 'asc')
                    ->get();

          $reviewed = DB::table('plan')
                    ->join('students','plan.student','=','students.id_student')
                    ->join('teams','plan.team','=','teams.id_team')
                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->where('plan.status',2)
                    ->select('plan.id as id','students.name as name','students.fsurname as fsurname','students.ssurname as lsurname','teams.name as team','plan.month as month',DB::raw("date_format(plan.updated_at,'%d/%m/%Y') as updated"),'plan.status as status')
                    ->orderBy('plan.updated_at', 'asc')
                    ->get();

          $historial = DB::table('plan')
                    ->join('students','plan.student','=','students.id_student')
                    ->join('teams','plan.team','=','teams.id_team')
                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->where('plan.status',3)
                    ->select('plan.id as id','students.name as name','students.fsurname as fsurname','students.ssurname as lsurname','teams.name as team','plan.month as month',DB::raw("date_format(plan.updated_at,'%d/%m/%Y') as updated"),'plan.status as status')
                    ->orderBy('plan.updated_at', 'asc')
                    ->get();
        }

        return view('informs.monthly_plan_supervisor_index', compact('supervisor','reviewed','not_reviewed','historial'));
    }

    /**
     * Display a student's plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStudentPlan($id){

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
     * @param  int  $month
     * @return \Illuminate\Http\Response
     */
    public function createPlan($month)
    {
        $_month = (int)$month;
        $months = array(1=>'enero', 2=>'febrero', 3=>'marzo', 4=>'abril', 5=>'mayo', 6=>'junio', 7=>'julio',8=>'agosto', 9=>'septiembre', 10=>'octubre', 11=>'noviembre', 12=>'diciembre');
        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $plan = Plan::where('student',$student->id_student)->where('nmonth',$_month)->first();
        $year = date("Y");
        $how_many_days = date('t', strtotime("$year-$month-01"));
        $objectives_count = 0;
        $username = \Auth::user()->fname.' '.\Auth::user()->lname;
        $email_std = \Auth::user()->email;
        $supervisor = Supervisor::find($team->supervisor);
        $user_supervisor =  User::find($supervisor->iduser);
        $email_sup = $user_supervisor->email;
        $cohort = Cohorte::find($student->cohorte);
        $inform = ($_month === 11 || $_month === 12)?'Planificación':'Informe';////////////
        $first_month = date("n",strtotime($student->initd));/////////
        $first_day = date("d",strtotime($student->initd));///////////
        $report_type = ($first_day == 15 && $first_month == $_month)?"quincenal":"mensual";/////////
        $results = DB::table('results')
                ->select('results.description as description','results.id as id')
                ->where('id','!=',1)
                ->orderBy('description','asc')
                ->get();

        $objectives_suggests = DB::table('objectives_suggests')->get();

        $_month_written = array_key_exists((int)$_month,$months)?$months[$_month]:"NOT_EXISTS";

        if(is_null($plan) && $_month != 0){
          $current_month = date('m');

          if((int)$current_month === $_month){ //create an report only for current month
            $plan = Plan::create([
              'month'=>$_month_written,
              'nmonth'=>$_month,
              'student'=>$student->id_student,
              'team'=>$team->id_team,
              'cohort'=>$cohort->name,
              'user_create'=>$username,
              'user_update'=>$username,
            ]);
          }else{
            return view("informs.unavailable");
          }

        }else{
          $objective = DB::table('objectives')
                    ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                    ->join('plan','plan_objectives.plan','=','plan.id')
                    ->where('plan.id',$plan->id)
                    ->select('objectives.*')
                    ->get();

          $objectives_count = count($objective);

          $year = date("Y",strtotime($plan->created_at));
          $how_many_days = date('t', strtotime("$year-$month-01"));
        }

        return view("informs.monthly_plan_create",compact('plan','how_many_days','year','objective','objectives_count','student','username','email_std','email_sup','results','inform','report_type','objectives_suggests','first_day'));
    }

    /**
     * Show a preview of the report.
     *
     * @param  int  $month
     * @return \Illuminate\Http\Response
     */
    public function reportPreview($month)
    {
        $_month = (int)$month;
        $student = Student::where('email', \Auth::user()->email)->first();
        $report = Plan::where('student',$student->id_student)->where('nmonth',$_month)->first();

        if(!is_null($report)){
          $hq = Headquarters::find($student->headquarter);
          $team = Team::find($report->team);
          $municipality = Municipality::find($team->municipality);
          $department = Departament::find($municipality->id_departament);
          $year = date("Y",strtotime($report->created_at));
          $month = $report->nmonth;
          $how_many_days = date('t', strtotime("$year-$month-01"));
          $first_month = date("n",strtotime($student->initd));
          $first_day = date("d",strtotime($student->initd));
          $report_type = ($first_day == 15 && $first_month == $month)?"quincenal":"mensual";
          $username = \Auth::user()->fname.' '.\Auth::user()->lname;
          $supervisor = Supervisor::find($team->supervisor);
          $user_supervisor =  User::find($supervisor->iduser);
          $email_sup = $user_supervisor->email;

          $objective = DB::table('objectives')
                    ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                    ->join('plan','plan_objectives.plan','=','plan.id')
                    ->where('plan.id',$report->id)
                    ->select('objectives.*')
                    ->get();

          $objectives_count = count($objective);


          if($report->status == 0){
              return view("informs.monthly_plan_student_preview",compact('report','student','hq','team','municipality','department','year','how_many_days','objective','objectives_count','report_type','email_sup','username'));
          }else{
              return view("informs.monthly_plan_reviewed",compact('report','student','hq','team','municipality','department','year','how_many_days','objective','objectives_count','report_type','username','email_sup'));
          }


        }else{
          return view("informs.unavailable");
        }
    }

    /**
     * Show the report to correct.
     *
     * @param  int  $month
     * @return \Illuminate\Http\Response
     */
    public function reportToReview($id)
    {
        $report = Plan::find($id);
        $student = Student::find($report->student);
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($report->team);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $year = date("Y",strtotime($report->created_at));
        $month = $report->nmonth;
        $how_many_days = date('t', strtotime("$year-$month-01"));
        $first_month = date("n",strtotime($student->initd));
        $first_day = date("d",strtotime($student->initd));
        $report_type = ($first_day == 15 && $first_month == $month)?"quincenal":"mensual";
        $delivery_date = date('d/m/Y',strtotime($report->updated_at));
        $delivery_time = date('H:i',strtotime($report->updated_at));
        $email_user = \Auth::user()->email;

        $objective = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$report->id)
                  ->select('objectives.*')
                  ->get();

        $objectives_count = count($objective);

        return view("informs.monthly_plan_to_correct",compact('report','student','hq','team','municipality','department','year','how_many_days','objective','objectives_count','report_type','delivery_date','delivery_time','email_user'));
    }

    /**
     * Show the report to correct.
     *
     * @param  int  $month
     * @return \Illuminate\Http\Response
     */
    public function reportReviewed($month)
    {
        $_month = (int)$month;
        $student = Student::where('email', \Auth::user()->email)->first();
        $report = Plan::where('student',$student->id_student)->where('nmonth',$_month)->first();

        if(!is_null($report)){
          $hq = Headquarters::find($student->headquarter);
          $team = Team::find($report->team);
          $municipality = Municipality::find($team->municipality);
          $department = Departament::find($municipality->id_departament);
          $year = date("Y",strtotime($report->created_at));
          $month = $report->nmonth;
          $how_many_days = date('t', strtotime("$year-$month-01"));
          $first_month = date("n",strtotime($student->initd));
          $first_day = date("d",strtotime($student->initd));
          $report_type = ($first_day == 15 && $first_month == $month)?"quincenal":"mensual";
          $username = \Auth::user()->fname.' '.\Auth::user()->lname;
          $supervisor = Supervisor::find($team->supervisor);
          $user_supervisor =  User::find($supervisor->iduser);
          $email_sup = $user_supervisor->email;

          $objective = DB::table('objectives')
                    ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                    ->join('plan','plan_objectives.plan','=','plan.id')
                    ->where('plan.id',$report->id)
                    ->select('objectives.*')
                    ->get();

          $objectives_count = count($objective);

          if($report->status == 2){
              return view("informs.monthly_plan_reviewed",compact('report','student','hq','team','municipality','department','year','how_many_days','objective','objectives_count','report_type','username','email_sup'));
          }else{
              return view("informs.monthly_plan_student_preview",compact('report','student','hq','team','municipality','department','year','how_many_days','objective','objectives_count','report_type','email_sup','username'));
          }

        }else{
          return view("informs.unavailable");
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newPlan(Request $request)
    {
        $rules = array(
            'month'       => 'required',
            'nmonth'      => 'required',
            'team'        => 'required',
            'student'     => 'required',
            'user_create' => 'required',
            'user_update' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $p = new Plan;
            $p->month = $request->month;
            $p->nmonth = $request->nmonth;
            $p->team = $request->team;
            $p->student = $request->student;
            $p->user_create = $request->user_create;
            $p->user_update = $request->user_update;
            $p->save();

            return Response::json( $p );
        }

    }

    /**
     * Update the specified plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateExperiences(Request $request)
    {
        $plan = Plan::find($request->id);
        $plan->experiences = $request->experiences;
        $plan->updated_at = date('Y-m-d H:i:s');
        $plan->save();

        return Response::json($plan);
    }

    /**
     * Update the experiences corrections of specified plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateExperiencesCorrections(Request $request)
    {
        $plan = Plan::find($request->id);
        $plan->experiences_corrections = $request->experiences;
        $plan->save();

        return Response::json($plan);
    }

    /**
     * Update the status of specified plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $plan = Plan::find($request->id);
        $plan->status = $request->status;
        $plan->updated_at = date('Y-m-d H:i:s');
        $plan->save();

        return Response::json($plan);
    }

    /**
     * Update the validated status of specified plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateValidateStatus(Request $request)
    {
        $plan = Plan::find($request->id);
        $plan->validated = $request->validated;
        $plan->updated_at = date('Y-m-d H:i:s');
        $plan->save();

        return Response::json($plan);
    }

    /**
     * Download the report as docx
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadReport($id)
    {
        $report = Plan::find($id);
        $student = Student::find($report->student);
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($report->team);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $year = date("Y",strtotime($report->created_at));
        $month = $report->nmonth;
        $how_many_days = date('t', strtotime("$year-$month-01"));
        //$objectives_count = Objective::where('plan',$report->id)->count();
        $first_month = date("n",strtotime($student->initd));
        $first_day = date("d",strtotime($student->initd));
        $report_type = ($first_day == 15 && $first_month == $month)?"quincenal":"mensual";
        $delivery_date = date('d/m/Y',strtotime($report->updated_at));
        $delivery_time = date('H:i',strtotime($report->updated_at));
        $email_user = \Auth::user()->email;
        $supervisor_hq = SupervisorH::where('student',$student->id_student)->first();
        $practice = "";

        switch ($student->practice) {
          case 1:
            $practice = "EPS";
            break;
          case 2:
            $practice = "PPS";
            break;
          case 3:
            $practice = "EDC";
            break;
          case 4:
            $practice = "PBP";
            break;
          default:
            break;
        }

        $nc = DB::table('contracts')
                  ->join('students','contracts.student','=','students.id_student')
                  ->where('students.id_student','=',$student->id_student)
                  ->select('id_contracts as id','no as contract_number')
                  ->first();

        $objectives = DB::table('objectives')
                  ->join('plan_objectives','objectives.id','=','plan_objectives.objective')
                  ->join('plan','plan_objectives.plan','=','plan.id')
                  ->where('plan.id',$report->id)
                  ->select('objectives.*')
                  ->get();


        $document = new \PhpOffice\PhpWord\TemplateProcessor('doc/informe-mensual-tmp.docx');
        $document->setValue('nc',($nc === null)?'':$nc->contract_number);
        $document->setValue('headquarter',$hq->name);
        $document->setValue('municipality',$municipality->municipality);
        $document->setValue('department',$department->departament);
        $document->setValue('report_type',$report_type);
        $document->setValue('first_day',($report_type == "mensual")?1:15);
        $document->setValue('last_day',$how_many_days);
        $document->setValue('mm',$report->month);
        $document->setValue('yy',$year);
        $document->setValue('student_name',$student->name.' '.$student->fsurname.' '.$student->ssurname);
        $document->setValue('career',$student->carrer);
        $document->setValue('carne',$student->carne);
        $document->setValue('academic_u',$student->academicu);
        $document->setValue('report_type_up',strtoupper($report_type));
        $document->setValue('period',($report_type=="mensual")?"el mes":"la quincena");
        $document->setValue('experiences',str_replace("\n","</w:t><w:br/><w:t>",$report->experiences));
        $document->setValue('practice',$practice);
        $document->setValue('supervisor_hq',$supervisor_hq->name);
        $document->setValue('supervisor_charge',$supervisor_hq->place);

        $document->cloneRow('objective', count($objectives));

        for($i =0;$i<count($objectives);$i++) {
          $document->setValue('objective#'.($i+1).'',$objectives[$i]->objective);
          $document->setValue('results#'.($i+1).'',str_replace("\n","</w:t><w:br/><w:t>",$objectives[$i]->results));
          $document->setValue('activities#'.($i+1).'',str_replace("\n","</w:t><w:br/><w:t>",$objectives[$i]->activities));
          $document->setValue('hits#'.($i+1).'',$objectives[$i]->hits);
          $document->setValue('failures#'.($i+1).'',$objectives[$i]->failures);
        }

        $filename = 'informe-'.$report->month.'-'.$year.'-'.$student->carne.'.docx';

        $document->saveAs($filename);
        header("Content-Disposition: attachment; filename=".$filename."; charset=iso-8859-1");
        readfile($filename);
        unlink($filename);

        //For PDF
        /*$reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $dirpath = dirname(dirname($reflection->getFileName()));

        \PhpOffice\PhpWord\Settings::setPdfRendererPath($dirpath.'/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        $fp = str_replace('vendor','public/'.$filename,$dirpath);

        //Load temp file
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filename);

        //Save it
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
        $xmlWriter->save('informe.pdf');*/
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
