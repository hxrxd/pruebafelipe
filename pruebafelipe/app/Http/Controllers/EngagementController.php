<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Departament;
use App\Municipality;
use App\Gender;
use App\CivilStatus;
use App\Practice;
use App\Headquarters;
use App\Cohorte;
use App\Student;
use App\Team;
use App\NumberToLetterConverter;
use App\NumberToLetterConverterAge;
use App\NumberToLetterConverterDate;
use App\Financing;
use App\SupervisorH;
use App\SupervisorU;
use App\Family;
use App\Contract;
use App\Agreement;
use App\Log;
use App\Receipt;
use App\Engagement;
use DB;
use Session;
use Redirect;
use Auth;

class EngagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $engagements = DB::table('engagements')
                        ->join('students','engagements.student','=','students.id_student')
                        ->join('agreement','engagements.agreement','=','agreement.id_agreement')
                        ->select('students.name','students.fsurname','students.carne','agreement.agreement_n','engagements.id_engagement','engagements.year','engagements.id_engagement','engagements.no')
                        ->where('students.rev',"=",0)
                        ->get();


        return view('engagement.indext',['engagements'=>$engagements]);


    }

    public function inicio($id){
         
        $contract = Contract::find($id);
        $student =Student::find($contract->student);


        $engagements = DB::table('engagements')
                        ->where('contract','=',$contract->id_contracts)
                        ->get();


        return view('engagement.index',['contract'=>$contract,'engagements'=>$engagements,'student'=>$student]);

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

    public function createE($id){
        $contract = Contract::find($id);
        $id_student = $contract->student;
        $student = Student::find($id_student);
        $financing = Financing::find($student->financing);
        $cohorte = Cohorte::find($student->cohorte);
        $agreements = Agreement::lists('agreement_n','id_agreement');;
        return view('engagement.create',['student'=>$student,'agreements'=>$agreements,'financing'=>$financing,'cohorte'=>$cohorte,'contract'=>$contract]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $converter = new NumberToLetterConverter();
        $grant =$request['grant']; 
        $grantm = $converter->to_word($grant,'Q');
        $student = Student::find($request['student']);
        $engagements = Engagement::where('year',date("Y"))->orderBy('no')->get();
        $lastengagement = $engagements->last();
        if ($lastengagement == null) {
            $no = 1;
        }
        else{
            $no = $lastengagement->no +1;
        }


        Engagement::create([
                'no'=>$no,
                'year'=>date("Y"),
                'student'=>$request['student'],
                'agreement'=>$request['agreement'],
                'initd'=>$request['initd'],
                'date2'=>$request['date2'],
                'date3'=>$request['date3'],
                'date4'=>$request['date4'],
                'date5'=>$request['date5'],
                'endd'=>$request['endd'],
                'length'=>$request['length'],
                'grant'=>$grant,
                'grantm'=>$grantm,
                'payments'=>$request['payments'],
                'contract'=>$request['contract'],
            ]);

        $contract = Contract::find($request['contract']);
        $contract->date2 = $request['date2'];
        $contract->date3 = $request['date3'];
        $contract->date4 = $request['date4'];
        $contract->date5 = $request['date5'];
        $contract->save();
        $log = [
            'desc'=>'Creacion de Gestion del estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);
        $engagements = Engagement::where('year',date("Y"))->orderBy('no')->get();
        $lastengagement = $engagements->last();
        $id = $lastengagement->id_engagement;

        Session::flash('message','Gestion creado exitosamente');

        return Redirect::to('gengagement/'.$id.'/download');

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
        $engagements = Engagement::find($id);
        $contract = Contract::find($engagements->contract);
        $student = Student::find($contract->student);
        $agreements = Agreement::lists('agreement_n','id_agreement');;
        return view('engagement.edit',['engagements'=>$engagements,'student'=>$student,'agreements'=>$agreements,'contract'=>$contract]);
    
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
        $student = Student::find($request['student']);
        $engagement = Engagement::find($id);

        $contract = Contract::find($engagement->contract);
        $contract->date2 = $request['date2'];
        $contract->date3 = $request['date3'];
        $contract->date4 = $request['date4'];
        $contract->date5 = $request['date5'];
        $contract->save();

        $engagement->fill($request->all());
        $engagement->save();

        $contract = Contract::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($contract->grant,'Q');
        $contract->grantm = $grantm;
        $contract->save();

        $engagement = Engagement::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($engagement->grant,'Q');
        $engagement->grantm = $grantm;
        $engagement->save();


        $log = [
            'desc'=>'Modificación del Contrato y Gestion :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Contrato actualizado exitosamente');
        return Redirect::to('/contract');
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
