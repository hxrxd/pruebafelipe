<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnostic;
use App\DxDemography;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;

class DxDemographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dx.demography');
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
      DxDemography::create([
        'description'=>$request['description'],
        'population_0_to_14'=>$request['population_0_to_14'],
        'population_15_to_64'=>$request['population_15_to_64'],
        'population_65_or_more'=>$request['population_65_or_more'],
        'population_women'=>$request['population_women'],
        'population_men'=>$request['population_men'],
        'population_indigenous'=>$request['population_indigenous'],
        'population_rural'=>$request['population_rural'],
        'population_urban'=>$request['population_urban'],
        'population_garifuna'=>$request['population_garifuna'],
        'population_xinca'=>$request['population_xinca'],
        'dx'=>Session::get('dx')->id,
      ]);

      DB::table('diagnostics')
        ->where('id',Session::get('dx')->id)
        ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s'),'edit_flag'=>28]);

    return redirect('dx/economy');
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
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editDemography()
    {
        $demography = DxDemography::where('dx',Session::get('dx')->id)->first();
        return view('dx.demography-edit',['demography'=>$demography]);
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
        $demography = DxDemography::find($id);
        $demography->fill($request->all());
        $demography->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect('dx/3/edit');
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
