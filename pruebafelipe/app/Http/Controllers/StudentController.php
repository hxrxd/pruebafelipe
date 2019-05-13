<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Redirect;
use App\Http\Controllers\Controller;
use nusoap_client;

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
use App\Financing;
use App\SupervisorH;
use App\SupervisorU;
use App\Supervisor;
use App\Family;
use App\Contract;
use App\Status;
use App\Check;
use App\RequerimentsAssignment;
use DB;
use Auth;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $email = Auth::user()->email;
        // $student = Student::leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
        //                     ->leftjoin('teams','headquarters.team','=','teams.id_team')
        //                     ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
        //                     ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
        //                     ->leftjoin('genders','students.gender','=','genders.id')
        //                     ->leftjoin('practices','students.practice','=','practices.id')
        //                     ->leftjoin('municipality','students.municipalityr','=','municipality.id_municipality')
        //                     ->leftjoin('departament','municipality.id_departament','=','Departament.id_departament')
        //                     ->leftjoin('civil_statuses','students.cstatus','=','civil_statuses.id')
        //                     ->select('students.carne','students.dpi', 'students.dpiw','students.name', 'students.fsurname', 'students.ssurname','students.email', 'genders.genders','civil_statuses.status', 'students.birthdate','students.nationality','students.carrer','students.academicu','students.personalp','students.homep','students.adressr','students.adressrw','students.initd', 'students.endd','practices.practice','headquarters.name as headquarter','teams.name as team','municipality.municipality as municipalityr','departament.departament as departamentr')
        //                     ->where('email', $email)
        //                     ->first();
        // if($student ==null){
        //     Session::flash('message','Debes registrarte antes de accedea a esta función');
        //     return Redirect::to('/');
        // }else{
        //      return view('student.index',compact('student'));
        // }


    }

    public function infoPay(){

        $studentinfo = Student::where('email', \Auth::user()->email)
                                ->first();

         $statusinfo = null;
        if($studentinfo ==null){
            Session::flash('message','Debes registrarte antes de acceder a esta función');
            return Redirect::to('/');
        }

        else{
           $id = $studentinfo->id_student;
           $statusinfo = Status::where('student', $id)->first();
           $check = Check::where('student', $id)->orderBy('id_check', 'DESC')->first();
        }

         return view('statusstudent.index', ['statusinfo'=>$statusinfo,'check'=>$check]);

    }

    public function studentData(){

        //
        $studentinfo = Student::where('email', \Auth::user()->email)
                                ->first();


        if($studentinfo ==null){
            Session::flash('message','Debes registrarte antes de acceder a esta función');
            return Redirect::to('/');
        }

        else{
            $id = $studentinfo->id_student;
            $student = Student::join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->join('teams','headquarters.team','=','teams.id_team')
                            ->join('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->join('cohortes','students.cohorte','=','cohortes.id')
                            ->join('genders','students.gender','=','genders.id')
                            ->join('practices','students.practice','=','practices.id')
                            ->join('civil_statuses','students.cstatus','=','civil_statuses.id')
                            ->where('students.id_student','=',$id)
                            ->select('students.carne','students.dpi', 'students.dpiw','students.name', 'students.fsurname', 'students.ssurname','students.email', 'genders.genders','civil_statuses.status', 'students.birthdate','students.nationality','students.carrer','students.academicu','students.personalp','students.homep','students.adressr','students.adressrw','students.initd', 'students.endd','practices.practice','headquarters.name as headquarter','teams.name as team','teams.supervisor as sup')
                            ->first();

            $supervisor = Supervisor::find($student->sup);
           
             return view('student.index',["supervisor"=>$supervisor,"student"=>$student]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function studentFromServer(Request $request)
    {
        # code...
        $student = Student::where('email', \Auth::user()->email)
                                ->first();

        if($student ==null){



        $client = new nusoap_client('https://registro.usac.edu.gt/WS/consultaEstudianteRyEv2.1.php?wsdl',FALSE);
        $carne = $request->input('carne');;
        $err = $client->getError();
        if ($err) {
            Session::flash('message','Conección con el servidor de Registro y Estadistica no establedida');
            return Redirect::to('/studentcreate');
        }

        $request = '<SOLICITUD_DATOS_RYE>
                <DEPENDENCIA>epsum</DEPENDENCIA>
                <LOGIN>epsumWS</LOGIN>
                <PWD>jf3085bm</PWD>
                <CARNET>'.$carne.'</CARNET>
            </SOLICITUD_DATOS_RYE>';

        $result = $client->call('datosGenerales', array('parameters' => $request ));

        if ($client->fault) {
            Session::flash('message','Solicitud con el servidor de Registro y Estadistica no establecida');
            return Redirect::to('/studentcreate');
        } else{

        $err = $client->getError();
        if ($err) {     // Muestra el error
            Session::flash('message','Error'.$err);
            return Redirect::to('/studentcreate');
        } else {        // Muestra el resultado
            $alumno=simplexml_load_string($result);

            if( $alumno->STATUS == '3'){
                Session::flash('message','Estudiante no registrado');
                return Redirect::to('/studentcreate');
            }
            else{
                $cohortes = Cohorte::where('status','=','1')->lists('cohorte','id');
                $departaments =  Departament::lists('departament','id_departament');
                $municipality = Municipality::lists('municipality','id_municipality');
                $genders = Gender::lists('genders','id');
                $civilstatus = CivilStatus::lists('status','id');
                $practices = Practice::lists('practice','id');
                $headquarters = Headquarters::where('status','=','1')->orderBy('name')->lists('name','id_headquarters');

                $dpiwfinal = $this->dpiToWord($alumno->CUI);

                $dpi1 = substr($alumno->CUI, 0, 4);
                $dpi2 = substr($alumno->CUI, 4, -4);
                $dpi3 = substr($alumno->CUI, -4);

                $dpin = $dpi1 ." ".$dpi2." ".$dpi3;


                return view('student.create',['alumno'=>$alumno,'departaments'=>$departaments,'municipality'=>$municipality,'genders'=>$genders,'civilstatus'=>$civilstatus,'practices'=>$practices,'headquarters'=>$headquarters,'cohortes'=>$cohortes,'dpiw'=>$dpiwfinal,'dpin'=>$dpin]);

                }
            }



            }
        }

        else{
            Session::flash('message','No puedes registrarte dos veces. Ya eres parte del programa EPSUM');
            return Redirect::to('/');

        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create($alumno)
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
        $long= explode('-', $request['headquarter']);
        $h = Headquarters::find($long['0']);
        $t = Team::find($h->team);

        $requestRequeriment = RequerimentsAssignment::find($long['1']);
        $requestRequeriment->value = 2;
        $requestRequeriment->save();
        //Encontrando Monto, cantidad de meses y de pagos
        $datetime1 = new \DateTime($request['initd']);
        $datetime2 = new \DateTime($request['endd']);
        $interval=$datetime2->diff($datetime1);
        $intervalMeses=$interval->format("%m");

        $day = $datetime1->format("d");
        $payments = $intervalMeses;
        if ($day==1) {
            # code...
            $intervalMeses = $intervalMeses+1;
            $payments = $payments+1;
        }

        if ($day==15) {
            # code...
            $payments = $intervalMeses+1;
        }

         $grant = $intervalMeses*2500;


        if ($request['carrer']=="Arquitectura"){
            $intervalMeses = 6.5;
            $grant = 16250;
        }

        if ($request['academicu']=="Facultad de Medicina Veterinaria y Zootecnia"){
            $intervalMeses = 6.5;
            $grant = 16500;
        }


       
        //Convirtiando a letras el monto
        $converter = new NumberToLetterConverter();
        $grantm = $converter->to_word($grant,'Q');



       Student::create([
            'dpi'=>$request['dpi'],
            'dpiw'=>$request['dpiw'],
            'name'=>$request['name'],
            'fsurname'=>$request['fsurname'],
            'ssurname'=>$request['ssurname'],
            'birthdate'=>$request['birthdate'],
            'cstatus'=>$request['cstatus'],
            'gender'=>$request['gender'],
            'carne'=>$request['carne'],
            'carrer'=>$request['carrer'],
            'academicu'=>$request['academicu'],
            'email'=>\Auth::user()->email,
            'personalp'=>$request['personalp'],
            'homep'=>$request['homep'],
            'adressr'=>$request['adressr'],
            'adressrw'=>$request['adressrw'],
            'municipalityr'=>$request['municipalityr'],
            'municipalityb'=>$request['municipalityb'],
            'practice'=>$request['practice'],
            'headquarter'=>$request['headquarter'],
            'initd'=>$request['initd'],
            'endd'=>$request['endd'],
            'cohorte'=>$request['cohorte'],
            'status'=>1,
            'rev'=>0,
            'financing'=>$t->financing,
            'length'=>$intervalMeses,
            'grant'=>$grant,
            'grantm'=>$grantm,
            'nationality'=>$request['nationality'],
            'payments'=>$payments,
        ]);
        //Generando Ficha de solicitud de beca







        return Redirect::to('/references');

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

    /**
     * Generate Ficha.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFicha()
    {
        $student = Student::where('email', \Auth::user()->email)
                                ->first();

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


        $day1 = $datetime1->format("d");

        $day2 = $datetime2->format("d");


        if ($day1==1) {
            # code...
            $intervalMeses = $intervalMeses+1;
        }

        $payments = $intervalMeses;

        $grant = $intervalMeses*2500;


       if(strcmp((string)$student->carrer, "Arquitectura") === 0){

            $payments = 6;
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


    public function dpiToWord($dpi){

        $con = new NumberToLetterConverter();


        $dpi1a = substr($dpi, 0, 4);
        $dpi2a = substr($dpi, 4, -4);
        $dpi3a = substr($dpi, -4);


        $dpi1w= $con->to_word($dpi1a,'dpi');
        $dpi2w= $con->to_word($dpi2a,'dpi');
        $dpi3w= $con->to_word($dpi3a,'dpi');

       $dpifinaln = trim($dpi1w).", ".trim($dpi2w).", ".trim($dpi3w);
        return $dpifinaln;
    }

    public function getCarta()
    {
        # code...
         setlocale(LC_ALL,"es_ES.utf8");

        $student = Student::where('email', \Auth::user()->email)
                                ->first();

        $datetime1 = new \DateTime($student->initd);
        $h = Headquarters::find($student['headquarter']);
        $t = Team::find($h->team);
        $s = Supervisor::find($t->supervisor);
        $m = Municipality::find($t->municipality);
        $d = Departament::find($m->id_departament);


        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-00.docx');
        $templateWord->setValue('nameincharge',$h->nameincharge);
        $templateWord->setValue('charge',$h->charge);
        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('length',$student->length);
        $templateWord->setValue('headquarter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departament',$d->departament);
        $templateWord->setValue('supervisor',$s->name);
        $templateWord->setValue('numeros',$s->phone);

        $templateWord->setValue('mm',strftime("%B", date_timestamp_get($datetime1)));
        $templateWord->setValue('yy',$datetime1->format('Y'));
        $templateWord->setValue('dd',$datetime1->format('d'));


        $templateWord->saveAs('CartaAsignacion.docx');
        header("Content-Disposition: attachment; filename=CartaAsignacion.docx; charset=iso-8859-1");


        readfile('CartaAsignacion.docx');



    }

    public function getContrato()
    {
        $student = Student::where('email', \Auth::user()->email)
                                ->first();


        $id = $student->id_student;

        $contract = Contract::where('student',$id)
                                ->where('year', date('Y'))
                                ->get()
                                ->last();

        if ($contract==null) {
            # code...

            Session::flash('message','No existe contrato para generar, contacta a los gestores del programa, este error puede ser causado por que aún no hay acuerdo de rectoría');
            return Redirect::to('/');
        }
        else{
            return view('student.contract');
        }

    }



    // FOR STATS

    public function getStats(){

      $total_stds = Student::count();
      $total_stds_men = Student::where('gender',1)->count();
      $total_stds_women = Student::where('gender',2)->count();

      $financing_epsum = Student::where('financing',1)->count();
      $financing_epsum_minfin = Student::where('financing',2)->count();
      $grant_epsum = Student::where('financing',1)->sum('grant');
      $grant_epsum_minfin = Student::where('financing',2)->sum('grant');
      $grant = Student::sum('grant');

      $total_stds_single = Student::where('cstatus',1)->orWhere('cstatus',2)->count();
      $total_stds_married = Student::where('cstatus',3)->orWhere('cstatus',4)->count();
      $total_stds_men_single = Student::where('cstatus',1)->count();
      $total_stds_men_married = Student::where('cstatus',3)->count();
      $total_stds_women_single = Student::where('cstatus',2)->count();
      $total_stds_women_married = Student::where('cstatus',4)->count();


      $stds_by_cohort_men = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.gender',1)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as men"))
              ->orderBy('id','desc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_cohort_women = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.gender',2)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as women"))
              ->orderBy('id','desc')
              ->groupBy('cohortes.name')
              ->get();


      $stds_by_cohort_men_single = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.cstatus',1)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as single"))
              ->orderBy('id','asc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_cohort_women_single = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.cstatus',2)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as single"))
              ->orderBy('id','asc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_cohort_men_married = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.cstatus',3)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as married"))
              ->orderBy('id','asc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_cohort_women_married = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->where('students.cstatus',4)
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(*) as married"))
              ->orderBy('id','asc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_au = DB::table('students')
              ->select('students.academicu as au',DB::raw("count(students.id_student) as numstds, (select count(students.id_student) from students where students.gender=1 and students.academicu = au) as men, (select count(students.id_student) from students where students.gender=2 and students.academicu = au) as women"))
              ->orderBy('numstds','desc')
              ->groupBy('students.academicu')
              ->get();

      $stds_by_career = DB::table('students')
              ->select('students.carrer as career',DB::raw("count(students.id_student) as numstds, (select count(students.id_student) from students where students.gender=1 and students.carrer = career) as men, (select count(students.id_student) from students where students.gender=2 and students.carrer = career) as women"))
              ->orderBy('numstds','desc')
              ->groupBy('students.carrer')
              ->get();

      $stds_by_practice = DB::table('students')
              ->join('practices','students.practice','=','practices.id')
              ->select('practices.practice as name','practices.practicea as shortname',DB::raw("count(students.id_student) as numstds"))
              ->orderBy('numstds','desc')
              ->groupBy('practices.practice')
              ->get();

      $stds_by_financing = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(students.id_student) as numstds, (select count(students.id_student) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=1) as f1, (select count(students.id_student) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=2) as f2"))
              ->orderBy('cohortes.id','desc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_grant = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("sum(students.grant) as total_grant, (select sum(students.grant) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=1) as g1, (select sum(students.grant) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=2) as g2"))
              ->orderBy('cohortes.id','desc')
              ->groupBy('cohortes.name')
              ->get();


      return view('stats.students', compact('total_stds','total_stds_men','total_stds_women','stds_by_cohort_men','stds_by_cohort_women',
              'total_stds_single','total_stds_married','total_stds_men_single','total_stds_men_married','total_stds_women_single','total_stds_women_married',
              'stds_by_cohort_men_single','stds_by_cohort_women_single','stds_by_cohort_men_married','stds_by_cohort_women_married','stds_by_au','stds_by_career',
              'stds_by_practice','stds_by_financing','financing_epsum','financing_epsum_minfin','stds_by_grant','grant_epsum','grant_epsum_minfin','grant'));
    }


    public function getFinancingStats(){

      $total_stds = Student::count();
      $total_stds_men = Student::where('gender',1)->count();
      $total_stds_women = Student::where('gender',2)->count();

      $financing_epsum = Student::where('financing',1)->count();
      $financing_epsum_minfin = Student::where('financing',2)->count();
      $grant_epsum = Student::where('financing',1)->sum('grant');
      $grant_epsum_minfin = Student::where('financing',2)->sum('grant');
      $grant = Student::sum('grant');


      $stds_by_financing = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("count(students.id_student) as numstds, (select count(students.id_student) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=1) as f1, (select count(students.id_student) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=2) as f2"))
              ->orderBy('cohortes.id','desc')
              ->groupBy('cohortes.name')
              ->get();

      $stds_by_grant = DB::table('students')
              ->join('cohortes','students.cohorte','=','cohortes.id')
              ->select('cohortes.id as id','cohortes.name as cohort',DB::raw("sum(students.grant) as total_grant, (select sum(students.grant) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=1) as g1, (select sum(students.grant) from students,cohortes where students.cohorte = cohortes.id and cohortes.name = cohort and students.financing=2) as g2"))
              ->orderBy('cohortes.id','desc')
              ->groupBy('cohortes.name')
              ->get();


      return view('stats.financing', compact('total_stds','total_stds_men','total_stds_women',
              'stds_by_financing','financing_epsum','financing_epsum_minfin','stds_by_grant',
              'grant_epsum','grant_epsum_minfin','grant'));
    }

    public function toIndexStats(){
      return view('stats.index');
    }


}
