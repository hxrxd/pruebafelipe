<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Status;
use App\Log;
use App\Student;
use App\Supervisor;

use Auth;
use DB;
use Session;
use Redirect;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $statuses = DB::table('statuses')
        //             ->join('students','statuses.student','=','students.id_student')
        //             ->join('contracts','statuses.student','=','contracts.student')
        //             ->select('statuses.id','statuses.stationery','statuses.budget','statuses.toaim1','statuses.toaim2','statuses.pay','statuses.conta','statuses.contract','students.carne','students.name','students.fsurname','students.ssurname','contracts.year','contracts.no')
        //             ->where('students.rev',"=",0)
        //                 ->get();

          $statuses = DB::table('statuses')
                    ->join('students','statuses.student','=','students.id_student')
                    ->select('statuses.id','statuses.stationery','statuses.budget','statuses.toaim1','statuses.toaim2','statuses.pay','statuses.conta','statuses.contract','students.carne','students.name','students.fsurname','students.ssurname','statuses.notice')
                    ->where('students.rev',"=",0)
                        ->get();


        

        $usuario = Auth::user()->id;
        $supervisor = Supervisor::where('iduser','=',$usuario)->get()->first();
        if (Auth::user()->rol == "Supervisor" ) {
            $statuses = DB::table('statuses')
                    ->leftjoin('students','statuses.student','=','students.id_student')
                    //->leftjoin('contracts','statuses.student','=','contracts.student')
                    ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                    ->leftjoin('teams','headquarters.team','=','teams.id_team')
                    ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                    ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                    ->where('students.rev',"=",0)
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->select('statuses.id','statuses.stationery','statuses.budget','statuses.toaim1','statuses.toaim2','statuses.pay','statuses.conta','statuses.contract','students.carne','students.name','students.fsurname','students.ssurname','statuses.notice')
                   
                        ->get();
        }

        return view('statuses.index',compact('statuses')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        $students = Student::query('students')
                        ->join('statuses','students.id_student','=','statuses.student','left outer')
                        ->select('students.carne','students.id_student')
                        ->whereNull('statuses.id')
                        ->lists('students.carne','students.id_student');

         return view('statuses.create',['students'=>$students]);

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
         Status::create([
            'student'=>$request['student'],
            'stationery'=>'0001-01-01',
            'contract'=>'0001-01-01',
            'budget'=>'0001-01-01',
            'toaim1'=>'0001-01-01',
            'toaim2'=>'0001-01-01',
            'conta'=>'0001-01-01',
            'pay'=>'0001-01-01',
            'notice'=>'',
            ]);

          Session::flash('message','Expediente creado exitosament');
        return Redirect::to('/statuses');
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

    public function massiveStatus()
    {
        return view('statuses.statusesedit');
    }

    public function updateMassiveStatus(Request $request)
    {
        $students = $request['students'];
        $date = $request['date']; 
        $type = $request['type'];
        $error = "Estudiantes con error al actualizar";
        $flag = false;

        $arrayStudents = trim(preg_replace('/\r/', ' ', $students));
        $arrayStudents = trim(preg_replace('/\r\n/', ' ', $arrayStudents));
        $arrayStudents = str_replace(' ', '', $arrayStudents);
        $arrayStudents =  explode(',',  $arrayStudents);
        
        switch ($type) {
            case 1:
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->stationery = $date;
                    $status->save();
                 }

                }

                break;
            case 2:
                # code...
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->contract = $date;
                    $status->save();
                 }

                }
                break;
            case 3:
                # code...
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->budget = $date;
                    $status->save();
                 }

                }
                break;
            case 4:
                # code...
            foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->toaim1 = $date;
                    $status->save();
                 }

                }
                break;
            case 5:
                # code...
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->toaim2 = $date;
                    $status->save();
                 }

                }
                break;
            case 6:
                # code...
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->conta = $date;
                    $status->save();
                 }

                }
                break;
            case 7:
                # code...
                foreach ($arrayStudents as $carne) {
                # code...
                $student  = DB::table('statuses')
                                                ->join('students','statuses.student','=','students.id_student')
                                                ->where('carne',$carne)
                                                ->first();
                
                if ($student == null) {
                     # code...
                    $error = $error." ".$carne.",";
                    $flag = true;

                 }
                 else{
                    $status = Status::find($student->id);
                    $status->pay = $date;
                    $status->save();
                 }

                }
                break;
            
            default:
                # code...
                $error = "La opción seleccionada no es válida";
                break;
        }

        $error = trim($error, ',');

        if ($flag == true) {
            # code...

            Session::flash('message',$error);
        }
        else{
            Session::flash('message',"Los Estudiantes fueron actualizados correctamente");
        }
        
        return Redirect::to('/statuses');




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
        $status = Status::find($id);
        return view('statuses.edit',['status'=>$status]);
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

        
        $status = Status::find($id);
        $student = Student::find($status->student);
        $status->fill($request->all());
        $status->save();
        
        $log = [
            'desc'=>'Modificación del Estado de Pago de :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Estado actualizado exitosamente');
        return Redirect::to('/statuses');
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
