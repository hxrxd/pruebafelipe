<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SupervisorH;
use App\SupervisorU;
use App\Family;
use App\Student;
use App\Status;
use Session;
use Redirect;



class ReferenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('student.reference');
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
        $student = Student::where('email', \Auth::user()->email)
                                ->first();

        Family::create([
                'name'=>$request['namep'],
                'phone'=>$request['phonep'],
                'relationship'=>"Padre",
                'student'=>$student->id_student,
            ]);

         Family::create([
                'name'=>$request['namem'],
                'phone'=>$request['phonem'],
                'relationship'=>"Madre",
                'student'=>$student->id_student,
            ]);

         SupervisorU::create([
                'name'=>$request['nameu'],
                'phone'=>$request['phoneu'],
                'email'=>$request['emailu'],
                'academic'=>$student->academicu,
                'student'=>$student->id_student,
            ]);

         SupervisorH::create([
                'name'=>$request['nameh'],
                'phone'=>$request['phoneh'],
                'email'=>$request['emailh'],
                'place'=>$request['place'],
                'student'=>$student->id_student,
            ]);

            Status::create([
            'student'=>$student->id_student,
            'stationery'=>'0001-01-01',
            'contract'=>'0001-01-01',
            'budget'=>'0001-01-01',
            'toaim1'=>'0001-01-01',
            'toaim2'=>'0001-01-01',
            'conta'=>'0001-01-01',
            'pay'=>'0001-01-01',

            ]);


        

        Session::flash('message','Registro Exitoso, Gracias por completar los campos requeridos');
        return Redirect::to('/');
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

    public function editPadre(){
        $student = Student::where('email', \Auth::user()->email)->first();
        $padre = Family::where('student', $student->id_student)->where('relationship','Padre')->first();

        if($padre == null){

             Family::create([
                'name'=>'',
                'phone'=>'',
                'relationship'=>"Padre",
                'student'=>$student->id_student,
            ]);

         }

        $padre = Family::where('student', $student->id_student)->where('relationship','Padre')->first();

         return view('student.padre', compact('padre'));       


    }

    public function editMadre(){
        $student = Student::where('email', \Auth::user()->email)->first();
        $madre = Family::where('student', $student->id_student)->where('relationship','Madre')->first();

        if($madre ==null){

              Family::create([
                'name'=>'',
                'phone'=>'',
                'relationship'=>"Madre",
                'student'=>$student->id_student,
            ]);
            
         }

          $madre = Family::where('student', $student->id_student)->where('relationship','Madre')->first();

           return view('student.madre', compact('madre'));       

    }

    public function editSupervisorU(){
        $student = Student::where('email', \Auth::user()->email)->first();
        $supervisoru = SupervisorU::where('student', $student->id_student)->first();
            
        if($supervisoru ==null){

             SupervisorU::create([
                'name'=>'',
                'phone'=>'',
                'email'=>'',
                'academic'=>$student->academicu,
                'student'=>$student->id_student,
            ]);
            
         }

         $supervisoru = SupervisorU::where('student', $student->id_student)->first();

          return view('student.supervisoru', compact('supervisoru'));       
        

    }

    public function editSupervisorH(){
        $student = Student::where('email', \Auth::user()->email)->first();
        $supervisorh = SupervisorH::where('student', $student->id_student)->first();

        if($supervisorh ==null){

            SupervisorH::create([
                'name'=>'',
                'phone'=>'',
                'email'=>'',
                'place'=>'',
                'student'=>$student->id_student,
            ]);
            
         }

         $supervisorh = SupervisorH::where('student', $student->id_student)->first();

          return view('student.supervisorh', compact('supervisorh'));       

        

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function updateP(Request $request, $id)
    {
        //
        $padre = Family::find($id);
        $padre->fill($request->all());
        $padre->save();

         Session::flash('message','Actualización exitosa');
        return Redirect::to('/');

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateM(Request $request, $id)
    {
        //
        $madre = Family::find($id);
        $madre->fill($request->all());
        $madre->save();

         Session::flash('message','Actualización exitosa');
        return Redirect::to('/');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSU(Request $request, $id)
    {
        //
        $supervisoru = SupervisorU::find($id);
        $supervisoru->fill($request->all());
        $supervisoru->save();

         Session::flash('message','Actualización exitosa');
        return Redirect::to('/');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSH(Request $request, $id)
    {
        //

        $supervisorh = SupervisorH::find($id);
        $supervisorh->fill($request->all());
        $supervisorh->save();

         Session::flash('message','Actualización exitosa');
        return Redirect::to('/');



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
