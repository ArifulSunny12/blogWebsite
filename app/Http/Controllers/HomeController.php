<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\comment;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=post::select('*')->orderByRaw('updated_at DESC')->with('user')->with('comment')->get();
        $users = User::with('post')->get();
        $comments = comment::with('post')->with('user')->get();
      

        return view('home', compact('posts'));
        
    }
}
