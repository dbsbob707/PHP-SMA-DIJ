<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    // get method
    public function show($page_id)
    {
        return view('page.index', [
            "url" => 'key',
            "password" => 'password',
            "expires_at" => 'morgen',
        ]);
    }

    public function index(Request $request, $page_id)
    {
        $value = $request->session()->pull('signin');

        if ($value === True) {
            $message = DB::table('messages')
                ->where('key', '=', $page_id)
                ->first();

            $message->created_at = Carbon::parse($message->created_at);
            $message->messagecontent = Crypt::decryptString($message->messagecontent);

            // dd();
            return view('message.index', [
                'message' => $message,
            ]);
        }
        return view('page.login', [
            'page_id' => $page_id,
        ]);
    }

    // post method
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'key' => 'required',
            'password' => 'required',
        ]);

        $page = DB::table('pages')
            ->where('key', '=', $request->only('key'))
            ->where('password', '=', $request->only('password'))
            ->first();

        // Verify code
        if ($page != null) {
            $request->session()->flash('signin', True);
        }

        // redirect
        return redirect('/' . $request->key);
    }
}
