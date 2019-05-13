<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;
use App\Supervisor;
use App\Log;
use App\Status;
use App\Check;
use App\Receipt;
use App\Contract;
use App\Engagement;
use App\InvDetail;
use App\InvArticle;
use App\InvProvider;
use App\InvPurchase;
use App\Appraisal;
use DB;
use Auth;

class ExcelController extends Controller
{
    public function getStudentBySupervisor()
    {
        # code...
        Excel::create('Estudiantes', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {

        $usuario = Auth::user()->id;
        $supervisor = Supervisor::where('iduser','=',$usuario)->get()->first();



        if(Auth::user()->rol == "Supervisor"){
             $students = Student::query('students')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('municipality','teams.municipality','=','municipality.id_municipality')
                            ->leftjoin('departament','municipality.id_departament','=','departament.id_departament')
                            ->leftjoin('practices','practices.id','=','students.practice')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                            //->leftjoin('supervisor_us','students.id_student','=','supervisor_us.student')
                            //->leftjoin('supervisor_hs','students.id_student','=','supervisor_hs.student')
                            ->where('teams.supervisor','=',$supervisor->id_supervisors)
                            ->where('students.status','=','1')
                            ->select(
                                [
                                    'students.email as Correo',
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    'practices.practice as Tipo',
                                    DB::raw("DATE_FORMAT(students.initd,'%d/%m/%Y') as Inicio"),
                                    DB::raw("DATE_FORMAT(students.endd,'%d/%m/%Y') as Finalizacion"),
                                    'students.length as Duración',
                                    'teams.name as Equipo',
                                    'headquarters.name as Sede',
                                    'municipality.municipality as Municipio',
                                    'departament.departament as Departamento',
                                    'students.homep as Telefono',
                                    'students.personalp as Celular',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.name as Cohorte',
                                    //'supervisor_us.name as SupervisorCarrera',
                                    //'supervisor_us.email as CorreoSupervisorCarrera',
                                    //'supervisor_us.phone as TeléfonoSupervisorCarrera',
                                    //'supervisor_hs.name as SupervisorSede',
                                    //'supervisor_hs.email as CorreoSupervisorSede',
                                    //'supervisor_hs.phone as TeléfonoSupervisorSede'

                                ]
                                )
                            ->get();

         }
         else{
             $students = Student::query('students')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('municipality','teams.municipality','=','municipality.id_municipality')
                            ->leftjoin('departament','municipality.id_departament','=','departament.id_departament')
                            ->leftjoin('practices','practices.id','=','students.practice')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                            // ->leftjoin('supervisor_us','students.id_student','=','supervisor_us.student')
                            // ->leftjoin('supervisor_hs','students.id_student','=','supervisor_hs.student')
                            ->where('students.status','=','1')
                            ->select(
                                [
                                    'students.email as Correo',
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    'practices.practice as Tipo',
                                    DB::raw("DATE_FORMAT(students.initd,'%d/%m/%Y') as Inicio"),
                                    DB::raw("DATE_FORMAT(students.endd,'%d/%m/%Y') as Finalizacion"),
                                    'students.length as Duración',
                                    'teams.name as Equipo',
                                    'headquarters.name as Sede',
                                    'municipality.municipality as Municipio',
                                    'departament.departament as Departamento',
                                    'students.homep as Telefono',
                                    'students.personalp as Celular',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.name as Cohorte',
                                    // 'supervisor_us.name as SupervisorCarrera',
                                    // 'supervisor_us.email as CorreoSupervisorCarrera',
                                    // 'supervisor_us.phone as TeléfonoSupervisorCarrera',
                                    // 'supervisor_hs.name as SupervisorSede',
                                    //'supervisor_hs.email as CorreoSupervisorSede',
                                    //'supervisor_hs.phone as TeléfonoSupervisorSede'

                                ]
                                )
                            ->get();

         }



        $sheet->fromArray($students);



    });

    })->export('xlsx');

    }



      public function getAllInfo()
    {
        # code...
        Excel::create('Estudiantes', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $students = Student::query('students')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('municipality as m1','teams.municipality','=','m1.id_municipality')
                            ->leftjoin('municipality as m2','students.municipalityr','=','m2.id_municipality')
                            ->leftjoin('municipality as m3','students.municipalityb','=','m3.id_municipality')
                            ->leftjoin('departament as d1','m1.id_departament','=','d1.id_departament')
                            ->leftjoin('departament as d2','m2.id_departament','=','d2.id_departament')
                            ->leftjoin('departament as d3','m3.id_departament','=','d3.id_departament')
                            ->leftjoin('practices','practices.id','=','students.practice')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                            ->leftjoin('genders','students.gender','=','genders.id')
                            ->leftjoin('civil_statuses','students.cstatus','=','civil_statuses.id')
                             ->select(
                                [
                                    'students.email as Correo',
                                    'students.carne as Carne',
                                    'students.dpi as DPI',
                                    'students.dpiw as DPIEscrito',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    'practices.practice as Tipo',
                                    DB::raw("DATE_FORMAT(students.birthdate,'%d/%m/%Y') as Nacimiento"),
                                    'genders.genders as Genero',
                                    'civil_statuses.status as EstadoCivil',
                                    'students.birthdate as FechaNacimiento',
                                    'students.adressr as Direccion',
                                    'students.adressrw as DireccionEscrita',
                                    'm2.municipality as MunicipioNacimiento',
                                    'd2.departament as DepartamentoNacimiento',
                                    'm3.municipality as MunicipioOrigen',
                                    'd3.departament as DepartamentoOrigen',
                                    DB::raw("DATE_FORMAT(students.initd,'%d/%m/%Y') as Inicio"),
                                    DB::raw("DATE_FORMAT(students.endd,'%d/%m/%Y') as Finalizacion"),
                                    'students.length as Duración',
                                    'teams.name as Equipo',
                                    'headquarters.name as Sede',
                                    'm1.municipality as Municipio',
                                    'd1.departament as Departamento',
                                    'students.homep as Telefono',
                                    'students.personalp as Celular',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.cohorte as Cohorte',

                                ]
                                )
                            ->get();


        $sheet->fromArray($students);



    });

    })->export('xlsx');

    }


    public function getStudent()
    {
        # code...
        Excel::create('Estudiantes', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $students = Student::query('students')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('municipality','teams.municipality','=','municipality.id_municipality')
                            ->leftjoin('departament','municipality.id_departament','=','departament.id_departament')
                            ->leftjoin('practices','practices.id','=','students.practice')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')

                           
                            ->select(
                                [
                                    'students.email as Correo',
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    'practices.practice as Tipo',
                                    DB::raw("DATE_FORMAT(students.initd,'%d/%m/%Y') as Inicio"),
                                    DB::raw("DATE_FORMAT(students.endd,'%d/%m/%Y') as Finalizacion"),
                                    'students.length as Duración',
                                    'teams.name as Equipo',
                                    'headquarters.name as Sede',
                                    'municipality.municipality as Municipio',
                                    'departament.departament as Departamento',
                                    'students.homep as Telefono',
                                    'students.personalp as Celular',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.cohorte as Cohorte',

                                ]
                                )
                            ->get();


        $sheet->fromArray($students);



    });

    })->export('xlsx');
    }

        public function getAcuerdo()
    {
        # code...
        Excel::create('Acuerdo', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $students = Student::query('students')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('municipality','teams.municipality','=','municipality.id_municipality')
                            ->leftjoin('departament','municipality.id_departament','=','departament.id_departament')
                            ->leftjoin('practices','practices.id','=','students.practice')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                            ->where('cohortes.status','=','1')
                            ->orderBy('students.cohorte')
                            ->select(
                                [
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    DB::raw("DATE_FORMAT(students.initd,'%d/%m/%Y') as Inicio"),
                                    DB::raw("DATE_FORMAT(students.endd,'%d/%m/%Y') as Finalizacion"),
                                    'students.length as Duración',
                                    DB::raw('students.grant as Monto'),
                                    'headquarters.name as Sede',
                                    'municipality.municipality as Municipio',
                                    'departament.departament as Departamento',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.cohorte as Cohorte',
                                    'students.personalp as Celular',
                                    'students.email as Email',

                                ]
                                )
                            ->get();


        $sheet->fromArray($students);



    });

    })->export('xlsx');
    }

    public function getExpediente()
    {
        # fix
        Excel::create('Estado del Expediente', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $students = Status::query('statuses')
                            ->leftjoin('students','statuses.student','=','students.id_student')
                            ->leftjoin('contracts','statuses.student','=','contracts.student')
                            ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                            ->leftjoin('financings','students.financing','=','financings.id_financings')
                            ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                            ->leftjoin('teams','headquarters.team','=','teams.id_team')
                            ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                            ->where('students.status','=','1')
                             ->where('contracts.year', (int)date("Y"))
                            ->select(
                                    [
                                        'students.carne as Carne',
                                        'students.email as Email',
                                        DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                        //DB::raw("CONCAT(contracts.no,'\-',contracts.year) as Codigo"),
                                        'contracts.no as No',
                                        'contracts.year as Año',
                                        'students.carrer as Carrera',
                                        'students.academicu as UnidadAcademica',
                                        DB::raw("DATE_FORMAT(statuses.stationery,'%d/%m/%Y') as Papeleria"),
                                        DB::raw("DATE_FORMAT(statuses.contract,'%d/%m/%Y') as Contrato"),
                                        DB::raw("DATE_FORMAT(statuses.budget,'%d/%m/%Y') as Presupuesto"),
                                        DB::raw("DATE_FORMAT(statuses.toaim1,'%d/%m/%Y') as Revision1"),
                                        DB::raw("DATE_FORMAT(statuses.toaim2,'%d/%m/%Y') as Revision2"),
                                        DB::raw("DATE_FORMAT(statuses.conta,'%d/%m/%Y') as Contabilidad"),
                                        DB::raw("DATE_FORMAT(statuses.pay,'%d/%m/%Y') as Pagado"),
                                        'statuses.notice as Aviso',
                                        'financings.name as Financiamiento',
                                        'cohortes.cohorte as Cohorte',
                                        'supervisors.name as Supervisor',
                                    ]
                                    )
                            ->get();


        $sheet->fromArray($students);



    });

    })->export('xlsx');
    }


    public function getCheques()
    {
        # fix
        Excel::create('Cheques', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {



         $check = Check::query('checks')
                        ->leftjoin('students','checks.student','=','students.id_student')
                        ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                        ->leftjoin('receipts','checks.receipt','=','receipts.id_receipts')
                        ->leftjoin('contracts','receipts.contract','=','contracts.id_contracts')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                         ->leftjoin('financings','students.financing','=','financings.id_financings')
                        ->select(
                                [
                                    'students.email as Email',
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    DB::raw("CONCAT(receipts.no,'-',receipts.year) as Recibo"),
                                    DB::raw("CONCAT(contracts.no,'-',contracts.year) as Contrato"),
                                    'receipts.grant as Monto',
                                    'checks.nocheck as Cheque',
                                    DB::raw("DATE_FORMAT(checks.datein,'%d/%m/%Y') as Ingreso"),
                                     DB::raw("DATE_FORMAT(checks.datepay,'%d/%m/%Y') as Pagado"),
                                    DB::raw("DATE_FORMAT(checks.dateout,'%d/%m/%Y') as Liquidado"),
                                    'checks.desc as Descripción',
                                    'financings.name as Financiamiento',
                                    'cohortes.cohorte as Cohorte',
                                    'supervisors.name as Supervisor',

                                ]
                                )
                        ->get();


        $sheet->fromArray($check);



    });

    })->export('xlsx');
    }


     public function getPagos()
    {
        # fix
        Excel::create('Pagos', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {



         $receipts = Receipt::query('receipts')
                        ->leftjoin('students','receipts.student','=','students.id_student')
                        ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                        ->leftjoin('contracts','receipts.contract','=','contracts.id_contracts')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->leftjoin('financings','students.financing','=','financings.id_financings')
                        ->select(
                                [
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    DB::raw("CONCAT(receipts.no,'-',receipts.year) as Recibo"),
                                    DB::raw("CONCAT(contracts.no,'-',contracts.year) as Contrato"),
                                     'receipts.no as Numero',
                                      'receipts.year as Año',
                                    'receipts.grant as Monto',
                                    'receipts.payments as Pagos',
                                     DB::raw("DATE_FORMAT(receipts.initd,'%d/%m/%Y') as Inicio"),
                                     DB::raw("DATE_FORMAT(receipts.endd,'%d/%m/%Y') as Finalizacion"),
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'cohortes.cohorte as Cohorte',
                                    DB::raw("DATE_FORMAT(receipts.created_at,'%d/%m/%Y') as Creado"),

                                ]
                                )
                        ->get();


        $sheet->fromArray($receipts);



    });

    })->export('xlsx');
    }

    public function getPagosinfo()
    {
        # fix

        Excel::create('Pagos', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


         setlocale(LC_ALL,"es_ES.utf8");
         $receipts = Receipt::query('receipts')
                        ->leftjoin('students','receipts.student','=','students.id_student')
                        ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                        ->leftjoin('contracts','receipts.contract','=','contracts.id_contracts')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->leftjoin('financings','students.financing','=','financings.id_financings')
                        ->where('receipts.year', (int)date("Y"))
                        ->select(
                                [
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    DB::raw("CONCAT(receipts.no,'-',receipts.year) as Recibo"),
                                    DB::raw("CONCAT(contracts.no,'-',contracts.year) as Contrato"),
                                    'receipts.year as Año',
                                    'receipts.grant as Monto',
                                     DB::raw("CONCAT('Del ',DATE_FORMAT(receipts.initd,'%d'),'/', DATE_FORMAT(receipts.initd,'%m'), ' al ',DATE_FORMAT(receipts.endd,'%d'),'/', DATE_FORMAT(receipts.endd,'%m'), ' del ', DATE_FORMAT(receipts.initd,'%Y')) as Periodo")

                                ]
                                )
                        ->get();


        $sheet->fromArray($receipts);



    });

    })->export('xlsx');
    }

    public function getGestion()
    {
        # fix
        Excel::create('Gestiones', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {



         $engagements = Engagement::query('engagements')
                        ->leftjoin('students','engagements.student','=','students.id_student')
                        ->leftjoin('contracts','engagements.contract','=','contracts.id_contracts')
                        ->leftjoin('agreement','contracts.agreement','=','agreement.id_agreement')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->leftjoin('financings','students.financing','=','financings.id_financings')
                        ->select(
                                [
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    DB::raw("CONCAT(engagements.no,'-',engagements.year) as Gestion"),
                                    DB::raw("CONCAT(contracts.no,'-',contracts.year) as Contrato"),
                                    'engagements.grant as Monto',
                                    'engagements.payments as Pagos',
                                     DB::raw("DATE_FORMAT(engagements.initd,'%d/%m/%Y') as Inicio"),
                                     DB::raw("DATE_FORMAT(engagements.endd,'%d/%m/%Y') as Finalizacion"),
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                    'agreement.agreement_n as Acuerdo',

                                ]
                                )
                        ->get();


        $sheet->fromArray($engagements);



    });

    })->export('xlsx');
    }



    public function getContracts()
    {


        Excel::create('Contratos', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {



         $contract = Contract::query('contract')
                        ->leftjoin('agreement','contracts.agreement','=','agreement.id_agreement')
                        ->leftjoin('students','contracts.student','=','students.id_student')
                         ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                        ->leftjoin('headquarters','students.headquarter','=','headquarters.id_headquarters')
                        ->leftjoin('teams','headquarters.team','=','teams.id_team')
                        ->leftjoin('supervisors','supervisors.id_supervisors','=','teams.supervisor')
                        ->leftjoin('financings','students.financing','=','financings.id_financings')
                        ->leftjoin('municipality','teams.municipality','=','municipality.id_municipality')
                            ->leftjoin('departament','municipality.id_departament','=','departament.id_departament')
                        ->select(
                                [
                                    'students.carne as Carne',
                                    DB::raw("CONCAT(students.name,' ',students.fsurname,' ',students.ssurname) as Estudiante"),
                                    'students.carrer as Carrera',
                                    'students.academicu as UnidadAcademica',
                                    'contracts.grant as Monto',
                                    'contracts.payments as Pagos',
                                    DB::raw("CONCAT(contracts.no,'-',contracts.year) as Contrato"),
                                    DB::raw("DATE_FORMAT(contracts.initd,'%d/%m/%Y') as Inicio"),
                                     DB::raw("DATE_FORMAT(contracts.endd,'%d/%m/%Y') as Finalizacion"),
                                      'headquarters.name as Sede',
                                    'municipality.municipality as Municipio',
                                    'departament.departament as Departamento',
                                    'financings.name as Financiamiento',
                                    'supervisors.name as Supervisor',
                                     'cohortes.cohorte as Cohorte',
                                    'agreement.agreement_n as Acuerdo',


                                ]
                                )
                        ->get();



        $sheet->fromArray($contract);



    });

    })->export('xlsx');
    }



    public function getSucesos()
    {

        Excel::create('Sucesos', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $sucess = Log::orderBy('created_at','desc')->get([ 'email as Usuario',
                                                            'desc as Operacion',
                                                            'created_at as Registro']);


        $sheet->fromArray($sucess);



    });

    })->export('xlsx');


    }
    public function getSucesosSupervisors()
    {

        Excel::create('Sucesos', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $sucess = Log::whereIn('email', ["luisafer29@gmail.com"," jenifer.pinzon@gmail.com"," elviszac@gmail.com","arq997@yahoo.es","ing.jennilopez@gmail.com","epsumquiche@gmail.com","  epsumhuehuetenango1@gmail.com","ingridpolanko@gmail.com","robertozea.epsum@gmail.com"," mvenriquealvarado@hotmail.com"])->orderBy('created_at','desc')->get([ 'email as Usuario',
                                                            'desc as Operacion',
                                                            'created_at as Registro']);


        $sheet->fromArray($sucess);



    });

    })->export('xlsx');


    }

    //Evaluación del Supervisor
    public function getAppraisals()
    {
        Excel::create('Evaluación supervisor', function($excel) {

        $excel->sheet('Hoja1', function($sheet) {


        $appraisal = Appraisal::leftjoin('students','appraisals.student','=','students.id_student')
                                ->leftjoin('cohortes','students.cohorte','=','cohortes.id')
                                ->orderBy('supervisor')
                                ->get([ 'appraisals.supervisor as Supervisor',
                                        'appraisals.civil_status as EstadoCivil',
                                        'age as Edad',
                                        DB::raw('CONVERT(journey, CHAR) as Jornada'),
                                        DB::raw('CONVERT(economic_activity, CHAR) as ActividadEconomica'),
                                        DB::raw('CONVERT(comunication, CHAR) as Comunicacion'),
                                        DB::raw('CONVERT(desc_comunication, CHAR) as DescComuniacion'),
                                        DB::raw('CONVERT(type_comunication, CHAR) as TipoComunicacion'),
                                        DB::raw('CONVERT(lapse_comunication, CHAR) as FrecuenciaComunicacion'),
                                        DB::raw('CONVERT(understandable_comunication, CHAR) as ComunicacionComprensible'),
                                        DB::raw('CONVERT(respect_communication, CHAR) as ComunicacionRespetuosa'),
                                        DB::raw('CONVERT(fulfillment, CHAR) as Cumplimiento'),
                                        DB::raw('CONVERT(assess_comunication, CHAR) as ValorarComunicacion'),
                                        DB::raw('CONVERT(accompaniment, CHAR) as  Acompanamiento'),
                                        DB::raw('CONVERT(interest, CHAR) as Interes'),
                                        DB::raw('CONVERT(assess_advisory, CHAR) as ValorarAsesoria'),
                                        DB::raw('CONVERT(type_advisory, CHAR) as TipoAsesoria'),
                                        DB::raw('CONVERT(resolution, CHAR) as Resolvio'),
                                        DB::raw('CONVERT(assess_accompaniment, CHAR) as ValorarAcompanamiento'),
                                        DB::raw('CONVERT(assess_mono, CHAR) as AsesoriaMono'),
                                        DB::raw('CONVERT(assess_convivencia, CHAR) as AsesoriaConvivencia'),
                                        DB::raw('CONVERT(assess_multi, CHAR) as AsesoriaMulti'),
                                        DB::raw('CONVERT(assess_wp, CHAR) as AsesoriaPlan'),
                                        DB::raw('CONVERT(assess_dx, CHAR) as AsesoriaDx'),
                                        DB::raw('CONVERT(respect, CHAR) as Respeto'),
                                        DB::raw('CONVERT(understandable, CHAR) as Compresion'),
                                        DB::raw('CONVERT(cooperation, CHAR) as Cooperacion'),
                                        DB::raw('CONVERT(amiability , CHAR) as Amable'),
                                        DB::raw('CONVERT(assess_supervisor, CHAR) as ValorarSupervisor'),
                                        DB::raw('CONVERT(complaint , CHAR) as Denuncias'),
                                        DB::raw('CONVERT(desc_appraisals, CHAR) as Descripcion'),
                                        DB::raw('CONVERT(name_student, CHAR) as Nombre'),
                                        'appraisals.created_at as Registro',
                                        'cohortes.name as Cohorte']);

    

        $sheet->fromArray($appraisal);



    });

    })->export('xlsx');

    }


    /* FOR INVENTORY */

    public function getInventoryRegs()
    {
        # code...
        Excel::create('Inventario', function($excel) {

        $excel->sheet('INVENTARIO GENERAL', function($sheet) {


        $regs = InvDetail::query('inv_details')
              ->leftjoin('inv_articles','inv_details.article','=','inv_articles.id')
              ->select([
                DB::raw("DATE_FORMAT(inv_details.open_date,'%d/%m/%Y') as FechaApertura"),
                //'inv_details.open_date as FechaApertura',
                'inv_details.inv_number as No.DeInventario',
                'inv_details.resp_target_number as No.TarjetaDeResponsabilidad',
                'inv_articles.description as Descripción',
                'inv_articles.cost as Valor(Q.)',
                'inv_details.observations as Observaciones',
                ])
              ->get();



        $sheet->fromArray($regs);


    });

    $excel->sheet('PROVEEDORES', function($sheet) {


        $provs = InvProvider::query('inv_providers')
              ->select([
                //DB::raw("DATE_FORMAT(inv_details.open_date,'%d/%m/%Y') as Fecha de apertura"),
                'inv_providers.name as Nombre',
                'inv_providers.nit as NIT',
                'inv_providers.phone as Teléfono',
                'inv_providers.email as Correo',
                DB::raw("CASE WHEN(inv_providers.status = 1) THEN 'Activo' ELSE 'Inactivo' END as Estado"),
                ])
              ->get();

        $sheet->fromArray($provs);


    });


    $excel->sheet('BIENES', function($sheet) {


        $arts = InvArticle::query('inv_articles')
              ->leftjoin('inv_providers','inv_articles.provider','=','inv_providers.id')
              ->select([
                //DB::raw("DATE_FORMAT(inv_details.open_date,'%d/%m/%Y') as Fecha de apertura"),
                'inv_articles.name as Nombre',
                'inv_articles.description as Descripción',
                'inv_providers.name as Proveedor',
                'inv_articles.cost as Valor(Q.)',
                DB::raw("CASE WHEN(inv_articles.status = 1) THEN 'Disponible' ELSE 'No disponible' END as Estado"),
                ])
              ->get();

        $sheet->fromArray($arts);


    });

    $excel->sheet('COMPRAS', function($sheet) {


        $pur = InvPurchase::query('inv_purchases')
              ->leftjoin('inv_providers','inv_purchases.provider','=','inv_providers.id')
              ->select([
                //DB::raw("DATE_FORMAT(inv_details.open_date,'%d/%m/%Y') as Fecha de apertura"),
                'inv_purchases.number as Número',
                'inv_purchases.oc_no as OrdenCompraNo.',
                'inv_providers.name as Proveedor',
                'inv_purchases.value as Valor(Q.)',
                //'inv_purchases.pdate as Fecha',
                DB::raw("DATE_FORMAT(inv_purchases.pdate,'%d/%m/%Y') as Fecha"),
                'inv_purchases.user as Registró',
                ])
              ->get();

        $sheet->fromArray($pur);


    });


    })->export('xlsx');

    }
}
