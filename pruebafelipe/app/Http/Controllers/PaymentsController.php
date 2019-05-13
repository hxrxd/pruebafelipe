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
use App\Engagement;
use App\Log;
use App\Receipt;

use DB;
use Session;
use Redirect;
use Auth;


class PaymentsController extends Controller
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

    public function inicio($id){
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        $student =Student::find($contract->student);
        $payments = DB::table('receipts')
                        ->where('contract','=',$contract->id_contracts)
                        ->get();

        return view('payments.index',['contract'=>$contract,'engagement'=>$engagement,'payments'=>$payments,'student'=>$student]);
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
        $engagement = Engagement::find($id);
        return view('payments.create',['engagement'=>$engagement]);
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
        $converter = new NumberToLetterConverter();
        $grant =$request['grant']; 
        $grantm = $converter->to_word($grant,'Q');
        $student = Student::find($request['student']);
        $contract = Contract::find($request['contract']);
        $engagement = Engagement::find($request['engagement']);
        $receipts = Receipt::where('year',date("Y"))
                                ->orderBy('no')->get();
        $lastreceipts = $receipts->last();
        if ($lastreceipts == null) {
            $no = 1;
        }
        else{
            $no = $lastreceipts->no +1;
        }
        Receipt::create([
                'no'=>$no,
                'year'=>date("Y"),
                'student'=>$request['student'],
                'contract'=>$contract->id_contracts,
                'initd'=>$request['initd'],
                'endd'=>$request['endd'],
                'grant'=>$grant,
                'grantm'=>$grantm,
                'payments'=>$request['payments'],
                 'engagement'=>$engagement->id_engagement,
            ]);
         $log = [
            'desc'=>'Creacion de Recibo y Pago del estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);
        $receipts = Receipt::where('year',date("Y"))
                                ->orderBy('no')->get();
        $lastreceipts = $receipts->last();
        Session::flash('message','Pago y Recibo creado exitosamente');
        $id= $lastreceipts->id_receipts;
        return Redirect::to('gpayment/'.$id.'/download');
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
        $receipts = Receipt::find($id);
        $student = Student::find($receipts->student);
        $contract = Contract::find($receipts->contract);

        $receipts = Receipt::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($receipts->grant,'Q');
        $receipts->grantm = $grantm;
        $receipts->save();

        return view('payments.edit',['student'=>$student,'receipts'=>$receipts,'contract'=>$contract]);


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
        
        $receipts = Receipt::find($id);
        $student = Student::find($receipts->student);
        $receipts->fill($request->all());
        $receipts->save();

         $log = [
            'desc'=>'Modificación del Pago :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Pago actualizado exitosamente');
        return Redirect::to('/pays');
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
    public function genPayment($id){
            $receipts = Receipt::find($id);
            $student = Student::find($receipts->student);
            
            return view('payments.download',['receipts'=>$receipts,'student'=>$student]);
    }

    public function genForm06($id){
         setlocale(LC_ALL,"es_ES.utf8");
        $receipts = Receipt::find($id);
        $engagement = Engagement::find($receipts->engagement);
        $contract = Contract::find($receipts->contract);
        $student = Student::find($receipts->student);
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-06.docx');
        $templateWord->setValue('no',$receipts->no);
        $templateWord->setValue('year',$receipts->year);
        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);


         $templateWord->setValue('noc',$engagement->no);
        $templateWord->setValue('yearc',$engagement->year);

        $templateWord->saveAs('AB-USAC-06.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-06.docx; charset=iso-8859-1");
        readfile('AB-USAC-06.docx');

    }

    public function genForm04($id){
        setlocale(LC_ALL,"es_ES.utf8");
        $receipts = Receipt::find($id);
        $engagement = Engagement::find($receipts->engagement);
        $contract = Contract::find($receipts->contract);
        $student = Student::find($receipts->student);

        $h = Headquarters::find($student->headquarter);
        $t = Team::find($h->team);
        
        
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

        $initd = new \DateTime($receipts->initd);
        $endd = new \DateTime($receipts->endd);


        $datetime1 = new \DateTime();

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-04.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));

        $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('no',$receipts->no);
        $templateWord->setValue('year',$receipts->year);  

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi); 

        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);

        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));

        $templateWord->setValue('noc',$engagement->no);
        $templateWord->setValue('yearc',$engagement->year);

        $templateWord->setValue('pay',$receipts->payments);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('grant',number_format($receipts->grant,2, '.', ','));
        

         $templateWord->saveAs('AB-USAC-04.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-04.docx; charset=iso-8859-1");
        readfile('AB-USAC-04.docx');
     
    }

    function dateToWordNumber($date)
    {
        
        $day = $date->format('d');
    
        $month = strftime("%B", date_timestamp_get($date));

        return $day." de ".$month;


    }



}
