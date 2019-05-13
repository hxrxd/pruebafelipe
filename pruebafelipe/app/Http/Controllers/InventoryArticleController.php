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

class InventoryArticleController extends Controller
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

    public function allArticles()
    {
        $articles = DB::table('inv_articles')
              ->join('inv_providers','inv_articles.provider','=','inv_providers.id')
              ->select('inv_articles.id as id','inv_articles.name as name','inv_articles.description as description', 'inv_providers.name as provider','inv_articles.cost as cost','inv_articles.status as status')
              ->get();
        //$artcles = InvArticle::orderBy('name','asc')->get();
        return view('inventory_article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = InvProvider::where('status',1)->orderBy('name','asc')->lists('name','id');
        return view('inventory_article.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $art = InvArticle::create([
            'name'=>$request['name'],
            'description'=>$request['description'],
            'provider'=>$request['provider'],
            'cost'=>$request['cost'],
        ]);

        $log = [
          'desc'=>'Se ha registrado el bien mueble: '.$art->name,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/article/create');
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
        $art = InvArticle::find($id);
        $providers = InvProvider::where('status',1)->orderBy('name','asc')->lists('name','id');
        return view('inventory_article.edit', compact('art','providers'));
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
        $art = InvArticle::find($id);
        $art->fill($request->all());
        $art->save();

        $log = [
          'desc'=>'Se ha actualizado la información del bien mueble: '.$art->name,
          'email'=>Auth::user()->email,
        ];

        Log::create($log);

        return redirect('inventory/articles');
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
      $articles = DB::table('inv_articles')
            ->join('inv_providers','inv_articles.provider','=','inv_providers.id')
            ->select('inv_articles.id as id','inv_articles.name as name','inv_articles.description as description', 'inv_providers.name as provider','inv_articles.cost as cost','inv_articles.status as status')
            ->get();

        $pdf = \PDF::loadView('report.summary-articles', compact('articles'));

        return $pdf->download('ReporteBienes.pdf');
        //return $pdf->stream();
    }
}
