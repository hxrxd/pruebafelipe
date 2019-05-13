<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Receipt;
use App\Student;
use App\Supervisor;
use App\Check;
use App\Log;
use App\Status;

use DB;
use Session;
use Redirect;
use Auth;
use Mail;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

         $check = DB::table('checks')
                        ->leftjoin('students','checks.student','=','students.id_student')
                        ->leftjoin('receipts','checks.receipt','=','receipts.id_receipts')
                        ->get();

        $usuario = Auth::user()->id;
        $supervisor = Supervisor::where('iduser','=',$usuario)->get()->first();
        if (Auth::user()->rol == "Supervisor" ) {
             $check = DB::table('checks')
                        ->leftjoin('students','checks.student','=','students.id_student')
                        ->leftjoin('receipts','checks.receipt','=','receipts.id_receipts')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                        ->where('teams.supervisor','=',$supervisor->id_supervisors)
                        ->select('students.carne', 'students.name', 'students.fsurname', 'students.ssurname', 'receipts.no', 'receipts.year','receipts.grant', 'checks.nocheck','checks.datein','checks.datepay','checks.dateout', 'checks.id_check','checks.desc')
                        ->get();
        } 
     

           
 
         
        return view('check.inicio',['check'=>$check]);
      
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio($id)
    {
        //
         $receipt = Receipt::find($id);
         $student = Student::find($receipt->student);

         $check = DB::table('checks')
                        ->where('receipt','=',$receipt->id_receipts)
                        ->get();



        return view('check.index',['receipt'=>$receipt,'check'=>$check,'student'=>$student]);
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




    public function createP($id){

        $receipt = Receipt::find($id);
        $student = Student::find($receipt->student);
        return view('check.create',['receipt'=>$receipt,'student'=>$student]);
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
        $receipt = $request['receipt'];
        $student = $request['student']; 
        $nocheck = $request['nocheck'];
        $studentReg = Student::find($request['student']);
        $grant =$request['grant']; 
        $noreceipt = $request['no']."-".$request['year'];
        $datein = $request['datein'];
        $desc = $noreceipt;
        Check::create([
                
                'receipt'=>$receipt,
                'student'=>$student,
                'nocheck'=>$nocheck,
                'grant'=>$grant,
                'datein'=>$datein,
                'datepay'=>'0001-01-01',
                'dateout'=>'0001-01-01',
                'desc'=>$desc,


        ]);

        Status::where('student', $student )
            ->update(['pay' =>  $datein]);

        $studentinfo = Student::where('id_student',$student)
                                ->first();

        Mail::send('emails.newcheck',$request->all(), function($msj) use ($studentinfo){
            $msj->subject('[EPSUM] Cheque listo para recoger');
            $msj->to($studentinfo->email);

        });

        $log = [
            'desc'=>'Creacion de Cheque del estudiante :'.$studentReg->carne. ' de numero '.$nocheck ,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Cheque creado exitosamente');
        return Redirect::to('/pays');
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
        $check = Check::find($id);
        return view('check.edit',['check'=>$check]);

    }

    public function massiveEdit()
    {
        //
        
        return view('check.masiveedit');

    }

    public function updateMassiveEdit(Request $request)
    {
        //
        $checks = $request['checks'];
        $date = $request['date']; 
        $type = $request['type'];
        $error = "Cheques con error al actualizar";
        $flag = false;

        $arraychecks = trim(preg_replace('/\r/', ' ', $checks));
        $arraychecks = trim(preg_replace('/\r\n/', ' ', $arraychecks));
        $arraychecks = str_replace(' ', '', $arraychecks);
        $arraychecks =  explode(',',  $arraychecks);
       
        if ($type == 1){
            // cheques entregados
            foreach ($arraychecks as $nocheck) {
                # code...
                 $check = Check::where('nocheck',$nocheck)->first();

                 if ($check == null) {
                     # code...
                    $error = $error." ".$nocheck.",";
                     $flag = true;
                 }
                 else{
                    $check->datepay = $date;
                    $check->save();
                 }

            }
        }

        if ($type == 2){
            // cheques entregados
            foreach ($arraychecks as $nocheck) {
                # code...
                 $check = Check::where('nocheck',$nocheck)->first();
                 if ($check == null) {
                     # code...
                    $error = $error." ".$nocheck.",";
                    $flag = true;
                 }
                 else{
                    $check->dateout = $date;
                    $check->save();
                 }
                 
                 

            }
        }

        $error = trim($error, ',');
        if ($flag == true) {
            # code...
            Session::flash('message',$error);
        }
        else{
            Session::flash('message',"Los cheques fueron actualizados correctamente");
        }
        Session::flash('message',$error);
        
        return Redirect::to('/check');


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
        $check = Check::find($id);
        $check->fill($request->all());
        $check->save();

         $log = [
            'desc'=>'Modificación del cheque:'.$check->nocheck,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Cheque actualizado exitosamente');
        
        return Redirect::to('/check');
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
