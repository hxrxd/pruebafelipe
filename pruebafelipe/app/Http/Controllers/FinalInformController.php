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
use App\FinalInform;
use App\Diagnostic;
use DB;
use Auth;
use Session;
use Redirect;
use Response;
use View;

class FinalInformController extends Controller
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
    public function create(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function toInform($type)
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
        $ty;
        $lines = DB::table('interv_lines')->lists('name','id');

        switch ($type) {
          case 1:
            $idpj = 1;
            $ty = "Multidisciplinario";
            $pj = Project::where('team',$team->id_team)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Multidisciplinario')
                ->where('status',0)
                ->first();

            Session::put('idpj', $idpj);
            Session::put('pj', $pj);

            if($pj == null){
                return view('informs.no_inform', compact('idpj'));
            }else{
                $final = DB::table('final_inform')
                    ->where('project',$pj->id)
                    ->first();
                if($final == null){
                    return view('informs.final_inform', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
                }else{
                    $allWorkplans = DB::table('workplans')
                            ->where('workplans.project',Session::get('pj')->id)
                            ->get();

                    $line = DB::table('interv_lines')->where('id',Session::get('pj')->line)->first();
                    return view('informs.inform', compact('final','allWorkplans','line','ty'));
                }
            }

            break;
          case 2:
            $idpj = 2;
            $ty = "Monodisciplinario";
            $pj = Project::where('student',$student->id_student)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Monodisciplinario')
                ->where('status',0)
                ->first();
            Session::put('idpj', $idpj);
            Session::put('pj', $pj);

            if($pj == null){
                return view('informs.no_inform', compact('idpj'));
            }else{
                $final = DB::table('final_inform')
                    ->where('project',$pj->id)
                    ->first();
                if($final == null){
                    return view('informs.final_inform', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
                }else{
                    $allWorkplans = DB::table('workplans')
                            ->where('workplans.project',Session::get('pj')->id)
                            ->get();

                    $line = DB::table('interv_lines')->where('id',Session::get('pj')->line)->first();
                    return view('informs.inform', compact('final','allWorkplans','line','ty'));
                }
            }

            break;
          case 3:
            $idpj = 3;
            $ty = "Convivencia";
            $pj = Project::where('team',$team->id_team)
                ->where('cohort','like','%'.$cohort_str.'%')
                ->where('type','Convivencia')
                ->where('status',0)
                ->first();
            Session::put('idpj', $idpj);
            Session::put('pj', $pj);

            if($pj == null){
                return view('informs.no_inform', compact('idpj'));
            }else{
                $final = DB::table('final_inform')
                    ->where('project',$pj->id)
                    ->first();
                if($final == null){
                    return view('informs.final_inform', compact('hq','team','cohort','municipality','department','lines','ty','idpj'));
                }else{
                    $allWorkplans = DB::table('workplans')
                            ->where('workplans.project',Session::get('pj')->id)
                            ->get();

                    $line = DB::table('interv_lines')->where('id',Session::get('pj')->line)->first();
                    return view('informs.inform', compact('final','allWorkplans','line','ty'));
                }
            }

            break;
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
        $final = FinalInform::create([
          'methodology'=>$request['methodology'],
          'direct_users'=>$request['direct_users'],
          'indirect_users'=>$request['indirect_users'],
          'project'=>$request['project'],
        ]);

        $student = Student::where('email', \Auth::user()->email)->first();
        $hq = Headquarters::find($student->headquarter);
        $team = Team::find($hq->team);
        $cohort = Cohorte::find($student->cohorte);
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $cohort_str = substr($cohort->cohorte,0,14);
        $username = $student->name . ' ' . $student->fsurname;
        $idpj = 0;
        $ty;
        $lines = DB::table('interv_lines')->lists('name','id');

        switch(Session::get('idpj')){
          case 1:
            $ty = "Multidisciplinario";
            break;
          case 2:
            $ty = "Monodisciplinario";
            break;
          case 3:
            $ty = "Convivencia";
            break;
        }

        $allWorkplans = DB::table('workplans')
                ->where('workplans.project',Session::get('pj')->id)
                ->get();

        $line = DB::table('interv_lines')->where('id',Session::get('pj')->line)->first();

        return view('informs.inform', compact('final','allWorkplans','line','idpj','team','ty'));
    }

    public function getReport(){
        $final = FinalInform::where('project',Session::get('pj')->id)->first();
        $team = Team::where('id_team',Session::get('pj')->team)->first();
        $municipality = Municipality::find($team->municipality);
        $department = Departament::find($municipality->id_departament);
        $allWorkplans = DB::table('workplans')
                ->where('workplans.project',Session::get('pj')->id)
                ->get();

        $line = DB::table('interv_lines')->where('id',Session::get('pj')->line)->first();

        $pdf = \PDF::loadView('report.summary', compact('final','allWorkplans','team','line','municipality','department'));

        //return $pdf->download('results.pdf');
        return $pdf->stream();
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
