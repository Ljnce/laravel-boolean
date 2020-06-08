<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


use App\Mail\SendNewMail;
use App\Message;
use App\Page;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = Message::all();
        $pages = Page::all();

        return view('admin.messages.index', compact('messages', 'pages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();



        // if(Auth::check()) {
        //     $data['user_id'] = Auth::id();
        // }
        // else {
        //     $data['user_id'] = Auth::loginUsingId($data['user_id'], true);
        // }


//     @auth
//     // The user is authenticated...
// @endauth
//
// @guest
//     // The user is not authenticated...
// @endguest
$data['user_id'] = Auth::id();
            $validator = Validator::make($data, [
                'email' => 'required',
                'message' => 'required',
            ]);


        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $message = new Message;
        $message->fill($data);
        $saved = $message->save();

        if(!$saved) {
            abort('404');
        }

        
        Mail::to('mail@mail.it')->send(new SendNewMail($message));
        return redirect()->back()->with('status', 'messaggio inviato correttamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.messages.show', compact('message'));
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
