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

use DB;
use Session;
use Redirect;
use Auth;
class GestorController extends Controller
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

    public function genContract($id)
    {
        $contract=Contract::find($id);
        $student=Student::find($contract->student);
        return view('gestor.index',['contract'=>$contract,'student'=>$student]);

    }

     public function genEngagement($id)
    {
        $engagement=Engagement::find($id);
        $contract=Contract::find($engagement->contract);
        $student=Student::find($engagement->student);
        return view('gestor.indexe',['contract'=>$contract,'engagement'=>$engagement,'student'=>$student]);

    }

    public function genContract130($id)
    {
        //
        setlocale(LC_ALL,"es_ES.utf8");
        $contract = Contract::find($id);
        $student = Student::find($contract->student);
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
        $templateWord->setValue('length', $converter->to_word($student->length,'dpi'));
        $templateWord->setValue('initd',$initd->format('d/m/Y'));
        $templateWord->setValue('endd',$endd->format('d/m/Y'));
        $templateWord->setValue('yearw1',$converter->to_word($initd->format('Y'),'dpi'));
        $templateWord->setValue('yearw2',$converter->to_word($endd->format('Y'),'dpi'));

        //Fechas
        $templateWord->setValue('initdw', $this->dateToWord($initd));
        $templateWord->setValue('enddw',$this->dateToWord($endd));

        $templateWord->setValue('initds',$initd->format('d/m/Y'));
        $templateWord->setValue('endds',$endd->format('d/m/Y'));

        $templateWord->setValue('initdsw', $this->dateToWord($initd));
        $templateWord->setValue('enddsw',$this->dateToWord($endd));

        $templateWord->saveAs('Contrato.docx');
        header("Content-Disposition: attachment; filename=Contrato.docx; charset=iso-8859-1");

        readfile('Contrato.docx');
       
    }
    
    public function genContract1515($id)
    {
        //
        $contract = Contract::find($id);
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();
        $initd = new \DateTime($student->initd);
        $endd = new \DateTime($student->endd);

        $initdt = new \DateTime($student->initd);
        $enddt =  new \DateTime($student->endd);

      
        $date2  = $initdt;
        $date5 = $enddt; 
        
        setlocale(LC_ALL,"en_US.utf8");
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
        $templateWord->setValue('length', $converter->to_word($student->length,'dpi'));
        $templateWord->setValue('initd',$initd->format('d/m/Y'));
        $templateWord->setValue('endd',$endd->format('d/m/Y'));

        $templateWord->setValue('date2',$date2->format('d/m/Y'));
        $templateWord->setValue('date3',$date3->format('d/m/Y'));

        $templateWord->setValue('date4',$date4->format('d/m/Y'));
        $templateWord->setValue('date5',$date5->format('d/m/Y'));
        $templateWord->setValue('yearw1',$converter->to_word($initd->format('Y'),'dpi'));
        $templateWord->setValue('yearw2',$converter->to_word($endd->format('Y'),'dpi'));

        //Fechas
        $templateWord->setValue('initdw', $this->dateToWord($initd));
        $templateWord->setValue('initdwd', $this->dayToWord($initd));
        $templateWord->setValue('enddw',$this->dateToWord($endd));

        $templateWord->setValue('date2w', $this->dateToWord($date2));
        $templateWord->setValue('date3w',$this->dateToWord($date3));

        $templateWord->setValue('date4w', $this->dateToWord($date4));
        $templateWord->setValue('date5w',$this->dateToWord($date5));
        $templateWord->setValue('date5wd',$this->dayToWord($date5));

        $templateWord->setValue('initds',$initd->format('d/m/Y'));
        $templateWord->setValue('endds',$endd->format('d/m/Y'));

        $templateWord->setValue('initdsw', $this->dateToWord($initd));
        $templateWord->setValue('enddsw',$this->dateToWord($endd));


        $payl = ($student->payments)-2;

        $templateWord->setValue('paymentslessw', $converter->to_word($payl,'dpi'));

        $templateWord->saveAs('Contrato.docx');
        header("Content-Disposition: attachment; filename=Contrato.docx; charset=iso-8859-1");

        readfile('Contrato.docx');
        

    }
    public function genContract1530($id)
    {
        //
        $contract = Contract::find($id);
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();
        $initd = new \DateTime($student->initd);
        $endd = new \DateTime($student->endd);

        $initdt = new \DateTime($student->initd);
        $enddt =  new \DateTime($student->endd);

      
        $date2  = $initdt;
        $date5 = $enddt; 
        
        setlocale(LC_ALL,"en_US.utf8");
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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/contrato15-30.docx');

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
        $templateWord->setValue('length', $converter->to_word($student->length,'dpi'));
        $templateWord->setValue('initd',$initd->format('d/m/Y'));
        $templateWord->setValue('endd',$endd->format('d/m/Y'));

        $templateWord->setValue('date2',$date2->format('d/m/Y'));
        $templateWord->setValue('date3',$date3->format('d/m/Y'));

        $templateWord->setValue('date4',$date4->format('d/m/Y'));
        $templateWord->setValue('date5',$date5->format('d/m/Y'));
        $templateWord->setValue('yearw1',$converter->to_word($initd->format('Y'),'dpi'));
        $templateWord->setValue('yearw2',$converter->to_word($endd->format('Y'),'dpi'));

        //Fechas
        $templateWord->setValue('initdw', $this->dateToWord($initd));
        $templateWord->setValue('initdwd', $this->dayToWord($initd));
        $templateWord->setValue('enddw',$this->dateToWord($endd));

        $templateWord->setValue('date2w', $this->dateToWord($date2));
        $templateWord->setValue('date3w',$this->dateToWord($date3));

        $templateWord->setValue('date4w', $this->dateToWord($date4));
        $templateWord->setValue('date5w',$this->dateToWord($date5));
        $templateWord->setValue('date5wd',$this->dayToWord($date5));

        $templateWord->setValue('initds',$initd->format('d/m/Y'));
        $templateWord->setValue('endds',$endd->format('d/m/Y'));

        $templateWord->setValue('initdsw', $this->dateToWord($initd));
        $templateWord->setValue('enddsw',$this->dateToWord($endd));


        $payl = ($student->payments)-2;

        $templateWord->setValue('paymentslessw', $converter->to_word($payl,'dpi'));

        $templateWord->saveAs('Contrato.docx');
        header("Content-Disposition: attachment; filename=Contrato.docx; charset=iso-8859-1");

        readfile('Contrato.docx');
        

    }
    

    public function genForm3130($id){

        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);


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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03-1.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));
         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);

        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);


        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',$engagement->payments);
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
            

    }
    public function genForm31515($id){
        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);

        

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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03-15.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));
         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',($engagement->payments-2));
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));
        $templateWord->setValue('grantless',number_format(($engagement->grant-2500),2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));

        $templateWord->setValue('date2', $this->dateToWordNumber($date2));
        $templateWord->setValue('date3',$this->dateToWordNumber($date3));

        $templateWord->setValue('date4', $this->dateToWordNumber($date4));
        $templateWord->setValue('date5',$this->dateToWordNumber($date5));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
        
    }

    public function genForm31530($id){
        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);

        

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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03-1530.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));

         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',($engagement->payments-1));
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));
        $templateWord->setValue('grantless',number_format(($engagement->grant-1250),2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));

        $templateWord->setValue('date2', $this->dateToWordNumber($date2));
        $templateWord->setValue('date3',$this->dateToWordNumber($date3));

        $templateWord->setValue('date4', $this->dateToWordNumber($date4));
        $templateWord->setValue('date5',$this->dateToWordNumber($date5));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
        
    }
    //formulario 15 dias
    public function genForm315d($id){
        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);

        

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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03-15d.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));

         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',($engagement->payments-1));
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));
        $templateWord->setValue('grantless',number_format(($engagement->grant-1250),2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));

        $templateWord->setValue('date2', $this->dateToWordNumber($date2));
        $templateWord->setValue('date3',$this->dateToWordNumber($date3));

        $templateWord->setValue('date4', $this->dateToWordNumber($date4));
        $templateWord->setValue('date5',$this->dateToWordNumber($date5));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
        
    }

    //formulario mes 15 dias
    public function genForm3en($id){
        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);

        

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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03-en.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));

         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);
        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);

        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',($engagement->payments-1));
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));
        $templateWord->setValue('grantless',number_format(($engagement->grant-1250),2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));

        $templateWord->setValue('date2', $this->dateToWordNumber($date2));
        $templateWord->setValue('date3',$this->dateToWordNumber($date3));

        $templateWord->setValue('date4', $this->dateToWordNumber($date4));
        $templateWord->setValue('date5',$this->dateToWordNumber($date5));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
        
    }

    public function genForm3mes($id){

        $datetime1 = new \DateTime();
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        
        $student = Student::find($contract->student);
        $converter = new NumberToLetterConverter();

        

        
        $initd = new \DateTime($engagement->initd);
        $endd = new \DateTime($engagement->endd);

        $date2 = new \DateTime($contract->date2);
        $date3 = new \DateTime($contract->date3);

        $date4 = new \DateTime($contract->date4);
        $date5 = new \DateTime($contract->date5);


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

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-03mes.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));
         $templateWord->setValue('charget',$f->charge);

        $templateWord->setValue('no',$contract->no);
        $templateWord->setValue('year',$contract->year);

        $templateWord->setValue('noe',$engagement->no);
        $templateWord->setValue('yeare',$engagement->year);


        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carrer',$student->carrer);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->setValue('dpi',$student->dpi);
        $templateWord->setValue('academicu',$student->academicu);
        $templateWord->setValue('adress',$student->adressr);
        $templateWord->setValue('homep',$student->homep);
        $templateWord->setValue('personalp',$student->personalp);

        $templateWord->setValue('item',$f->item);
        $templateWord->setValue('nameincharge',$f->nameincharge);
        $templateWord->setValue('nofinancing',$f->noname);

        $templateWord->setValue('headquerter',$h->name);
        $templateWord->setValue('municipality',$m->municipality);
        $templateWord->setValue('departmanet',$d->departament);

        

        $templateWord->setValue('payments',$engagement->payments);
        $templateWord->setValue('grantm',$engagement->grantm);
        $templateWord->setValue('grant',number_format($engagement->grant,2, '.', ','));

        $datefin =new \DateTime($a->date_n);
        $templateWord->setValue('agreement',$a->agreement_n);
        $templateWord->setValue('adate_n',$datefin->format('d/m/Y'));

        //Fechas
        $templateWord->setValue('initd', $this->dateToWordNumber($initd));
        $templateWord->setValue('endd',$this->dateToWordNumber($endd));


        $templateWord->saveAs('AB-USAC-03.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-03.docx; charset=iso-8859-1");

        readfile('AB-USAC-03.docx');
            

    }

    public function genForm05($id)
    {
        //                     
        $engagement = Engagement::find($id);
        $contract = Contract::find($engagement->contract);
        $student = Student::find($contract->student);
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-05.docx');
        $templateWord->setValue('no',$engagement->no);
        $templateWord->setValue('year',$engagement->year);
        $templateWord->setValue('name',$student->name);
        $templateWord->setValue('fsurname',$student->fsurname);
        $templateWord->setValue('ssurname',$student->ssurname);
        $templateWord->setValue('carne',$student->carne);
        $templateWord->saveAs('AB-USAC-05.docx');
        header("Content-Disposition: attachment; filename=AB-USAC-05.docx; charset=iso-8859-1");
        readfile('AB-USAC-05.docx');
        

    }

    public function genForm02($id){
        $student = Student::find($id);
          
        $datetime1 = new \DateTime($student->initd);
        $datetime2 = new \DateTime($student->endd);

        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/ab-usac-02.docx');
        $templateWord->setValue('dd',$datetime1->format('d'));
        $templateWord->setValue('mm',$datetime1->format('m'));
        $templateWord->setValue('yy',$datetime1->format('Y'));

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
        $templateWord->setValue('mount',number_format($student->grant,2, '.', ','));
        $templateWord->setValue('mountl',$student->grantm);

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
        setlocale(LC_ALL,"es_ES.utf8");
        $converter = new NumberToLetterConverterDate();
        $day = $date->format('d');
        $dayl = $converter->to_word($day,'dpi');
        $month = strftime("%B", date_timestamp_get($date));

        return $dayl."de ".$month;


    }

    function dayToWord($date)
    {
        setlocale(LC_ALL,"es_ES.utf8");
        $converter = new NumberToLetterConverterDate();
        $day = $date->format('d');
        $dayl = $converter->to_word($day,'dpi');
        return $dayl;


    }

    function dateToWordNumber($date)
    {
        setlocale(LC_ALL,"es_ES.utf8");
        
        $day = $date->format('d');
    
        $month = strftime("%B", date_timestamp_get($date));
      
        return $day." de ".$month;


    }
}
