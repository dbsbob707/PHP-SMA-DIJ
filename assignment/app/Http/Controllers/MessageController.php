<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Message;
use App\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MessageController extends Controller
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

    public function create(): Renderable
    {
        $colleague_emails = Http::get('https://pastebin.com/raw/uDzdKzGG')->json();
        
        // dd($colleague_emails[1]['name']);
        return view('create', [
            'colleague_emails' => $colleague_emails
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'colleague_email' => 'max:255',
            'messagecontent' => 'required',
        ]);

        $key = Str::random(16);
        $password = Str::random(32);

        // Store
        Message::create([
            'key' => $key,
            'colleague_email' => $request->colleague_email,
            'messagecontent' => Crypt::encryptString($request->messagecontent)
        ]);


        Page::create([
            'key' => $key,
            'password' => $password,
            'expires_at' => Carbon::now()->addHours(60),
        ]);

        $colleague_emails = Http::get('https://pastebin.com/raw/uDzdKzGG')->json();
        
        // redirect
        return view('create', [
            'colleague_emails' => $colleague_emails,
            'key' => $key,
            'password' => $password,
        ]);
    }

    public function login(Request $request)
    {
        // validation
        $this->validate($request, [
            'password' => 'required',
        ]);

        // Check the password
        if (auth()->attempt($request->only('password'))) {
            return back();
        }

        // redirect
        return back()->with('status', 'Invalid password');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        if (auth()->check()) {
            $message->messagecontent = Crypt::decryptString($message->messagecontent);
        }

        return view('message.index', [
            'message' => $message
        ]);
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
