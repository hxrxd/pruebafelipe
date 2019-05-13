<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnostic;
use App\DxHealth;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;

class DxHealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dx.health');
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
      DxHealth::create([
        'rate_access_primary_health_care'=>$request['rate_access_primary_health_care'],
        'rate_diseases_by_contaminated_water'=>$request['rate_diseases_by_contaminated_water'],
        'rate_chronic_malnutrition'=>$request['rate_chronic_malnutrition'],
        'diseases'=>$request['diseases'],
        'dx'=>Session::get('dx')->id,
      ]);

      DB::table('diagnostics')
        ->where('id',Session::get('dx')->id)
        ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s'),'edit_flag'=>56]);

      return redirect('dx/education');
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
    public function editHealth()
    {
        $health = DxHealth::where('dx',Session::get('dx')->id)->first();
        return view('dx.health-edit',['health'=>$health]);
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
        $health = DxHealth::find($id);
        $health->fill($request->all());
        $health->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect('dx/5/edit');
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
