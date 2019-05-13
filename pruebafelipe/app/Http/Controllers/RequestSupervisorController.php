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

use Auth;
use DB;
use Session;
use Redirect;

class RequestSupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Coordinador
        if (Auth::user()->rol == "Coordinador") {
            # code...
            $usuario = Auth::user()->id;
            $ncohorte = Cohorte::where('status',1)->get()->first();
            
            $assignment = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                        ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                        ->join('supervisors','teams.supervisor', '=', 'supervisors.id_supervisors')
                        ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                        ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                        ->select('supervisors.name as namesuper','requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
                        ->where('requeriments_assignment.cohorte','like', $ncohorte->next)
                        ->where('requeriments_assignment.value',1)
                        ->orderBy('equipo', 'ASC')
                        ->get();
            $reqAct = DB::table('conf')->where('description','request')->first();
            
            return view('requerimentsupervisors.index', compact('assignment','ncohorte','reqAct'));
        }
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
        $html ="<select class='js-example-basic-multiple' name='states[]' multiple='multiple' style='width:100%;' id='UA' required>";
        $data = RequerimentsAssignment::join('headquarters', 'requeriments_assignment.headquarter', '=', 'headquarters.id_headquarters')
                                ->join('teams', 'headquarters.team', '=', 'teams.id_team')
                                ->join('supervisors','teams.supervisor', '=', 'supervisors.id_supervisors')
                                ->join('municipality', 'teams.municipality', '=', 'municipality.id_municipality')
                                ->join('departament', 'municipality.id_departament', '=', 'departament.id_departament')
                                ->select('supervisors.name as namesuper','requeriments_assignment.id as id','departament.departament as dp', 'municipality.municipality as mun', 'teams.name as equipo', 'headquarters.name as sede', 'requeriments_assignment.meta_discipline as disciplina', 'requeriments_assignment.academic_unit as ua', 'requeriments_assignment.value as act')
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
        
        return view('requerimentsupervisors.edit',['data'=>$data,'pla'=>$pla,'m'=>$m]);
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $es='';
        $requestRequeriment = RequerimentsAssignment::find($id);
        foreach ($request['states'] as $key) {
            # code...
            $es = $es.$key.'/';
        }
        $es = substr($es, 0, -1);
        $requestRequeriment->academic_unit = $es;
        $requestRequeriment->save();
        Session::flash('message','Unidades académicas actualizadas exitosamente');
        return Redirect::to('/requestsupervisor');
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
