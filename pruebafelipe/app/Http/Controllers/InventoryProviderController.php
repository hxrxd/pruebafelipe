<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\InvProvider;
use App\InvDetail;
use App\InvArticle;
use App\InvPurchase;
use App\Log;
use DB;
use Auth;
use Session;
use Redirect;
use View;
use Response;

class InventoryProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory_provider.create');
    }


    public function allProviders()
    {
        $providers = InvProvider::where('status',1)->orderBy('name','asc')->get();
        return view('inventory_provider.index',compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prov = InvProvider::create([
            'name'=>$request['name'],
            'nit'=>$request['nit'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
        ]);

        $log = [
          'desc'=>'Se ha registrado el proveedor: '.$prov->name,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/provider/create');
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
        $prov = InvProvider::find($id);
        return view('inventory_provider.edit', compact('prov'));
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
        $prov = InvProvider::find($id);
        $prov->fill($request->all());
        $prov->save();

        $log = [
          'desc'=>'Se ha actualizado la información del proveedor: '.$prov->name,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/providers');
    }

    public function dismiss($id)
    {

        DB::table('inv_providers')
          ->where('id',$id)
          ->update(['status'=>0]);

        $prov = InvProvider::find($id);

        $log = [
          'desc'=>'Se ha dado de baja al proveedor: '.$prov->name,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/providers');
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

    public function getReport(){
        $providers = InvProvider::where('status',1)->orderBy('name','asc')->get();

        $pdf = \PDF::loadView('report.summary-providers', compact('providers'));

        return $pdf->download('ReporteProveedores.pdf');
        //return $pdf->stream();
    }
}
