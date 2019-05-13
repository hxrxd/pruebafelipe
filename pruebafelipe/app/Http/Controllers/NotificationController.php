<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Notification;
use DB;
use Redirect;
use Response;
use Validator;

class NotificationController extends Controller
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
    public function createNotification()
    {
        $supervisors_mails = DB::table('supervisors')
                  ->join('users','supervisors.iduser','=','users.id')
                  ->select('supervisors.name as name','users.email as mail')
                  ->get();

        return view("notifications.create", compact('supervisors_mails'));
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
     * Store a new notification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notify(Request $request)
    {
      $rules = array(
          'title' => 'required',
          'description' => 'required',
          'email_emisor' => 'required',
          'email_receptor' => 'required',
          'link' => 'required'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
          return Redirect::back()
              ->withInput()
              ->withErrors($validator);
      } else {
          $ntf = new Notification;
          $ntf->title = $request->title;
          $ntf->description = $request->description;
          $ntf->message = $request->message;
          $ntf->email_emisor = $request->email_emisor;
          $ntf->email_receptor = $request->email_receptor;
          $ntf->link = $request->link;
          $ntf->type = $request->type;
          $ntf->updated_at = date('Y-m-d H:i:s');
          $ntf->save();

          return Response::json($ntf);
      }
    }

    /**
     * Returns a list of notifications.
     *
     * @param  int $user
     * @return \Illuminate\Http\Response
     */
    public function getNotifications($email)
    {
        $notifications = Notification::where('email_receptor',$email)->orderBy('created_at','desc')->get();

        return Response::json($notifications);
    }

    /**
     * Update the status of specified notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsSeen(Request $request)
    {
        $notif = Notification::find($request->id);
        $notif->seen = $request->status;
        $notif->updated_at = date('Y-m-d H:i:s');
        $notif->save();

        return Response::json($notif);
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req){
        Notification::find($req->id)->delete();
        return response()->json();
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
