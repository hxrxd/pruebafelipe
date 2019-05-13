<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Redirect;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use App\Supervisor;
use App\Appraisal;


class AppraisalsController extends Controller
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
    public function create()
    {
        //
        $student = null;
        $student = Student::where('email', \Auth::user()->email)
                                ->first();

        
        if($student ==null){
            Session::flash('message','Debes realizar tu eps antes de acceder a esta función');
            return Redirect::to('/');
        }
        else{
            $appraisal = null;
            $appraisal = Appraisal::where('student', $student->id_student)->first();
            if ($appraisal == null) {
                # code...
                $hq = Headquarters::find($student->headquarter);
                $team = Team::find($hq->team);
                $supervisor = Supervisor::find($team->supervisor);
                return view('appraisals.create',['student'=>$student,'supervisor'=>$supervisor]);
            }
            else{
              return Redirect::to('/doitappraisal'); 
            }
            
        }

        return Redirect::to('/');
        
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
        $student = Student::find($request['student']);
        $supervisor = $request['supervisor'];
        $edge = $this->calcularEdad($student->birthdate);


        Appraisal::create([
                'student'=>$request['student'],
                'age'=>$edge,
                'supervisor'=>$supervisor,
                'journey'=>$request['journey'],
                'civil_status'=>$request['civil_status'],
                'economic_activity'=>$request['economic_activity'],
                'comunication'=>$request['comunication'],
                'desc_comunication'=>$request['desc_comunication'],
                'type_comunication'=>$request['type_comunication'],
                'lapse_comunication'=>$request['lapse_comunication'],
                'understandable_comunication'=>$request['understandable_comunication'],
                'respect_communication'=>$request['respect_communication'],
                'fulfillment'=>$request['fulfillment'],
                'assess_comunication'=>$request['assess_comunication'],
                'accompaniment'=>$request['accompaniment'],
                'interest'=>$request['interest'],
                'assess_advisory'=>$request['assess_advisory'],
                'type_advisory'=>$request['type_advisory'],
                'resolution'=>$request['resolution'],
                'assess_accompaniment'=>$request['assess_accompaniment'],
                'assess_mono'=>$request['assess_mono'],
                'assess_convivencia'=>$request['assess_convivencia'],
                'assess_multi'=>$request['assess_multi'],
                'assess_wp'=>$request['assess_wp'],
                'assess_dx'=>$request['assess_dx'],
                'respect'=>$request['respect'],
                'understandable'=>$request['understandable'],
                'cooperation'=>$request['cooperation'],
                'amiability'=>$request['amiability'],
                'assess_supervisor'=>$request['assess_supervisor'],
                'complaint'=>$request['complaint'],
                'desc_appraisals'=>$request['desc_appraisals'],
                'name_student'=>$request['name_student'],
        ]);

        return view('appraisals.doit');

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

    public function doIt(){
        return view('appraisals.doit');
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

     function calcularEdad($fecha_nacimiento) { 
        $tiempo = strtotime($fecha_nacimiento); 
        $ahora = time(); 
        $edad = ($ahora-$tiempo)/(60*60*24*365.25); 
        $edad = intval($edad); 
        return $edad; 
    } 


    
}
