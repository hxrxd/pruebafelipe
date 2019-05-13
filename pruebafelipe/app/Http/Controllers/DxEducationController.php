<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnostic;
use App\DxEducation;
use App\Cohorte;
use App\Student;
use App\Headquarters;
use App\Team;
use DB;
use Auth;
use Session;
use Redirect;

class DxEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dx.education');
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
      DxEducation::create([
        'percentage_math_test_approval_primary'=>$request['percentage_math_test_approval_primary'],
        'percentage_math_test_approval_secondary'=>$request['percentage_math_test_approval_secondary'],
        'percentage_math_test_approval_diversified'=>$request['percentage_math_test_approval_diversified'],
        'percentage_reading_test_approval_primary'=>$request['percentage_reading_test_approval_primary'],
        'percentage_reading_test_approval_secondary'=>$request['percentage_reading_test_approval_secondary'],
        'percentage_reading_test_approval_diversified'=>$request['percentage_reading_test_approval_diversified'],
        'dx'=>Session::get('dx')->id,
      ]);

      DB::table('diagnostics')
        ->where('id',Session::get('dx')->id)
        ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s'),'edit_flag'=>70]);

      return redirect('dx/enviroment');
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
    public function editEducation()
    {
        $education = DxEducation::where('dx',Session::get('dx')->id)->first();
        return view('dx.education-edit',['education'=>$education]);
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
        $education = DxEducation::find($id);
        $education->fill($request->all());
        $education->save();

        DB::table('diagnostics')
          ->where('id',Session::get('dx')->id)
          ->update(['user_update'=>Session::get('username'),'updated_at'=>date('Y-m-d H:i:s')]);

        return redirect('dx/6/edit');
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
