<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Agreement;

use Session;
use Redirect;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agreement = Agreement::All();
        return view('agreement.index',compact('agreement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('agreement.create');
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
        Agreement::create([
            'agreement_n'=>$request['agreement_n'],
            'agreement_w'=>$request['agreement_w'],
            'date_n'=>$request['date_n'],
            'date_w'=>$request['date_w'],
            ]);

        Session::flash('message','Acuerdo creado exitosamente');
        return Redirect::to('/agreement');

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

        $agreement = Agreement::find($id);
        return view('agreement.edit',['agreement'=>$agreement]);
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
        $agreement = Agreement::find($id);
        $agreement->fill($request->all());
        $agreement->save();

         Session::flash('message','Acuerdo editado exitosamente');
        return Redirect::to('/agreement');

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
