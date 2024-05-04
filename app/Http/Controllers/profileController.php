<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\post;
use App\Models\comment;
use App\Models\User;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function profile(){
      $posts=post::select('*')->where('user_id', '=', Auth::user()->id)->orderByRaw('updated_at DESC')->with('user')->with('comment')->get();
      $users = User::with('post')->get();
      $comments = comment::with('post')->with('user')->get();
      

    return view('profile', compact('posts'));
    
  }
}
