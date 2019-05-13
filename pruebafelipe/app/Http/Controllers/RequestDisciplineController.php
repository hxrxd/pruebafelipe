<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\Supervisor;
use App\Departament;
use App\Municipality;
use App\MetaDisciplines;
use App\RequerimentsAssignment;
use App\Student;
use App\Cohorte;
use App\Team;
use App\Headquarters;
use App\Conf;

use Auth;
use DB;
use Session;
use Redirect;

class RequestDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol == "Supervisor") {
            # code...
            $usuario = Auth::user()->id;
            $supervisor = Supervisor::where('iduser',$usuario)->get()->first();
            $ncohorte = Cohorte::where('status',1)->get()->first();
            $assignment;
            $flagMeta = RequerimentsAssignment::where('cohorte','like',$ncohorte->next)
                                            ->where('id_supervisors',$supervisor->id_supervisors)
                                            ->get()->first();
            if (count($flagMeta)==0) {
                # code...
                $tempTable = Student::join('headquarters','students.headquarter','=','headquarters.id_headquarters')
                                    ->join('teams','headquarters.team','=','teams.id_team')
                                    ->join('supervisors','teams.supervisor','=','supervisors.id_supervisors')
                                    ->join('meta_discipline', 'students.carrer','=', 'meta_discipline.carrer')
                                    ->join('cohortes','students.cohorte','=','cohortes.id')
                                    ->select('headquarters.id_headquarters as sede','meta_discipline.metacarrer as disciplina','students.academicu as ua')
                                    ->distinct()
                                    ->where('supervisors.id_supervisors',$supervisor->id_supervisors)
                                    ->where('cohortes.name','like',$ncohorte->previous)
                                    ->get();
                foreach ($tempTable as $key) {
                    # code...
                    RequerimentsAssignment::create([
                        'headquarter'=> $key->sede,
                        'meta_discipline'=> $key->disciplina,
                        'academic_unit'=> $key->ua,
                        'cohorte'=>$ncohorte->next,
                        'id_supervisors'=>$supervisor->id_supervisors,
                        'value'=> 1,
                    ]);
                }
                $assignment = $this->getdata($supervisor->id_supervisors, $ncohorte->next);
            } else {
                # code...
                $assignment = $this->getdata($supervisor->id_supervisors, $ncohorte->next);
            }
            $reqAct = DB::table('conf')->where('description','request')->first();

