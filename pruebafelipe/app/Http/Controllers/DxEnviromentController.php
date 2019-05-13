<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnostic;
use App\DxEnviroment;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;

class DxEnviromentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dx.enviroment');
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
      DxEnviroment::create([
        'forest_cover_rate'=>$request['forest_cover_rate'],
        'num_plans_integral_management_solid_waste'=>$request['num_plans_integral_management_solid_waste'],
        'land_use_rate'=>$request['land_use_rate'],
        'dx'=>Session::get('dx')->id,
      ]);

      DB::table('diagnostics')
        ->where('id',Session::get('dx')->id)
        ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s'),'edit_flag'=>84]);

      return redirect('dx/municipalmanagement');
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
    public function editEnviroment()
    {
        $enviroment = DxEnviroment::where('dx',Session::get('dx')->id)->first();
        return view('dx.enviroment-edit',['enviroment'=>$enviroment]);
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
        $enviroment = DxEnviroment::find($id);
        $enviroment->fill($request->all());
        $enviroment->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect('dx/7/edit');
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
