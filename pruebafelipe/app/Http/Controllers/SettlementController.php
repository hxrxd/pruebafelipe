<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Settlement;
use App\Student;
use App\NumberToLetterConverterDate;
use App\Log;

use Session;
use Redirect;
use Auth;


class SettlementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settlement = Settlement::leftjoin('students','settlements.student','=','students.id_student')
                            ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->where('year', (int)date("Y"))
                            ->select('students.name', 'students.carne','students.ssurname','students.name','settlements.no','students.academicu','students.carrer','teams.name as team','supervisors.name as supervisor','students.id_student','supervisors.iduser')->get();;

       return view('settlement.index',["settlement"=>$settlement]);


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

    //para dar debaja a estudiantes desde gestor

    public function deleteStudent($id){
        $student = Student::find($id);
        $student->rev = 1;
        $student->save();

        $log = [
            'desc'=>'Estudiante finalizo proceso de pago :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

         Session::flash('message','Estudiante eliminado exitosamente');
        return Redirect::to('/studentg');
    }
    public function createSettlement($id){

        $student = Student::find($id);

        $settlement = Settlement::where('year',date("Y"))->orderBy('no')->get();
        $lastsettlement = $settlement->last();
        if ($lastsettlement == null) {
            $no = 1;
        }
        else{
            $no = $lastsettlement->no +1;
        }

        Settlement::create([
                'no'=>$no,
                'year'=>date("Y"),
                'student'=>$id
                
            ]);


        
        $student->status = 0;
        $student->save();




        $log = [
            'desc'=>'Creacion de Finiquito del estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

          setlocale(LC_ALL,"es_ES.utf8");

        $datetime1 = new \DateTime();
        $initd = new \DateTime($student->initd);
        $endd = new \DateTime($student->endd);

        $settlementget = Settlement::where('student','=',$student->id_student)->get()->last();

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/finiquito2017.docx');

        $templateWord->setValue('no',$settlementget->no);
        $templateWord->setValue('year',$datetime1->format('Y'));


        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);

        $templateWord->setValue('initd', $this->dateToWord($initd));
        $templateWord->setValue('endd',$this->dateToWord($endd));
        $templateWord->setValue('date',$this->dateToWord($endd));

        


        $templateWord->saveAs('Finiquito.docx');
        header("Content-Disposition: attachment; filename=Finiquito.docx; charset=iso-8859-1");
        readfile('Finiquito.docx');


    }

    public function recreateSettlement($id){

        $student = Student::find($id);

        $settlement = Settlement::where('year',date("Y"))->orderBy('no')->get();
        $lastsettlement = $settlement->last();
        


        
        $student->status = 0;
        $student->save();




        $log = [
            'desc'=>'Reimpresion de Finiquito del estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

          setlocale(LC_ALL,"es_ES.utf8");

        $datetime1 = new \DateTime();
        $initd = new \DateTime($student->initd);
        $endd = new \DateTime($student->endd);

        $settlementget = Settlement::where('student','=',$student->id_student)->get()->last();

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/finiquito2017.docx');

        $templateWord->setValue('no',$settlementget->no);
        $templateWord->setValue('year',$datetime1->format('Y'));


        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);

        $templateWord->setValue('initd', $this->dateToWord($initd));
        $templateWord->setValue('endd',$this->dateToWord($endd));
        $templateWord->setValue('date',$this->dateToWord($endd));

        


        $templateWord->saveAs('Finiquito.docx');
        header("Content-Disposition: attachment; filename=Finiquito.docx; charset=iso-8859-1");
        readfile('Finiquito.docx');


    }

    function dateToWord($date)
    {
        $converter = new NumberToLetterConverterDate();
        $day = $date->format('d');
        $dayl = $converter->to_word($day,'dpi');
        $month = strftime("%B", date_timestamp_get($date));
        $year = $date->format('Y');
        $yearl= $converter->to_word($year,'dpi');

        return $dayl."de ".$month." del ".$yearl;


    }
}
