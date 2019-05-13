<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Departament;
use App\Municipality;
use App\Gender;
use App\CivilStatus;
use App\Practice;
use App\Headquarters;
use App\Cohorte;
use App\Student;
use App\Team;
use App\NumberToLetterConverter;
use App\NumberToLetterConverterAge;
use App\NumberToLetterConverterDate;
use App\Financing;
use App\SupervisorH;
use App\SupervisorU;
use App\Family;
use App\Contract;
use App\Agreement;
use App\Log;
use App\Receipt;
use DB;
use Session;
use Redirect;
use Auth;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        $payments = DB::table('receipts')
                        ->join('contracts','contracts.id_contracts','=','receipts.contract')
                        ->join('students','receipts.student','=','students.id_student')
                        ->select('students.name','students.fsurname','students.ssurname','students.carne','contracts.id_contracts','receipts.year','contracts.id_contracts','contracts.no','receipts.contract','receipts.id_receipts','receipts.payments','receipts.no','receipts.grant')
                        ->where('receipts.created_at', '>=', '2018-01-01 00:00:00')
                        ->get();

                        

        return view('pay.index',['payments'=>$payments]);
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
        //
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