            return view('requerimentassignment.index', compact('assignment','ncohorte','reqAct'));
        }
    }

    public function getdata($idSupervisor, $cohort){
        $data = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                                ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                                ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                                ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                                ->select('requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
                                ->where('teams.supervisor', $idSupervisor)
                                ->where('requeriments_assignment.cohorte','like', $cohort)
                                ->orderBy('equipo', 'ASC')
                                ->get();
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $metadisciplinas = MetaDisciplines::distinct()->lists('metacarrer','metacarrer');
            $departament = Departament::lists('departament','id_departament');
            
            return view('requerimentassignment.create',compact('metadisciplinas','departament'));
    }
    public function getRequest()
    {   
        $ncohorte = Cohorte::where('status',1)->get()->first();
        $assignment = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                    ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                    ->join('supervisors','teams.supervisor', '=', 'supervisors.id_supervisors')
                    ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                    ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                    ->select('supervisors.name as namesuper','requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
                    ->where('requeriments_assignment.cohorte','like', $ncohorte->name)
                    ->where('requeriments_assignment.value','<>',0)
                    ->orderBy('equipo', 'ASC')
                    ->get();
        if (count($assignment)===0) {
            return view('stats_new.assignmentempty');
        }else{
            $departament = Departament::join('municipality','departament.id_departament','=','municipality.id_departament')
                                ->join('teams','municipality.id_municipality','=','teams.municipality')
                                ->where('teams.status',1)
                                ->lists('departament.departament','departament.id_departament');
            return view('stats_new.requestheadquarter',compact('departament'));
        }
        
    }
    public function getTablaData($dp, $mn){
        $ncohorte = Cohorte::where('status',1)->get()->first();
        $html ='';
        $assignment = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                    ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                    ->join('supervisors','teams.supervisor', '=', 'supervisors.id_supervisors')
                    ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                    ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                    ->select('supervisors.name as namesuper','requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
                    ->where('requeriments_assignment.cohorte','like', $ncohorte->name)
                    ->where('requeriments_assignment.value','<>',0)
                    ->where('departament.id_departament',$dp)
                    ->where('municipality.id_municipality',$mn)
                    ->orderBy('equipo', 'ASC')
                    ->get();
        
        if (count($assignment)===0) {
            # code...
            $html = '<h2> Aún no se han aperturado sedes para la siguiente corhorte, para más información puedes entrar a nuestra página: epsum.usac.edu.gt </h2>';
        } else {
            # code...
            $html = ' <div style="margin-bottom: 20px;" class="table-responsive">
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:right;">Equipo</th>
                                <th style="text-align:right;">Sede</th>
                                <th style="text-align:right;">Disciplina</th>
                                <th style="text-align:right;">Unidad Académica</th>
                                <th style="text-align:right;">Disponibilidad</th>
                            </tr>
                        </thead>
                    <tbody>';
            foreach ($assignment as $key) {
                # code...
                $html = $html.'
                    <tr>
                        <td style="text-align:right;">'. $key->equipo .'</td>
                        <td style="text-align:right;">'. $key->sede .'</td>
                        <td style="text-align:right;">'. $key->disciplina .'</td>
                        <td style="text-align:right;">'. $key->ua .'</td>';
                if ($key->act===1) {
                    # code...
                    $html = $html.' <td class="color-green" style="text-align:right;">Disponible</td>
                                    </tr>';
                } else if ($key->act===2){
                    # code...
                    $html = $html.' <td class="color-red" style="text-align:right;"> Ocupado</td>
                                    </tr>';
                }
            }
            $html = $html.'</tbody>
                </table>
                </div>';
            //dd($assignment);
        }
        return Response::json(compact('html'));
    }
    public function getmunicipalityD($dp){
        $html ='<select required class="js-example-basic-single form-control m-b" id="municipal" name="municipal" tablaindex ="2">';
        $municipality = Municipality::join('departament','municipality.id_departament', '=', 'departament.id_departament')
                                    ->join('teams','municipality.id_municipality','=','teams.municipality')
                                    ->distinct()
                                    ->select('municipality.id_municipality as id', 'municipality.municipality as mn')
                                    ->where('teams.status',1)
                                    ->where('departament.id_departament',$dp)
                                    ->get();
            foreach ($municipality as $key) {
                # code...
                $html=$html.'<option value="'.$key->id.'">'.$key->mn.'</option>';
            }
        $html = $html.'</select>';
        return Response::json(compact('html'));
    }
    public function getmunicipality($dp){
        $html ='<select required class="form-control m-b chosen-selec" id="municipal" name="municipal" tablaindex ="2">';
        $municipality = Municipality::join('departament','municipality.id_departament', '=', 'departament.id_departament')
                                    ->where('departament.id_departament',$dp)
                                    ->get();
            foreach ($municipality as $key) {
                # code...
                $html=$html.'<option value="'.$key->id_municipality.'">'.$key->municipality.'</option>';
            }
        $html = $html.'</select>';
        return Response::json(compact('html'));
    }
    public function getteam($mn){
        $html ='<select required class="form-control m-b chosen-selec" id="tm" name="tm">';
        $municipality = Team::join('municipality','teams.municipality', '=', 'municipality.id_municipality')
                                    ->where('municipality.id_municipality',$mn)
                                    ->where('teams.status','=',1)
                                    ->get();
            foreach ($municipality as $key) {
                # code...
                $html=$html.'<option value="'.$key->id_team.'">'.$key->name.'</option>';
            }
        $html = $html.'</select>';
        return Response::json(compact('html'));
    }
    public function getsede($tm){
        $html ='<select required class="form-control m-b chosen-selec" id="sd" name="sd">';
        $sede = Headquarters::join('teams','headquarters.team', '=', 'teams.id_team')
                            ->distinct()
                            ->select('headquarters.name as name','headquarters.id_headquarters as id')
                            ->where('teams.id_team',$tm)
                            ->where('headquarters.status','=',1)
                            ->get();
            foreach ($sede as $key) {
                # code...
                $html=$html.'<option value="'.$key->id.'">'.$key->name.'</option>';
            }
        $html = $html.'</select>';
        return Response::json(compact('html'));
    }
    public function getUA($ds){
        $html ="<select class='js-example-basic-multiple' name='states[]' multiple='multiple' style='width:100%;' id='UA' required>";
        $UA = MetaDisciplines::select('academic')
                            ->where('metacarrer','like',$ds)
                            ->get();
        foreach ($UA as $key) {
            # code...
            $html=$html.'<option value="'.$key->academic.'">'.$key->academic.'</option>';
        }
        $html = $html.'</select>';
        return Response::json(compact('html'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $es = '';
        $usuario = Auth::user()->id;
        $supervisor = Supervisor::where('iduser',$usuario)->get()->first();
        if ($supervisor != null) {
            # code...
            $ncohorte = Cohorte::where('status',1)->get()->first();

            foreach ($request['states'] as $key) {
                # code...
                $es = $es.$key.'/';
            }
            $es = substr($es, 0, -1);
            RequerimentsAssignment::create([
                'headquarter' => $request['sd'],
                'meta_discipline' => $request['meta'],
                'academic_unit' => $es,
                'cohorte' => $ncohorte->next,
                'id_supervisors' => $supervisor->id_supervisors,
                'value' => 1,
            ]);
            
            Session::flash('message','Solicitud de disciplina creado exitosamente');
            return Redirect::to('/requestdisciplines');
        } else {
            # code...
            $ncohorte = Cohorte::where('status',1)->get()->first();
            $h = Headquarters::find($request['sd']);
            $t = Team::find($h->team);
            $supervisor = $t->supervisor;
            foreach ($request['states'] as $key) {
                # code...
                $es = $es.$key.'/';
            }
            $es = substr($es, 0, -1);
            RequerimentsAssignment::create([
                'headquarter' => $request['sd'],
                'meta_discipline' => $request['meta'],
                'academic_unit' => $es,
                'cohorte' => $ncohorte->next,
                'id_supervisors' => $supervisor,
                'value' => 1,
            ]);
            
            Session::flash('message','Solicitud de disciplina creado exitosamente');
            return Redirect::to('/requestsupervisor');
        }
        
       
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
        $html ="<select class='js-example-basic-multiple' name='states[]' multiple='multiple' style='width:100%;' id='UA' required>";
        $data = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                                ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                                ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                                ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                                ->select('requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
                                ->where('requeriments_assignment.id', $id)
                                ->orderBy('equipo', 'ASC')
                                ->get()->first();
        $meta = MetaDisciplines::select('academic')
                                ->where('metacarrer',$data->disciplina)
                                ->get();
        $m;
        foreach ($meta as $key) {
            # code...
            $m[] = $key->academic;
        }
        $pla= explode('/', $data->ua);
        foreach ($pla as $key => $value) {
            # code...
            $m=$this->remover($value,$m);
        }
        
        return view('requerimentassignment.edit',['data'=>$data,'pla'=>$pla,'m'=>$m]);
    }
    function remover ($valor,$arr)
    {
        foreach (array_keys($arr, $valor) as $key) 
        {
            unset($arr[$key]);
        }
        //echo "Removiendo: ".$valor."\n\n";
        return $arr;
    }
    public function activate($idRequest, $value){
        $requestRequeriment = RequerimentsAssignment::find($idRequest);
        $requestRequeriment->value = $value;
        $requestRequeriment->save();
        $result='Cambio realizado';
        return Response::json(compact('result'));
    }
    public function actrequeriment($idRequest, $value){
        $conf = Conf::find($idRequest);
        $conf->act = $value;
        $conf->save();
        $result='Sucess';
        return Response::json(compact('result'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $es='';
        $requestRequeriment = RequerimentsAssignment::find($id);
        foreach ($request['states'] as $key) {
            # code...
            $es = $es.$key.'/';
        }
        $es = substr($es, 0, -1);
        $requestRequeriment->academic_unit = $es;
        $requestRequeriment->save();
        Session::flash('message','Unidades académicas actualizadas exitosamente');
        return Redirect::to('/requestdisciplines');
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
