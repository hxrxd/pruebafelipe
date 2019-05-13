<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cohorte;
use App\Log;
use Session;
use Redirect;
use Auth;

class CohorteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cohortes = Cohorte::All();
        return view('cohorte.index',compact('cohortes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cohorte.create');
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
        Cohorte::create([
                'cohorte'=>$request['cohorte'],
                'status'=>1,
            ]);

        Session::flash('message','Cohorte creada exitosamente');
        return Redirect::to('/cohortes');
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
        $cohorte = Cohorte::find($id);
        return view('cohorte.edit',compact('cohorte'));
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

        $cohorte = Cohorte::find($id);
        $all = $request->all();
        $all['status'] = ($request->get('status') === 'on');
        $cohorte->fill($all);
        $cohorte->save();



        $log = [
            'desc'=>'Modificación de cohorte',
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Contrato actualizado exitosamente');
        return Redirect::to('/cohortes');
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
