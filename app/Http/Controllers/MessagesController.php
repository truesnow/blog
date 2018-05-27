<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index'],
        ]);
    }

    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(30);

        return $this->view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140',
        ]);

        Auth::user()->messages()->create([
            'content' => $request['content'],
        ]);

        return redirect()->back();
    }
}
