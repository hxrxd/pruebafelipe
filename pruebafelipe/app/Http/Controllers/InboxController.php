<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Log;
use App\Inbox;
use App\User;
use DB;
use Session;
use Redirect;
use Auth;



class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $inbox = DB::table('inboxes')
                        ->join('users','inboxes.email','=','users.email')
                        ->where('inboxes.year',"=",date("Y"))
                         ->select('inboxes.id_inbox','inboxes.email','inboxes.no','inboxes.year','inboxes.sender','inboxes.message','users.fname','users.lname','inboxes.datein')
                        ->orderBy('inboxes.no', 'desc')
                        ->get();

         return view('inbox.index',compact('inbox'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::where('rol','!=','Estudiante')->select(DB::raw("CONCAT(fname,' ',lname) as name"),'email')->lists('name','email');
        
        return view('inbox.create',compact('users'));
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
        $inbox = Inbox::where('year',date("Y"))->orderBy('no')->get();
        $lastinbox = $inbox->last();
        if ($lastinbox == null) {
            $no = 1;
        }
        else{
            $no = $lastinbox->no +1;
        }

        $description = "";

        if ($request['description'] != null) {
                $description = $request['description'];
        }

        Inbox::create([
                'no'=>$no,
                'year'=>date("Y"),
                'datein'=>$request['datein'],
                'sender'=>$request['sender'],
                'message'=>$request['message'],
                'subject'=>$request['subject'],
                'email'=>$request['receiver'],
                'observation'=>$description,
                'status'=>1,
                'rev'=>0,
                'processing'=>""
                
            ]);

         $log = [
            'desc'=>'Creacion de correspondecia nueva',
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Correspondecia nueva ingresada exitosamente');
        return Redirect::to('/inbox');
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
        $users = User::where('rol','!=','Estudiante')->select(DB::raw("CONCAT(fname,' ',lname) as name"),'email')->lists('name','email');
        $inbox = Inbox::find($id);
        
        return view('inbox.edit',['users'=>$users,'inbox'=>$inbox]);

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
        $inbox = Inbox::find($id);
        $all = $request->all();
        $all['status'] = ($request->get('status') === 'on');
        $inbox->fill($all);
        $inbox->save();

         $log = [
            'desc'=>'Modificación de buzon de entrada número: '.$inbox->no.'-'.$inbox->year,
            'email'=>Auth::user()->email,
        ];

        Log::create($log);

        Session::flash('message','Buzón de entrada actualizado exitosamente');
        return Redirect::to('/inbox');
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

    public function genInbox($id)
    {
        $inbox = Inbox::find($id);
        $date = new \DateTime($inbox->datein);
        $user = User::where('email','=',$inbox->email)->first();
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('doc/trasladodedocumentos.docx');
        $templateWord->setValue('no',$inbox->no);
        $templateWord->setValue('year',$inbox->year);
        $templateWord->setValue('datein',$date->format('d/m/Y'));
        $templateWord->setValue('sender',$inbox->sender);
        $templateWord->setValue('message',$inbox->message);
        $templateWord->setValue('receiver',$inbox->email);
        $templateWord->setValue('subject',$inbox->subject);
        $templateWord->setValue('observation',$inbox->observation);

        $templateWord->setValue('lname',$user->lname);
        $templateWord->setValue('fname',$user->fname);
       
        $templateWord->saveAs('Traslado.docx');
        header("Content-Disposition: attachment; filename=Traslado.docx; charset=iso-8859-1");
        readfile('Traslado.docx');


    }
}
