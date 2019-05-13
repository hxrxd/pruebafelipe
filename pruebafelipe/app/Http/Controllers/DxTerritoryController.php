<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnostic;
use App\DxTerritory;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;

class DxTerritoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dx.territory');
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
        DxTerritory::create([
          'name'=>$request['name'],
          'location'=>$request['location'],
          'masl'=>$request['masl'],
          'surface'=>$request['surface'],
          'dx'=>Session::get('dx')->id,
        ]);

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s'),'edit_flag'=>14]);

        return redirect('dx/demography');
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
     * @return \Illuminate\Http\Response
     */
    public function editTerritory()
    {
        $territory = DxTerritory::where('dx',Session::get('dx')->id)->first();
        return view('dx.territory-edit',['territory'=>$territory]);
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
        $territory = DxTerritory::find($id);
        $territory->fill($request->all());
        $territory->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect('dx/2/edit');
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
