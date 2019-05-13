<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Redirect;
use DB;
use Auth;

use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use App\Supervisor;
use App\PartnerRating;

class PartnerRatingController extends Controller
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
            $partner = null;
            $partner = PartnerRating::where('student', $student->id_student)->first();
            if ($partner == null) {
                # code...
                $hq = Headquarters::find($student->headquarter);
                $team = Team::find($hq->team);
                $cohort = Cohorte::find($student->cohorte);
                $supervisor = Supervisor::find($team->supervisor);

                return view('partnerrating.create',['student'=>$student,'hq'=>$hq]);
            }
            else{
              return Redirect::to('/doitpartnerrating'); 
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
        
      
        PartnerRating::create([

            'headquarter' => $request['headquarter'],
            'student' => $request['student'],
            'space' => $request['space'],
            'desc_space' => $request['desc_space'],
            'equipment' => $request['equipment'],
            'desc_equipment' => $request['desc_equipment'],
            'location' => $request['location'],
            'community' => $request['community'],
            'team_time' => $request['team_time'],
            'capabilities' => $request['capabilities'],
            'asses_capabilities' => $request['asses_capabilities'],
            'relationship' => $request['relationship'],
            'knowledge' => $request['knowledge'],
            'transport' => $request['transport'],
            'stipend' => $request['stipend'],
            'materials' => $request['materials'],
            'trainings' => $request['trainings'],
            'permission' =>$request['permission'],
            'social_risk' => $request['social_risk'],
            'ambiental_risk' =>$request['ambiental_risk'],
            'desc_partner' =>$request['desc_partner'],

        ]);

        return view('partnerrating.doit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function doIt(){
        return view('partnerrating.doit');
    }

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
