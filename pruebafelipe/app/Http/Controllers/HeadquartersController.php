<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Departament;
use App\Municipality;
use App\Financing;
use App\Team;
use App\Headquarters;
use App\Log;
use App\Supervisor;

use Auth;
use DB;
use Session;
use Redirect;

class HeadquartersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->rol == "Supervisor") {
            $usuario = Auth::user()->id;
            $supervisor = Supervisor::where('iduser','=',$usuario)->get()->first();
            $headquarters = DB::table('headquarters')
                    ->join('teams','headquarters.team','=','teams.id_team')
                    ->select('headquarters.id_headquarters','headquarters.name', 'headquarters.nameincharge','headquarters.charge','headquarters.phone','teams.name as team')
                    ->where('teams.supervisor','=',$supervisor->id_supervisors)
                    ->get();
        return view('headquarters.index',compact('headquarters'));

        }
        else{
            $headquarters = DB::table('headquarters')
                    ->join('teams','headquarters.team','=','teams.id_team')
                    ->select('headquarters.id_headquarters','headquarters.name', 'headquarters.nameincharge','headquarters.charge','headquarters.phone','teams.name as team')
                    ->get();
        return view('headquarters.index',compact('headquarters'));

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
        $team = Team::lists('name','id_team');
        return view('headquarters.create',['team'=>$team]);

       
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
        $log = [
            'desc'=>'Creación de Sede :'.$request['name'],
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Headquarters::create([
            'name'=>$request['name'],
            'nameincharge'=>$request['nameincharge'],
            'charge'=>$request['charge'],
            'phone'=>$request['phone'],
            'team'=>$request['team'],
            'status'=>1,
            ]);
        Session::flash('message','Sede creado exitosamente');
        return Redirect::to('/headquarters');
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
        $headquarter = Headquarters::find($id);
        $log = [
            'desc'=>'Edición de la sede :'.$headquarter['name'],
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        $team = Team::where('status','=','1')->lists('name','id_team');

        return view('headquarters.edit',['team'=>$team,'headquarter'=>$headquarter]);

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

        $headquarter = Headquarters::find($id);
        $all = $request->all();
        $all['status'] = ($request->get('status') === 'on');
        $headquarter->fill($all);
        $headquarter->save();

        Session::flash('message','Sede Actualizada exitosamente');
        return Redirect::to('/headquarters');
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
