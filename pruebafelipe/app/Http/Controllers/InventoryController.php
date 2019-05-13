<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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
use Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $regs = DB::table('inv_details')
            ->join('inv_articles','inv_details.article','=','inv_articles.id')
            ->join('employees','inv_details.employee','=','employees.id')
            ->select('inv_articles.id as id','inv_articles.name as name','inv_articles.description as description','inv_details.observations as observations','inv_articles.cost as cost', 'inv_details.open_date as open_date','inv_details.inv_number as inv_number','inv_details.resp_target_number as resp_target_number','employees.name as incharge')
            ->get();

        return view('inventory_input.index',compact('regs'));
    }

    public function allPurchases(){

        $purchases = DB::table('inv_purchases')
            ->join('inv_providers', 'inv_purchases.provider','=','inv_providers.id')
            ->select('inv_purchases.number as number','inv_providers.name as provider','inv_purchases.oc_no as oc_no', 'inv_purchases.pdate as pdate','inv_purchases.value as value','inv_providers.name as name')
            ->get();

        return view('inventory_input.index_purchases', compact('purchases'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = InvProvider::where('status',1)->orderBy('name','asc')->lists('name','id');
        $articles = InvArticle::orderBy('name','asc')->lists('name','id');
        $inv = InvDetail::orderBy('resp_target_number','desc')->first();
        return view('inventory_input.create', compact('providers','articles','inv'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = InvPurchase::create([
            'number'=>$request['number'],
            'oc_no'=>$request['oc_no'],
            'pdate'=>$request['pdate'],
            'value'=>$request['value'],
            'provider'=>$request['provider'],
            'user'=>Auth::user()->email,
        ]);

        $log = [
          'desc'=>'Se ha registrado el documento de factura No.: '.$purchase->number,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/register/'.$purchase->id);
    }

    public function register($id){
        $purchase = InvPurchase::find($id);
        $provider = InvProvider::find($purchase->provider);
        $employees = DB::table('employees')->where('status',1)->orderBy('name','asc')->lists('name','id');
        $articles = InvArticle::where('provider',$provider->id)->orderBy('name','asc')->lists('name','id');
        return view('inventory_input.regis', compact('purchase','provider','articles','employees'));
    }

    public function fillArticleFields($id){
        $article = DB::table('inv_articles')->where('id',$id)->first();

        return Response::json($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regArticle(Request $request)
    {
        $rules = array(
            'purchase'       => 'required',
            'article'               => 'required',
            'inv_number'               => 'required',
            'open_date'               => 'required',
            'employee'               => 'required',
            'resp_target_number' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $art = new InvDetail;
            $art->purchase = $request->purchase;
            $art->article = $request->article;
            $art->inv_number = $request->inv_number;
            $art->open_date = $request->open_date;
            $art->resp_target_number = $request->resp_target_number;
            $art->employee = $request->employee;
            $art->observations = $request->observations;
            $art->save();

            $log = [
              'desc'=>'Se realizó el registro de inventario No.: '.$art->inv_number,
              'email'=>Auth::user()->email,
            ];

            Log::create($log);

            return Response::json( $art );
        }

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

    public function getReport(){
      $inventory = DB::table('inv_details')
            ->join('inv_articles','inv_details.article','=','inv_articles.id')
            ->select('inv_articles.id as id','inv_articles.name as name','inv_articles.description as description','inv_details.observations as observations','inv_articles.cost as cost', 'inv_details.open_date as open_date','inv_details.inv_number as inv_number','inv_details.resp_target_number as resp_target_number')
            ->get();

        $pdf = \PDF::loadView('report.summary-inventory', compact('inventory'));

        return $pdf->download('ReporteGeneralInventario.pdf');
        //return $pdf->stream();
    }

    public function getPurchasesReport(){
      $purchases = DB::table('inv_purchases')
          ->join('inv_providers', 'inv_purchases.provider','=','inv_providers.id')
          ->select('inv_purchases.number as number','inv_providers.name as provider','inv_purchases.oc_no as oc_no', 'inv_purchases.pdate as pdate', 'inv_purchases.user as user','inv_purchases.value as value','inv_providers.name as name')
          ->get();

        $pdf = \PDF::loadView('report.summary-purchases', compact('purchases'));

        return $pdf->download('ReporteCompras.pdf');
        //return $pdf->stream();
    }
}
