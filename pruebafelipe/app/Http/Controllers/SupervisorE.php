<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\Supervisor;
use DB;
use Session;
use Redirect;

class SupervisorE extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors =  DB::table('supervisors')
                        ->join('users','supervisors.iduser','=','users.id')
                        ->select('supervisors.*','users.email')
                        ->get();
        return view('supervisore.index',compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users =  User::lists('email','id');
        return view('supervisore.create',compact('users'));
        
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


        Supervisor::create([
            'name'=>$request['name'],
            'iduser'=>$request['user'],
            'phone'=>$request['phone'],
            'region'=>$request['region'],
            ]);

        Session::flash('message','Usuario Creado exitosamente');
        return Redirect::to('/supervisore');
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
        $supervisor = Supervisor::find($id);
        $users =  User::lists('email','id');
        return view('supervisore.edit',['supervisor'=>$supervisor,'users'=>$users]);
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
        
        $supervisor = Supervisor::find($id);
        $supervisor->fill($request->all());
        $supervisor->save();

        Session::flash('message','Supervisor Actualizado exitosamente');
        return Redirect::to('/supervisore');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
