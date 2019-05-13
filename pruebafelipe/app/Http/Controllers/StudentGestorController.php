<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use DB;

use App\Team;
use App\Student;
use App\Headquarters;
use App\Departament;
use App\Log;
use App\Municipality;
use App\Gender;
use App\CivilStatus;
use App\Practice;
use App\Cohorte;
use App\NumberToLetterConverter;
use App\Financing;
use App\SupervisorH;
use App\SupervisorU;
use App\Family;
use Auth;


class StudentGestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = DB::table('students')
                            ->join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->join('cohortes','students.cohorte','=','cohortes.id')
                            ->select('students.id_student','teams.name as team','students.carne','students.academicu','students.carrer','students.name','students.fsurname','students.ssurname','supervisors.name as supervisor','cohortes.cohorte as cohorte')
                            ->where('students.rev','=',0)
                            ->get();

        return view('studentgestor.index',compact('students'));
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
        $cohortes = Cohorte::lists('cohorte','id');
        $municipality = Municipality::lists('municipality','id_municipality');
        $genders = Gender::lists('genders','id');
        $civilstatus = CivilStatus::lists('status','id');
        $practices = Practice::lists('practice','id');
        $headquarters = Headquarters::where('status','=','1')->orderBy('name')->lists('name','id_headquarters');
        $financings = Financing::lists('name','id_financings');
        $student = Student::find($id);
        
        
        return view('studentgestor.edit', ['student'=>$student,'municipality'=>$municipality,'genders'=>$genders,'civilstatus'=>$civilstatus,'practices'=>$practices,'headquarters'=>$headquarters,'cohortes'=>$cohortes,'financings'=>$financings]);
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
        $student = Student::find($id);
        $student->fill($request->all());
        $student->save();

        $log = [
            'desc'=>'Modificación de Estudiante :'.$student->carne,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        $student = Student::find($id);
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($student->grant,'Q');
        $student->grantm = $grantm;
        $student->save();

        Session::flash('message','Estudiante Actualizado exitosamente');
        return Redirect::to('/studentg');
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

    public function getFicha($id)
    {
        $student = Student::find($id);
          
        $datetime1 = new \DateTime($student->initd);
        $datetime2 = new \DateTime($student->endd);

        // $today = new \DateTime();

        // $thisyear = $today->format('Y');

        // $year1 = $datetime1->format('Y');
        // $year2 = $datetime2->format('Y');

        // if($year1 == $year2){
        //     $datetime2 = new \DateTime($student->endd);
        // }
        // else{

        //     if($thisyear == $year1){
        //         $datetime2->modify('last day of december '.$datetime1->format('Y'));
        //     }

        //     if($thisyear == $year2){
        //         $datetime1->modify('first day of january '.$datetime2->format('Y'));
        //     }

       
        // }

        $datebefore = strtotime('-4 day',strtotime($datetime1->format('Y-m-d')));
        
        $date = new \DateTime(date('Y-m-d',$datebefore));


        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-02.docx');
        

        $templateWord->setValue('dd',$date->format('d'));
        $templateWord->setValue('mm',$date->format('m'));
        $templateWord->setValue('yy',$date->format('Y'));

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('email',$student->email);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('initd',$datetime1->format('d/m/Y'));
        $templateWord->setValue('endd',$datetime2->format('d/m/Y'));
        
        $interval=$datetime2->diff($datetime1);
        $intervalMeses=$interval->format("%m");
        $grant = $intervalMeses*2500;

        $day1 = $datetime1->format("d");

        $day2 = $datetime2->format("d");
        
        if ($day1==1) {
            # code...
            $intervalMeses = $intervalMeses+1;
           
        }





        
        $payments = $intervalMeses;
        $grant = $intervalMeses*2500;
        
        if(strcmp((string)$student->carrer, "Arquitectura") === 0){
            
            $payments = 6.5;
            $grant = 16250;
            
        }

        if(strcmp((string)$student->academicu, "Facultad de Medicina Veterinaria y Zootecnia") === 0){
            
            $payments = 6;
            $grant = 16500;
            
        }

        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($grant,'Q');



        $templateWord->setValue('mount',number_format($grant,2, '.', ','));
        $templateWord->setValue('mountl',$grantm);

        $h = Headquarters::find($student['headquarter']);
        $t = Team::find($h->team);
        $f = Financing::find($student->financing);
        $m = Municipality::find($t->municipality);
        $d = Departament::find($m->id_departament);

        $templateWord->setValue('headquarter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departament',$d->departament);
        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('financingname',$f->nameincharge);
        $templateWord->setValue('financingreg',$f->noname);

        $templateWord->saveAs('FichadeBeca.docx');
        header("Content-Disposition: attachment; filename=FichadeBeca.docx; charset=iso-8859-1");
    
        
        readfile('FichadeBeca.docx');
    }
}
