<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\Correlatives;

use DB;
use Session;
use Redirect;
use Auth;

class CorrelativesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $correlatives = DB::table('correlatives')
                        ->join('users','correlatives.email','=','users.email')
                        ->where('correlatives.year',"=",date("Y"))
                         ->select('correlatives.id','correlatives.email','correlatives.no','correlatives.year','correlatives.subject','correlatives.to','correlatives.created_at')
                        ->orderBy('correlatives.no', 'desc')
                         ->get();

         return view('correlatives.index',compact('correlatives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('correlatives.create');

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
        $correlative = Correlatives::where('year',date("Y"))->orderBy('no')->get();
        $lastcorrelative = $correlative->last();
        if ($lastcorrelative == null) {
            $no = 1;
        }
        else{
            $no = $lastcorrelative->no +1;
        }

        $description = "";

        if ($request['description'] != null) {
                $description = $request['description'];
        }

        Correlatives::create([
                'no'=>$no,
                'year'=>date("Y"),
                'subject'=>$request['subject'],
                'to'=>$request['to'],
                'description'=>$description,
                'email'=>$request['email']
                
            ]);
        $log = [
            'desc'=>'Creacion de correlativo',
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Correlativo creado exitosamente');
        return Redirect::to('/correlatives');
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
         $correlative = Correlatives::find($id);
         return view('correlatives.edit',compact('correlative'));
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
        $correlative = Correlatives::find($id);
        $all = $request->all();
        $correlative->fill($all);
        $correlative->save();

         $log = [
            'desc'=>'Modificación de correlativo número: '.$correlative->no.'-'.$correlative->year,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Correlativo actualizado exitosamente');
        return Redirect::to('/correlatives');
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
