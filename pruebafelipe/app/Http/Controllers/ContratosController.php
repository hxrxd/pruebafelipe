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

use DB;
use Session;
use Redirect;
use Auth;

class ContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contracts = DB::table('contracts')
                        ->join('students','contracts.student','=','students.id_student')
                        ->join('agreement','contracts.agreement','=','agreement.id_agreement')
                        ->select('students.name','students.fsurname','students.carne','agreement.agreement_n','contracts.id_contracts','contracts.year','contracts.id_contracts','contracts.no')
                        ->where('students.rev',"=",0)
                        ->get();

        return view('contract.index',compact('contracts'));
        
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
        $converter = new NumberToLetterConverter();
        $grant =$request['grant']; 
        $grantm = $converter->to_word($grant,'Q');
        $student = Student::find($request['student']);
        $contracts = Contract::where('year',date("Y"))->orderBy('no')->get();
        $lastcontract = $contracts->last();
        if ($lastcontract == null) {
            $no = 1;
        }
        else{
            $no = $lastcontract->no +1;
        }


        Contract::create([
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
            ]);
        $log = [
            'desc'=>'Creacion de Contrato del estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Contrato creado exitosamente');
        return Redirect::to('/contract');
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
        $contract = Contract::find($id);
        $student = Student::find($contract->student);
        $agreements = Agreement::lists('agreement_n','id_agreement');;
        return view('contract.edit',['student'=>$student,'agreements'=>$agreements,'contract'=>$contract]);
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
        $contract = Contract::find($id);
        $contract->fill($request->all());
        $contract->save();

        $contract = Contract::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($contract->grant,'Q');
        $contract->grantm = $grantm;
        $contract->save();


        $log = [
            'desc'=>'Modificación del Contrato :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Contrato actualizado exitosamente');
        return Redirect::to('/contract');

    }

    public function findStudent()
    {    
        //un solo contrato por estudiante
        $students = Student::query('students')
                        ->join('contracts','students.id_student','=','contracts.student','left outer')
                        ->select('students.carne','students.id_student')
                        ->whereNull('contracts.id_contracts')
                        ->lists('students.carne','students.id_student');


        //varios contratos por estudiante
        $students1 = Student::lists('carne','id_student'); 

        return view('contract.student',compact('students'));
    }

    public function createContract(Request $request){
        $id_student = $request->student;
        $student = Student::find($id_student);
        $financing = Financing::find($student->financing);
        $cohorte = Cohorte::find($student->cohorte); 
        $agreements = Agreement::where('agreement_n','like','%2019')->lists('agreement_n','id_agreement');
        return view('contract.create',['student'=>$student,'agreements'=>$agreements,'financing'=>$financing,'cohorte'=>$cohorte]);
    }

    public function getContrato1(){
        $student = Student::where('email', \Auth::user()->email)
                                ->first();
        $contract = Contract::where('student',$student->id_student)
                                ->where('year',date('Y'))
                                ->get()
                                ->last();
        $converter = new NumberToLetterConverter();

        
        $initd = new \DateTime($student->initd);
        $endd = new \DateTime($student->endd);


        $h = Headquarters::find($student->headquarter);
        $t = Team::find($h->team);
        
        $pay = $converter->to_word($student->length,'dpi');
        $f = Financing::find($student->financing);
        //Equipo
        $m = Municipality::find($t->municipality);
        $d = Departament::find($m->id_departament);
         //Domicilio
        $md = Municipality::find($student->municipalityr);
        $dd = Departament::find($md->id_departament);

        $a = Agreement::find($contract->agreement);
        $p = Practice::find($student->practice);
        $cs = CivilStatus::find($student->cstatus);

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/contrato1-30.docx');

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('practice',mb_strtoupper($p->practice,'utf-8'));
        $templateWord->setValue('datew',$a->date_w);
        $templateWord->setValue('name',mb_strtoupper($student->name,'utf-8'));
        $templateWord->setValue('fsurname',mb_strtoupper($student->fsurname,'utf-8'));
        $templateWord->setValue('ssurname',mb_strtoupper($student->ssurname,'utf-8'));

        $templateWord->setValue('namel',$student->name);
        $templateWord->setValue('fsurnamel',$student->fsurname);
        $templateWord->setValue('ssurnamel',$student->ssurname);

        $templateWord->setValue('age', $this->calculaedad($student->birthdate));
        $templateWord->setValue('nationality',$student->nationality);
        $templateWord->setValue('statusc',$cs->status);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adressw',$student->adressrw);
        $templateWord->setValue('municipalityr',$md->municipality);
        $templateWord->setValue('departamentr',$dd->departament);
        $templateWord->setValue('dpiw',$student->dpiw);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('grantm',mb_strtoupper($student->grantm,'utf-8'));
        $templateWord->setValue('grant',number_format($student->grant,2, '.', ','));
        $templateWord->setValue('headquarter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departament',$d->departament);
        $templateWord->setValue('agreement_w',$a->agreement_w);
        $templateWord->setValue('date_w',$a->date_w);
        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('itemw',$f->itemw);
        $templateWord->setValue('paymentsw',$pay);
        $templateWord->setValue('length',$student->length);
        $templateWord->setValue('initd',$initd->format('d/m/Y'));
        $templateWord->setValue('endd',$endd->format('d/m/Y'));
        $templateWord->setValue('yearw',$converter->to_word($initd->format('Y'),'dpi'));

        //Fechas
        $templateWord->setValue('initdw', $this->dateToWord($initd));
        $templateWord->setValue('enddw',$this->dateToWord($endd));

        $templateWord->setValue('initds',$initds->format('d/m/Y'));
        $templateWord->setValue('endds',$endds->format('d/m/Y'));

        $templateWord->setValue('initdsw', $this->dateToWord($initds));
        $templateWord->setValue('enddsw',$this->dateToWord($endds));

        $templateWord->saveAs('Contrato.docx');
        header("Content-Disposition: attachment; filename=Contrato.docx; charset=iso-8859-1");

        readfile('Contrato.docx');
    

    }

    

    public function getContrato15(){
         $student = Student::where('email', \Auth::user()->email)
                                ->first();
        $contract = Contract::where('student',$student->id_student)
                                ->where('year',date('Y'))
                                ->get()
                                ->last();
        $converter = new NumberToLetterConverter();

        
        $initd = new \DateTime($student->initd);
        $date2  = $initd;

        $date5 = $endd; 
        $endd = new \DateTime($student->endd);


        $monthi = strftime("%B", date_timestamp_get($initd));
        $yeari = $initd->format('Y');

        $monthl = strftime("%B", date_timestamp_get($endd));
        $yearl = $endd->format('Y');


        $string1 = "last day of ".$monthi." ".$yeari;
        $string2 = "first day of ".$monthl." ".$yearl;

        $date2->modify($string1);
        $date5->modify($string2);

        $date3 = $date2;
        $date3a = strtotime('+1 day',strtotime($date3->format('Y-m-d')));
        $date3 = new \DateTime(date('Y-m-d',$date3a));

        $date4 = $date5;
        $date4b = strtotime('-1 day',strtotime($date4->format('Y-m-d')));
        $date4 = new \DateTime(date('Y-m-d',$date4b));

        
       
        
        $h = Headquarters::find($student->headquarter);
        $t = Team::find($h->team);
        
        $pay = $converter->to_word($student->payments,'dpi');
        $f = Financing::find($student->financing);
        //Equipo
        $m = Municipality::find($t->municipality);
        $d = Departament::find($m->id_departament);
         //Domicilio
        $md = Municipality::find($student->municipalityr);
        $dd = Departament::find($md->id_departament);

        $a = Agreement::find($contract->agreement);
        $p = Practice::find($student->practice);
        $cs = CivilStatus::find($student->cstatus);

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/contrato15-15.docx');

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('practice',mb_strtoupper($p->practice,'utf-8'));
        $templateWord->setValue('datew',$a->date_w);
        $templateWord->setValue('name',mb_strtoupper($student->name,'utf-8'));
        $templateWord->setValue('fsurname',mb_strtoupper($student->fsurname,'utf-8'));
        $templateWord->setValue('ssurname',mb_strtoupper($student->ssurname,'utf-8'));

        $templateWord->setValue('namel',$student->name);
        $templateWord->setValue('fsurnamel',$student->fsurname);
        $templateWord->setValue('ssurnamel',$student->ssurname);

        $templateWord->setValue('age', $this->calculaedad($student->birthdate));
        $templateWord->setValue('nationality',$student->nationality);
        $templateWord->setValue('statusc',$cs->status);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adressw',$student->adressrw);
        $templateWord->setValue('municipalityr',$md->municipality);
        $templateWord->setValue('departamentr',$dd->departament);
        $templateWord->setValue('dpiw',$student->dpiw);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('grantm',mb_strtoupper($student->grantm,'utf-8'));
        $templateWord->setValue('grant',number_format($student->grant,2, '.', ','));
        $templateWord->setValue('headquarter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departament',$d->departament);
        $templateWord->setValue('agreement_w',$a->agreement_w);
        $templateWord->setValue('date_w',$a->date_w);
        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('itemw',$f->itemw);
        $templateWord->setValue('paymentsw',$pay);
        $templateWord->setValue('length',$student->length);
        $templateWord->setValue('initd',$initd->format('d/m/Y'));
        $templateWord->setValue('endd',$endd->format('d/m/Y'));

        $templateWord->setValue('date2',$initd->format('d/m/Y'));
        $templateWord->setValue('date3',$endd->format('d/m/Y'));

        $templateWord->setValue('date4',$initd->format('d/m/Y'));
        $templateWord->setValue('date5',$endd->format('d/m/Y'));
        $templateWord->setValue('yearw',$converter->to_word($initd->format('Y'),'dpi'));

        //Fechas
        $templateWord->setValue('initdw', $this->dateToWord($initd));
        $templateWord->setValue('enddw',$this->dateToWord($endd));

        $templateWord->setValue('date2w', $this->dateToWord($date2));
        $templateWord->setValue('date3w',$this->dateToWord($date3));

        $templateWord->setValue('date4w', $this->dateToWord($date4));
        $templateWord->setValue('date5w',$this->dateToWord($date5));

        $payl = ($contract->payments)-2;

        $templateWord->setValue('paymentslessw', $converter->to_word($payl,'dpi'));

        $templateWord->saveAs('Contrato.docx');
        header("Content-Disposition: attachment; filename=Contrato.docx; charset=iso-8859-1");

        readfile('Contrato.docx');

        
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

    function calculaedad($date){
        $date2 = date('Y-m-d');//
        $diff = abs(strtotime($date2) - strtotime($date));
        $years = floor($diff / (365*60*60*24));

        $converter = new NumberToLetterConverterAge();
        $edad = $converter->to_word($years,'edad');


        return $edad;
        
    }

    function dateToWord($date)
    {
        $converter = new NumberToLetterConverterDate();
        $day = $date->format('d');
        $dayl = $converter->to_word($day,'dpi');
        $month = strftime("%B", date_timestamp_get($date));

        return $dayl."de ".$month;


    }

    function datemonthToWord($date)
    {
        $converter = new NumberToLetterConverterDate();
        $day = $date->format('d');
        
        $month = strftime("%B", date_timestamp_get($date));

        return $day."de ".$month;


    }
}
