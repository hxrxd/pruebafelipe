<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

use App\Departament;
use App\Municipality;
use App\Gender;
use App\CivilStatus;
use App\Practice;
use App\Headquarters;
use App\Cohorte;
use App\Student;
use App\Team;
use App\Project;
use App\NumberToLetterConverter;
use App\Financing;
use App\SupervisorH;
use App\SupervisorU;
use App\Supervisor;
use App\Family;
use App\Contract;
use App\Status;
use App\Check;
use App\Log;
use App\Appraisal;
use App\PartnerRating;
use DB;
use Auth;



class SupervisorStudentController extends Controller
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
        $students = DB::table('students')
                            ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->join('cohortes','students.cohorte','=','cohortes.id')
                            ->where('teams.supervisor','=',$supervisor->id_supervisors)
                            ->where('students.status','=',1)
                            ->select('students.id_student','teams.name as team','students.carne','students.academicu','students.carrer','students.name','students.fsurname','students.ssurname','supervisors.name as supervisor','cohortes.cohorte as cohorte')
                            ->get();

        return view('supervisorstudent.index',compact('students'));
        }
        else{

            
            $students = DB::table('students')
                            ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->join('cohortes','students.cohorte','=','cohortes.id')
                            ->where('students.status','=',1)
                            ->select('students.id_student','teams.name as team','students.carne','students.academicu','students.carrer','students.name','students.fsurname','students.ssurname','supervisors.name as supervisor','cohortes.cohorte as cohorte')
                            ->get();

            return view('supervisorstudent.index',compact('students'));

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
         $studentinfo = Student::find($id);


        if($studentinfo ==null){
            Session::flash('message','Debes registrarte antes de acceder a esta función');
            return Redirect::to('/');
        }

        else{
            $id = $studentinfo->id_student;
            $student = Student::join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->join('cohortes','students.cohorte','=','cohortes.id')
                            ->join('genders','students.gender','=','genders.id')
                            ->join('practices','students.practice','=','practices.id')
                            ->join('civil_statuses','students.cstatus','=','civil_statuses.id')
                            ->where('students.id_student','=',$id)
                            ->select('students.carne','students.dpi', 'students.dpiw','students.name', 'students.fsurname', 'students.ssurname','students.email', 'genders.genders','civil_statuses.status', 'students.birthdate','students.nationality','students.carrer','students.academicu','students.personalp','students.homep','students.adressr','students.adressrw','students.initd', 'students.endd','practices.practice','headquarters.name as headquarter','teams.name as team','teams.supervisor as sup')
                            ->first();

            $supervisor = Supervisor::find($student->sup);
           
             return view('student.index',["supervisor"=>$supervisor,"student"=>$student]);
            }
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
        $cohortes = Cohorte::lists('cohorte','id');
        $municipality = Municipality::lists('municipality','id_municipality');
        $genders = Gender::lists('genders','id');
        $civilstatus = CivilStatus::lists('status','id');
        $practices = Practice::lists('practice','id');
        $headquarters = Headquarters::where('status','=','1')->orderBy('name')->lists('name','id_headquarters');
        $financings = Financing::lists('name','id_financings');
        $student = Student::find($id);
        
        return view('supervisorstudent.edit', ['student'=>$student,'municipality'=>$municipality,'genders'=>$genders,'civilstatus'=>$civilstatus,'practices'=>$practices,'headquarters'=>$headquarters,'cohortes'=>$cohortes,'financings'=>$financings]);
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
        $student = Student::find($id);
        $student->fill($request->all());
        $student->save();

        $log = [
            'desc'=>'Modificación de Estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        $student = Student::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($student->grant,'Q');
        $student->grantm = $grantm;
        $student->save();

        Log::create($log);

        Session::flash('message','Estudiante Actualizado exitosamente');
        return Redirect::to('/supervisorstudent');
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

     public function settlement($id)
    {
        //
        $studentinfo = Student::find($id);
        $appraisals = Appraisal::where('student',$studentinfo->id_student)->first();
        $partnerRating = PartnerRating::where('student',$studentinfo->id_student)->first();
        $project = Project::where('student',$studentinfo->id_student)->where('type','Monodisciplinario')->first();


         return view('supervisorstudent.view', ['studentinfo'=>$studentinfo,'appraisals'=>$appraisals,'partnerRating'=>$partnerRating,'project'=>$project]);


    }

}
